<?php

namespace App\Controllers;

use App\Models\ChamadoModel;
use App\Models\ArquivoModel;
use App\Models\UsuarioModel;
use App\Models\AtendimentoModel;
use App\Models\AvaliacaoModel;
use App\Models\HistoricoModel;

class Relatorio extends BaseController
{
    protected $chamadoModel;
    protected $arquivoModel;
    protected $usuarioModel;
    protected $atendimentoModel;
    protected $avaliacaoModel;
    protected $historicoModel;

    public function __construct()
    {
        $this->chamadoModel = new ChamadoModel();
        $this->arquivoModel = new ArquivoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->atendimentoModel = new AtendimentoModel();
        $this->avaliacaoModel = new AvaliacaoModel();
        $this->historicoModel = new HistoricoModel();
    }

    public function index()
    {
        $isLogged = session()->get('token');
        $user = base64_decode($isLogged);
        $isLogged = json_decode($user);

        if ($isLogged) {
            // Obter dados para relatórios com filtro do mês/ano atual
            $anoAtual = date('Y');
            $mesAtual = date('m');
            
            $estatisticas = $this->obterEstatisticasGerais($anoAtual, $mesAtual);
            $atendimentosPorUsuario = $this->obterAtendimentosPorUsuario($anoAtual, $mesAtual);
            $evolucaoMensal = $this->obterEvolucaoMensal($anoAtual);
            $atendimentosDiarios = $this->obterAtendimentosDiarios($anoAtual, $mesAtual);

            $data = [
                "data" => $this->chamadoModel->obterTodos(),
                "permissao" => [
                    "nivel" => $isLogged->nivel,
                    "setor" =>  $isLogged->setor
                ],
                "user" => json_decode($user)->user,
                "estatisticas" => $estatisticas,
                "atendimentosPorUsuario" => $atendimentosPorUsuario,
                "evolucaoMensal" => $evolucaoMensal,
                "atendimentosDiarios" => $atendimentosDiarios
            ];

            return view('relatorios/index', $data);
        }

        return redirect()->to(base_url('login'));
    }

