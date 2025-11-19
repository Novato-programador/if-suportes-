<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<!-- Main Content -->
<style>
    /* Dashboard Cards - Design Aprimorado */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .card {
        background: var(--white);
        border-radius: 16px;
        padding: 24px;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        opacity: 0.8;
    }

    .stat-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: var(--transition);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }

    .stat-icon.open {
        background: linear-gradient(135deg, rgba(247, 37, 133, 0.15), rgba(247, 37, 133, 0.25));
        color: var(--warning);
        box-shadow: 0 4px 12px rgba(247, 37, 133, 0.2);
    }

    .stat-icon.progress {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.15), rgba(67, 97, 238, 0.25));
        color: var(--primary);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }

    .stat-icon.completed {
        background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.25));
        color: var(--success);
        box-shadow: 0 4px 12px rgba(76, 201, 240, 0.2);
    }

    .stat-icon.users {
        background: linear-gradient(135deg, rgba(58, 12, 163, 0.15), rgba(58, 12, 163, 0.25));
        color: var(--secondary);
        box-shadow: 0 4px 12px rgba(58, 12, 163, 0.2);
    }

    .stat-info {
        text-align: right;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 8px;
        background: linear-gradient(135deg, var(--dark), var(--gray));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-title {
        color: var(--gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Charts Section - Design Aprimorado */
    .charts-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
    }

    .chart-card {
        background: var(--white);
        border-radius: 16px;
        padding: 24px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .chart-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--dark);
    }

    .chart-actions select {
        padding: 10px 16px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        background: var(--white);
        font-size: 0.9rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .chart-actions select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .chart-container {
        height: 320px;
        position: relative;
    }

    /* Recent Activity - Design Aprimorado */
    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        gap: 16px;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 12px;
        background: var(--white);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
        transition: var(--transition);
    }

    .activity-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .activity-item:last-child {
        margin-bottom: 0;
    }

    .activity-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.2rem;
    }

    .activity-icon.ticket {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.15), rgba(67, 97, 238, 0.25));
        color: var(--primary);
    }

    .activity-icon.user {
        background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.25));
        color: var(--success);
    }

    .activity-icon.alert {
        background: linear-gradient(135deg, rgba(247, 37, 133, 0.15), rgba(247, 37, 133, 0.25));
        color: var(--warning);
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 500;
        margin-bottom: 6px;
        color: var(--dark);
        line-height: 1.4;
    }

    .activity-time {
        color: var(--gray);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .activity-time::before {
        content: '🕒';
        font-size: 0.8rem;
    }

    /* Responsive - Mantido igual */
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

        .charts-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }

        .chart-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .chart-actions {
            width: 100%;
        }

        .chart-actions select {
            width: 100%;
        }
    }
</style>
<script>
    const base_url = '<?= base_url() ?>';
