<?php

namespace App\Models;

use CodeIgniter\Model;

class ArquivoModel extends BaseModel{  
    protected $DBGroup ='default';
    protected $table      = 'arquivo';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nome', 'chamado_id', 'created_at','typeMine'];
    protected $before = ["gerarChave"];

    public function addArquivo($dados = null) {
        if(!is_null($dados)) {
            $this->insert($dados);
            return $this->getInsertID(); // Retorna o ID do arquivo inserido
        }
        return null;
    }
    public function obterTodos($chamado_id = null) {
        if (!is_null($chamado_id)) {
            return $this->select("id, nome, typeMine, created_at")
            ->where("chamado_id",$chamado_id)
            ->findAll();
        }
    }

}