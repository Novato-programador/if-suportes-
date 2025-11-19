<?php

namespace App\Controllers;

use App\Models\ChamadoModel;
use App\Models\ArquivoModel;
use App\Models\UsuarioModel;
use App\Models\AtendimentoModel;
use App\Models\HistoricoModel;
use PhpParser\Node\Stmt\TryCatch;

class Chamados extends BaseController
{
    protected $chamadoModel;
    protected $arquivoModel;
    protected $usuarioModel;
    protected $atendimentoModel;
    protected $historicoModel;

    public function __construct()
    {
        $this->chamadoModel = new ChamadoModel();
        $this->arquivoModel = new ArquivoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->atendimentoModel = new AtendimentoModel();
        $this->historicoModel = new HistoricoModel();
    }

    // Método para buscar anexos de um chamado
    public function anexos($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([]);
        }

        // Obter o ID do chamado a partir da chave
        $chamado_id = $this->chamadoModel->obterId($id);
        if (!$chamado_id) {
            return $this->response->setJSON([]);
        }

        // Buscar os anexos do chamado
        $anexos = $this->arquivoModel->obterTodos($chamado_id);

        // Formatar os anexos para exibição em lista
        $formattedAnexos = [];
        foreach ($anexos as $anexo) {
            $formattedAnexos[] = [
                'id' => $anexo['id'],
                'nome' => $anexo['nome'],
                'tipo' => $anexo['typeMine'],
                'data' => $anexo['created_at'],
                'url' => base_url('assets/uploads/' . $anexo['nome'])
            ];
        }

