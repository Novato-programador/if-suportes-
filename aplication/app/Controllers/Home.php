<?php

namespace App\Controllers;

use App\Models\ChamadoModel;
use App\Models\UsuarioModel;

class Home extends BaseController
{
    protected $chamadoModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->chamadoModel = new ChamadoModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {

        $isLogaded = session()->get('token');
        if ($isLogaded) {
            $user = base64_decode($isLogaded);
            $isLogaded = json_decode($user);
            $data = ['user' => json_decode($user)->user];
            return view('home/index', $data);
        }
        return redirect()->to(base_url('login'));
    }
    public function obterDados()
    {
        $isLogaded = session()->get('token');

        if ($isLogaded) {
            $user = base64_decode($isLogaded);
            $isLogaded = json_decode($user);
            $isFilter = $isLogaded->setor != "TI" ? $isLogaded->setor : null;
            if ($this->request->isAJAX()) {
                $data = [
                    "chamadosAbertos" => $this->chamadoModel->obterTotalChamadosAbertos($isFilter),
                    "chamadosAndamento" => $this->chamadoModel->obterTotalChamadosEmAndamento($isFilter),
                    "chamadosConcluido" => $this->chamadoModel->obterTotalChamadosConcluidoMesAtual($isFilter),
                ];
                return $this->response->setJSON([
                    'success' => true,
                    'data' => $data,
                ]);
            }
        } else {
            $this->response->setJSON([
                'success' => false,
                'message' => 'Faça login para continuar',
                'errorLogin' => true
            ]);
        }
        return $this->response->setStatusCode(404);
    }
}
