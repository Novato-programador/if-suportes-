<?php

namespace App\Models;

use CodeIgniter\Model;

class AvaliacaoModel extends BaseModel
{
    protected $DBGroup = 'default';
    protected $table      = 'avaliacao';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['usuario_id', 'atendimento_id', 'nota', 'created_at'];
    /**
     * Atualiza ou cria uma avaliação do atendimento associado ao usuário e chamado informados.
     * - Se já existir avaliação para o mesmo usuário e atendimento, apenas atualiza a nota.
     * - Se não existir, cria uma nova avaliação.
     * - Se não existir atendimento, cria um automaticamente para permitir a avaliação.
     *
     * @param int $usuario_id
     * @param int $chamado_id
     * @param string $nota
     * @return int|false Retorna o ID da avaliação criada/atualizada ou false em caso de erro
     */
    public function atualizarAvaliacao($usuario_id, $chamado_id, $nota)
    {

        $atendimento = new AtendimentoModel();
        $atendimento_id = $atendimento->obterIdParaAvaliacao($chamado_id);

        // Se não existir atendimento associado, criar um automaticamente
        if (empty($atendimento_id)) {

            // Criar um registro de atendimento automático para permitir a avaliação
            $dados_atendimento = [
                'usuario_id' => $usuario_id,
                'chamado_id' => $chamado_id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $atendimento_id = $atendimento->insert($dados_atendimento);

            if (!$atendimento_id) {
                return false;
            }
        }


        // Verifica se já existe uma avaliação do usuário para este atendimento
        $avaliacaoExistente = $this->select('id')
            ->where('usuario_id', $usuario_id)
            ->where('atendimento_id', $atendimento_id)
            ->first();

        // deve armazenar o valor numérico da nota (string -> número)
        $notas = ['Excelente' => 4, 'Bom' => 3, 'Regular' => 2, 'Ruim' => 1];

        // Validação da nota informada
        if (!isset($notas[$nota])) {
            return false;
        }

        if (!empty($avaliacaoExistente) && isset($avaliacaoExistente['id'])) {
            // Atualiza apenas a nota
            $this->update($avaliacaoExistente['id'], ['nota' => $notas[$nota]]);
            return $avaliacaoExistente['id'];
        }

        // Cria nova avaliação
        $dados = [
            'usuario_id' => (int) $usuario_id,
            'atendimento_id' => (int) $atendimento_id,
            'nota' => $notas[$nota],
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->insert($dados);
        $insertId = $this->getInsertID();
        return $insertId;
    }
}
