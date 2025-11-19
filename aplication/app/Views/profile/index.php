<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<script>
    const base_url = '<?php echo base_url(); ?>';
</script>
<style>
    :root {
        --primary: #2e7d32;
        --secondary: #1b5e20;
        --success: #4caf50;
        --warning: #ff9800;
        --danger: hsl(0, 100.00%, 50.00%);
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
        color: #4caf50;
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

    /* Dashboard Cards */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .stat-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
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
        text-align: right;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-title {
        color: var(--gray);
        font-size: 0.9rem;
    }

    /* Section Title */
    .section-title {
        margin: 30px 0 20px;
        font-size: 1.5rem;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Tabs */
    .tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        padding-bottom: 10px;
    }

    .tab {
        padding: 8px 20px;
        border-radius: 20px;
        background: var(--light);
        cursor: pointer;
        transition: var(--transition);
    }

    .tab.active {
        background: var(--primary);
        color: white;
    }

    /* Table */
    .table-container {
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    th {
        background: #f8f9fa;
        font-weight: 600;
    }

    tr:last-child td {
        border-bottom: none;
    }

    .status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-open {
        background: rgba(255, 152, 0, 0.1);
        color: var(--warning);
    }

    .status-progress {
        background: rgba(138, 216, 22, 0.1);
        color: var(--primary);
    }

    .status-awaiting {
        background: rgba(125, 113, 46, 0.1);
        color: var(--warning);
    }

    .status-canceled {
        background: rgba(149, 50, 43, 0.1);
        color: var(--danger);
    }

    .status-returned {
        background: rgba(214, 29, 23, 0.1);
        color: var(--danger);
    }

    .status-completed {
        background: rgba(76, 175, 80, 0.1);
        color: var(--success);
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: var(--transition);
        margin-right: 5px;
        font-size: 0.85rem;
    }

    .btn-view {
        background: rgba(46, 125, 50, 0.1);
        color: var(--primary);
    }

    .btn-close {
        background: rgba(255, 152, 0, 0.1);
        color: var(--warning);
    }

    .btn_right {
        text-align: right;
    }

    .action-btn:hover {
        opacity: 0.9;
        transform: scale(1.05);
    }

    /* Search and Filter */
    .search-filter {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 15px;
    }

    .search-box {
        flex: 1;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    .filter-select {
        padding: 10px 15px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        background: white;
        font-size: 0.9rem;
        min-width: 180px;
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
    }

    @media (max-width: 768px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }

        .search-filter {
            flex-direction: column;
        }

        .filter-select {
            min-width: auto;
        }
    }

    /* Ratings */
    .rating-stars {
        display: inline-flex;
        gap: 4px;
        color: var(--warning);
        font-size: 1rem;
        vertical-align: middle;
    }

    .rating-stars .far.fa-star {
        color: rgba(0, 0, 0, 0.25);
    }
</style>

<!-- Header -->
<div class="header">
    <h1>Meus Chamados</h1>
    <div class="user-info">
        <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
        <span><?php echo $user; ?></span>
    </div>
</div>
<!-- Dashboard Cards -->
<div class="dashboard-cards">
    <div class="card">
        <div class="stat-card">
            <div class="stat-icon open">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="stat-info">
                <div id="totalAberto" class="stat-number">0</div>
                <div class="stat-title">Chamados Abertos</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="stat-card">
            <div class="stat-icon open">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="stat-info">
                <div id="totalDevolvido" class="stat-number">0</div>
                <div class="stat-title">Chamados Devolvidos</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="stat-card">
            <div class="stat-icon progress">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="stat-info">
                <div id="totalAndamento" class="stat-number">0</div>
                <div class="stat-title">Em Andamento</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="stat-card">
            <div class="stat-icon open">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="stat-info">
                <div id="totalConfirmacao" class="stat-number">0</div>
                <div class="stat-title">Aguardando Confirmação</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="stat-card">
            <div class="stat-icon completed">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <div id="totalConcluido" class="stat-number">0</div>
                <div class="stat-title">Finalizados</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="stat-card">
            <div class="stat-icon canceled">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-info">
                <div id="totalCancelado" class="stat-number">0</div>
                <div class="stat-title">Cancelados</div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="search-filter">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Buscar por protocolo, título ou descrição...">
    </div>
    <select class="filter-select">
        <option value="">Todos os status</option>
        <option value="Aberto">Aberto</option>
        <option value="Em Andamento">Em Andamento</option>
        <option value="Devolvido">Devolvido</option>
        <option value="Aguardando Confirmação">Aguardando Confirmação</option>
        <option value="Finalizado">Finalizado</option>
        <option value="Cancelado">Cancelado</option>
    </select>
</div>

<!-- Tabs -->
<div class="tabs">
    <div class="tab active">Todos os Chamados</div>
    <div class="tab">Abertos</div>
    <div class="tab">Devolvidos</div>
    <div class="tab">Em Andamento</div>
    <div class="tab">Aguardando Confirmação</div>
    <div class="tab">Finalizados</div>
    <div class="tab">Cancelados</div>
</div>

<!-- Table -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Título</th>
                <th>Data de Abertura</th>
                <th>Avaliação</th>
                <th>Status</th>
                <th class="btn_right">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $optionStatus = ['A' => 'Aberto', 'E' => 'Em Andamento', 'B' => 'Devolvido', 'G' => 'Confirmação Enviada', 'F' => 'Aguardando Confirmação', 'C' => 'Finalizado', 'X' => 'Cancelado'];
            $optionClassStatus = ['A' => 'open', 'E' => 'progress', 'B' => 'returned', 'F' => 'awaiting', 'G' => 'awaiting', 'C' => 'completed', 'X' => 'canceled'];
            if (count($chamados) > 0) {
                foreach ($chamados as $chamado) {
                    echo '<tr>';
                    echo '<td style="display:none">' . $chamado['chave'] . '</td>';
                    echo '<td>' . $chamado['numero'] . '</td>';
                    echo '<td>' . $chamado['titulo'] . '</td>';
                    echo '<td>' . toDataBR($chamado['registro']) . '</td>';
                    // Renderização de avaliação com estrelas (1 a 4)
                    $ratingRaw = $chamado['avaliacao'];
                    $ratingMap = [
                        'ruim' => 1,
                        'regular' => 2,
                        'bom' => 3,
                        'excelente' => 4
                    ];
                    $rating = 0;
                    if (is_numeric($ratingRaw)) {
                        $rating = max(0, min(4, (int)$ratingRaw));
                    } elseif (is_string($ratingRaw)) {
                        $key = strtolower(trim($ratingRaw));
                        $rating = $ratingMap[$key] ?? 0;
                    }
                    $starsHtml = '<div class="rating-stars">';
                    for ($i = 1; $i <= 4; $i++) {
                        if ($i <= $rating) {
                            $starsHtml .= '<i class="fas fa-star" aria-hidden="true"></i>';
                        } else {
                            $starsHtml .= '<i class="far fa-star" aria-hidden="true"></i>';
                        }
                    }
                    $starsHtml .= '</div>';
                    echo '<td>' . $starsHtml . '</td>';
                    echo '<td><span class="status status-' . $optionClassStatus[$chamado['status']] . '">' . $optionStatus[$chamado['status']] . '</span></td>';
                    echo '<td class="btn_right">';
                    echo '<button class="action-btn btn-view"><i class="fas fa-eye"></i> Visualizar</button>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">Nenhum chamado encontrado.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    // Filtros: busca, select e tabs funcionando em conjunto
    (function() {
        const searchInput = document.querySelector('.search-box input');
        const filterSelect = document.querySelector('.filter-select');
        const tabs = document.querySelectorAll('.tabs .tab');
        const rows = document.querySelectorAll('.table-container tbody tr');

        const tabMapping = {
            'Todos os Chamados': '',
            'Abertos': 'Aberto',
            'Devolvidos': 'Devolvido',
            'Em Andamento': 'Em Andamento',
            'Aguardando Confirmação': 'Aguardando Confirmação',
            'Confirmação Recebida': 'Confirmação Recebida',
            'Finalizados': 'Finalizado',
            'Cancelados': 'Cancelado'
        };

        function applyFilters() {
            const query = (searchInput?.value || '').trim().toLowerCase();
            const statusFilter = filterSelect?.value || '';

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                const statusSpan = row.querySelector('.status');
                const rowStatus = statusSpan ? statusSpan.textContent.trim() : '';

                const matchesQuery = query === '' || rowText.includes(query);
                const matchesStatus = statusFilter === '' || rowStatus === statusFilter;

                row.style.display = (matchesQuery && matchesStatus) ? '' : 'none';
            });
        }

        // Tabs -> atualiza select e aplica filtro
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const label = tab.textContent.trim();
                if (filterSelect && Object.prototype.hasOwnProperty.call(tabMapping, label)) {
                    filterSelect.value = tabMapping[label];
                }
                applyFilters();
            });
        });

        // Select -> ativa tab correspondente e aplica filtro
        if (filterSelect) {
            filterSelect.addEventListener('change', () => {
                const value = filterSelect.value;
                let targetLabel = 'Todos os Chamados';
                for (const [label, status] of Object.entries(tabMapping)) {
                    if (status === value) {
                        targetLabel = label;
                        break;
                    }
                }
                tabs.forEach(t => {
                    if (t.textContent.trim() === targetLabel) {
                        t.classList.add('active');
                    } else {
                        t.classList.remove('active');
                    }
                });
                applyFilters();
            });
        }

        // Busca incremental
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                applyFilters();
            });
        }

        // Inicializa com filtros padrão
        applyFilters();

        // Interação com botões de ação
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = row.querySelector('td:first-child').textContent;

                if (this.classList.contains('btn-view')) {
                    window.location.href = base_url + 'chamados/' + id + '/siga';
                }
            });
        });
    })();
</script>
<script>
    const obterDados = async () => {
        const response = await fetch(base_url + 'profile/obterDados', {
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
        const totalDevolvido = document.getElementById("totalDevolvido");
        const totalConfirmacao = document.getElementById("totalConfirmacao");
        const totalCancelado = document.getElementById("totalCancelado");
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
                if (dadosResponse.chamadosDevolvido && totalDevolvido) {
                    totalDevolvido.innerText = dadosResponse.chamadosDevolvido;
                }
                if (dadosResponse.chamadosConfirmacao && totalConfirmacao) {
                    totalConfirmacao.innerText = dadosResponse.chamadosConfirmacao;
                }
                if (dadosResponse.chamadosCancelado && totalCancelado) {
                    totalCancelado.innerText = dadosResponse.chamadosCancelado;
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
</script>
<?php echo $this->endSection('content'); ?>