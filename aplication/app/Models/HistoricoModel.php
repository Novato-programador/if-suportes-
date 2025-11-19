<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoricoModel extends BaseModel
{
    protected $DBGroup = 'default';
    protected $table      = 'historico';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['usuario_id', 'chamado_id', 'operacao', 'descricao', 'created_at'];
    protected $before = ["gerarChave"];

    public function atualizarComentario($usuario_id, $chamado_id, $comentario)
    {
        $dados = [
            "usuario_id" => $usuario_id,
            "chamado_id" => $chamado_id,
            "operacao" => "Comentário",
            "descricao" => $comentario,
            "created_at" => date('Y-m-d H:i:s')
        ];
        return $this->insert($dados);
    }
}
