<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
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

    /* Report Header */
    .report-header {
        background: var(--white);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: var(--card-shadow);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .report-info-item {
        display: flex;
        flex-direction: column;
    }

    .report-info-label {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 5px;
    }

    .report-info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .report-status {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 5px;
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

    /* Timeline */
    .timeline-container {
        background: var(--white);
        border-radius: 12px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        margin-bottom: 25px;
    }

    .section-title {
        margin: 0 0 25px;
        font-size: 1.5rem;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .timeline {
        position: relative;
        max-width: 100%;
        margin: 0 auto;
    }

    .timeline::after {
        content: '';
        position: absolute;
        width: 4px;
        background-color: #e0e0e0;
        top: 0;
        bottom: 0;
        left: 20px;
        margin-left: -2px;
    }

    .timeline-item {
        padding: 10px 20px 30px 60px;
        position: relative;
        background-color: inherit;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        left: 12px;
        background-color: var(--white);
        border: 4px solid var(--primary);
        top: 15px;
        border-radius: 50%;
        z-index: 1;
    }

    .timeline-item.completed::after {
        border-color: var(--success);
    }

    .timeline-item.in-progress::after {
        border-color: var(--info);
    }

    .timeline-item.pending::after {
        border-color: var(--warning);
    }

    .timeline-content {
        padding: 20px;
        background-color: #f8f9fa;
        position: relative;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .timeline-date {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 5px;
    }

    .timeline-title {
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark);
    }

    .timeline-description {
        color: var(--gray);
        line-height: 1.5;
    }

    .attendant-info {
        display: flex;
        align-items: center;
        margin-top: 10px;
        gap: 8px;
    }

    .attendant-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        font-weight: bold;
    }

    .attendant-name {
        font-size: 0.9rem;
        color: var(--gray);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-secondary {
        background: #f0f0f0;
        color: var(--dark);
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
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
        .report-header {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .timeline::after {
            left: 15px;
        }

        .timeline-item {
            padding-left: 45px;
        }

        .timeline-item::after {
            left: 7px;
        }
    }
</style>


<div class="header">
    <h1>Relatório de Atendimento</h1>
    <div class="user-info">
        <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
        <span><?php echo $user; ?></span>
    </div>
</div>

<!-- Report Header -->
<div class="report-header">
    <div class="report-info-item">
        <span class="report-info-label">Solicitante</span>
        <span class="report-info-value"><?php echo $relatorio["solicitante"]; ?></span>
    </div>
    <div class="report-info-item">
        <span class="report-info-label">ID do Chamado</span>
        <span class="report-info-value"><?php echo $relatorio["numero"]; ?></span>
    </div>
    <div class="report-info-item">
        <span class="report-info-label">Data de Abertura</span>
        <span class="report-info-value"><?php echo toDataBR($relatorio["registro"]); ?></span>
    </div>
    <div class="report-info-item">
        <span class="report-info-label">Categoria</span>
        <span class="report-info-value"><?php echo $relatorio["categoria"]; ?></span>
    </div>
    <div class="report-info-item">
        <span class="report-info-label">Status</span>
        <span class="report-info-value">
            <?php
            $optionsStatus = [
                "A" => "Aberto",
                "C" => "Finalizado",
                "E" => "Em Andamento",
                "G" => "Em Andamento",
            ];
            ?>
            <span class="report-status status-progress"><?php echo $optionsStatus[$relatorio["status"]]; ?></span>
        </span>
    </div>
</div>

<!-- Timeline -->
<div class="timeline-container">
    <h2 class="section-title">
        <i class="fas fa-history"></i>
        Histórico de Atendimentos
    </h2>

    <div class="timeline">
        <?php foreach ($relatorio["historico"] as $item): ?>
            <div class="timeline-item completed">
                <div class="timeline-content">
                    <div class="timeline-date"><?php echo toDataBR($item["created_at"]); ?></div>
                    <div class="timeline-title"><?php echo $item["operacao"]; ?></div>
                    <div class="timeline-description">
                        <?php echo $item["descricao"]; ?>
                    </div>
                    <div class="attendant-info">
                        <div class="attendant-avatar"><?php echo primeiraLetraNome($item["nome"]); ?></div>
                        <span class="attendant-name"><?php echo $item["nome"]; ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Action Buttons -->
<div class="action-buttons">
    <button class="btn btn-primary">
        <i class="fas fa-print"></i>
        Imprimir Relatório
    </button>
    <button class="btn btn-secondary">
        <i class="fas fa-file-pdf"></i>
        Exportar PDF
    </button>
    <button class="btn btn-secondary">
        <i class="fas fa-envelope"></i>
        Enviar por E-mail
    </button>
    <button class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Voltar
    </button>
</div>
</main>

<script>
    // Simulação de interação com os botões
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.querySelector('.fa-print')) {
                alert('Relatório enviado para impressão');
            } else if (this.querySelector('.fa-file-pdf')) {
                alert('Relatório exportado como PDF');
            } else if (this.querySelector('.fa-envelope')) {
                alert('Relatório enviado por e-mail');
            } else if (this.querySelector('.fa-arrow-left')) {
                alert('Voltando para a lista de chamados');
            }
        });
    });
</script>
<?php echo $this->endSection("content");
