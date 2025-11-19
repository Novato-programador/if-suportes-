<?php

namespace App\Models;

use CodeIgniter\Model;

class ChamadoModel extends BaseModel
{
    protected $DBGroup = 'default';
    protected $table      = 'chamados';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'usuario_id',
        'numero',
        'status',
        'titulo',
        'setor',
        'tipo',
        'observacao',
        'registro',
        'update',
        'chave',
        'resposta',
        'atendimento_date'
    ];
    protected $before = ["gerarChave"];

    /**
     * Versão otimizada da função obterTodos() 
     * Resolve problemas de N+1 queries e múltiplas consultas desnecessárias
     * Mantém compatibilidade com a interface original
     */
    public function obterTodos()
    {
        // Cache estático para atendentes para evitar consultas repetidas
        static $cacheAtendentes = [];

        // Query única otimizada com JOINs para buscar todos os dados necessários
        $todosOsChamados = $this->select("
                chamados.id, 
                chamados.numero, 
                u.nome, 
                chamados.status, 
                chamados.titulo, 
                chamados.setor, 
                chamados.tipo, 
                chamados.observacao, 
                chamados.registro, 
                chamados.update, 
                chamados.chave, 
                chamados.resposta,
                chamados.atendimento_date,
                atendente.nome as atendente
            ")
            ->join("usuarios u", "u.id = chamados.usuario_id", "left")
            ->join("atendimento a", "a.chamado_id = chamados.id", "left")
            ->join("usuarios atendente", "atendente.id = a.usuario_id", "left")
            ->whereIn("chamados.status", ["A", "E", "C", "F", "G", "B"])
            ->orderBy("chamados.id", "desc")
            ->findAll();

        // Agrupar por status de forma eficiente
        $chamadosAgrupados = [
            "chamadosAbertos" => [],
            "chamadosAndamento" => [],
            "chamadosConcluido" => [],
            "chamadosAguardandoConfirmacao" => [],
            "chamadosConfirmados" => [],
            "chamadosDevolvidos" => []
        ];

        // Processar uma única vez todos os chamados
        foreach ($todosOsChamados as $chamado) {
            // Remover campo atendente se for null para chamados abertos
            if ($chamado['status'] === 'A') {
                unset($chamado['atendente']);
            }

            switch ($chamado['status']) {
                case 'A':
                    $chamadosAgrupados["chamadosAbertos"][] = $chamado;
                    break;
                case 'E':
                    $chamadosAgrupados["chamadosAndamento"][] = $chamado;
                    break;
                case 'C':
                    $chamadosAgrupados["chamadosConcluido"][] = $chamado;
                    break;
                case 'F':
                    $chamadosAgrupados["chamadosAguardandoConfirmacao"][] = $chamado;
                    break;
                case 'G':
                    $chamadosAgrupados["chamadosConfirmados"][] = $chamado;
                    break;
                case 'B':
                    $chamadosAgrupados["chamadosDevolvidos"][] = $chamado;
                    break;
            }
        }

        // Processar arquivos apenas uma vez para cada grupo
        $chamadosAgrupados["chamadosAbertos"] = $this->processarArquivos($chamadosAgrupados["chamadosAbertos"]);
        $chamadosAgrupados["chamadosAndamento"] = $this->processarArquivos($chamadosAgrupados["chamadosAndamento"]);
        $chamadosAgrupados["chamadosConcluido"] = $this->processarArquivos($chamadosAgrupados["chamadosConcluido"]);
        $chamadosAgrupados["chamadosAguardandoConfirmacao"] = $this->processarArquivos($chamadosAgrupados["chamadosAguardandoConfirmacao"]);
        $chamadosAgrupados["chamadosConfirmados"] = $this->processarArquivos($chamadosAgrupados["chamadosConfirmados"]);
        $chamadosAgrupados["chamadosDevolvidos"] = $this->processarArquivos($chamadosAgrupados["chamadosDevolvidos"]);

        return $chamadosAgrupados;
    }

    /**
     * Versão paginada e otimizada para melhor performance
     * @param string|null $status Status específico ou null para todos
     * @param int $page Página atual (1-based)
     * @param int $limit Registros por página
     * @param string $search Termo de busca
     * @param string|null $setor Filtro por setor
     * @return array
     */
    public function obterTodosPaginado($status = null, $page = 1, $limit = 15, $search = '', $setor = null)
    {
        $offset = ($page - 1) * $limit;

        $builder = $this->select("
                chamados.id, 
                chamados.numero, 
                u.nome, 
                chamados.status, 
                chamados.titulo, 
                chamados.setor, 
                chamados.tipo, 
                chamados.observacao, 
                chamados.registro, 
                chamados.update, 
                chamados.chave, 
                chamados.resposta,
                chamados.atendimento_date,
                atendente.nome as atendente
            ")
            ->join("usuarios u", "u.id = chamados.usuario_id", "left")
            ->join("atendimento a", "a.chamado_id = chamados.id", "left")
            ->join("usuarios atendente", "atendente.id = a.usuario_id", "left")
            ->orderBy("chamados.id", "desc");

        // Aplicar filtro de status se fornecido
        if ($status) {
            $builder->where("chamados.status", $status);
        } else {
            $builder->whereIn("chamados.status", ["A", "E", "C", "F", "G", "B"]);
        }

        // Aplicar filtro de setor se fornecido
        if ($setor) {
            $builder->where("chamados.setor", $setor);
        }

        // Aplicar busca se fornecida
        if (!empty($search)) {
            $builder->groupStart()
                ->like("chamados.numero", $search)
                ->orLike("u.nome", $search)
                ->orLike("chamados.titulo", $search)
                ->orLike("chamados.observacao", $search)
                ->groupEnd();
        }

        // Aplicar paginação
        $builder->limit($limit, $offset);

        $chamados = $builder->findAll();

        // Processar arquivos conforme método original
        $chamados = $this->processarArquivos($chamados);

        // Limpar campo atendente para chamados abertos
        foreach ($chamados as &$chamado) {
            if ($chamado['status'] === 'A') {
                unset($chamado['atendente']);
            }
        }

        return $chamados;
    }

    /**
     * Conta total de chamados com filtros aplicados
     * @param string|null $status Status específico ou null para todos
     * @param string $search Termo de busca
     * @param string|null $setor Filtro por setor
     * @return int
     */
    public function contarChamados($status = null, $search = '', $setor = null)
    {
        $builder = $this->select("COUNT(DISTINCT chamados.id) as total")
            ->join("usuarios u", "u.id = chamados.usuario_id", "left");

        if ($status) {
            $builder->where("chamados.status", $status);
        } else {
            $builder->whereIn("chamados.status", ["A", "E", "C", "F", "B"]);
        }

        if ($setor) {
            $builder->where("chamados.setor", $setor);
        }

        if (!empty($search)) {
            $builder->groupStart()
                ->like("chamados.numero", $search)
                ->orLike("u.nome", $search)
                ->orLike("chamados.titulo", $search)
                ->orLike("chamados.observacao", $search)
                ->groupEnd();
        }

        $result = $builder->findAll();
        return $result[0]['total'] ?? 0;
    }



    /**
     * Conta total de chamados por status
     * @param string $status Status do chamado
     * @param string $search Termo de busca (opcional)
     * @return int
     */
    public function contarChamadosPorStatus($status = null, $search = '')
    {
        $builder = $this->select("COUNT(*) as total")
            ->join("usuarios u", "u.id = chamados.usuario_id", "left");

        // Aplicar filtro de status se fornecido
        if ($status) {
            $builder->where("chamados.status", $status);
        } else {
            $builder->whereIn("chamados.status", ["A", "E", "C", "F", "B"]);
        }

        if (!empty($search)) {
            $builder->groupStart()
                ->like("chamados.numero", $search)
                ->orLike("u.nome", $search)
                ->orLike("chamados.titulo", $search)
                ->orLike("chamados.observacao", $search)
                ->groupEnd();
        }

        $result = $builder->findAll();
        return $result[0]['total'] ?? 0;
    }
    private function obterAtendente($chamado_id)
    {
        $atendimento = new AtendimentoModel();
        $rs = $atendimento->select("u.nome as atendente")
            ->join("usuarios u", "u.id = atendimento.usuario_id", "left")
            ->where("chamado_id", $chamado_id)
            ->find();
        if ($rs) {
            return $rs[0]["atendente"];
        }
        return null;
    }
    private function processarArquivos($chamadosAbertos = [])
    {
        $arquivo = new ArquivoModel();
        for ($i = 0; $i < count($chamadosAbertos); $i++) {
            $chamadosAbertos[$i]["arquivo"] = $arquivo->obterTodos($chamadosAbertos[$i]["id"]);
        }
        return $chamadosAbertos;
    }

    public function enviar($dados = null)
    {

        if (!is_null($dados)) {
            $dados["chave"] = $this->gerarChave();
            return $this->insert($dados);
        }
        return null;
    }

    public function obterStatus($chave = null)
    {
        if (!is_null($chave)) {
            $result = $this->select("status")
                ->where("chave", $chave)
                ->find();

            if (!empty($result) && isset($result[0]["status"])) {
                return $result[0]["status"];
            }

            return null;
        }
        return null;
    }
    public function obterId($chave = null)
    {
        if (!is_null($chave)) {
            $result = $this->select("id")
                ->where("chave", $chave)
                ->find();

            if (!empty($result) && isset($result[0]["id"])) {
                return $result[0]["id"];
            }

            return null;
        }
        return null;
    }
    public function obterdadosChamadoParaAtendimento($chamado_id = null)
    {
        $dados = [];
        if (!is_null($chamado_id)) {
            $rs = $this->select("chamados.id,chamados.chave,u.nome as solicitante, u.telefone, chamados.setor, chamados.observacao, chamados.tipo as categoria")
                ->join("usuarios u", "u.id = chamados.usuario_id", "left")
                ->where("chamados.id", $chamado_id)
                ->find();
            if ($rs) {
                $dados = $rs[0];
                $dados["historico"] = $this->obterHistorico($dados["id"]);
            }
        }
        return $dados;
    }
    private function obterHistorico($chamado_id = null)
    {
        if (!is_null($chamado_id)) {
            $historico = new HistoricoModel();
            $rs = $historico->select("historico.operacao, historico.descricao, u.nome as atendente, historico.created_at as registro")
                ->join("usuarios u", "u.id = historico.usuario_id", "left")
                ->where("chamado_id", $chamado_id)
                ->findAll();
            if ($rs) {
                return $rs;
            }
        }
        return null;
    }

    public function updateChamado($id = null, $dados = null)
    {
        if (!is_null($id) && !is_null($dados)) {
            return $this->update($id, $dados);
        }
    }
    public function gerarChave()
    {
        return md5(uniqid(rand() . date("Y:m:d H:i:s")));
    }


    public function obterTotalChamadosAbertos($setor = null)
    {
        $whereAberto = [
            "status" => "A"
        ];

        if (!is_null($setor) && !empty($setor)) {
            $whereAberto["setor"] = $setor;
        }

        $rs =  $this->select("count(status) as total")
            ->where($whereAberto)
            ->findAll();
        if ($rs) {
            return $rs[0]["total"];
        }
        return 0;
    }
    public function obterTotalChamadosEmAndamento($setor = null)
    {

        $whereAndamento = [
            "status" => "E"
        ];


        if (!is_null($setor) && !empty($setor)) {
            $whereAndamento["setor"] = $setor;
        }
        $rs =  $this->select("count(status) as total")
            ->where($whereAndamento)
            ->findAll();
        if ($rs) {
            return $rs[0]["total"];
        }
        return 0;
    }

    public function obterTotalChamadosConcluido($setor = null)
    {

        $whereConcluido = [
            "status" => "C"
        ];

        if (!is_null($setor) && !empty($setor)) {
            $whereConcluido["setor"] = $setor;
        }
        $rs =  $this->select("count(status) as total")
            ->where($whereConcluido)
            ->findAll();
        if ($rs) {
            return $rs[0]["total"];
        }
        return 0;
    }
    public function obterTotalChamadosConcluidoMesAtual($setor = null)
    {

        $whereConcluido = [
            "status" => "C"
        ];

        if (!is_null($setor) && !empty($setor)) {
            $whereConcluido["setor"] = $setor;
        }
        $rs =  $this->select("count(status) as total")
            ->where($whereConcluido)
            ->where("registro >= DATE_FORMAT(NOW(), '%Y-%m-01')")
            ->findAll();
        if ($rs) {
            return $rs[0]["total"];
        }
        return 0;
    }
    public function cancelarChamado($id = null, $dados = null)
    {
        if (!is_null($id) && !is_null($dados)) {
            return $this->update($id, $dados);
        }
    }

    public function obterDadosGraficoStatus($setor = null)
    {
        // Dados para gráfico de status por período
        $statusData = [
            'week' => [
                'labels' => ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                'datasets' => [
                    [
                        'label' => 'Abertos',
                        'data' => $this->obterDadosPorDiaSemana('A', $setor),
                        'backgroundColor' => 'rgba(255, 152, 0, 0.2)',
                        'borderColor' => 'rgba(255, 152, 0, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ],
                    [
                        'label' => 'Em Andamento',
                        'data' => $this->obterDadosPorDiaSemana('E', $setor),
                        'backgroundColor' => 'rgba(46, 125, 50, 0.2)',
                        'borderColor' => 'rgba(46, 125, 50, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ],
                    [
                        'label' => 'Concluídos',
                        'data' => $this->obterDadosPorDiaSemana('C', $setor),
                        'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                        'borderColor' => 'rgba(76, 175, 80, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ]
                ]
            ],
            'month' => [
                'labels' => ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
                'datasets' => [
                    [
                        'label' => 'Abertos',
                        'data' => $this->obterDadosPorSemanaMes('A', $setor),
                        'backgroundColor' => 'rgba(255, 152, 0, 0.2)',
                        'borderColor' => 'rgba(255, 152, 0, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ],
                    [
                        'label' => 'Em Andamento',
                        'data' => $this->obterDadosPorSemanaMes('E', $setor),
                        'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                        'borderColor' => 'rgba(46, 125, 50, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ],
                    [
                        'label' => 'Concluídos',
                        'data' => $this->obterDadosPorSemanaMes('C', $setor),
                        'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                        'borderColor' => 'rgba(76, 175, 80, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ]
                ]
            ],
            'quarter' => [
                'labels' => ['Mês 1', 'Mês 2', 'Mês 3'],
                'datasets' => [
                    [
                        'label' => 'Abertos',
                        'data' => $this->obterDadosPorMesTrimestre('A', $setor),
                        'backgroundColor' => 'rgba(255, 152, 0, 0.2)',
                        'borderColor' => 'rgba(255, 152, 0, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ],
                    [
                        'label' => 'Em Andamento',
                        'data' => $this->obterDadosPorMesTrimestre('E', $setor),
                        'backgroundColor' => 'rgba(46, 125, 50, 0.2)',
                        'borderColor' => 'rgba(46, 125, 50, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ],
                    [
                        'label' => 'Concluídos',
                        'data' => $this->obterDadosPorMesTrimestre('C', $setor),
                        'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                        'borderColor' => 'rgba(76, 175, 80, 1)',
                        'borderWidth' => 2,
                        'tension' => 0.3
                    ]
                ]
            ]
        ];

        return $statusData;
    }

    private function obterDadosPorDiaSemana($status, $setor = null)
    {
        $dados = [];
        $diasSemana = [2, 3, 4, 5, 6, 7, 1]; // Segunda a Domingo

        foreach ($diasSemana as $dia) {
            $where = [
                'status' => $status,
                'DAYOFWEEK(registro)' => $dia,
                'WEEK(registro)' => 'WEEK(NOW())',
                'YEAR(registro)' => 'YEAR(NOW())'
            ];

            if (!is_null($setor) && !empty($setor)) {
                $where['setor'] = $setor;
            }

            $query = $this->db->table($this->table)
                ->selectCount('id', 'total')
                ->where('status', $status)
                ->where('DAYOFWEEK(registro)', $dia)
                ->where('WEEK(registro) = WEEK(NOW())')
                ->where('YEAR(registro) = YEAR(NOW())');

            if (!is_null($setor) && !empty($setor)) {
                $query->where('setor', $setor);
            }

            $result = $query->get()->getRowArray();
            $dados[] = (int)($result['total'] ?? 0);
        }

        return $dados;
    }

    private function obterDadosPorSemanaMes($status, $setor = null)
    {
        $dados = [];

        for ($semana = 1; $semana <= 4; $semana++) {
            $query = $this->db->table($this->table)
                ->selectCount('id', 'total')
                ->where('status', $status)
                ->where('MONTH(registro) = MONTH(NOW())')
                ->where('YEAR(registro) = YEAR(NOW())')
                ->where('WEEK(registro, 1) - WEEK(DATE_SUB(registro, INTERVAL DAYOFMONTH(registro)-1 DAY), 1) + 1', $semana);

            if (!is_null($setor) && !empty($setor)) {
                $query->where('setor', $setor);
            }

            $result = $query->get()->getRowArray();
            $dados[] = (int)($result['total'] ?? 0);
        }

        return $dados;
    }

    private function obterDadosPorMesTrimestre($status, $setor = null)
    {
        $dados = [];
        $mesAtual = date('n');
        $trimestreAtual = ceil($mesAtual / 3);
        $mesesTrimestre = [
            1 => [1, 2, 3],
            2 => [4, 5, 6],
            3 => [7, 8, 9],
            4 => [10, 11, 12]
        ];

        foreach ($mesesTrimestre[$trimestreAtual] as $mes) {
            $query = $this->db->table($this->table)
                ->selectCount('id', 'total')
                ->where('status', $status)
                ->where('MONTH(registro)', $mes)
                ->where('YEAR(registro) = YEAR(NOW())');

            if (!is_null($setor) && !empty($setor)) {
                $query->where('setor', $setor);
            }

            $result = $query->get()->getRowArray();
            $dados[] = (int)($result['total'] ?? 0);
        }

        return $dados;
    }

    public function obterDadosGraficoCategorias($setor = null)
    {
        // Obter tipos únicos de chamados
        $query = $this->db->table($this->table)
            ->select('tipo, COUNT(*) as total')
            ->groupBy('tipo');

        if (!is_null($setor) && !empty($setor)) {
            $query->where('setor', $setor);
        }

        $tipos = $query->get()->getResultArray();

        $labels = [];
        $data = [];
        $cores = [
            'rgba(67, 97, 238, 0.8)',
            'rgba(76, 201, 240, 0.8)',
            'rgba(247, 37, 133, 0.8)',
            'rgba(108, 117, 125, 0.8)',
            'rgba(255, 193, 7, 0.8)',
            'rgba(40, 167, 69, 0.8)',
            'rgba(220, 53, 69, 0.8)',
            'rgba(23, 162, 184, 0.8)'
        ];
        $coresBorda = [
            'rgba(67, 97, 238, 1)',
            'rgba(76, 201, 240, 1)',
            'rgba(247, 37, 133, 1)',
            'rgba(108, 117, 125, 1)',
            'rgba(255, 193, 7, 1)',
            'rgba(40, 167, 69, 1)',
            'rgba(220, 53, 69, 1)',
            'rgba(23, 162, 184, 1)'
        ];

        $backgroundColor = [];
        $borderColor = [];

        foreach ($tipos as $index => $tipo) {
            $labels[] = $tipo['tipo'] ?: 'Outros';
            $data[] = (int)$tipo['total'];
            $backgroundColor[] = $cores[$index % count($cores)];
            $borderColor[] = $coresBorda[$index % count($coresBorda)];
        }

        $categoryData = [
            'labels' => $labels,
            'datasets' => [[
                'data' => $data,
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => 2,
                'hoverOffset' => 12
            ]]
        ];

        return $categoryData;
    }
    public function obterTotal()
    {
        $anoAtual = date("Y");
        return $this->select('count(id) as total')
            ->where("YEAR(registro)", $anoAtual)
            ->findAll()[0]["total"];
    }
    /**
     * Retorna todos os chamados abertos pelo usuario logado
     * para o ID informado
     * @param [type] $usuarioLogadedID
     * @return void
     */
    public function obterTodosMeusChamados($usuarioLogadedID = null)
    {
        if (!is_null($usuarioLogadedID)) {
            $chamados = $this->select('chamados.id, chamados.chave, chamados.numero, chamados.titulo, chamados.registro, chamados.status')
                ->join('usuarios', 'usuarios.id = chamados.usuario_id')
                ->where('usuario_id', $usuarioLogadedID)
                ->findAll();
            if ($chamados) {

                for ($i = 0; $i < count($chamados); $i++) {
                    $chamados[$i]["avaliacao"] = $this->obterAvaliacao($chamados[$i]["id"]);
                }
            }
            return $chamados;
        }
    }
    private function obterAvaliacao($chamado_id = null)
    {
        if (!is_null($chamado_id)) {
            $avaliacao = new AvaliacaoModel();
            $nota = $avaliacao->select('nota')
                ->join("atendimento", "atendimento.id=avaliacao.atendimento_id")
                ->join("chamados", "chamados.id=atendimento.chamado_id")
                ->where('chamado_id', $chamado_id)
                ->findAll();
            if ($nota) {
                return $nota[0]["nota"];
            }
        }
    }
    public function obterTotalChamadosPorUsuario($id = null, $status = null)
    {
        $where = [
            "status" => $status ?? "A"
        ];
        if (!is_null($id) && !empty($id)) {
            $where["usuario_id"] = $id;
        }
        $rs =  $this->select("count(status) as total")
            ->where($where)
            ->findAll();
        if ($rs) {
            return $rs[0]["total"];
        }
        return 0;
    }
    public function obterDadosDoChamadoParaSiga($chave = null)
    {
        if (!is_null($chave) && !empty($chave)) {
            $rs =  $this->select("*")
                ->where("chave", $chave)
                ->findAll();
            if ($rs) {
                $rs[0]["solicitante"] = $this->obterNomeDoUsuario($rs[0]["usuario_id"]);
                $rs[0]["tecnico"] = $this->obterTecnicoResponsavel($rs[0]["id"]);
                $rs[0]["historico"] = $this->obterHistorico($rs[0]["id"]);
                $rs[0]["dataUltimaAtualizacao"] = $this->obterUltimaAtualizacao($rs[0]["id"]);
                $rs[0]["dataInicioAtendimento"] = $this->obterInicioDoAtendimento($rs[0]["id"]);
                $rs[0]["solucao"] = $this->obterSolucaoAplicada($rs[0]["id"]);
                $rs[0]["tempoDeResolucao"] = $this->tempoDeResolucao($rs[0]["dataInicioAtendimento"], $rs[0]["dataUltimaAtualizacao"]);
                $notas = [4 => 'Excelente', 3 => 'Bom', 2 => 'Regular', 1 => 'Ruim'];
                $rs[0]["avaliacao"] = $this->obterAvaliacao($rs[0]["id"]);
                if ($rs[0]["avaliacao"]) {
                    $rs[0]["avaliacao"] = $notas[$rs[0]["avaliacao"]];
                }
                return $rs[0];
            }
        }
        return null;
    }
    private function obterNomeDoUsuario($usuario_id = null)
    {
        if (!is_null($usuario_id) && !empty($usuario_id)) {
            $usuario = new UsuarioModel();
            $rs = $usuario->select("nome")
                ->where("id", $usuario_id)
                ->findAll();
            if ($rs) {
                return $rs[0]["nome"];
            }
        }
        return null;
    }
    /**
     * Retorna o tecnico responsavel pelo atendimento
     *
     * @param [type] $chamado_id
     * @return void
     */
    private function obterTecnicoResponsavel($chamado_id = null)
    {
        if (!is_null($chamado_id) && !empty($chamado_id)) {
            $atendimento = new AtendimentoModel();
            $rs = $atendimento->select("nome")
                ->join("chamados", "chamados.id=atendimento.chamado_id")
                ->join("usuarios", "usuarios.id=atendimento.usuario_id")
                ->where("chamados.id", $chamado_id)
                ->findAll();
            if ($rs) {
                return $rs[0]["nome"];
            }
        }
        return null;
    }
    /**
     * Retorna a ultima atualização de atendimento para o chamado informado
     *
     * @param [type] $chamado_id
     * @return void
     */
    private function obterUltimaAtualizacao($chamado_id = null)
    {
        if (!is_null($chamado_id) && !empty($chamado_id)) {
            $rs = $this->select("created_at")
                ->join("historico", "historico.chamado_id=chamados.id")
                ->where("chamados.id", $chamado_id)
                ->orderBy("created_at", "DESC")
                ->findAll();
            if ($rs) {
                return $rs[0]["created_at"];
            }
        }
        return null;
    }
    private function obterInicioDoAtendimento($chamado_id = null)
    {
        if (!is_null($chamado_id) && !empty($chamado_id)) {
            $rs = $this->select("created_at")
                ->join("historico", "historico.chamado_id=chamados.id")
                ->where("chamados.id", $chamado_id)
                ->orderBy("created_at", "ASC")
                ->findAll();
            if ($rs) {
                return $rs[0]["created_at"];
            }
        }
        return null;
    }
    private function obterSolucaoAplicada($chamado_id = null)
    {
        if (!is_null($chamado_id) && !empty($chamado_id)) {
            $rs = $this->select("descricao as solucao")
                ->join("historico", "historico.chamado_id=chamados.id")
                ->where("chamados.id", $chamado_id)
                ->orderBy("created_at", "DESC")
                ->findAll();
            if ($rs) {
                return $rs[0]["solucao"];
            }
        }
        return null;
    }
    private function tempoDeResolucao($dataInicial = null, $dataFinal = null)
    {
        if (!is_null($dataInicial) && !empty($dataInicial) && !is_null($dataFinal) && !empty($dataFinal)) {
            $dataInicial = new \DateTime($dataInicial);
            $dataFinal = new \DateTime($dataFinal);
            $intervalo = $dataInicial->diff($dataFinal);
            // Retorna uma duração legível combinando dias, horas e minutos; se tudo for zero, retorna segundos
            $partes = [];
            $dias = (int) $intervalo->format('%a');
            $horas = (int) $intervalo->format('%h');
            $minutos = (int) $intervalo->format('%i');
            $segundos = (int) $intervalo->format('%s');
            if ($dias > 0) {
                $partes[] = $dias . ' dias';
            }
            if ($horas > 0) {
                $partes[] = $horas . ' horas';
            }
            if ($minutos > 0) {
                $partes[] = $minutos . ' minutos';
            }
            if (empty($partes)) {
                $partes[] = $segundos . ' segundos';
            }
            return implode(' ', $partes);
        }
        return null;
    }
    public function atualizarStatus($id = null, $status = null)
    {
        if (!is_null($id) && !empty($id) && !is_null($status) && !empty($status)) {
            $this->update($id, ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
        }
    }
}
