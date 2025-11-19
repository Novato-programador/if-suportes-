<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
        background: rgba(46, 125, 50, 0.1);
        color: var(--primary);
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

    .btn-edit {
        background: rgba(76, 175, 80, 0.1);
        color: var(--success);
    }

    .btn-close {
        background: rgba(255, 152, 0, 0.1);
        color: var(--warning);
    }

    .btn-download {
        background: rgba(33, 150, 243, 0.1);
        color: var(--info);
    }

    .action-btn:hover {
        opacity: 0.9;
        transform: scale(1.05);
    }

    /* Filtros de Relatórios */
    .report-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
        background: var(--white);
        padding: 20px;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        min-width: 200px;
    }

    .filter-group label {
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }

    .filter-group select,
    .filter-group input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: var(--light);
    }

    .btn-generate {
        padding: 10px 20px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        align-self: flex-end;
        transition: var(--transition);
    }

    .btn-generate:hover {
        background: var(--secondary);
    }

    /* Gráficos */
    .charts-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .chart-card {
        background: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--card-shadow);
    }

    .chart-title {
        margin-bottom: 15px;
        font-size: 1.2rem;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
    }

    /* Tabela de Relatórios */
    .report-summary {
        margin-top: 30px;
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

        .charts-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }

        .report-filters {
            flex-direction: column;
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

<!-- Filtros -->
<div class="report-filters">
    <div class="filter-group">
        <label for="periodo">Período</label>
        <select id="periodo">
            <option value="mensal">Mensal</option>
            <option value="trimestral">Trimestral</option>
            <option value="semestral">Semestral</option>
            <option value="anual">Anual</option>
        </select>
    </div>

    <div class="filter-group" id="mes-group">
        <label for="mes">Mês</label>
        <select id="mes">
            <option value="01">Janeiro</option>
            <option value="02">Fevereiro</option>
            <option value="03">Março</option>
            <option value="04">Abril</option>
            <option value="05">Maio</option>
            <option value="06">Junho</option>
            <option value="07">Julho</option>
            <option value="08">Agosto</option>
            <option value="09">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
    </div>

    <div class="filter-group" id="trimestre-group" style="display: none;">
        <label for="trimestre">Trimestre</label>
        <select id="trimestre">
            <option value="1">1º Trimestre</option>
            <option value="2">2º Trimestre</option>
            <option value="3">3º Trimestre</option>
            <option value="4">4º Trimestre</option>
        </select>
    </div>

    <div class="filter-group" id="semestre-group" style="display: none;">
        <label for="semestre">Semestre</label>
        <select id="semestre">
            <option value="1">1º Semestre</option>
            <option value="2">2º Semestre</option>
        </select>
    </div>

    <div class="filter-group">
        <label for="ano">Ano</label>
        <select id="ano">
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
        </select>
    </div>

    <button class="btn-generate" id="generate-report">
        <i class="fas fa-sync-alt"></i> Gerar Relatório
    </button>
</div>

<!-- Cards de Estatísticas -->
<div class="dashboard-cards">
    <div class="card stat-card">
        <div class="stat-icon completed">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number">142</div>
            <div class="stat-title">Concluídos</div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="stat-icon progress">
            <i class="fas fa-spinner"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number">28</div>
            <div class="stat-title">Em Andamento</div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="stat-icon open">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number">15</div>
            <div class="stat-title">Pendentes</div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="stat-icon" style="background: rgba(33, 150, 243, 0.2); color: var(--info);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number">8</div>
            <div class="stat-title">Atendentes</div>
        </div>
    </div>
</div>

<!-- Gráficos -->
<h2 class="section-title"><i class="fas fa-chart-bar"></i> Visualizações</h2>

<div class="charts-container">
    <div class="chart-card">
        <div class="chart-title">
            <i class="fas fa-chart-pie"></i> Status dos Atendimentos
        </div>
        <div class="chart-wrapper">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <div class="chart-title">
            <i class="fas fa-user-chart"></i> Atendimentos por Pessoa
        </div>
        <div class="chart-wrapper">
            <canvas id="atendentesChart"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <div class="chart-title">
            <i class="fas fa-calendar-alt"></i> Atendimentos por Dia
        </div>
        <div class="chart-wrapper">
            <canvas id="dailyChart"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <div class="chart-title">
            <i class="fas fa-signal"></i> Evolução Mensal
        </div>
        <div class="chart-wrapper">
            <canvas id="monthlyTrendChart"></canvas>
        </div>
    </div>
</div>

<!-- Tabela de Detalhes -->
<h2 class="section-title"><i class="fas fa-table"></i> Detalhamento por Atendente</h2>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Atendente</th>
                <th>Concluídos</th>
                <th>Em Andamento</th>
                <th>Pendentes</th>
                <th>Total</th>
                <th>Performance</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>João Silva</td>
                <td>42</td>
                <td>5</td>
                <td>2</td>
                <td>49</td>
                <td>85.7%</td>
            </tr>
            <tr>
                <td>Maria Santos</td>
                <td>38</td>
                <td>7</td>
                <td>3</td>
                <td>48</td>
                <td>79.2%</td>
            </tr>
            <tr>
                <td>Pedro Costa</td>
                <td>35</td>
                <td>4</td>
                <td>1</td>
                <td>40</td>
                <td>87.5%</td>
            </tr>
            <tr>
                <td>Ana Oliveira</td>
                <td>27</td>
                <td>6</td>
                <td>4</td>
                <td>37</td>
                <td>73.0%</td>
            </tr>
            <tr>
                <td>Carlos Souza</td>
                <td>0</td>
                <td>6</td>
                <td>5</td>
                <td>11</td>
                <td>0.0%</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Botões de Ação -->
<div style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
    <button id="exportar-pdf" class="action-btn btn-download">
        <i class="fas fa-file-pdf"></i> Exportar PDF
    </button>
    <button id="exportar-excel" class="action-btn btn-download">
        <i class="fas fa-file-excel"></i> Exportar Excel
    </button>
    <button id="imprimir" class="action-btn btn-download">
        <i class="fas fa-print"></i> Imprimir
    </button>
</div>

<script>
    // Controle dos filtros de período
    document.getElementById('periodo').addEventListener('change', function() {
        const periodo = this.value;
        document.getElementById('mes-group').style.display = periodo === 'mensal' ? 'flex' : 'none';
        document.getElementById('trimestre-group').style.display = periodo === 'trimestral' ? 'flex' : 'none';
        document.getElementById('semestre-group').style.display = periodo === 'semestral' ? 'flex' : 'none';
    });

    // Gerar relatório
    document.getElementById('generate-report').addEventListener('click', function() {
        const filtro = gerarFiltro();
        atualizarDados(filtro);
    });

    // Função para gerar filtro baseado nos valores atuais dos campos
    function gerarFiltro() {
        const periodo = document.getElementById('periodo').value;
        const ano = document.getElementById('ano').value;
        let filtro = '';

        switch (periodo) {
            case 'mensal':
                const mes = document.getElementById('mes').value;
                const meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                ];
                filtro = `${meses[parseInt(mes)-1]} de ${ano}`;
                break;
            case 'trimestral':
                const trimestre = document.getElementById('trimestre').value;
                filtro = `${trimestre}º Trimestre de ${ano}`;
                break;
            case 'semestral':
                const semestre = document.getElementById('semestre').value;
                filtro = `${semestre}º Semestre de ${ano}`;
                break;
            case 'anual':
                filtro = `Ano de ${ano}`;
                break;
        }

        return filtro;
    }

    // Função para atualizar os dados exibidos
    function atualizarDados(filtro) {
        // Se filtro não foi fornecido, gerar automaticamente
        if (!filtro) {
            filtro = gerarFiltro();
        }

        document.querySelector('.header h1').textContent = `Relatórios de Atendimentos - ${filtro}`;

        const btn = document.getElementById('generate-report');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gerando...';
        btn.disabled = true;

        // Preparar dados para envio
        const periodo = document.getElementById('periodo').value;
        const ano = document.getElementById('ano').value;
        const mes = document.getElementById('mes').value;
        const trimestre = document.getElementById('trimestre').value;
        const semestre = document.getElementById('semestre').value;

        // Fazer requisição AJAX
        fetch('<?= base_url('relatorio/gerarRelatorio') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    periodo: periodo,
                    ano: ano,
                    mes: mes,
                    trimestre: trimestre,
                    semestre: semestre
                })
            })
            .then(response => response.json())
            .then(data => {
                btn.innerHTML = originalText;
                btn.disabled = false;

                if (data.success) {
                    // Atualizar estatísticas
                    atualizarEstatisticas(data.data.estatisticas);

                    // Atualizar gráficos
                    atualizarGraficos(data.data);

                    // Atualizar tabela de atendentes
                    atualizarTabelaAtendentes(data.data.atendimentosPorUsuario);
                } else {
                    alert('Erro ao gerar relatório: ' + data.message);
                }
            })
            .catch(error => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                console.error('Erro:', error);
                alert('Erro ao gerar relatório');
            });
    }

    // Função para atualizar estatísticas
    function atualizarEstatisticas(stats) {
        const statElements = [
            document.querySelector('.stat-card:nth-child(1) .stat-number'),
            document.querySelector('.stat-card:nth-child(2) .stat-number'),
            document.querySelector('.stat-card:nth-child(3) .stat-number'),
            document.querySelector('.stat-card:nth-child(4) .stat-number')
        ];

        const values = [
            stats.concluidos || 0,
            stats.em_andamento || 0,
            stats.pendentes || 0,
            stats.atendentes || 0
        ];

        statElements.forEach((element, index) => {
            if (element) {
                element.textContent = values[index];
            } else {
                console.error(`Elemento de estatística ${index + 1} não encontrado`);
            }
        });
    }

    // Função para atualizar tabela de atendentes
    function atualizarTabelaAtendentes(atendentes) {
        const tbody = document.querySelector('.table-container table tbody');
        if (!tbody) {
            console.error('Elemento tbody não encontrado');
            return;
        }

        tbody.innerHTML = '';

        if (atendentes && atendentes.length > 0) {
            atendentes.forEach(atendente => {
                const row = document.createElement('tr');
                row.innerHTML = `
                        <td>${atendente.nome || 'N/A'}</td>
                        <td>${atendente.concluidos || 0}</td>
                        <td>${atendente.em_andamento || 0}</td>
                        <td>${atendente.pendentes || 0}</td>
                        <td>${atendente.total || 0}</td>
                        <td>${atendente.performance || 0}%</td>
                    `;
                tbody.appendChild(row);
            });
        } else {
            const row = document.createElement('tr');
            row.innerHTML = '<td colspan="6" style="text-align: center;">Nenhum dado encontrado</td>';
            tbody.appendChild(row);
        }
    }

    // Variáveis globais para os gráficos
    let statusChart, atendentesChart, dailyChart, monthlyChart;

    // Função para atualizar gráficos
    function atualizarGraficos(data) {
        // Atualizar gráfico de status
        if (data.estatisticas) {
            statusChart.data.datasets[0].data = [
                data.estatisticas.concluidos || 0,
                data.estatisticas.em_andamento || 0,
                data.estatisticas.pendentes || 0
            ];
            statusChart.update();
        }

        // Atualizar gráfico de atendentes
        if (data.atendimentosPorUsuario) {
            const nomes = data.atendimentosPorUsuario.map(item => item.nome);
            const totais = data.atendimentosPorUsuario.map(item => item.total);

            atendentesChart.data.labels = nomes;
            atendentesChart.data.datasets[0].data = totais;
            atendentesChart.update();
        }

        // Atualizar gráfico de atendimentos por dia
        if (data.atendimentosDiarios && dailyChart) {
            const labels = data.atendimentosDiarios.map(item => {
                const date = new Date(item.data);
                return date.toLocaleDateString('pt-BR', {
                    day: '2-digit',
                    month: '2-digit'
                });
            });
            const totais = data.atendimentosDiarios.map(item => item.total);

            dailyChart.data.labels = labels;
            dailyChart.data.datasets[0].data = totais;
            dailyChart.update();
        }

        // Atualizar gráfico de evolução mensal
        if (data.evolucaoMensal && monthlyChart) {
            const concluidos = data.evolucaoMensal.map(item => item.concluidos);
            const emAndamento = data.evolucaoMensal.map(item => item.em_andamento);
            const pendentes = data.evolucaoMensal.map(item => item.pendentes);

            monthlyChart.data.datasets[0].data = concluidos;
            monthlyChart.data.datasets[1].data = emAndamento;
            monthlyChart.data.datasets[2].data = pendentes;
            monthlyChart.update();
        }
    }

    // Inicialização dos gráficos
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar valores padrão dos filtros
        const dataAtual = new Date();
        const anoAtual = dataAtual.getFullYear();
        const mesAtual = String(dataAtual.getMonth() + 1).padStart(2, '0');

        // Definir período como mensal
        document.getElementById('periodo').value = 'mensal';

        // Definir ano atual
        document.getElementById('ano').value = anoAtual;

        // Definir mês atual
        document.getElementById('mes').value = mesAtual;

        // Mostrar apenas o grupo de mês (período mensal)
        document.getElementById('mes-group').style.display = 'flex';
        document.getElementById('trimestre-group').style.display = 'none';
        document.getElementById('semestre-group').style.display = 'none';

        // Gerar relatório automaticamente com os valores padrão
        // Aguardar um pouco para garantir que todos os elementos estejam carregados
        setTimeout(() => {
            atualizarDados();
        }, 100);

        // Dados iniciais do PHP
        const estatisticas = <?= json_encode($estatisticas) ?>;
        const atendimentosPorUsuario = <?= json_encode($atendimentosPorUsuario) ?>;
        const evolucaoMensal = <?= json_encode($evolucaoMensal) ?>;
        const atendimentosDiarios = <?= json_encode($atendimentosDiarios) ?>;

        // Gráfico de Pizza - Status dos Atendimentos
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        statusChart = new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: ['Concluídos', 'Em Andamento', 'Pendentes'],
                datasets: [{
                    data: [
                        estatisticas ? estatisticas.concluidos || 0 : 0,
                        estatisticas ? estatisticas.em_andamento || 0 : 0,
                        estatisticas ? estatisticas.pendentes || 0 : 0
                    ],
                    backgroundColor: ['#4caf50', '#2e7d32', '#ff9800'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Gráfico de Barras - Atendimentos por Pessoa
        const atendentesCtx = document.getElementById('atendentesChart').getContext('2d');
        atendentesChart = new Chart(atendentesCtx, {
            type: 'bar',
            data: {
                labels: atendimentosPorUsuario.map(item => item.nome),
                datasets: [{
                    label: 'Atendimentos',
                    data: atendimentosPorUsuario.map(item => item.total),
                    backgroundColor: '#2196f3',
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico de Linha - Atendimentos por Dia (últimos 15 dias)
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        dailyChart = new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: atendimentosDiarios.map(item => {
                    const date = new Date(item.data);
                    return date.toLocaleDateString('pt-BR', {
                        day: '2-digit',
                        month: '2-digit'
                    });
                }),
                datasets: [{
                    label: 'Atendimentos por Dia',
                    data: atendimentosDiarios.map(item => item.total),
                    borderColor: '#2e7d32',
                    tension: 0.3,
                    fill: true,
                    backgroundColor: 'rgba(46, 125, 50, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico de Evolução Mensal
        const monthlyCtx = document.getElementById('monthlyTrendChart').getContext('2d');
        monthlyChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                        label: 'Concluídos',
                        data: evolucaoMensal.map(item => item.concluidos),
                        borderColor: '#4caf50',
                        tension: 0.3
                    },
                    {
                        label: 'Em Andamento',
                        data: evolucaoMensal.map(item => item.em_andamento),
                        borderColor: '#2e7d32',
                        tension: 0.3
                    },
                    {
                        label: 'Pendentes',
                        data: evolucaoMensal.map(item => item.pendentes),
                        borderColor: '#ff9800',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Atualizar estatísticas iniciais
        if (estatisticas) {
            atualizarEstatisticas(estatisticas);
        } else {
            console.warn('Estatísticas não disponíveis');
        }

        // Atualizar tabela de atendentes inicial
        if (atendimentosPorUsuario) {
            atualizarTabelaAtendentes(atendimentosPorUsuario);
        } else {
            console.warn('Dados de atendimentos por usuário não disponíveis');
        }

        // Funcionalidade de exportação PDF
        document.getElementById('exportar-pdf').addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gerando PDF...';

            gerarRelatorioPDFCompleto().finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-file-pdf"></i> Exportar PDF';
            });
        });

        // Funcionalidade de exportação Excel
        document.getElementById('exportar-excel').addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gerando Excel...';

            try {
                gerarRelatorioExcel();
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-file-excel"></i> Exportar Excel';
            }
        });

        // Funcionalidade de impressão
        document.getElementById('imprimir').addEventListener('click', function() {
            window.print();
        });
    });

    // Função para gerar relatório em PDF
    function gerarRelatorioPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Configurações do documento
        const pageWidth = doc.internal.pageSize.getWidth();
        const pageHeight = doc.internal.pageSize.getHeight();
        let yPosition = 20;

        // Título do relatório
        doc.setFontSize(20);
        doc.setFont(undefined, 'bold');
        doc.text('Relatório de Atendimentos', pageWidth / 2, yPosition, {
            align: 'center'
        });
        yPosition += 15;

        // Data de geração
        doc.setFontSize(10);
        doc.setFont(undefined, 'normal');
        const dataAtual = new Date().toLocaleDateString('pt-BR');
        doc.text(`Gerado em: ${dataAtual}`, pageWidth / 2, yPosition, {
            align: 'center'
        });
        yPosition += 20;

        // Estatísticas gerais
        doc.setFontSize(14);
        doc.setFont(undefined, 'bold');
        doc.text('Estatísticas Gerais', 20, yPosition);
        yPosition += 10;

        doc.setFontSize(10);
        doc.setFont(undefined, 'normal');

        // Obter dados das estatísticas
        const concluidos = document.querySelector('.stat-card:nth-child(1) .stat-number').textContent;
        const emAndamento = document.querySelector('.stat-card:nth-child(2) .stat-number').textContent;
        const pendentes = document.querySelector('.stat-card:nth-child(3) .stat-number').textContent;
        const atendentes = document.querySelector('.stat-card:nth-child(4) .stat-number').textContent;

        doc.text(`Chamados Concluídos: ${concluidos}`, 20, yPosition);
        yPosition += 7;
        doc.text(`Chamados Em Andamento: ${emAndamento}`, 20, yPosition);
        yPosition += 7;
        doc.text(`Chamados Pendentes: ${pendentes}`, 20, yPosition);
        yPosition += 7;
        doc.text(`Total de Atendentes: ${atendentes}`, 20, yPosition);
        yPosition += 20;

        // Tabela de atendentes
        doc.setFontSize(14);
        doc.setFont(undefined, 'bold');
        doc.text('Detalhamento por Atendente', 20, yPosition);
        yPosition += 10;

        // Cabeçalho da tabela
        doc.setFontSize(9);
        doc.setFont(undefined, 'bold');
        const colunas = ['Atendente', 'Concluídos', 'Em Andamento', 'Pendentes', 'Total', 'Performance'];
        const larguraColunas = [60, 25, 30, 25, 20, 25];
        let xPosition = 20;

        colunas.forEach((coluna, index) => {
            doc.text(coluna, xPosition, yPosition);
            xPosition += larguraColunas[index];
        });
        yPosition += 7;

        // Linha separadora
        doc.line(20, yPosition, pageWidth - 20, yPosition);
        yPosition += 5;

        // Dados da tabela
        doc.setFont(undefined, 'normal');
        const tbody = document.querySelector('.table-container table tbody');
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {
            if (yPosition > pageHeight - 30) {
                doc.addPage();
                yPosition = 20;
            }

            const cells = row.querySelectorAll('td');
            xPosition = 20;

            cells.forEach((cell, index) => {
                if (index < colunas.length) {
                    const texto = cell.textContent.trim();
                    doc.text(texto, xPosition, yPosition);
                    xPosition += larguraColunas[index];
                }
            });
            yPosition += 7;
        });

        // Salvar o PDF
        const nomeArquivo = `relatorio_atendimentos_${new Date().toISOString().split('T')[0]}.pdf`;
        doc.save(nomeArquivo);
    }

    // Função para gerar relatório em Excel
    function gerarRelatorioExcel() {
        // Criar um novo workbook
        const wb = XLSX.utils.book_new();

        // Obter dados das estatísticas
        const concluidos = document.querySelector('.stat-card:nth-child(1) .stat-number').textContent;
        const emAndamento = document.querySelector('.stat-card:nth-child(2) .stat-number').textContent;
        const pendentes = document.querySelector('.stat-card:nth-child(3) .stat-number').textContent;
        const atendentes = document.querySelector('.stat-card:nth-child(4) .stat-number').textContent;

        // Criar aba de Estatísticas
        const estatisticasData = [
            ['Relatório de Atendimentos'],
            ['Gerado em:', new Date().toLocaleDateString('pt-BR')],
            [''],
            ['Estatísticas Gerais'],
            ['Métrica', 'Valor'],
            ['Chamados Concluídos', concluidos],
            ['Chamados Em Andamento', emAndamento],
            ['Chamados Pendentes', pendentes],
            ['Total de Atendentes', atendentes]
        ];

        const wsEstatisticas = XLSX.utils.aoa_to_sheet(estatisticasData);

        // Aplicar formatação na aba de estatísticas
        wsEstatisticas['!cols'] = [{
                width: 25
            },
            {
                width: 15
            }
        ];

        // Adicionar a aba de estatísticas ao workbook
        XLSX.utils.book_append_sheet(wb, wsEstatisticas, 'Estatísticas');

        // Criar aba de Detalhamento
        const detalhamentoData = [
            ['Detalhamento por Atendente'],
            [''],
            ['Atendente', 'Concluídos', 'Em Andamento', 'Pendentes', 'Total', 'Performance']
        ];

        // Obter dados da tabela de atendentes
        const tbody = document.querySelector('.table-container table tbody');
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowData = [];

            cells.forEach(cell => {
                rowData.push(cell.textContent.trim());
            });

            if (rowData.length > 0) {
                detalhamentoData.push(rowData);
            }
        });

        const wsDetalhamento = XLSX.utils.aoa_to_sheet(detalhamentoData);

        // Aplicar formatação na aba de detalhamento
        wsDetalhamento['!cols'] = [{
                width: 25
            },
            {
                width: 12
            },
            {
                width: 15
            },
            {
                width: 12
            },
            {
                width: 10
            },
            {
                width: 15
            }
        ];

        // Adicionar a aba de detalhamento ao workbook
        XLSX.utils.book_append_sheet(wb, wsDetalhamento, 'Detalhamento');

        // Gerar nome do arquivo com data atual
        const dataAtual = new Date().toISOString().split('T')[0];
        const nomeArquivo = `relatorio_atendimentos_${dataAtual}.xlsx`;

        // Salvar o arquivo Excel
        XLSX.writeFile(wb, nomeArquivo);
    }
    // Função para gerar relatório PDF completo com gráficos
    async function gerarRelatorioPDFCompleto() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Configurações do documento
        const pageWidth = doc.internal.pageSize.getWidth();
        const pageHeight = doc.internal.pageSize.getHeight();
        let yPosition = 20;

        // Cores padrão do IFPA
        const ifpaVerde = '#004A80';
        const ifpaVerdeClaro = '#0066A4';
        const ifpaDourado = '#F2B705';
        const ifpaCinza = '#F5F5F5';

        // CABEÇALHO INSTITUCIONAL
        doc.setFillColor(0, 74, 128); // Verde IFPA
        doc.rect(0, 0, pageWidth, 15, 'F');

        doc.setTextColor(255, 255, 255);
        doc.setFontSize(10);
        doc.setFont(undefined, 'bold');
        doc.text('INSTITUTO FEDERAL DO PARÁ - CAMPUS ALTAMIRA', pageWidth / 2, 8, {
            align: 'center'
        });
        doc.text('SISTEMA INTEGRADO DE SUPORTE - IFPA SUPORTES', pageWidth / 2, 12, {
            align: 'center'
        });

        // Título do relatório
        doc.setTextColor(0, 74, 128);
        doc.setFontSize(16);
        doc.setFont(undefined, 'bold');
        doc.text('RELATÓRIO DE ATENDIMENTOS', pageWidth / 2, yPosition + 10, {
            align: 'center'
        });
        yPosition += 20;

        // Data de geração
        doc.setFontSize(9);
        doc.setTextColor(100, 100, 100);
        const dataAtual = new Date().toLocaleDateString('pt-BR');
        doc.text(`Gerado em: ${dataAtual}`, pageWidth / 2, yPosition, {
            align: 'center'
        });
        yPosition += 15;

        // Linha decorativa
        doc.setDrawColor(242, 183, 5); // Dourado IFPA
        doc.setLineWidth(0.5);
        doc.line(20, yPosition, pageWidth - 20, yPosition);
        yPosition += 10;

        // Estatísticas gerais
        doc.setTextColor(0, 74, 128);
        doc.setFontSize(12);
        doc.setFont(undefined, 'bold');
        doc.text('ESTATÍSTICAS GERAIS', 20, yPosition);
        yPosition += 8;

        doc.setFontSize(9);
        doc.setTextColor(0, 0, 0);
        doc.setFont(undefined, 'normal');

        // Obter dados das estatísticas
        const concluidos = document.querySelector('.stat-card:nth-child(1) .stat-number')?.textContent || '0';
        const emAndamento = document.querySelector('.stat-card:nth-child(2) .stat-number')?.textContent || '0';
        const pendentes = document.querySelector('.stat-card:nth-child(3) .stat-number')?.textContent || '0';
        const atendentes = document.querySelector('.stat-card:nth-child(4) .stat-number')?.textContent || '0';

        // Caixa de estatísticas
        doc.setFillColor(245, 245, 245);
        doc.rect(20, yPosition, pageWidth - 40, 25, 'F');
        doc.setDrawColor(200, 200, 200);
        doc.rect(20, yPosition, pageWidth - 40, 25);

        doc.text(`Chamados Concluídos: ${concluidos}`, 25, yPosition + 8);
        doc.text(`Chamados Em Andamento: ${emAndamento}`, 25, yPosition + 16);
        doc.text(`Chamados Pendentes: ${pendentes}`, pageWidth / 2 + 10, yPosition + 8);
        doc.text(`Total de Atendentes: ${atendentes}`, pageWidth / 2 + 10, yPosition + 16);

        yPosition += 35;

        // Capturar e adicionar gráficos
        try {
            // Gráfico de Status
            const statusChart = document.getElementById('statusChart');
            if (statusChart) {
                const statusCanvas = await html2canvas(statusChart.parentElement, {
                    backgroundColor: '#ffffff',
                    scale: 2
                });
                const statusImgData = statusCanvas.toDataURL('image/png');

                doc.setFontSize(11);
                doc.setFont(undefined, 'bold');
                doc.setTextColor(0, 74, 128);
                doc.text('STATUS DOS ATENDIMENTOS', 20, yPosition);
                yPosition += 8;

                const imgWidth = 80;
                const imgHeight = (statusCanvas.height * imgWidth) / statusCanvas.width;
                doc.addImage(statusImgData, 'PNG', 20, yPosition, imgWidth, imgHeight);
                yPosition += imgHeight + 25;
            }

            // Nova página para mais gráficos se necessário
            if (yPosition > pageHeight - 100) {
                doc.addPage();
                yPosition = 20;
            }

            // Gráfico de Atendentes
            const atendentesChart = document.getElementById('atendentesChart');
            if (atendentesChart) {
                const atendentesCanvas = await html2canvas(atendentesChart.parentElement, {
                    backgroundColor: '#ffffff',
                    scale: 2
                });
                const atendentesImgData = atendentesCanvas.toDataURL('image/png');

                doc.setFontSize(11);
                doc.setFont(undefined, 'bold');
                doc.setTextColor(0, 74, 128);
                doc.text('ATENDIMENTOS POR PESSOA', 20, yPosition);
                yPosition += 8;

                const imgWidth = 80;
                const imgHeight = (atendentesCanvas.height * imgWidth) / atendentesCanvas.width;
                doc.addImage(atendentesImgData, 'PNG', 20, yPosition, imgWidth, imgHeight);
                yPosition += imgHeight + 25;
            }

        } catch (error) {
            console.error('Erro ao capturar gráficos:', error);
        }

        // Nova página para tabela
        doc.addPage();
        yPosition = 20;

        // Tabela de atendentes
        doc.setFontSize(12);
        doc.setFont(undefined, 'bold');
        doc.setTextColor(0, 74, 128);
        doc.text('DETALHAMENTO POR ATENDENTE', 20, yPosition);
        yPosition += 10;

        // Cabeçalho da tabela
        doc.setFontSize(8);
        doc.setFont(undefined, 'bold');
        const colunas = ['Atendente', 'Concluídos', 'Em Andamento', 'Pendentes', 'Total', 'Performance'];
        const larguraColunas = [60, 25, 30, 25, 20, 25];
        let xPosition = 20;

        // Desenhar cabeçalho com cores IFPA
        doc.setFillColor(0, 74, 128);
        doc.rect(20, yPosition - 5, pageWidth - 40, 8, 'F');
        doc.setTextColor(255, 255, 255);

        colunas.forEach((coluna, index) => {
            doc.text(coluna, xPosition, yPosition);
            xPosition += larguraColunas[index];
        });
        yPosition += 8;

        // Resetar cor do texto
        doc.setTextColor(0, 0, 0);
        doc.setFont(undefined, 'normal');

        // Dados da tabela
        const tbody = document.querySelector('.table-container table tbody');
        const rows = tbody ? tbody.querySelectorAll('tr') : [];

        rows.forEach((row, rowIndex) => {
            if (yPosition > pageHeight - 30) {
                doc.addPage();
                yPosition = 20;
            }

            // Alternar cor de fundo das linhas
            if (rowIndex % 2 === 0) {
                doc.setFillColor(245, 245, 245);
                doc.rect(20, yPosition - 5, pageWidth - 40, 8, 'F');
            }

            const cells = row.querySelectorAll('td');
            xPosition = 20;

            cells.forEach((cell, index) => {
                if (index < colunas.length) {
                    const texto = cell.textContent.trim();
                    doc.text(texto, xPosition, yPosition);
                    xPosition += larguraColunas[index];
                }
            });
            yPosition += 8;
        });

        // Rodapé em todas as páginas
        const totalPages = doc.internal.getNumberOfPages();
        for (let i = 1; i <= totalPages; i++) {
            doc.setPage(i);
            doc.setFontSize(7);
            doc.setTextColor(100, 100, 100);
            doc.text(`Página ${i} de ${totalPages}`, pageWidth / 2, pageHeight - 10, {
                align: 'center'
            });
            doc.text('IFPA Campus Altamira - Sistema Integrado de Suporte', pageWidth - 20, pageHeight - 10, {
                align: 'right'
            });

            // Linha do rodapé
            doc.setDrawColor(242, 183, 5);
            doc.setLineWidth(0.3);
            doc.line(20, pageHeight - 15, pageWidth - 20, pageHeight - 15);
        }

        // Salvar o PDF
        const nomeArquivo = `relatorio_ifpa_altamira_${new Date().toISOString().split('T')[0]}.pdf`;
        doc.save(nomeArquivo);
    }
</script>
<?php echo $this->endSection('content'); ?>