    /**
     * Obter estatísticas gerais dos chamados
     */
    private function obterEstatisticasGerais($ano = null, $mes = null)
    {
        $db = \Config\Database::connect();
        
        // Construir filtro de data se fornecido
        $filtroData = '';
        if ($ano && $mes) {
            $filtroData = " AND YEAR(registro) = $ano AND MONTH(registro) = $mes";
        } elseif ($ano) {
            $filtroData = " AND YEAR(registro) = $ano";
        }
        
        // Contar chamados por status
        $concluidos = $db->query("SELECT COUNT(*) as total FROM chamados WHERE status = 'C' $filtroData")->getRow()->total;
        $emAndamento = $db->query("SELECT COUNT(*) as total FROM chamados WHERE status = 'E' $filtroData")->getRow()->total;
        $pendentes = $db->query("SELECT COUNT(*) as total FROM chamados WHERE status IN ('A', 'B') $filtroData")->getRow()->total;
        
        // Contar atendentes ativos (sem filtro de data)
        $atendentes = $db->query("SELECT COUNT(DISTINCT u.id) as total FROM usuarios u 
                                 INNER JOIN atendimento a ON u.id = a.usuario_id 
                                 WHERE u.nivel = 'admin'")->getRow()->total;

        return [
            'concluidos' => $concluidos,
            'em_andamento' => $emAndamento,
            'pendentes' => $pendentes,
            'atendentes' => $atendentes
        ];
    }

    /**
     * Obter atendimentos por usuário
     */
    private function obterAtendimentosPorUsuario($ano = null, $mes = null)
    {
        $db = \Config\Database::connect();
        
        // Construir filtro de data se fornecido
        $filtroData = '';
        if ($ano && $mes) {
            $filtroData = " AND YEAR(c.registro) = $ano AND MONTH(c.registro) = $mes";
        } elseif ($ano) {
            $filtroData = " AND YEAR(c.registro) = $ano";
        }
        
        $query = "SELECT 
                    u.nome,
                    COUNT(CASE WHEN c.status = 'C' THEN 1 END) as concluidos,
                    COUNT(CASE WHEN c.status = 'E' THEN 1 END) as em_andamento,
                    COUNT(CASE WHEN c.status IN ('A', 'B') THEN 1 END) as pendentes,
                    COUNT(*) as total,
                    ROUND((COUNT(CASE WHEN c.status = 'C' THEN 1 END) * 100.0 / NULLIF(COUNT(*), 0)), 1) as performance
                  FROM usuarios u
                  LEFT JOIN atendimento a ON u.id = a.usuario_id
                  LEFT JOIN chamados c ON a.chamado_id = c.id
                  WHERE u.nivel = 'admin' $filtroData
                  GROUP BY u.id, u.nome
                  HAVING COUNT(*) > 0
                  ORDER BY concluidos DESC";
        
        return $db->query($query)->getResultArray();
    }

    /**
     * Obter evolução mensal dos chamados (sempre mostra o ano completo)
     */
    private function obterEvolucaoMensal($ano = null)
    {
        $db = \Config\Database::connect();
        $ano = $ano ?: date('Y');
        
        $query = "SELECT 
                    MONTH(registro) as mes,
                    COUNT(CASE WHEN status = 'C' THEN 1 END) as concluidos,
                    COUNT(CASE WHEN status = 'E' THEN 1 END) as em_andamento,
                    COUNT(CASE WHEN status IN ('A', 'B') THEN 1 END) as pendentes
                  FROM chamados 
                  WHERE YEAR(registro) = ?
                  GROUP BY MONTH(registro)
                  ORDER BY mes";
        
        $resultado = $db->query($query, [$ano])->getResultArray();
        
        // Preencher meses sem dados
        $evolucao = [];
        for ($i = 1; $i <= 12; $i++) {
            $evolucao[$i] = [
                'mes' => $i,
                'concluidos' => 0,
                'em_andamento' => 0,
                'pendentes' => 0
            ];
        }
        
        foreach ($resultado as $row) {
            $evolucao[$row['mes']] = $row;
        }
        
        return array_values($evolucao);
    }

    /**
     * Obter atendimentos diários com base no período filtrado
     */
    private function obterAtendimentosDiarios($periodo = null, $ano = null, $mes = null, $trimestre = null, $semestre = null)
    {
        $db = \Config\Database::connect();
        
        // Se não há filtros, usar últimos 15 dias
        if (!$periodo || !$ano) {
            $query = "SELECT 
                        DATE(registro) as data,
                        COUNT(*) as total
                      FROM chamados 
                      WHERE registro >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)
                      GROUP BY DATE(registro)
                      ORDER BY data";
            
            return $db->query($query)->getResultArray();
        }
        
        $whereClause = "WHERE YEAR(registro) = ?";
        $params = [$ano];
        
        switch ($periodo) {
            case 'mensal':
                $whereClause .= " AND MONTH(registro) = ?";
                $params[] = $mes;
                break;
                
            case 'trimestral':
                $mesesTrimestre = [
                    1 => [1, 2, 3],
                    2 => [4, 5, 6],
                    3 => [7, 8, 9],
                    4 => [10, 11, 12]
                ];
                $meses = $mesesTrimestre[$trimestre];
                $whereClause .= " AND MONTH(registro) IN (" . implode(',', $meses) . ")";
                break;
                
            case 'semestral':
                $mesesSemestre = [
                    1 => [1, 2, 3, 4, 5, 6],
                    2 => [7, 8, 9, 10, 11, 12]
                ];
                $meses = $mesesSemestre[$semestre];
                $whereClause .= " AND MONTH(registro) IN (" . implode(',', $meses) . ")";
                break;
                
            case 'anual':
                // Já filtrado pelo ano na whereClause
                break;
        }
        
        $query = "SELECT 
                    DATE(registro) as data,
                    COUNT(*) as total
                  FROM chamados 
                  $whereClause
                  GROUP BY DATE(registro)
                  ORDER BY data";
        
        return $db->query($query, $params)->getResultArray();
    }

