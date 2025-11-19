<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ControlChamados - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --secondary: #1b5e20;
            --success: #4caf50;
            --warning: #ff9800;
            --info: #2196f3;
            --dark: #1e1e2c;
            --light: #f8f9fa;
            --gray: #6c757d;
            --white: #ffffff;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: #333;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Layout principal */
        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Painel esquerdo - Informações */
        .info-panel {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .info-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48cGF0dGVybiBpZD0icGF0dGVybiIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIiBwYXR0ZXJuVHJhbnNmb3JtPSJyb3RhdGUoNDUpIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIi8+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjEpIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIi8+PC9zdmc+');
            opacity: 0.3;
        }

        .info-content {
            position: relative;
            z-index: 1;
            max-width: 500px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .logo i {
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .logo h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        .features {
            margin: 40px 0;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .feature i {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            width: 40px;
            text-align: center;
        }

        .feature h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .feature p {
            opacity: 0.8;
            font-size: 0.95rem;
        }

        /* Painel direito - Formulário de login */
        .login-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background-color: var(--white);
        }

        .login-form-container {
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .login-header p {
            color: var(--gray);
        }

        .login-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .input-with-icon input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .input-with-icon input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);
            outline: none;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me input {
            width: 16px;
            height: 16px;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-button:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: var(--gray);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #ddd;
        }

        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .social-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .social-btn.google i {
            color: #DB4437;
        }

        .social-btn.microsoft i {
            color: #00A4EF;
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            color: var(--gray);
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }

            .info-panel {
                padding: 40px 20px;
            }

            .info-content {
                max-width: 100%;
            }

            .login-panel {
                padding: 40px 20px;
            }
        }

        @media (max-width: 576px) {
            .logo h1 {
                font-size: 1.5rem;
            }

            .feature h3 {
                font-size: 1rem;
            }

            .social-login {
                flex-direction: column;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <?php $success = session()->getFlashdata('success'); if ($success): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '<?= $success ?>',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        background: '#f8f9fa',
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                });
            </script>
        <?php endif; ?>
        <?php $error = session()->getFlashdata('error'); if ($error): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: '<?= $error ?>',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        background: '#f8f9fa',
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                });
            </script>
        <?php endif; ?>
        <!-- Painel esquerdo com informações -->
        <div class="info-panel">
            <div class="info-content">
                <div class="logo">
                    <i class="fas fa-headset"></i>
                    <h1>IFPA - Suportes</h1>
                </div>

                <h2>Sistema de Gerenciamento de Chamados</h2>
                <p>Uma plataforma moderna para gerenciar e acompanhar solicitações de suporte técnico.</p>

                <div class="features">
                    <div class="feature">
                        <i class="fas fa-ticket-alt"></i>
                        <div>
                            <h3>Abertura Rápida</h3>
                            <p>Registre novos chamados em poucos cliques</p>
                        </div>
                    </div>

                    <div class="feature">
                        <i class="fas fa-search"></i>
                        <div>
                            <h3>Acompanhamento em Tempo Real</h3>
                            <p>Monitore o status de seus chamados a qualquer momento</p>
                        </div>
                    </div>

                    <div class="feature">
                        <i class="fas fa-chart-bar"></i>
                        <div>
                            <h3>Dashboard Interativo</h3>
                            <p>Visualize métricas e relatórios detalhados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Painel direito com formulário de login -->
        <div class="login-panel">
            <div class="login-form-container">
                <div class="login-header">
                    <h2>Entrar no Sistema</h2>
                    <p>Use suas credenciais para acessar o sistema</p>
                </div>

                <!-- <form class="login-form"> -->
                <div class="login-form">
                    <?php echo form_open("login/signin", ["method" => "POST", "id" => "loginForm"]); ?>
                    <div class="form-group">
                        <label for="username">Usuário</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>
                            <div class="error-message">Por favor, insira um usuário válido</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                            <div class="error-message">A senha deve ter pelo menos 6 caracteres</div>
                        </div>
                    </div>

                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input type="checkbox" id="remember">
                            <label for="remember">Lembrar-me</label>
                        </div>
                        <a href="#" class="forgot-password">Esqueceu a senha?</a>
                    </div>

                    <button type="submit" id="btnEntrar" class="login-button">
                        <i class="fas fa-sign-in-alt"></i>
                        Entrar
                    </button>

                    <div class="divider">
                        <span>Ou entre com</span>
                    </div>


                    <div class="register-link">
                        <p>Não tem uma conta? <a href="#">Solicitar acesso</a></p>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <script>
            // Validação e feedback no evento de SUBMIT do formulário (cobre clique e tecla Enter)
            const loginForm = document.getElementById('loginForm');
            loginForm.addEventListener('submit', function(e) {
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;

                if (!username || !password) {
                    alert('Por favor, preencha todos os campos obrigatórios.');
                    return;
                }

                // Feedback visual do botão sem impedir o envio padrão
                const loginButton = document.getElementById('btnEntrar');
                loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Entrando...';
                // Desabilita após a fila de eventos para não bloquear o POST nativo
                setTimeout(() => {
                    loginButton.disabled = true;
                }, 0);
            });

            // Efeitos visuais nos campos de entrada
            document.querySelectorAll('.input-with-icon input').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('i').style.color = 'var(--primary)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('i').style.color = 'var(--gray)';
                });
            });
        </script>
</body>

</html>