        return $this->response->setJSON($formattedAnexos ?: []);
    }

    public function index()
    {

        $isLogged = session()->get('token');
        $user = base64_decode($isLogged);
        $isLogged = json_decode($user);

        if ($isLogged) {
            $data = [
                "data" => $this->chamadoModel->obterTodos(),
                "permissao" => [
                    "nivel" => $isLogged->nivel,
                    "setor" =>  $isLogged->setor
                ],
                "user" => json_decode($user)->user
            ];

            return view('chamados/index', $data);
        }

        return redirect()->to(base_url('login'));
    }
    public function carregarChamados()
    {
        if ($this->request->isAJAX()) {

            $data = [
                "atividadeRecente" => $this->usuarioModel->obterAtividadeRecente(),
                "usuariosAtivos" => $this->usuarioModel->obterTotalUsuariosAtivos(),
                "chamadosAbertos" => $this->chamadoModel->obterTotalChamadosAbertos(),
                "chamadosAndamento" => $this->chamadoModel->obterTotalChamadosEmAndamento(),
                "chamadosConcluido" => $this->chamadoModel->obterTotalChamadosConcluido(),
            ];
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Comunicação realizada com sucesso',
                'data' => $data
            ]);
        } else {
            $this->response->setJSON([
                'success' => false,
                'message' => 'Faça login para continuar',
                'errorLogin' => true
            ]);
        }
        return $this->response->setStatusCode(404);
    }

    /**
     * Método para paginação de chamados via AJAX
     */
    public function paginar()
    {
        if ($this->request->isAJAX()) {
            $isLogged = session()->get('token');
            $user = base64_decode($isLogged);
            $isLogged = json_decode($user);

            if (!$isLogged) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Faça login para continuar',
                    'errorLogin' => true
                ]);
            }

            $page = $this->request->getGet('page') ?? 1;
            $limit = $this->request->getGet('limit') ?? 15;
            $status = $this->request->getGet('status') ?? null;
            $search = $this->request->getGet('search') ?? '';

            // Obter chamados paginados
            $chamados = $this->chamadoModel->obterTodosPaginado($status, $page, $limit, $search);

            // Contar total de registros
            $total = $this->chamadoModel->contarChamadosPorStatus($status, $search);

            // Calcular informações de paginação
            $totalPages = ceil($total / $limit);

            $pagination = [
                'current_page' => (int)$page,
                'total_pages' => $totalPages,
                'total_records' => $total,
                'per_page' => (int)$limit,
                'has_next' => $page < $totalPages,
                'has_prev' => $page > 1
            ];

            return $this->response->setJSON([
                'success' => true,
                'data' => $chamados,
                'pagination' => $pagination,
                'permissao' => [
                    'nivel' => $isLogged->nivel,
                    'setor' => $isLogged->setor
                ]
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Faça login para continuar',
                'errorLogin' => true
            ]);
        }
    }

    public function create()
    {

        $isLogaded = session()->get('token');
        if ($isLogaded) {
            $user = base64_decode($isLogaded);
            $user = json_decode($user)->user;
            return view('chamados/form', ["user" => $user]);
        }
        return redirect()->to(base_url('login'));
    }

    /**
     * Salva um novo chamado no banco de dados
     * Processa anexos múltiplos e os associa ao chamado criado
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            $isLogged = session()->get('token');
            $user = base64_decode($isLogged);
            $user = json_decode($user);

            if (!$isLogged) {
                return redirect()->to(base_url('login'));
            }

            $post = $this->request->getPost();

            // Dados do chamado
            $dados = [
                "numero" => $this->gerarNumeroChamado(),
                "usuario_id" => $user->id,
                "status" => "A",
                "titulo" => $post["titulo"],
                "setor"    => $post["setor"],
                "tipo"    => $post["tipo"],
                "observacao" => $post["descricao"],
                "registro"    => date("Y-m-d H:i:s"),
            ];

            // Salvar o chamado primeiro
            $resultado = $this->chamadoModel->enviar($dados);

            if ($resultado) {
                // Obter o ID do chamado recém-criado
                $chamado_id = $this->chamadoModel->getInsertID();

                // Processar múltiplos anexos
                $arquivos_salvos = 0;
                if ($_FILES && isset($_FILES["anexo"]) && is_array($_FILES["anexo"]["name"])) {
                    $fileCount = count($_FILES["anexo"]["name"]);

                    for ($i = 0; $i < $fileCount; $i++) {
                        if (!empty($_FILES["anexo"]["name"][$i]) && $_FILES["anexo"]["error"][$i] == 0) {
                            $file = [
                                "name" => $_FILES["anexo"]["name"][$i],
                                "type" => $_FILES["anexo"]["type"][$i],
                                "tmp_name" => $_FILES["anexo"]["tmp_name"][$i],
                                "error" => $_FILES["anexo"]["error"][$i],
                                "size" => $_FILES["anexo"]["size"][$i]
                            ];

                            // Validar tipo de arquivo
                            if (!$this->validarTipoArquivo($file["type"])) {
                                continue; // Pula arquivos com tipo inválido
                            }

                            // Validar tamanho do arquivo (5MB máximo)
                            if (!$this->validarTamanhoArquivo($file["size"])) {
                                continue; // Pula arquivos muito grandes
                            }

                            // Enviar arquivo para o servidor
                            $arquivoNome = $this->enviarArquivo($file);

                            if (!empty($arquivoNome)) {
                                $dados_arquivo = [
                                    "nome" => $arquivoNome,
                                    "typeMine" => $file["type"],
                                    "created_at" => date("Y-m-d H:i:s"),
                                    "chamado_id" => $chamado_id // Associar ao chamado criado
                                ];

                                // Salvar o arquivo no banco
                                $arquivo_id = $this->arquivoModel->addArquivo($dados_arquivo);
                                if ($arquivo_id) {
                                    $arquivos_salvos++;
                                }
                            }
                        }
                    }
                }

                $mensagem = "Chamado aberto com sucesso!";
                if ($arquivos_salvos > 0) {
                    $mensagem .= " {$arquivos_salvos} arquivo(s) anexado(s).";
                }

                return redirect()->to("chamados")->with("success", $mensagem);
            } else {
                $mensagem = "Erro ao abrir chamado, tente novamente mais tarde!";
                return redirect()->to("chamados/create")->with("error", $mensagem);
            }
        } catch (\Exception $e) {
            // Log do erro para debugging
            log_message('error', 'Erro no método store: ' . $e->getMessage());

            $mensagem = "Erro interno do sistema. Tente novamente.";
            return redirect()->to("chamados/create")->with("error", $mensagem);
        }
    }

    /**
     * Valida se o tipo de arquivo é permitido
     * Tipos permitidos: JPG, JPEG, PNG, PDF
     * 
     * @param string $mimeType Tipo MIME do arquivo
     * @return bool True se o tipo for válido, false caso contrário
     */
    private function validarTipoArquivo($mimeType)
    {
        $tiposPermitidos = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'application/pdf'
        ];

        return in_array(strtolower($mimeType), $tiposPermitidos);
    }

    /**
     * Valida se o tamanho do arquivo está dentro do limite
     * Tamanho máximo: 5MB (5242880 bytes)
     * 
     * @param int $tamanho Tamanho do arquivo em bytes
     * @return bool True se o tamanho for válido, false caso contrário
     */
    private function validarTamanhoArquivo($tamanho)
    {
        $tamanhoMaximo = 5 * 1024 * 1024; // 5MB em bytes
        return $tamanho <= $tamanhoMaximo && $tamanho > 0;
    }

    /**
     * Gera o numero de chamados por ano
     *
     * @return void
     */
    private function gerarNumeroChamado()
    {
        $anoAtual = date("Y");
        $totalChamados = $this->chamadoModel->obterTotal();
        $numero = ($totalChamados + 1);
        if ($numero < 10) {
            $numero = "0" . $numero;
        }
        $key = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $texto = $numero . "/"  . $anoAtual . "-" . $key;
        return $texto;
    }
    /**
     * Envia arquivo para o diretório de uploads
     * Gera nome único para evitar conflitos
     * 
     * @param array $file Array com informações do arquivo ($_FILES)
     * @return string|null Nome do arquivo salvo ou null em caso de erro
     */
    private function enviarArquivo($file = null)
    {
        if (is_null($file) || !isset($file["tmp_name"]) || !isset($file["name"])) {
            log_message('error', 'Arquivo inválido fornecido para enviarArquivo');
            return null;
        }

        try {
            $uploadPath = 'assets/uploads/';

            // Criar diretório se não existir
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Obter extensão do arquivo de forma mais segura
            $pathInfo = pathinfo($file["name"]);
            $ext = isset($pathInfo['extension']) ? '.' . strtolower($pathInfo['extension']) : '';

            // Gerar nome único
            $codigo = uniqid(rand());
            $nome = md5($codigo . time()) . $ext;
            $fullPath = $uploadPath . $nome;

            // Verificar se arquivo já existe (improvável, mas seguro)
            $contador = 1;
            while (file_exists($fullPath)) {
                $nome = md5($codigo . time() . $contador) . $ext;
                $fullPath = $uploadPath . $nome;
                $contador++;
            }

            // Mover arquivo
            if (move_uploaded_file($file["tmp_name"], $fullPath)) {
                log_message('info', "Arquivo salvo com sucesso: {$nome}");
                return $nome;
            } else {
                log_message('error', "Falha ao mover arquivo: {$file['name']}");
                return null;
            }
        } catch (\Exception $e) {
            log_message('error', 'Erro no enviarArquivo: ' . $e->getMessage());
            return null;
        }
    }
    public function edit($chave = null)
    {

        if (!is_null($chave)) {

            $isLogged = session()->get('token');
            $user = base64_decode($isLogged);
            $isLogged = json_decode($user);
            $user = json_decode($user)->user;
            if ($isLogged) {
                if ($isLogged->setor == "TI") {
                    // Obter o ID do chamado a partir da chave
                    $status = $this->chamadoModel->obterStatus($chave);

                    switch ($status) {
                        case 'A':
                            return $this->carregarViewAtribuirChamado($chave, $user);
                            break;
                        case 'E':
                            return $this->carregarViewAtendimento($chave, $user);
                            break;
                        case 'F':
                            return $this->carregarViewAtendimento($chave, $user);
                            break;
                        case 'G':
                            return $this->carregarViewAtendimento($chave, $user);
                            break;
                        case 'B':
                            return $this->carregarViewAtribuirChamado($chave, $user);
                            break;
                    }

                    $chamado_id = $this->chamadoModel->obterId($chave);

                    // Buscar os anexos do chamado
                    $anexos = [];
                    if ($chamado_id) {
                        $anexos = $this->arquivoModel->obterTodos($chamado_id);
                    }
                    $data = [
                        "user" => $user,
                        "chave" => $chave,
                        "anexos" => $anexos,
                        "relatorio" => $this->carregarRelatorioAtendimento($chave)
                    ];
                    return view("chamados/relatorioAtendimento", $data);
                } else {
                    $mensagem = "Você não tem permissão para esta ação.";
                    return redirect()->to("chamados")->with("error", $mensagem);
                }
            } else {
                $mensagem = "Faça login para continuar";
                return redirect()->to("chamados")->with("error", $mensagem);
            }
        }
    }
    /**
     * Carrega a view para atribuir o chamado
     *
     * @param [type] $chave
     * @param [type] $user
     * @return void
     */
    private function carregarViewAtribuirChamado($chave = null, $user = null)
    {
        if (!is_null($chave) && !is_null($user)) {

            $chamado_id = $this->chamadoModel->obterId($chave);
            // Buscar os anexos do chamado
            $anexos = [];
            if ($chamado_id) {
                $anexos = $this->arquivoModel->obterTodos($chamado_id);
            }

            $data = [
                "user" => $user,
                "chave" => $chave,
                "anexos" => $anexos
            ];
            return view("chamados/formAtribuirChamado", $data);
        }
    }
    private function carregarViewAtendimento($chave = null, $user = null)
    {
        if (!is_null($chave) && !is_null($user)) {

            $chamado_id = $this->chamadoModel->obterId($chave);
            $dadosChamadoParaAtendimento = $this->chamadoModel->obterdadosChamadoParaAtendimento($chamado_id) ?? [];
            // Buscar os anexos do chamado
            $anexos = [];
            if ($chamado_id) {
                $anexos = $this->arquivoModel->obterTodos($chamado_id);
            }

            $data = [
                "user" => $user,
                "chave" => $chave,
                "dados" => $dadosChamadoParaAtendimento,
                "anexos" => $anexos
            ];
            return view("chamados/formAtendimento", $data);
        }
    }
    /**
     * Registra atendimento de um chamado
     * Processa anexos múltiplos e os associa ao chamado existente
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function registrarAtendimento()
    {
        try {
            $post = $this->request->getPost();
            $chave = $post["chave"];
            $status = $post["status"];
            $observacoes = $post["observacoes"];

            // Validação dos campos obrigatórios
            if (empty($chave) || empty($observacoes)) {
                $mensagem = "Preencha todos os campos";
                return redirect()->to("chamados/{$chave}/edit")->with("error", $mensagem);
            }

            // Obter ID do chamado pela chave
            $chamado_id = $this->chamadoModel->obterId($chave);

            if (!$chamado_id) {
                $mensagem = "Chamado não encontrado";
                return redirect()->to("chamados")->with("error", $mensagem);
            }

            // Obter dados do usuário logado
            $isLogged = session()->get('token');
            $user = base64_decode($isLogged);
            $userLoggadedID = json_decode($user)->id;

            // Dados para o histórico
            $dados_historico = [
                "usuario_id" => $userLoggadedID,
                "chamado_id" => $chamado_id,
                "operacao" => "CHAMADO EM ATENDIMENTO",
                "descricao" => $observacoes,
                "created_at" => date("Y-m-d H:i:s")
            ];

            // Dados para atualizar o status do chamado
            $dados_status = [
                "status" => $status,
                "updated_at" => date("Y-m-d H:i:s")
            ];

            // Salvar histórico e atualizar status
            $this->historicoModel->insert($dados_historico);
            $this->chamadoModel->update($chamado_id, $dados_status);

            // Processar múltiplos anexos
            $arquivos_salvos = 0;
            if ($_FILES && isset($_FILES["anexo"]) && is_array($_FILES["anexo"]["name"])) {
                $fileCount = count($_FILES["anexo"]["name"]);

                for ($i = 0; $i < $fileCount; $i++) {
                    if (!empty($_FILES["anexo"]["name"][$i]) && $_FILES["anexo"]["error"][$i] == 0) {
                        $file = [
                            "name" => $_FILES["anexo"]["name"][$i],
                            "type" => $_FILES["anexo"]["type"][$i],
                            "tmp_name" => $_FILES["anexo"]["tmp_name"][$i],
                            "error" => $_FILES["anexo"]["error"][$i],
                            "size" => $_FILES["anexo"]["size"][$i]
                        ];

                        // Validar tipo de arquivo
                        if (!$this->validarTipoArquivo($file["type"])) {
                            log_message('warning', "Tipo de arquivo inválido rejeitado: {$file['type']} - {$file['name']}");
                            continue; // Pula arquivos com tipo inválido
                        }

                        // Validar tamanho do arquivo (5MB máximo)
                        if (!$this->validarTamanhoArquivo($file["size"])) {
                            log_message('warning', "Arquivo muito grande rejeitado: {$file['size']} bytes - {$file['name']}");
                            continue; // Pula arquivos muito grandes
                        }

                        // Enviar arquivo para o servidor
                        $arquivoNome = $this->enviarArquivo($file);

                        if (!empty($arquivoNome)) {
                            $dados_arquivo = [
                                "nome" => $arquivoNome,
                                "typeMine" => $file["type"],
                                "created_at" => date("Y-m-d H:i:s"),
                                "chamado_id" => $chamado_id // Associar ao chamado existente
                            ];

                            // Salvar o arquivo no banco
                            $arquivo_id = $this->arquivoModel->addArquivo($dados_arquivo);
                            if ($arquivo_id) {
                                $arquivos_salvos++;
                                log_message('info', "Arquivo anexado ao chamado {$chamado_id}: {$arquivoNome}");
                            }
                        }
                    }
                }
            }

            $mensagem = "Atendimento registrado com sucesso!";
            if ($arquivos_salvos > 0) {
                $mensagem .= " {$arquivos_salvos} arquivo(s) anexado(s).";
            }

            return redirect()->to("chamados")->with("success", $mensagem);
        } catch (\Exception $e) {
            // Log do erro para debugging
            log_message('error', 'Erro no registrarAtendimento: ' . $e->getMessage());

            $mensagem = "Erro interno do sistema. Tente novamente.";
            return redirect()->to("chamados")->with("error", $mensagem);
        }
    }
    /**
     * Atribui o chamado a um atendente e registrar o historico
     *
     * @return void
     */
    public function atribuirChamado()
    {
        try {
            $chave = $this->request->getPost("chave");
            $usuario_id = $this->request->getPost("usuario");
            $observacoes = $this->request->getPost("observacoes");
            if (empty($chave) || empty($usuario_id) || empty($observacoes)) {
                $mensagem = "Preencha todos os campos";
                return redirect()->to("chamados/atribuirChamado/$chave")->with("error", $mensagem);
            }
            $chamado_id = $this->chamadoModel->obterId($chave);
            $dados_atendimento = [
                "usuario_id" => $usuario_id,
                "chamado_id" => $chamado_id,
                "observacoes" => $observacoes,
                "created_at"    => date("Y-m-d H:i:s")
            ];
            $isLogged = session()->get('token');
            $user = base64_decode($isLogged);
            $userLoggadedID = json_decode($user)->id;

            $dados_historico = [
                "usuario_id" => $userLoggadedID,
                "chamado_id" => $chamado_id,
                "operacao" => "CHAMADO ATRIBUIDO",
                "descricao" => $observacoes,
                "created_at"    => date("Y-m-d H:i:s")
            ];
            $dados_status = [
                "status" => "E",
                "updated_at" => date("Y-m-d H:i:s")
            ];

            $this->atendimentoModel->insert($dados_atendimento);
            $this->historicoModel->insert($dados_historico);
            $this->chamadoModel->update($chamado_id, $dados_status);
            $mensagem = "Chamado atribuído com sucesso";
            return redirect()->to("chamados")->with("success", $mensagem);
        } catch (\Exception $e) {
            $mensagem = $e->getMessage();
            return redirect()->to("chamados")->with("error", $mensagem);
        }
    }
    public function cancel($chave = null)
    {
        $isLogaded = session()->get('token');
        if ($isLogaded) {
            if (!is_null($chave)) {
                $id = $this->chamadoModel->obterId($chave);
                $dados = [
                    "status" => "X",
                    "registro"    => date("Y-m-d H:i:s")
                ];
                $result = $this->chamadoModel->cancelarChamado($id, $dados);
                if ($result) {
                    $mensagem = "Chamado cancelado com sucesso";
                    return redirect()->to("chamados")->with("success", $mensagem);
                }
            }
        }
        $mensagem = "Erro ao cancelar chamado";
        return redirect()->to("chamados")->with("error", $mensagem);
    }
    public function siga($chave = null)
    {
        $isLogaded = session()->get('token');
        if ($isLogaded) {
            if (is_null($chave)) {
                $mensagem = "Chave inválida";
                return redirect()->to("chamados")->with("error", $mensagem);
            }
            return view("chamados/siga", ["chave" => $chave]);
        }
        return redirect()->to(base_url('login'));
    }
    private function carregarRelatorioAtendimento($chave = null)
    {
        if (!is_null($chave)) {
            $db = db_connect();
            $builder = $db->table("chamados");
            $builder->select("chamados.id,chamados.chave, chamados.tipo as categoria, chamados.numero, chamados.status, registro, update, u.nome as solicitante");
            $builder->join("usuarios u", "u.id = chamados.usuario_id");
            $builder->where("chamados.chave", $chave);
            $query = $builder->get();
            $result = $query->getResultArray();
            if ($result) {
                $result[0]["historico"] = $this->obterHistoricoAtendimento($result[0]["id"]);
                return $result[0];
            }
            return $result;
        }
    }
    private function obterHistoricoAtendimento($chamado_id = null)
    {
        if (!is_null($chamado_id)) {
            $db = db_connect();
            $builder = $db->table("historico");
            $builder->select("u.nome, historico.operacao, historico.descricao, historico.created_at");
            $builder->join("usuarios u", "u.id = historico.usuario_id");
            $builder->where("historico.chamado_id", $chamado_id);
            $query = $builder->get();
            $result = $query->getResultArray();
            if ($result) {
                return $result;
            }
            return $result;
        }
    }
}