    /**
     * Gerar relatório com filtros via AJAX
     */
    public function gerarRelatorio()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Requisição inválida']);
        }

        $periodo = $this->request->getPost('periodo');
        $ano = $this->request->getPost('ano');
        $mes = $this->request->getPost('mes');
        $trimestre = $this->request->getPost('trimestre');
        $semestre = $this->request->getPost('semestre');

        try {
            $dados = $this->obterDadosComFiltro($periodo, $ano, $mes, $trimestre, $semestre);
            
            return $this->response->setJSON([
                'success' => true,
                'data' => $dados
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erro ao gerar relatório: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Obter dados com filtros específicos
     */
    private function obterDadosComFiltro($periodo, $ano, $mes = null, $trimestre = null, $semestre = null)
    {
        $db = \Config\Database::connect();
        $whereClause = "WHERE YEAR(registro) = ?";
        $params = [$ano];

        switch ($periodo) {
            case 'mensal':
                $whereClause .= " AND MONTH(registro) = ?";
                $params[] = $mes;
                break;
            case 'trimestral':
                $mesesTrimestre = [
                    1 => [1, 2, 3],
                    2 => [4, 5, 6],
                    3 => [7, 8, 9],
                    4 => [10, 11, 12]
                ];
                $meses = $mesesTrimestre[$trimestre];
                $whereClause .= " AND MONTH(registro) IN (" . implode(',', $meses) . ")";
                break;
            case 'semestral':
                $mesesSemestre = [
                    1 => [1, 2, 3, 4, 5, 6],
                    2 => [7, 8, 9, 10, 11, 12]
                ];
                $meses = $mesesSemestre[$semestre];
                $whereClause .= " AND MONTH(registro) IN (" . implode(',', $meses) . ")";
                break;
        }

        // Estatísticas filtradas
        $estatisticas = $db->query("SELECT 
                                      COUNT(CASE WHEN status = 'C' THEN 1 END) as concluidos,
                                      COUNT(CASE WHEN status = 'E' THEN 1 END) as em_andamento,
                                      COUNT(CASE WHEN status IN ('A', 'B') THEN 1 END) as pendentes
                                    FROM chamados $whereClause", $params)->getRow();

        // Atendimentos por usuário filtrados
        $atendimentosPorUsuario = $db->query("SELECT 
                                                u.nome,
                                                COUNT(CASE WHEN c.status = 'C' THEN 1 END) as concluidos,
                                                COUNT(CASE WHEN c.status = 'E' THEN 1 END) as em_andamento,
                                                COUNT(CASE WHEN c.status IN ('A', 'B') THEN 1 END) as pendentes,
                                                COUNT(*) as total,
                                                ROUND((COUNT(CASE WHEN c.status = 'C' THEN 1 END) * 100.0 / COUNT(*)), 1) as performance
                                              FROM usuarios u
                                              LEFT JOIN atendimento a ON u.id = a.usuario_id
                                              LEFT JOIN chamados c ON a.chamado_id = c.id
                                              $whereClause AND u.nivel = 'admin'
                                              GROUP BY u.id, u.nome
                                              ORDER BY concluidos DESC", $params)->getResultArray();

        // Obter dados de atendimentos diários com filtros corretos
        $atendimentosDiarios = $this->obterAtendimentosDiarios($periodo, $ano, $mes, $trimestre, $semestre);

        // Obter dados de evolução mensal (sempre mostra o ano completo)
        $evolucaoMensal = $this->obterEvolucaoMensal($ano);

        // Contar total de atendentes
        $totalAtendentes = $db->query("SELECT COUNT(DISTINCT u.id) as total 
                                       FROM usuarios u 
                                       LEFT JOIN atendimento a ON u.id = a.usuario_id 
                                       LEFT JOIN chamados c ON a.chamado_id = c.id 
                                       $whereClause AND u.nivel = 'admin'", $params)->getRow()->total;

        return [
            'estatisticas' => (object) array_merge((array) $estatisticas, ['atendentes' => $totalAtendentes]),
            'atendimentosPorUsuario' => $atendimentosPorUsuario,
            'atendimentosDiarios' => $atendimentosDiarios,
            'evolucaoMensal' => $evolucaoMensal
        ];
    }
}
