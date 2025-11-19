<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends BaseModel
{
    protected $DBGroup = 'default';
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['responsavel', 'telefone', 'nome', 'chave', 'email', 'senha', 'setor', 'status', 'nivel', 'created_at'];
    /**
     * Retorna os dados do usuario para chave informada
     *
     * @param [type] $chave
     * @return void
     */
    public function obterDadosUser($chave = null)
    {
        if (!is_null($chave)) {
            $rs = $this->select("chave, telefone, email, nome, setor, status, nivel")
                ->where("chave", $chave)->find();
            if ($rs) {
                return $rs[0];
            }
        }
    }
    // metodo obter os dados 
    public function ObterDados()
    {
        return $this->where("status!=", "S")->findAll(); // Retorna todos os registros da tabela 'usuarios'
    }
    public function obterSolicitacoes()
    {
        return $this->where("status", "S")->findAll(); // Retorna todos os registros da tabela 'usuarios'
    }
    public function auth($username = null, $password = null)
    {
        $resultado = $this->select('*')
            ->where(['email' => $username, 'senha' => $password])
            ->findAll();
        if ($resultado) {
            $token = [
                'user' => $resultado[0]['nome'],
                'id' => $resultado[0]['id'],
                'nivel' => $resultado[0]['nivel'],
                'setor' => $resultado[0]['setor'],
            ];
            return  $this->gerarToken($token);
        }
    }
    public function gerarToken($dados = null)
    {
        if (!is_null($dados)) {
            $json = json_encode($dados);
            $_token =  base64_encode($json);
            return $_token;
        }
    }
    public function obterTodos()
    {
        return $this->select("chave, telefone, nome, setor, status, nivel")
            ->where("status !=", "S")
            ->findAll();
    }
    public function updateUser($dados = null)
    {
        if (!is_null($dados)) {
            $id = $this->obterId($dados["chave"]);
            if ($id) {
                if ($dados["acao"] == "aceitar") {
                    $dados = [
                        "status" => "A",
                        "nivel" => $dados["permissao"]
                    ];
                    return $this->update($id, $dados) ? "Solicitação autorizada com sucesso!" : "Erro ao autorizar solicitação!";
                } else {
                    $this->delete($id);
                    return "Solicitação rejeitada com sucesso!";
                }
            }
        }
    }
    public function obterId($chave = null)
    {
        if (!is_null($chave)) {
            $rs = $this->select("id")
                ->where("chave", $chave)
                ->find();
            if ($rs) {
                return $rs[0]["id"];
            }
        }
    }
    /**
     * Retorna os dados do usuário para realizar o reset de senha
     *
     * @param [type] $chave
     * @return void
     */
    public function obterUserToReset($chave = null)
    {
        if (!is_null($chave)) {
            $rs = $this->select("id,telefone")
                ->where("chave", $chave)
                ->find();
            if ($rs) {
                return $rs[0];
            }
        }
    }
    public function addSolicitacao($dados = null)
    {
        if (!is_null($dados)) {
            $dados_insert = [
                "chave" => $this->gerarChave(),
                "email" => $dados["email"],
                "nome" => $dados["nome"],
                "telefone" => $dados["fone"],
                "responsavel" => $dados["responsavel"],
                "senha" => md5(md5(md5($dados["siape"]))),
                "setor" => $dados["setor"],
                "status" => "S",
                "nivel" => NULL,
                "created_at" => date("Y:m:d H:i:s")
            ];
            return $this->insert($dados_insert);
        }
    }
    public function gerarChave()
    {
        return md5(uniqid(rand() . date("Y:m:d H:i:s")));
    }
    public function obterTotalUsuariosAtivos($setor = null)
    {
        $whereAtivo = [
            "status" => "A"
        ];

        if (!is_null($setor) && !empty($setor)) {
            $whereAberto["setor"] = $setor;
        }

        $rs =  $this->select("count(status) as total")
            ->where($whereAtivo)
            ->findAll();
        if ($rs) {
            return $rs[0]["total"];
        }
        return 0;
    }
    public function obterAtividadeRecente($setor = null)
    {
        $db = db_connect();
        $builder = $db->table("usuarios");
        $builder->select("c.numero, usuarios.nome, c.setor, c.registro, c.status");
        $builder->join("chamados c", "c.usuario_id = usuarios.id");
        if (!is_null($setor) && !empty($setor)) {
            $builder->where("c.setor", $setor);
        }
        $builder->limit(5);
        $builder->orderBy("c.registro", "DESC");
        $query = $builder->get();
        $rs = $query->getResultArray();
        if ($rs) {
            return $rs;
        }
        return [];
    }
    /**
     * Confirma se o usuário existe e se a senha está correta
     * para redefinição de senha
     * @param [type] $id
     * @param [type] $senha
     * @return void
     */
    public function checkUser($id = null, $senha = null)
    {
        if (!is_null($id) && !is_null($senha)) {
            $rs = $this->select("id")
                ->where(["id" => $id, "senha" => md5(md5(md5($senha)))])
                ->find();
            if ($rs) {
                return true;
            }
        }
        return false;
    }
    public function obterTodosAtivos()
    {
        return $this->select("id, nome, funcao")
            ->where("status", "A")
            ->where("setor", "TI")
            ->findAll();
    }
}
