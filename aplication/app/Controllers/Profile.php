<?php

namespace App\Controllers;

use App\Models\ChamadoModel;
use App\Models\UsuarioModel;
use App\Models\AvaliacaoModel;
use App\Models\HistoricoModel;

class Profile extends BaseController
{
    protected $chamadoModel;
    protected $usuarioModel;
    protected $avaliacaoModel;
    protected $historicoModel;

    public function __construct()
    {
        $this->chamadoModel = new ChamadoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->avaliacaoModel = new AvaliacaoModel();
        $this->historicoModel = new HistoricoModel();
    }

    public function index()
    {

        $isLogaded = session()->get('token');
        if ($isLogaded) {
            $user = base64_decode($isLogaded);
            $user = json_decode($user);
            $data = [
                'user' => $user->user,
                'chamados' => $this->chamadoModel->obterTodosMeusChamados($user->id)
            ];
            return view('profile/index', $data);
        }
        return redirect()->to(base_url('login'));
    }
    public function obterDados()
    {
        $isLogaded = session()->get('token');
        $user = base64_decode($isLogaded);
        $user = json_decode($user);
        if ($this->request->isAJAX() &&  $user->id) {
            $data = [
                "chamadosAbertos" => $this->chamadoModel->obterTotalChamadosPorUsuario($user->id, "A"),
                "chamadosAndamento" => $this->chamadoModel->obterTotalChamadosPorUsuario($user->id, "E"),
                "chamadosConcluido" => $this->chamadoModel->obterTotalChamadosPorUsuario($user->id, "C"),
                "chamadosDevolvido" => $this->chamadoModel->obterTotalChamadosPorUsuario($user->id, "B"),
                "chamadosConfirmacao" => $this->chamadoModel->obterTotalChamadosPorUsuario($user->id, "F"),
                "chamadosCancelado" => $this->chamadoModel->obterTotalChamadosPorUsuario($user->id, "X"),
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
    public function carregarViewSiga()
    {
        $isLogaded = session()->get('token');
        $user = base64_decode($isLogaded);
        $user = json_decode($user);
        if ($this->request->isAJAX() &&  $user->id) {
            $chave = $this->request->getPost('chave');
            $data = [
                'user' => $user->user,
                'chamado' => $this->chamadoModel->obterDadosDoChamadoParaSiga($chave)
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
    public function sendAvaliacao()
    {
        try {
            $isLogaded = session()->get('token');
            $user = base64_decode($isLogaded);
            $user = json_decode($user);

            if ($this->request->isAJAX() &&  $user->id) {

                $chave = $this->request->getPost('chave');
                $avaliacao = $this->request->getPost('avaliacao');

                // Log dos dados recebidos
                log_message('debug', 'sendAvaliacao - Dados recebidos: chave=' . $chave . ', avaliacao=' . $avaliacao . ', user_id=' . $user->id);

                if (empty($chave) || empty($avaliacao)) {
                    log_message('error', 'sendAvaliacao - Dados obrigatórios não informados');
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Chave do chamado e avaliação são obrigatórios'
                    ])->setStatusCode(400);
                }

                $chamado_id = $this->chamadoModel->obterId($chave);
                log_message('debug', 'sendAvaliacao - chamado_id obtido: ' . ($chamado_id ? $chamado_id : 'null'));

                if (!$chamado_id) {
                    log_message('error', 'sendAvaliacao - Chamado não encontrado para chave: ' . $chave);
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Chamado não encontrado ou inválido'
                    ])->setStatusCode(404);
                }

                $rs = $this->avaliacaoModel->atualizarAvaliacao($user->id, $chamado_id, $avaliacao);
                log_message('debug', 'sendAvaliacao - Resultado atualizarAvaliacao: ' . ($rs !== false ? $rs : 'false'));

                if ($rs === false) {
                    log_message('error', 'sendAvaliacao - Falha ao atualizar avaliação para chamado_id: ' . $chamado_id . ', user_id: ' . $user->id);
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Nenhum atendimento foi encontrado para este chamado e usuário.'
                    ])->setStatusCode(404);
                }

                log_message('info', 'sendAvaliacao - Avaliação salva com sucesso. ID: ' . $rs);
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Avaliação enviada com sucesso',
                    'data' => $rs
                ]);
            } else {
                log_message('warning', 'sendAvaliacao - Acesso negado: não é AJAX ou usuário não logado');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Faça login para continuar',
                    'errorLogin' => true
                ])->setStatusCode(401);
            }
        } catch (\Exception $e) {
            log_message('error', 'sendAvaliacao - Exceção capturada: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erro interno do servidor: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
    public function sendComentario()
    {
        try {
            $isLogaded = session()->get('token');
            $user = base64_decode($isLogaded);
            $user = json_decode($user);
            
            if ($this->request->isAJAX() && $user->id) {
                $chave = $this->request->getPost('chave');
                $comentario = $this->request->getPost('comentario');
                
                // Log dos dados recebidos
                log_message('debug', 'sendComentario - Dados recebidos: chave=' . $chave . ', user_id=' . $user->id);
                
                // Validar dados obrigatórios
                if (empty($chave) || empty($comentario)) {
                    log_message('error', 'sendComentario - Dados obrigatórios não informados');
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Chave do chamado e comentário são obrigatórios'
                    ])->setStatusCode(400);
                }
                
                $chamado_id = $this->chamadoModel->obterId($chave);
                log_message('debug', 'sendComentario - chamado_id obtido: ' . ($chamado_id ? $chamado_id : 'null'));
                
                if (!$chamado_id) {
                    log_message('error', 'sendComentario - Chamado não encontrado para chave: ' . $chave);
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Chamado não encontrado ou inválido'
                    ])->setStatusCode(404);
                }
                
                // Atualizar comentário no histórico
                $rs = $this->historicoModel->atualizarComentario($user->id, $chamado_id, $comentario);
                log_message('debug', 'sendComentario - Resultado atualizarComentario: ' . ($rs !== false ? $rs : 'false'));
                
                if ($rs === false) {
                    log_message('error', 'sendComentario - Falha ao atualizar comentário para chamado_id: ' . $chamado_id . ', user_id: ' . $user->id);
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Nenhum atendimento foi encontrado para este chamado e usuário.'
                    ])->setStatusCode(404);
                }
                
                // Verificar status atual e atualizar se necessário
                $status = $this->chamadoModel->obterStatus($chave);
                log_message('debug', 'sendComentario - Status atual do chamado: ' . $status);
                
                if ($status === null) {
                    log_message('error', 'sendComentario - Não foi possível obter o status do chamado para chave: ' . $chave);
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Erro ao verificar status do chamado'
                    ])->setStatusCode(500);
                }
                
                if ($status === 'F') {
                    // Status F = Aguardando Confirmação -> mudar para G = Confirmado Resposta
                    $statusAtualizado = $this->chamadoModel->atualizarStatus($chamado_id, 'G');
                    
                    if ($statusAtualizado) {
                        log_message('info', 'sendComentario - Status atualizado de F para G para chamado_id: ' . $chamado_id);
                    } else {
                        log_message('error', 'sendComentario - Falha ao atualizar status de F para G para chamado_id: ' . $chamado_id);
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Erro ao atualizar status do chamado'
                        ])->setStatusCode(500);
                    }
                }
                
                log_message('info', 'sendComentario - Comentário enviado com sucesso para chamado_id: ' . $chamado_id);
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Comunicação realizada com sucesso',
                ]);
                
            } else {
                log_message('warning', 'sendComentario - Acesso negado: não é AJAX ou usuário não logado');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Faça login para continuar',
                    'errorLogin' => true
                ])->setStatusCode(401);
            }
        } catch (\Exception $e) {
            log_message('error', 'sendComentario - Exceção capturada: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erro interno do servidor: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
