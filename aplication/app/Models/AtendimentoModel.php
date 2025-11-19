<?php

namespace App\Models;

use CodeIgniter\Model;

class AtendimentoModel extends BaseModel
{
    protected $DBGroup = 'default';
    protected $table      = 'atendimento';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['usuario_id', 'chamado_id', 'created_at'];
    protected $before = ["gerarChave"];
    public function obterIdParaAvaliacao($chamado_id)
    {
        $rs =  $this->select('id')
            ->where('chamado_id', $chamado_id)
            ->orderBy('id', 'desc')
            ->find();
        if (!empty($rs) && isset($rs[0]['id'])) {
            return $rs[0]['id'];
        }

        return null;
    }
}