</script>
<!-- Dashboard Cards -->
<div class="dashboard-cards">
    <div class="card stat-card">
        <div class="stat-icon open">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="stat-info">
            <div id="totalAberto" class="stat-number">0</div>
            <div class="stat-title">Chamados Abertos</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon progress">
            <i class="fas fa-spinner"></i>
        </div>
        <div class="stat-info">
            <div id="totalAndamento" class="stat-number">0</div>
            <div class="stat-title">Em Andamento</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon completed">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div id="totalConcluido" class="stat-number">0</div>
            <div class="stat-title">Concluídos</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon users">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <div id="totalUsuarios" class="stat-number">0</div>
            <div class="stat-title">Usuários Ativos</div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="charts-container">
    <!-- Main Chart -->
    <div class="chart-card">
        <div class="chart-header">
            <div class="chart-title">Chamados por Status (Últimos 7 dias)</div>
            <div class="chart-actions">
                <select id="timeRange">
                    <option value="week">Última semana</option>
                    <option value="month">Último mês</option>
                    <option value="quarter">Último trimestre</option>
                </select>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Top Categories -->
    <div class="chart-card">
        <div class="chart-header">
            <div class="chart-title">Top Categorias</div>
        </div>
        <div class="chart-container">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="chart-card">
    <div class="chart-header">
        <div class="chart-title">Atividade Recente</div>
    </div>
    <ul class="activity-list" id="atividadesRecentes"></ul>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const statusData = {
        week: {
            labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            datasets: [{
                    label: 'Abertos',
                    data: [12, 19, 8, 15, 10, 7, 14],
                    backgroundColor: 'rgba(247, 37, 133, 0.2)',
                    borderColor: 'rgba(247, 37, 133, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Em Andamento',
                    data: [8, 12, 6, 10, 14, 9, 11],
                    backgroundColor: 'rgba(46, 125, 50, 0.2)',
                    borderColor: 'rgba(46, 125, 50, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Concluídos',
                    data: [20, 25, 18, 22, 28, 24, 30],
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderColor: 'rgba(76, 175, 80, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        },
        month: {
            labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
            datasets: [{
                    label: 'Abertos',
                    data: [45, 52, 48, 55],
                    backgroundColor: 'rgba(255, 152, 0, 0.2)',
                    borderColor: 'rgba(255, 152, 0, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Em Andamento',
                    data: [35, 40, 38, 42],
                    backgroundColor: 'rgba(67, 97, 238, 0.2)',
                    borderColor: 'rgba(67, 97, 238, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Concluídos',
                    data: [120, 135, 125, 140],
                    backgroundColor: 'rgba(76, 201, 240, 0.2)',
                    borderColor: 'rgba(76, 201, 240, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        },
        quarter: {
            labels: ['Mês 1', 'Mês 2', 'Mês 3'],
            datasets: [{
                    label: 'Concluídos',
                    data: [450, 480, 520],
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderColor: 'rgba(76, 175, 80, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Em Andamento',
                    data: [120, 135, 150],
                    backgroundColor: 'rgba(46, 125, 50, 0.2)',
                    borderColor: 'rgba(46, 125, 50, 1)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Pendentes',
                    data: [150, 165, 180],
                    backgroundColor: 'rgba(255, 152, 0, 0.2)',
                    borderColor: 'rgba(255, 152, 0, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        }
    };

    const categoryData = {
        labels: ['Hardware', 'Software', 'Rede', 'Outros'],
        datasets: [{
            data: [32, 28, 15, 9],
            backgroundColor: [
                'rgba(67, 97, 238, 0.8)',
                'rgba(76, 201, 240, 0.8)',
                'rgba(247, 37, 133, 0.8)',
                'rgba(108, 117, 125, 0.8)'
            ],
            borderColor: [
                'rgba(67, 97, 238, 1)',
                'rgba(76, 201, 240, 1)',
                'rgba(247, 37, 133, 1)',
                'rgba(108, 117, 125, 1)'
            ],
            borderWidth: 2,
            hoverOffset: 12
        }]
    };
    const obterDados = async () => {
        const response = await fetch(base_url + 'dashboard/obterDados', {
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
    const carregarDadosDashboard = async () => {
        const totalAberto = document.getElementById("totalAberto");
        const totalAndamento = document.getElementById("totalAndamento");
        const totalConcluido = document.getElementById("totalConcluido");
        const totalUsuarios = document.getElementById("totalUsuarios");
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
                if (dadosResponse.usuariosAtivos && totalUsuarios) {
                    totalUsuarios.innerText = dadosResponse.usuariosAtivos;
                }
                // Dados das atividades recentes
                if (dadosResponse.atividadeRecente) {
                    carregarAtividadesRecentes(dadosResponse.atividadeRecente);
                }
                // Atualizar dados de categoria
                if (dadosResponse.categoryData) {
                    categoryData.labels = dadosResponse.categoryData.labels;
                    categoryData.datasets[0].data = dadosResponse.categoryData.datasets[0].data;
                    categoryData.datasets[0].backgroundColor = dadosResponse.categoryData.datasets[0].backgroundColor;
                    categoryData.datasets[0].borderColor = dadosResponse.categoryData.datasets[0].borderColor;
                }

                // Atualizar dados de status por período
                if (dadosResponse.statusData) {
                    // Dados da semana
                    if (dadosResponse.statusData.week) {
                        statusData.week.labels = dadosResponse.statusData.week.labels;
                        statusData.week.datasets = dadosResponse.statusData.week.datasets;
                    }

                    // Dados do mês
                    if (dadosResponse.statusData.month) {
                        statusData.month.labels = dadosResponse.statusData.month.labels;
                        statusData.month.datasets = dadosResponse.statusData.month.datasets;
                    }

                    // Dados do trimestre
                    if (dadosResponse.statusData.quarter) {
                        statusData.quarter.labels = dadosResponse.statusData.quarter.labels;
                        statusData.quarter.datasets = dadosResponse.statusData.quarter.datasets;
                    }

                }


                // Inicializar gráficos após carregar os dados
                inicializarGraficos();

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

    // Inicializar gráficos
    let statusChart, categoryChart;

    function inicializarGraficos() {
        // Configurar gráfico de status
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        statusChart = new Chart(statusCtx, {
            type: 'line',
            data: statusData.week,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });




        // Configurar gráfico de categorias
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: categoryData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                cutout: '60%'
            }
        });

        // Event listener para mudança de período
        document.getElementById('timeRange').addEventListener('change', function() {
            const selectedRange = this.value;
            statusChart.data = statusData[selectedRange];
            statusChart.update();
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Carregar dados do dashboard
        carregarDadosDashboard();
    });

    // Função para atualizar dados em tempo real (opcional)
    function iniciarAtualizacaoTempoReal() {
        setInterval(() => {
            // Recarregar dados do dashboard periodicamente
            carregarDadosDashboard();
        }, 30000); // Atualizar a cada 30 segundos
    }
    /**
     * Carrega as atividades recentes
     */
    function carregarAtividadesRecentes(dados) {
        const atividadesRecentes = document.getElementById("atividadesRecentes");

        atividadesRecentes.innerHTML = "";
        const icones = [{
                status: "A",
                icone: "fas fa-exclamation-triangle"
            },
            {
                status: "E",
                icone: "fas fa-ticket-alt"
            },
            {
                status: "C",
                icone: "fas fa-check-circle"
            },
            {
                status: "X",
                icone: "fas fa-times-circle"
            },
            {
                status: "P",
                icone: "fas fa-pause-circle"
            }
        ];

        for (var j = 0; j < dados.length; j++) { // Mudei 'i' para 'j' para evitar conflito
            const li = document.createElement("li");
            li.setAttribute("class", "activity-item");

            const divIcon = document.createElement("div");
            divIcon.setAttribute("class", "activity-icon ticket");

            const icon = document.createElement("i"); // Mudei 'i' para 'icon'

            // Buscar o ícone correspondente ao status, com fallback para ícone padrão
            const iconeEncontrado = icones.find(item => item.status === dados[j]["status"]);
            const iconeClasse = iconeEncontrado ? iconeEncontrado.icone : "fas fa-question-circle";

            icon.setAttribute("class", iconeClasse);

            const divContent = document.createElement("div");
            divContent.setAttribute("class", "activity-content");

            const divTitle = document.createElement("div");
            divTitle.setAttribute("class", "activity-title");

            const divTime = document.createElement("div");
            divTime.setAttribute("class", "activity-time");

            // Preenchendo os dados

            let chamado = dados[j]["status"] === "A" ? "Novo chamado" : (dados[j]["status"] === "C" ? "Chamando concluído" : "Chamado em andamento");
            divTitle.innerText = chamado + " #" + dados[j]["numero"] + ", criado por " + formatarPrimeiroNome(dados[j]["nome"]) + " para " + dados[j]["setor"];
            divTime.innerText = formatarDataHoraString(dados[j]["registro"]);

            if (dados[j]["status"]) {
                li.classList.add(dados[j]["status"].toLowerCase());
            }

            divIcon.append(icon);
            divContent.append(divTitle);
            divContent.append(divTime);

            li.append(divIcon);
            li.append(divContent);
            atividadesRecentes.append(li);
        }
    }
    /**
     * Função para formatar a data e hora de uma string no formato 'YYYY-MM-DD HH:MM:SS' para 'DD/MM/YYYY HH:MM'
     * @param {string} dataHoraString - A string contendo a data e hora no formato 'YYYY-MM-DD HH:MM:SS'
     * @returns {string} - A string formatada no formato 'DD/MM/YYYY HH:MM'
     * 
     */
    function formatarDataHoraString(dataHoraString) {
        if (!dataHoraString) return '';

        const [data, tempo] = dataHoraString.split(' ');
        const [ano, mes, dia] = data.split('-');

        return `${dia}/${mes}/${ano} ${tempo}`;
    }

    function formatarPrimeiroNome(nomeCompleto) {
        if (!nomeCompleto || typeof nomeCompleto !== 'string') {
            return '';
        }

        // Remove espaços extras e divide pelo primeiro espaço
        const nomeTrimado = nomeCompleto.trim();
        const primeiroNome = nomeTrimado.split(' ')[0];

        if (!primeiroNome) {
            return '';
        }

        // Converte para minúsculas e depois capitaliza a primeira letra
        return primeiroNome.charAt(0).toUpperCase() +
            primeiroNome.slice(1).toLowerCase();
    }
</script>
<?php echo $this->endSection('content'); ?>