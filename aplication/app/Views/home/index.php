<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<script>
    const base_url = '<?= base_url() ?>';
    const nomeUser = '<?= $user ?>';
</script>
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
    }

    /* Sidebar */
    .sidebar {
        width: 250px;
        background: #2e7d32;
        color: var(--white);
        padding: 20px 0;
        transition: var(--transition);
        height: 100vh;
        position: fixed;
        overflow-y: auto;
    }

    .sidebar-header {
        padding: 0 20px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 20px;
    }

    .sidebar-header h2 {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.5rem;
    }

    .sidebar-header h2 i {
        color: #ffffff;
    }

    .sidebar-menu {
        list-style: none;
    }

    .sidebar-menu li {
        margin-bottom: 5px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: var(--transition);
        gap: 10px;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
        background: rgba(255, 255, 255, 0.15);
        border-left: 4px solid #4caf50;
    }

    .sidebar-menu a i {
        width: 20px;
        text-align: center;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        margin-left: 250px;
        padding: 20px;
        transition: var(--transition);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    /* Welcome Section */
    .welcome-container {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: 16px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .welcome-container::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(25deg);
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .greeting {
        font-size: 2.2rem;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .welcome-message {
        font-size: 1.1rem;
        margin-bottom: 20px;
        max-width: 600px;
        opacity: 0.9;
    }

    .datetime {
        display: flex;
        gap: 20px;
        margin-top: 25px;
        flex-wrap: wrap;
    }

    .date,
    .time {
        background: rgba(255, 255, 255, 0.15);
        padding: 10px 20px;
        border-radius: 10px;
        backdrop-filter: blur(5px);
    }

    /* Quick Stats */
    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .stat-icon.open {
        background: rgba(255, 152, 0, 0.2);
        color: var(--warning);
    }

    .stat-icon.progress {
        background: rgba(46, 125, 50, 0.2);
        color: var(--primary);
    }

    .stat-icon.completed {
        background: rgba(76, 175, 80, 0.2);
        color: var(--success);
    }

    .stat-info {
        flex-grow: 1;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-title {
        color: var(--gray);
        font-size: 0.9rem;
    }

    /* Quick Actions */
    .section-title {
        margin: 30px 0 20px;
        font-size: 1.5rem;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .action-card {
        background: var(--white);
        border-radius: 12px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        text-align: center;
        cursor: pointer;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .action-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
        color: white;
        background: var(--primary);
    }

    .action-title {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: var(--dark);
    }

    .action-desc {
        color: var(--gray);
        font-size: 0.9rem;
    }

    /* Recent Activity */
    .recent-activity {
        background: var(--white);
        border-radius: 12px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
    }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: rgba(46, 125, 50, 0.1);
        color: var(--primary);
    }

    .activity-content {
        flex-grow: 1;
    }

    .activity-title {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .activity-time {
        font-size: 0.85rem;
        color: var(--gray);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .sidebar {
            width: 70px;
        }

        .sidebar-header h2 span,
        .sidebar-menu a span {
            display: none;
        }

        .main-content {
            margin-left: 70px;
        }

        .greeting {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 768px) {

        .quick-stats,
        .quick-actions {
            grid-template-columns: 1fr;
        }

        .datetime {
            flex-direction: column;
            gap: 10px;
        }

        .welcome-container {
            padding: 20px;
        }
    }
</style>


<!-- Main Content -->
<div class="header">
    <h1>Painel Principal</h1>
    <div class="user-info">
        <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
        <span><?php echo $user; ?></span>
    </div>
</div>

<!-- Welcome Section -->
<div class="welcome-container">
    <div class="welcome-content">
        <h2 class="greeting" id="greeting">Bom dia, <?php echo $user; ?>!</h2>
        <p class="welcome-message">Seja bem-vindo ao Sistema de Suporte IFPA. Aqui você pode gerenciar chamados, acompanhar solicitações e visualizar relatórios.</p>

        <div class="datetime">
            <div class="date" id="current-date">Segunda-feira, 00 de Janeiro de 2023</div>
            <div class="time" id="current-time">00:00:00</div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="quick-stats">
    <div class="stat-card">
        <div class="stat-icon open">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <div id="totalAberto" class="stat-number">0</div>
            <div class="stat-title">Chamados em Aberto</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon progress">
            <i class="fas fa-spinner"></i>
        </div>
        <div class="stat-info">
            <div id="totalAndamento" class=" stat-number">0</div>
            <div class="stat-title">Em Andamento</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon completed">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div id="totalConcluido" class="stat-number">0</div>
            <div class="stat-title">Concluídos (Este Mês)</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<h2 class="section-title"><i class="fas fa-bolt"></i> Ações Rápidas</h2>

<div class="quick-actions">
    <div class="action-card">
        <a style="cursor: pointer; text-decoration: none;" href="<?php echo base_url('chamados/create'); ?>">
            <div class="action-icon">
                <i class="fas fa-plus"></i>
            </div>
            <h3 class="action-title">Abrir Chamado</h3>
            <p class="action-desc">Registre uma nova solicitação de suporte</p>
        </a>
    </div>

    <div class="action-card">
        <a style="cursor: pointer; text-decoration: none;" href="<?php echo base_url('meus-chamados'); ?>">
            <div class="action-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="action-title">Acompanhar</h3>
            <p class="action-desc">Consulte o status de um chamado</p>
        </a>
    </div>

    <div class="action-card">
        <a style="cursor: pointer; text-decoration: none;" href="<?php echo base_url('chamados'); ?>">
            <div class="action-icon">
                <i class="fas fa-list"></i>
            </div>
            <h3 class="action-title">Meus Chamados</h3>
            <p class="action-desc">Visualize todos os seus chamados</p>
        </a>
    </div>

    <div class="action-card">
        <a style="cursor: pointer; text-decoration: none;" href="<?php echo base_url('relatorios'); ?>">
            <div class="action-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <h3 class="action-title">Relatórios</h3>
            <p class="action-desc">Acesse relatórios e estatísticas</p>
        </a>
    </div>
</div>

<script>
    const obterDados = async () => {
        const response = await fetch(base_url + 'home/obterDados', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
        });
        if (response.ok) {
            const data = await response.json();
            return data;
        } else {
            throw new Error('Erro ao carregar dados');
        }
    }

    // Função principal assíncrona para executar o código
    const carregarDadosHome = async () => {
        const totalAberto = document.getElementById("totalAberto");
        const totalAndamento = document.getElementById("totalAndamento");
        const totalConcluido = document.getElementById("totalConcluido");
        try {

            const data = await obterDados();
            if (data.success == true) {
                const dadosResponse = data.data;
                if (dadosResponse.chamadosAbertos && totalAberto) {
                    totalAberto.innerText = dadosResponse.chamadosAbertos;
                }
                if (dadosResponse.chamadosAndamento && totalAndamento) {
                    totalAndamento.innerText = dadosResponse.chamadosAndamento;
                }
                if (dadosResponse.chamadosConcluido && totalConcluido) {
                    totalConcluido.innerText = dadosResponse.chamadosConcluido;
                }

            } else {
                throw new Error(`Status inesperado: ${data.status}`);
            }
        } catch (error) {
            console.error('Erro:', error);
            Swal.fire({
                icon: 'error',
                title: 'Erro de conexão',
                text: 'Não foi possível conectar ao servidor. Verifique sua conexão e tente novamente.',
                confirmButtonText: 'OK'
            });
        }
    }
    carregarDadosHome();
    // Função para atualizar dados em tempo real (opcional)
    function iniciarAtualizacaoTempoReal() {
        setInterval(() => {
            // Recarregar dados do dashboard periodicamente
            carregarDadosHome();
        }, 30000); // Atualizar a cada 30 segundos
    }
    // Iniciar atualização em tempo real
    iniciarAtualizacaoTempoReal();


    // Atualizar saudação de acordo com o horário
    function updateGreeting() {
        const hour = new Date().getHours();
        const greeting = document.getElementById('greeting');
        const userName = nomeUser;

        if (hour >= 5 && hour < 12) {
            greeting.textContent = `Bom dia, ${userName}!`;
        } else if (hour >= 12 && hour < 18) {
            greeting.textContent = `Boa tarde, ${userName}!`;
        } else {
            greeting.textContent = `Boa noite, ${userName}!`;
        }
    }

    // Atualizar data e hora
    function updateDateTime() {
        const now = new Date();

        // Formatar data
        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        const dateString = now.toLocaleDateString('pt-BR', options);
        document.getElementById('current-date').textContent = dateString;

        // Formatar hora
        const timeString = now.toLocaleTimeString('pt-BR');
        document.getElementById('current-time').textContent = timeString;
    }

    // Inicializar e atualizar a cada segundo
    updateGreeting();
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Adicionar interações aos cards de ação
    document.querySelectorAll('.action-card').forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);

            // Aqui você pode adicionar a lógica para redirecionar para a página correspondente
            const title = this.querySelector('.action-title').textContent;
        });
    });
</script>
<?php echo $this->endSection('content'); ?>