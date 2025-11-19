<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {

        $isLogged = session()->get('token');
        $user = base64_decode($isLogged);
        $isLogged = json_decode($user);

        if ($isLogged) {
            if ($isLogged->nivel == "admin" && $isLogged->setor == "TI") {
                $data = [
                    "data" => $this->usuarioModel->obterTodos(),
                    "permissao" => [
                        "nivel" => $isLogged->nivel,
                        "setor" => $isLogged->setor
                    ],
                    "user" => json_decode($user)->user
                ];

                return view('usuario/index', $data);
            } else {
                return "<h1>Você não tem permissão para esta ação<h1>";
            }
        }

        return redirect()->to(base_url('login'));
    }
    public function edit($chave = null)
    {
        $isLogged = session()->get('token');
        $user = base64_decode($isLogged);
        $isLogged = json_decode($user);

        if ($isLogged) {
            if ($isLogged->nivel == "admin" && $isLogged->setor == "TI") {
                $dados = null;
                $dados = $this->usuarioModel->obterDadosUser($chave);
                $data = [
                    "chave" => $chave,
                    "data" => $dados,
                    "permissao" => [
                        "nivel" => $isLogged->nivel,
                        "setor" => $isLogged->setor
                    ],
                    "user" => json_decode($user)->user
                ];

                return view('usuario/form', $data);
            } else {
                return "<h1>Você não tem permissão para esta ação<h1>";
            }
        }

        return redirect()->to(base_url('login'));
    }
    public function solicitacoes()
    {
        $isLogged = session()->get('token');
        $user = base64_decode($isLogged);
        $isLogged = json_decode($user);
        if ($isLogged) {
            if ($isLogged->nivel == "admin" && $isLogged->setor == "TI") {
                $data = [
                    "solicitacoes" => $this->usuarioModel->obterSolicitacoes(),
                    "permissao" => [
                        "nivel" => $isLogged->nivel,
                        "setor" => $isLogged->setor
                    ],
                    "user" => json_decode($user)->user
                ];

                return view('usuario/solicitacoes', $data);
            } else {
                $mensagem = "Você não tem permissão para esta ação";
                return redirect()->to("usuario")->with("error", $mensagem);
            }
        }

        return redirect()->to(base_url('login'));
    }
    public function processar_solicitacao()
    {
        $post = $this->request->getPost();

        $isLogged = session()->get('token');
        $user = base64_decode($isLogged);
        $isLogged = json_decode($user);
        if ($isLogged && !is_null($post)) {
            if ($isLogged->nivel == "admin" && $isLogged->setor == "TI") {
                $mensagem = $this->usuarioModel->updateUser($post);
                if ($mensagem) {
                    return redirect()->to("solicitacoes")->with("success", $mensagem);
                }
            } else {
                $mensagem = "Erro ao processar solicitação";
                return redirect()->to("usuario")->with("error", $mensagem);
            }
        }

        return redirect()->to(base_url('login'));
    }
    public function store()
    {
        $post = $this->request->getPost();
        if (!empty($post["chave"]) && isset($post["chave"])) {
            $dados = [
                "nome" => $post["nome"],
                "email" => $post["email"],
                "telefone" => $post["telefone"],
                "nivel" => !empty($post["nivel"]) ? (!empty($post["acesso"]) && $post["acesso"] === "on" ? $post["nivel"] : NULL) : NULL,
                "setor" => $post["setor"],
                "status" => !empty($post["acesso"]) && $post["acesso"] === "on" ? "A" : "I",
                "update_at" => date("Y-m-d H:i:s")
            ];
            $id = $this->usuarioModel->obterId($post["chave"]);
            if ($id) {
                $this->usuarioModel->update($id, $dados);
                $mensagem = "Cadastro atualizado com sucesso!";
                return redirect()->to("usuario")->with("success", $mensagem);
            }
        } else {
            $id = $this->usuarioModel->insert($post);
            if ($id) {

                $mensagem = "Cadastro realizado com sucesso!";
                return redirect()->to("usuario")->with("success", $mensagem);
            }
        }
        return redirect()->to("usuario");
    }
    public function resetPass()
    {
        if ($this->request->isAJAX()) {
            $post = $this->request->getPost();
            if (!empty($post["chave"]) && isset($post["chave"])) {
                $isLogged = session()->get('token');
                $user = base64_decode($isLogged);
                $user = json_decode($user);
                if ($this->confirmarReset($user->id, $post["senha"])) {
                    $dadosUser = $this->usuarioModel->obterUserToReset($post["chave"]);
                    if (!empty($dadosUser["id"]) && !empty($dadosUser["telefone"])) {
                        $novaSenha = $this->gerarChaveSegura();
                        $senhaSemHas = $novaSenha;
                        if (!empty($novaSenha) && !is_null($novaSenha)) {
                            $novaSenha = md5(md5(md5($novaSenha)));
                        }
                        $dados = [
                            "telefone" => $dadosUser["telefone"],
                            "senha" => $novaSenha,
                            "update_at" => date("Y-m-d H:i:s")
                        ];
                        $this->usuarioModel->update($dadosUser["id"], $dados);
                        return $this->response->setJSON([
                            'success' => true,
                            'message' => 'Senha redefinida com sucesso',
                            'telefone' => $dados["telefone"],
                            'senha' => $senhaSemHas
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Senha de confirmação inválida',
                    ]);
                }
            }
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Faça login para continuar',
            ]);
        }
        return $this->response->setStatusCode(404);
    }
    private function confirmarReset($id = null, $senha = null)
    {
        if (!is_null($id) && !is_null($senha)) {
            return $this->usuarioModel->checkUser($id, $senha);
        }
    }
    /**
     * Gera senha aleatória para o reset de senha
     *  Exemplo de uso
     * $chaveSegura = gerarChaveSegura();
     * echo "Chave segura: " . $chaveSegura . "\n";

     * Chave sem caracteres especiais
     * $chaveSemEspeciais = gerarChaveSegura(8, false);
     * echo "Chave sem especiais: " . $chaveSemEspeciais . "\n";
     * @param integer $tamanho
     * @param boolean $incluirEspeciais
     * @return void
     */
    private function gerarChaveSegura($tamanho = 8, $incluirEspeciais = true)
    {
        // Conjuntos de caracteres
        $letrasMaiusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $letrasMinusculas = 'abcdefghijklmnopqrstuvwxyz';
        $numeros = '0123456789';
        $especiais = '!@#$%&*()-_=+[]{};:,.<>?';

        // Combina todos os caracteres
        $todosCaracteres = $letrasMaiusculas . $letrasMinusculas . $numeros;

        if ($incluirEspeciais) {
            $todosCaracteres .= $especiais;
        }

        // Garante que a chave tenha pelo menos um caractere de cada tipo
        $chave = '';
        $chave .= $letrasMaiusculas[random_int(0, strlen($letrasMaiusculas) - 1)];
        $chave .= $letrasMinusculas[random_int(0, strlen($letrasMinusculas) - 1)];
        $chave .= $numeros[random_int(0, strlen($numeros) - 1)];

        if ($incluirEspeciais) {
            $chave .= $especiais[random_int(0, strlen($especiais) - 1)];
        }

        // Preenche o restante com caracteres aleatórios
        $tamanhoRestante = $tamanho - strlen($chave);
        $todosCaracteresArray = str_split($todosCaracteres);

        for ($i = 0; $i < $tamanhoRestante; $i++) {
            $chave .= $todosCaracteresArray[random_int(0, count($todosCaracteresArray) - 1)];
        }

        // Embaralha a chave para maior aleatoriedade
        return str_shuffle($chave);
    }
    public function obterUsuarios()
    {
        $usuarios = $this->usuarioModel->obterTodosAtivos();
        return $this->response->setJSON($usuarios);
    }
}
