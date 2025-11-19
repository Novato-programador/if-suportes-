<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }
    // Tela de login
    public function index()
    {
        $isLogaded = session()->get('token');
        if ($isLogaded) {
            return redirect()->to(base_url('home'));
        }
        return view("login/index");
    }
    // Processa o login
    public function signin()
    {
        $post = $this->request->getPost();
        if ($post) {
            $username = $post["username"];
            $password = $post["password"];
            $resposta = $this->usuarioModel->auth($username, md5(md5(md5($password))));
            if ($resposta) {
                session()->set('token', $resposta);
                return redirect()->to(base_url('home'));
            }
        }
        $mensagem = "Usuário ou senha inválidos!";
        return redirect()->to("login")->withInput()->with("error", $mensagem);
    }
    // Deslogar
    public function signout()
    {
        session()->remove("token");
        return redirect()->to(base_url('login'));
    }
    // ✅ Tela de cadastro (formulário)
    public function register()
    {
        return view("login/form");
    }
    public function store()
    {
        $post = $this->request->getPost();
        if ($post) {
            $rs = $this->usuarioModel->addSolicitacao($post);
            if ($rs) {
                // Redireciona para o formulário com mensagem de sucesso
                return redirect()->to(base_url('login'))->with('success', 'Solicitação enviada com sucesso!');
            } else {
                // Se falhar no insert, volta com mensagem de erro
                return redirect()->back()->with('error', 'Não foi possível registrar a solicitação.');
            }
        }

        // Caso não tenha POST, volta para o formulário
        return redirect()->to(base_url('login'));
    }
}
