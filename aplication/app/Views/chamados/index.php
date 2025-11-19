<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<style>
    :root {
        --primary: #2e7d32;
        --secondary: #1b5e20;
        --success: #4caf50;
        --warning: #ff9800;
        --danger: rgb(247, 3, 3);
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

    /* Breadcrumb */
    .breadcrumb {
        list-style: none;
        display: flex;
        padding: 8px 16px;
        background-color: #f8f9fa;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .breadcrumb li {
        display: flex;
        align-items: center;
    }

    .breadcrumb li+li::before {
        content: "›";
        padding: 0 8px;
        color: #6c757d;
    }

    .breadcrumb a {
        text-decoration: none;
        color: #007bff;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb .active {
        color: #6c757d;
    }

    /* Section Title */
    .section-title {
        margin: 30px 0 20px;
        font-size: 1.5rem;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary);
    }

    /* Chamados List */
    .chamados-list {
        display: grid;
        gap: 15px;
        margin-bottom: 30px;
    }

    /* Container para chamados paginados - garantir mesmo espaçamento */
    #chamados-paginados-content {
        margin-bottom: 30px;
    }

    #chamados-paginados-content .chamados-list {
        display: grid;
        gap: 15px;
        margin-bottom: 30px;
    }

    .chamado-card {
        background: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        cursor: pointer;
        border-left: 4px solid var(--primary);
    }

    .chamado-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    }

    .chamado-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .chamado-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .chamado-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
        margin-bottom: 10px;
    }

    .chamado-info p {
        margin: 5px 0;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .chamado-info strong {
        color: var(--dark);
    }

    .btn-novo {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        margin-top: 20px;
    }

    .btn-novo:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
    }

    /* Status badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-aberto {
        background: rgba(255, 152, 0, 0.1);
        color: var(--warning);
    }

    .status-devolvido {
        background: rgba(255, 8, 0, 0.1);
        color: var(--danger);
    }

    .status-andamento {
        background: rgba(46, 125, 50, 0.1);
        color: var(--primary);
    }

    .status-concluido {
        background: rgba(76, 175, 80, 0.1);
        color: var(--success);
    }

    .status-aguardando {
        background: rgba(177, 196, 74, 0.1);
        color: var(--warning);
    }

    .status-confirmado {
        background: rgba(177, 196, 74, 0.1);
        color: var(--warning);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 25px;
        border-radius: 12px;
        width: 90%;
        max-width: 700px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 28px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }

    .modal-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .modal-title {
        font-size: 1.5rem;
        color: var(--dark);
        margin-bottom: 10px;
    }

    .modal-body {
        margin-bottom: 25px;
    }

    .modal-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .modal-detail-item {
        margin-bottom: 10px;
    }

    .modal-detail-item strong {
        display: block;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .action-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
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

    .action-btn:hover {
        opacity: 0.9;
        transform: scale(1.05);
    }

    /* Anexos Modal */
    #modalAnexo .modal-content {
        max-width: 800px;
    }

    .anexos-container {
        max-height: 400px;
        overflow-y: auto;
        padding: 10px;
    }

    .anexo-item {
        margin-bottom: 15px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border-left: 3px solid var(--primary);
    }

    .anexo-item p {
        margin: 5px 0;
        font-size: 14px;
    }

    .anexo-item img {
        max-width: 100%;
        margin-top: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .anexo-link {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 16px;
        background-color: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: var(--transition);
    }

    .anexo-link:hover {
        background-color: var(--secondary);
        text-decoration: none;
        color: white;
    }

    /* Search Container */
    .search-container {
        background: var(--white);
        padding: 20px;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-container input[type="text"] {
        flex: 1;
        min-width: 300px;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: var(--transition);
        background-color: #f8f9fa;
    }

    .search-container input[type="text"]:focus {
        outline: none;
        border-color: var(--primary);
        background-color: var(--white);
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .search-container input[type="text"]::placeholder {
        color: #6c757d;
        font-style: italic;
    }

    .search-container button {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
    }

    .search-container button:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
    }

    .search-container button:active {
        transform: translateY(0);
    }

    .search-container button i {
        font-size: 14px;
    }

    /* Clear button */
    .btn-clear {
        background-color: #6c757d !important;
        color: white !important;
    }

    .btn-clear:hover {
        background-color: #5a6268 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    /* Search results info */
    .search-results-info {
        background: rgba(46, 125, 50, 0.1);
        color: var(--primary);
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        display: none;
    }

    .search-results-info.show {
        display: block;
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
        .main-content {
            padding: 15px;
        }

        .modal-content {
            width: 95%;
            margin: 10% auto;
            padding: 20px;
        }

        .modal-footer {
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
            justify-content: center;
        }

        .chamado-info {
            grid-template-columns: 1fr;
        }

        /* Search container responsivo */
        .search-container {
            flex-direction: column;
            gap: 12px;
            padding: 15px;
        }

        .search-container input[type="text"] {
            min-width: 100%;
            width: 100%;
        }

        .search-container button {
            width: 100%;
            min-width: auto;
        }

        .search-results-info {
            font-size: 13px;
            padding: 8px 12px;
        }
    }

    @media (max-width: 480px) {
        .search-container {
            padding: 12px;
        }

        .search-container input[type="text"] {
            font-size: 14px;
            padding: 10px 12px;
        }

        .search-container button {
            font-size: 14px;
            padding: 10px 16px;
        }
    }

    /* Estilos para filtros de status */
    .status-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 20px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .status-filter {
        padding: 8px 16px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-filter:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    .status-filter.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    .status-filter.active:hover {
        background: #0056b3;
        border-color: #0056b3;
    }

    /* Estilos para loading */
    .loading-spinner {
        text-align: center;
        padding: 40px;
        font-size: 16px;
        color: #6c757d;
    }

    .loading-spinner i {
        font-size: 24px;
        margin-right: 10px;
    }

    /* Estilos para paginação */
    .pagination-container {
        margin: 30px 0;
    }

    .pagination-info {
        text-align: center;
        margin: 30px 0 15px 0;
        color: #6c757d;
        font-size: 14px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .pagination-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        margin-bottom: 15px;
        flex-wrap: wrap;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .pagination-btn {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        min-width: 40px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pagination-btn:hover:not(:disabled) {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    .pagination-numbers {
        display: flex;
        gap: 2px;
        flex-wrap: wrap;
    }

    .pagination-number {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        min-width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #495057;
    }

    .pagination-number:hover {
        background: #e9ecef;
        border-color: #adb5bd;
        text-decoration: none;
        color: #495057;
    }

    .pagination-number.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination-number.active:hover {
        background: #0056b3;
        border-color: #0056b3;
    }

    .pagination-size {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 14px;
        color: #6c757d;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        margin-top: 15px;
    }

    .pagination-size select {
        padding: 6px 10px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        background: white;
        font-size: 14px;
    }

    /* Responsividade para paginação */
    @media (max-width: 768px) {
        .status-filters {
            justify-content: center;
        }

        .status-filter {
            font-size: 12px;
            padding: 6px 12px;
        }

        .pagination-controls {
            gap: 3px;
        }

        .pagination-btn,
        .pagination-number {
            padding: 6px 8px;
            font-size: 12px;
            min-width: 32px;
            height: 32px;
        }

        .pagination-size {
            flex-direction: column;
            gap: 5px;
        }
    }

    @media (max-width: 480px) {
        .status-filters {
            gap: 5px;
            padding: 10px;
        }

        .status-filter {
            font-size: 11px;
            padding: 5px 8px;
        }

        .pagination-container {
            padding: 15px 10px;
        }

        .pagination-numbers {
            max-width: 100%;
            overflow-x: auto;
        }
    }
</style>

<div class="header">
    <h1><i class="fas fa-ticket-alt"></i> Chamados</h1>
    <div class="user-info">
        <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
        <span><?php echo $user; ?></span>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url("/home"); ?>">Início</a></li>
        <li class="breadcrumb-item active" aria-current="page">Chamados</li>
    </ol>
</nav>
<?php if (session()->has('success')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '<?= session()->get('success') ?>',
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
<?php if (session()->has('error')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '<?= session()->get('error') ?>',
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
<?php
function viewChamados($dados, $tipo = null, $statusClass)
{
    $isLogged = session()->get('token');
    $user = base64_decode($isLogged);
    $isLogged = json_decode($user);

    for ($i = 0; $i < count($dados); $i++) {
        if ($isLogged->setor !== 'TI') {
            if ($isLogged->setor == $dados[$i]['setor']) {
?>
                <div class="chamado-card" onclick="abrirModal('<?php echo $dados[$i]['numero']; ?>','<?php echo $dados[$i]['nome']; ?>','<?php echo $dados[$i]['titulo']; ?>', '<?php echo $dados[$i]['setor']; ?>', '<?php echo $dados[$i]['tipo']; ?>', '<?php echo $dados[$i]['observacao']; ?>', '<?php echo $dados[$i]['chave']; ?>', '<?php echo $tipo; ?>', <?php echo htmlspecialchars(json_encode($dados[$i]['arquivo']), ENT_QUOTES, 'UTF-8'); ?>)">
                    <div class="chamado-header">
                        <h3 class="chamado-title"><?php echo $dados[$i]['titulo'] ?></h3>
                        <span class="status-badge <?php echo $statusClass; ?>">
                            <?php
                            if ($tipo == 'aberto') echo 'Aberto';
                            elseif ($tipo == 'devolvido') echo 'Devolvido';
                            elseif ($tipo == 'aguardando') echo 'Aguardando Confirmação';
                            elseif ($tipo == 'andamento') echo 'Em Andamento';
                            elseif ($tipo == 'confirmado') echo 'Confirmado';
                            else echo 'Concluído';
                            ?>
                        </span>
                    </div>
                    <div class="chamado-info">
                        <p><strong>ID #:</strong> <?php echo $dados[$i]['numero']; ?></p>
                        <p><strong>Solicitante:</strong> <?php echo $dados[$i]['nome']; ?></p>
                        <p><strong>Local do atendimento:</strong> <?php echo $dados[$i]['setor']; ?></p>
                        <p><strong>Categoria:</strong> <?php echo $dados[$i]['tipo']; ?></p>
                        <p><strong>Descrição do problema:</strong> <?php echo strlen($dados[$i]['observacao']) > 50 ? substr($dados[$i]['observacao'], 0, 50) . '...' : $dados[$i]['observacao']; ?></p>
                        <p><strong>Data da abertura:</strong> <?php echo toDataBR($dados[$i]['registro']); ?></p>
                        <?php if (!empty($dados[$i]['resposta'])): ?>
                            <p><strong>Resposta:</strong> <?php echo strlen($dados[$i]['resposta']) > 50 ? substr($dados[$i]['resposta'], 0, 50) . '...' : $dados[$i]['resposta']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="chamado-card" onclick="abrirModal('<?php echo $dados[$i]['numero']; ?>','<?php echo $dados[$i]['nome']; ?>','<?php echo $dados[$i]['titulo']; ?>', '<?php echo $dados[$i]['setor']; ?>', '<?php echo $dados[$i]['tipo']; ?>', '<?php echo $dados[$i]['observacao']; ?>', '<?php echo $dados[$i]['chave']; ?>', '<?php echo $tipo; ?>', <?php echo htmlspecialchars(json_encode($dados[$i]['arquivo']), ENT_QUOTES, 'UTF-8'); ?>)">
                <div class="chamado-header">
                    <h3 class="chamado-title"><?php echo $dados[$i]['titulo'] ?></h3>
                    <span class="status-badge <?php echo $statusClass; ?>">
                        <?php
                        if ($tipo == 'aberto') echo 'Aberto';
                        elseif ($tipo == 'devolvido') echo 'Devolvido';
                        elseif ($tipo == 'aguardando') echo 'Aguardando Confirmação';
                        elseif ($tipo == 'andamento') echo 'Em Andamento';
                        elseif ($tipo == 'confirmado') echo 'Confirmado';
                        else echo 'Concluído';
                        ?>
                    </span>
                </div>
                <div class="chamado-info">
                    <p><strong>ID #:</strong> <?php echo $dados[$i]['numero']; ?></p>
                    <p><strong>Solicitante:</strong> <?php echo $dados[$i]['nome']; ?></p>
                    <p><strong>Local do atendimento:</strong> <?php echo $dados[$i]['setor']; ?></p>
                    <p><strong>Categoria:</strong> <?php echo $dados[$i]['tipo']; ?></p>
                    <p><strong>Descrição do problema:</strong> <?php echo strlen($dados[$i]['observacao']) > 50 ? substr($dados[$i]['observacao'], 0, 50) . '...' : $dados[$i]['observacao']; ?></p>
                    <p><strong>Data da abertura:</strong> <?php echo toDataBR($dados[$i]['registro']); ?></p>
                    <p><strong>Data da modificação:</strong> <?php echo toDataBR($dados[$i]['update']); ?></p>
                    <?php if (!empty($dados[$i]['atendente'])): ?>
                        <p><strong>Responsável pelo atendimento: </strong> <?php echo $dados[$i]['atendente']; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($dados[$i]['resposta'])): ?>
                        <p><strong>Resposta:</strong> <?php echo strlen($dados[$i]['resposta']) > 50 ? substr($dados[$i]['resposta'], 0, 50) . '...' : $dados[$i]['resposta']; ?></p>
                        <p><strong>Data do atendimento:</strong> <?php echo toDataBR($dados[$i]['atendimento_date']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
<?php
        }
    }
}
?>
<!-- Adicionar filtro de pesquisa pelo solicitante, numero do chamado e pelo assunto -->
<div class="search-container">
    <input type="text" id="search-input" placeholder="Pesquisar por solicitante, número do chamado ou assunto..." onkeyup="filtrarChamadosRealTime(event)">
    <button onclick="filtrarChamados()">
        <i class="fas fa-search"></i> Pesquisar
    </button>
    <button onclick="limparFiltro()" class="btn-clear">
        <i class="fas fa-times"></i> Limpar
    </button>
</div>
<div id="search-results-info" class="search-results-info"></div>

<!-- Filtros de Status -->
<div class="status-filters">
    <button class="status-filter active" data-status="" onclick="filtrarPorStatus('')">
        <i class="fas fa-list"></i> Todos
    </button>
    <button class="status-filter" data-status="A" onclick="filtrarPorStatus('A')">
        <i class="fas fa-list"></i> Abertos
    </button>
    <button class="status-filter" data-status="B" onclick="filtrarPorStatus('B')">
        <i class="fas fa-undo"></i> Devolvidos
    </button>
    <button class="status-filter" data-status="E" onclick="filtrarPorStatus('E')">
        <i class="fas fa-spinner"></i> Em Andamento
    </button>
    <button class="status-filter" data-status="F" onclick="filtrarPorStatus('F')">
        <i class="fas fa-clock"></i> Aguardando Confirmação
    </button>
    <button class="status-filter" data-status="G" onclick="filtrarPorStatus('G')">
        <i class="fas fa-check-circle"></i> Confirmados
    </button>
    <button class="status-filter" data-status="C" onclick="filtrarPorStatus('C')">
        <i class="fas fa-check-circle"></i> Concluídos
    </button>
</div>

<!-- Container para chamados paginados -->
<div id="chamados-container">
    <div id="loading" class="loading-spinner" style="display: none;">
        <i class="fas fa-spinner fa-spin"></i> Carregando...
    </div>

    <div id="chamados-content">
        <!-- Conteúdo inicial carregado via PHP -->
        <h2 class="section-title"><i class="fas fa-list"></i> Chamados em Aberto</h2>
        <div class="chamados-list">
            <?php viewChamados($data["chamadosAbertos"], "aberto", "status-aberto"); ?>
        </div>

        <h2 class="section-title"><i class="fas fa-list"></i> Chamados em Devolvidos</h2>
        <div class="chamados-list">
            <?php viewChamados($data["chamadosDevolvidos"], "devolvido", "status-devolvido"); ?>
        </div>

        <h2 class="section-title"><i class="fas fa-spinner"></i> Chamados em Andamento</h2>
        <div class="chamados-list">
            <?php viewChamados($data["chamadosAndamento"], "andamento", "status-andamento"); ?>
        </div>

        <h2 class="section-title"><i class="fas fa-spinner"></i> Chamados Aguardando Confirmação</h2>
        <div class="chamados-list">
            <?php viewChamados($data["chamadosAguardandoConfirmacao"], "aguardando", "status-aguardando"); ?>
        </div>
        <h2 class="section-title"><i class="fas fa-check-circle"></i> Chamados Confirmados</h2>
        <div class="chamados-list">
            <?php viewChamados($data["chamadosConfirmados"], "confirmado", "status-confirmado"); ?>
        </div>

        <h2 class="section-title"><i class="fas fa-check-circle"></i> Chamados Concluídos</h2>
        <div class="chamados-list">
            <?php viewChamados($data["chamadosConcluido"], "concluido", "status-concluido"); ?>
        </div>
    </div>
</div>

<!-- Controles de Paginação -->
<div id="pagination-container" class="pagination-container" style="display: none;">
    <!-- Container para os chamados paginados -->
    <div id="chamados-paginados-content"></div>

    <div class="pagination-info">
        <span id="pagination-info-text"></span>
    </div>
    <div class="pagination-controls">
        <button id="btn-first-page" class="pagination-btn" onclick="irParaPrimeiraPagina()">
            <i class="fas fa-angle-double-left"></i>
        </button>
        <button id="btn-prev-page" class="pagination-btn" onclick="irParaPaginaAnterior()">
            <i class="fas fa-angle-left"></i>
        </button>
        <div id="pagination-numbers" class="pagination-numbers"></div>
        <button id="btn-next-page" class="pagination-btn" onclick="irParaProximaPagina()">
            <i class="fas fa-angle-right"></i>
        </button>
        <button id="btn-last-page" class="pagination-btn" onclick="irParaUltimaPagina()">
            <i class="fas fa-angle-double-right"></i>
        </button>
    </div>
    <div class="pagination-size">
        <label for="page-size">Registros por página:</label>
        <select id="page-size" onchange="alterarTamanhoPagina()">
            <option value="10">10</option>
            <option value="15" selected>15</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
</div>

<!-- Modal de detalhes -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModal()">&times;</span>
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitulo"></h3>
        </div>
        <div class="modal-body">
            <div class="modal-details">
                <div class="modal-detail-item">
                    <strong>ID #:</strong>
                    <span id="modalNumero"></span>
                </div>
                <div class="modal-detail-item">
                    <strong>Assunto:</strong>
                    <span id="modalAssunto"></span>
                </div>
                <div class="modal-detail-item">
                    <strong>Solicitante:</strong>
                    <span id="modalSolicitante"></span>
                </div>
                <div class="modal-detail-item">
                    <strong>Local do atendimento:</strong>
                    <span id="modalSetor"></span>
                </div>
                <div class="modal-detail-item">
                    <strong>Categoria:</strong>
                    <span id="modalTipo"></span>
                </div>
                <div class="modal-detail-item" style="grid-column: 1 / -1;">
                    <strong>Descrição:</strong>
                    <p id="modalObs"></p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php if ($permissao["setor"] == "TI"): ?>
                <a href="" class="action-btn btn-edit" id="btn-editar-chamado">
                    <i class="fas fa-edit"></i> Editar Chamado
                </a>
            <?php endif; ?>

            <a href="javascript:void(0)" class="action-btn btn-view" id="btn-verAnexo">
                <i class="fas fa-paperclip"></i> Ver Anexos
            </a>

            <a class="action-btn btn-close" id="btn-encerrarChamado">
                <i class="fas fa-times-circle"></i> Encerrar Chamado
            </a>
        </div>
    </div>
</div>

<!-- Modal de Anexos -->
<div id="modalAnexo" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModalAnexo()">&times;</span>
        <div class="modal-header">
            <h3>Anexos do Chamado</h3>
        </div>
        <div class="anexos-container" id="anexos-container">
            <p>Carregando anexos...</p>
        </div>
    </div>
</div>

<script>
    const baseUrl = "<?php echo base_url('chamados'); ?>";

    function abrirModal(numero, solicitante, titulo, setor, tipo, obs, id, tipoChamado, anexos) {
        document.getElementById('modalTitulo').textContent = "Detalhes do Chamado";
        document.getElementById('modalAssunto').textContent = titulo;
        document.getElementById('modalNumero').textContent = numero;
        document.getElementById('modalSolicitante').textContent = solicitante;
        document.getElementById('modalSetor').textContent = setor;
        document.getElementById('modalTipo').textContent = tipo;
        document.getElementById('modalObs').textContent = obs;

        const btnActionChamado = document.getElementById('btn-editar-chamado');
        if (btnActionChamado) {
            switch (tipoChamado) {
                case "confirmado":
                    btnActionChamado.innerText = "Atender Chamado";
                    break;
                case "andamento":
                    btnActionChamado.innerText = "Atender Chamado";
                    break;
                case "aberto":
                    btnActionChamado.innerText = "Atribuir Chamado";
                    break;
                case "aguardando":
                    btnActionChamado.innerText = "Confirmar Chamado";
                    break;
                case "devolvido":
                    btnActionChamado.innerText = "Atribuir Chamado";
                    break;
                default:
                    btnActionChamado.innerText = "Abrir Relatorio";
                    break;
            }
            // btnActionChamado.innerText = tipoChamado === "andamento" ? "Atender Chamado" : (tipoChamado === "aberto" ? "Atribuir Chamado" : "Abrir Relatorio");
        }

        const btnEditarChamado = document.getElementById('btn-editar-chamado');
        if (btnEditarChamado) btnEditarChamado.href = baseUrl + '/' + id + '/edit';

        // Ver anexos
        const btnVerAnexo = document.getElementById('btn-verAnexo');
        if (btnVerAnexo) {
            btnVerAnexo.onclick = function() {
                document.getElementById('modalAnexo').style.display = 'block';

                // Primeiro, exibir os anexos da variável passada
                let anexosHTML = '';

                // Verificar se há anexos passados diretamente
                if (anexos && anexos.length > 0) {
                    anexosHTML += '<h4>Lista de Anexos:</h4>';
                    anexos.forEach(anexo => {
                        anexosHTML += `<div class="anexo-item">`;
                        anexosHTML += `<p><strong>Nome:</strong> ${anexo.nome}</p>`;
                        anexosHTML += `<p><strong>Data:</strong> ${anexo.created_at || 'N/A'}</p>`;

                        // Verificar o tipo de arquivo para exibição adequada
                        if (anexo.typeMine && anexo.typeMine.includes('image')) {
                            anexosHTML += `<img src="<?php echo base_url('assets/uploads/'); ?>/${anexo.nome}" alt="Anexo" style="max-width:100%; max-height:300px; object-fit:contain; margin-bottom:15px;">`;
                        } else if (anexo.typeMine && anexo.typeMine.includes('pdf')) {
                            anexosHTML += `<a href="<?php echo base_url('assets/uploads/'); ?>/${anexo.nome}" target="_blank" class="anexo-link">Visualizar PDF</a>`;
                        } else {
                            anexosHTML += `<a href="<?php echo base_url('assets/uploads/'); ?>/${anexo.nome}" target="_blank" class="anexo-link">Baixar Arquivo</a>`;
                        }
                        anexosHTML += `</div>`;
                    });
                    document.getElementById('anexos-container').innerHTML = anexosHTML;
                } else {
                    // Se não houver anexos passados diretamente, buscar via AJAX
                    document.getElementById('anexos-container').innerHTML = '<p>Carregando anexos...</p>';
                }

                // Agora, buscar todos os anexos do chamado via AJAX
                fetch(`${baseUrl}/anexos/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            anexosHTML = '<h4>Lista de Anexos:</h4>';
                            data.forEach(anexo => {
                                anexosHTML += `<div class="anexo-item">`;
                                anexosHTML += `<p><strong>Nome:</strong> ${anexo.nome}</p>`;
                                anexosHTML += `<p><strong>Data:</strong> ${anexo.created_at || 'N/A'}</p>`;

                                // Verificar o tipo de arquivo para exibição adequada
                                if (anexo.typeMine && anexo.typeMine.includes('image')) {
                                    anexosHTML += `<img src="${anexo.url}" alt="Anexo" style="max-width:100%; max-height:300px; object-fit:contain; margin-bottom:15px;">`;
                                } else if (anexo.typeMine && anexo.typeMine.includes('pdf')) {
                                    anexosHTML += `<a href="${anexo.url}" target="_blank" class="anexo-link">Visualizar PDF</a>`;
                                } else {
                                    anexosHTML += `<a href="${anexo.url}" target="_blank" class="anexo-link">Baixar Arquivo</a>`;
                                }
                                anexosHTML += `</div>`;
                            });
                            document.getElementById('anexos-container').innerHTML = anexosHTML;
                        } else if (!anexos || anexos.length === 0) {
                            document.getElementById('anexos-container').innerHTML = '<p>Nenhum anexo encontrado para este chamado.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar anexos:', error);
                        if (!anexos || anexos.length === 0) {
                            document.getElementById('anexos-container').innerHTML = '<p>Erro ao carregar anexos. Por favor, tente novamente.</p>';
                        }
                    });
            };
        }

        const btnEncerrarChamado = document.getElementById('btn-encerrarChamado');
        if (btnEncerrarChamado) {
            if (tipoChamado === "concluido") {
                btnEncerrarChamado.style.display = "none";
            } else {
                btnEncerrarChamado.style.display = "inline-flex";
                btnEncerrarChamado.href = baseUrl + '/' + id + '/cancel';
            }
        }

        document.getElementById('modal').style.display = 'block';
    }

    function fecharModalAnexo() {
        document.getElementById('modalAnexo').style.display = 'none';
    }

    function fecharModal() {
        document.getElementById('modal').style.display = 'none';
    }

    // Fechar modais ao clicar fora deles
    window.onclick = function(event) {
        const modal = document.getElementById('modal');
        const modalAnexo = document.getElementById('modalAnexo');

        if (event.target == modal) {
            fecharModal();
        }
        if (event.target == modalAnexo) {
            fecharModalAnexo();
        }
    }

    /**
     * Função para filtrar chamados por solicitante, número do chamado ou assunto
     * Realiza busca em tempo real nos elementos da página
     */
    function filtrarChamados() {
        const searchInput = document.getElementById('search-input');
        const searchTerm = searchInput.value.toLowerCase().trim();

        if (searchTerm === '') {
            limparFiltro();
            return;
        }

        filtrarChamadosPorTermo(searchTerm);
    }

    /**
     * Função para filtrar chamados em tempo real durante a digitação
     * @param {Event} event - Evento do teclado
     */
    function filtrarChamadosRealTime(event) {
        // Filtrar apenas se Enter for pressionado ou após 3 caracteres
        const searchTerm = event.target.value.toLowerCase().trim();

        if (event.key === 'Enter') {
            event.preventDefault();
            filtrarChamados();
            return;
        }

        if (searchTerm.length >= 3) {
            filtrarChamadosPorTermo(searchTerm);
        } else if (searchTerm.length === 0) {
            limparFiltro();
        }
    }

    /**
     * Função principal que executa o filtro nos chamados
     * @param {string} searchTerm - Termo de pesquisa
     */
    function filtrarChamadosPorTermo(searchTerm) {
        const chamadosLists = document.querySelectorAll('.chamados-list');
        const sectionTitles = document.querySelectorAll('.section-title');
        let totalVisible = 0;
        let totalChamados = 0;

        // Iterar por cada seção de chamados (aberto, andamento, concluído)
        chamadosLists.forEach((list, index) => {
            const chamados = list.querySelectorAll('.chamado-card');
            let visibleInSection = 0;

            chamados.forEach(chamado => {
                totalChamados++;

                // Extrair dados do chamado para comparação
                const numero = chamado.querySelector('.chamado-title')?.textContent.toLowerCase() || '';
                const solicitanteElement = chamado.querySelector('p:nth-child(1)')?.textContent.toLowerCase() || '';
                const assuntoElement = chamado.querySelector('p:nth-child(2)')?.textContent.toLowerCase() || '';

                // Verificar se o termo de pesquisa está presente em algum dos campos
                const matchNumero = numero.includes(searchTerm);
                const matchSolicitante = solicitanteElement.includes(searchTerm);
                const matchAssunto = assuntoElement.includes(searchTerm);

                if (matchNumero || matchSolicitante || matchAssunto) {
                    chamado.style.display = 'block';
                    chamado.style.animation = 'fadeIn 0.3s ease-in';
                    visibleInSection++;
                    totalVisible++;
                } else {
                    chamado.style.display = 'none';
                }
            });

            // Mostrar/ocultar seção baseado se há chamados visíveis
            if (sectionTitles[index]) {
                if (visibleInSection > 0) {
                    sectionTitles[index].style.display = 'block';
                    list.style.display = 'grid';
                } else {
                    sectionTitles[index].style.display = 'none';
                    list.style.display = 'none';
                }
            }
        });

        // Mostrar informações dos resultados da pesquisa
        mostrarResultadosPesquisa(totalVisible, totalChamados, searchTerm);
    }

    /**
     * Função para limpar o filtro e mostrar todos os chamados
     */
    function limparFiltro() {
        const searchInput = document.getElementById('search-input');
        const chamadosLists = document.querySelectorAll('.chamados-list');
        const sectionTitles = document.querySelectorAll('.section-title');
        const resultsInfo = document.getElementById('search-results-info');

        // Limpar campo de pesquisa
        searchInput.value = '';

        // Mostrar todos os chamados e seções
        chamadosLists.forEach((list, index) => {
            const chamados = list.querySelectorAll('.chamado-card');

            chamados.forEach(chamado => {
                chamado.style.display = 'block';
                chamado.style.animation = 'fadeIn 0.3s ease-in';
            });

            if (sectionTitles[index]) {
                sectionTitles[index].style.display = 'block';
                list.style.display = 'grid';
            }
        });

        // Ocultar informações dos resultados
        resultsInfo.classList.remove('show');
        resultsInfo.textContent = '';
    }

    /**
     * Função para mostrar informações dos resultados da pesquisa
     * @param {number} visible - Número de chamados visíveis
     * @param {number} total - Total de chamados
     * @param {string} term - Termo pesquisado
     */
    function mostrarResultadosPesquisa(visible, total, term) {
        const resultsInfo = document.getElementById('search-results-info');

        if (visible === 0) {
            resultsInfo.innerHTML = `<i class="fas fa-info-circle"></i> Nenhum chamado encontrado para "${term}". Tente pesquisar por outro termo.`;
            resultsInfo.style.background = 'rgba(255, 152, 0, 0.1)';
            resultsInfo.style.color = '#ff9800';
        } else {
            resultsInfo.innerHTML = `<i class="fas fa-check-circle"></i> Encontrados ${visible} de ${total} chamados para "${term}"`;
            resultsInfo.style.background = 'rgba(46, 125, 50, 0.1)';
            resultsInfo.style.color = '#2e7d32';
        }

        resultsInfo.classList.add('show');
    }

    // Adicionar animação CSS para fadeIn
    const style = document.createElement('style');
    style.textContent = `
         @keyframes fadeIn {
             from { opacity: 0; transform: translateY(10px); }
             to { opacity: 1; transform: translateY(0); }
         }
     `;
    document.head.appendChild(style);

    // ===== SISTEMA DE PAGINAÇÃO =====

    // Variáveis globais para paginação
    let currentPage = 1;
    let currentStatus = '';
    let currentSearch = '';
    let currentLimit = 15;
    let totalPages = 1;
    let paginationData = null;
    let userPermissions = null;

    /**
     * Filtrar chamados por status
     */
    function filtrarPorStatus(status) {
        // Atualizar botões de filtro
        document.querySelectorAll('.status-filter').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector(`[data-status="${status}"]`).classList.add('active');

        // Resetar paginação
        currentPage = 1;
        currentStatus = status;
        currentSearch = document.getElementById('search-input').value.trim();

        // Sempre carregar chamados paginados via AJAX para dados atualizados
        carregarChamadosPaginados();
    }

    /**
     * Carregar chamados paginados via AJAX
     */
    function carregarChamadosPaginados() {
        mostrarLoading(true);

        const params = new URLSearchParams({
            page: currentPage,
            limit: currentLimit,
            status: currentStatus,
            search: currentSearch
        });

        const fullUrl = `${baseUrl}/paginar?${params}`;

        fetch(fullUrl, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    paginationData = data.pagination;
                    userPermissions = data.permissao;
                    totalPages = data.pagination.total_pages;

                    renderizarChamados(data.data);
                    atualizarPaginacao();

                    // Ocultar conteúdo original e mostrar paginação
                    document.getElementById('chamados-content').style.display = 'none';
                    document.getElementById('pagination-container').style.display = 'block';
                } else {
                    console.error('Erro ao carregar chamados:', data.message);
                    alert('Erro ao carregar chamados. Tente novamente.');
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert('Erro de conexão. Tente novamente.');
            })
            .finally(() => {
                mostrarLoading(false);
            });
    }

    /**
     * Renderizar chamados na tela
     */
    function renderizarChamados(chamados) {
        const container = document.getElementById('chamados-paginados-content');

        if (chamados.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #6c757d;">
                    <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 16px;"></i>
                    <h3>Nenhum chamado encontrado</h3>
                    <p>Não há chamados para os filtros selecionados.</p>
                </div>
            `;
            return;
        }

        let html = '';
        const statusInfo = getStatusInfo(currentStatus);

        html += `<h2 class="section-title"><i class="${statusInfo.icon}"></i> ${statusInfo.title}</h2>`;
        html += '<div class="chamados-list">';

        chamados.forEach(chamado => {
            const chamadoStatusInfo = getStatusInfo(chamado.status);
            html += gerarHtmlChamado(chamado, chamado.status, chamadoStatusInfo.class);
        });

        html += '</div>';
        container.innerHTML = html;
    }

    /**
     * Gerar HTML para um chamado individual
     */
    function gerarHtmlChamado(chamado, tipo, statusClass) {
        const anexosJson = chamado.arquivo ? JSON.stringify(chamado.arquivo) : '[]';
        const anexosEscaped = anexosJson.replace(/"/g, '&quot;');

        let html = `
            <div class="chamado-card" onclick="abrirModal('${chamado.numero}','${chamado.nome}','${chamado.titulo}', '${chamado.setor}', '${chamado.tipo}', '${chamado.observacao}', '${chamado.chave}', '${tipo}', ${anexosEscaped})">
                <div class="chamado-header">
                    <h3 class="chamado-title">${chamado.titulo}</h3>
                    <span class="status-badge ${statusClass}">${getStatusText(tipo)}</span>
                </div>
                <div class="chamado-info">
                    <p><strong>ID #:</strong> ${chamado.numero}</p>
                    <p><strong>Solicitante:</strong> ${chamado.nome}</p>
                    <p><strong>Local do atendimento:</strong> ${chamado.setor}</p>
                    <p><strong>Categoria:</strong> ${chamado.tipo}</p>
                    <p><strong>Descrição do problema:</strong> ${chamado.observacao.length > 50 ? chamado.observacao.substring(0, 50) + '...' : chamado.observacao}</p>
                    <p><strong>Data da abertura:</strong> ${formatarData(chamado.registro)}</p>
        `;

        // Adicionar campos específicos para TI
        if (userPermissions && userPermissions.setor === 'TI') {
            html += `<p><strong>Data da modificação:</strong> ${formatarData(chamado.update)}</p>`;

            if (chamado.atendente) {
                html += `<p><strong>Responsável pelo atendimento:</strong> ${chamado.atendente}</p>`;
            }

            if (chamado.resposta) {
                html += `<p><strong>Resposta:</strong> ${chamado.resposta.length > 50 ? chamado.resposta.substring(0, 50) + '...' : chamado.resposta}</p>`;
                html += `<p><strong>Data do atendimento:</strong> ${formatarData(chamado.atendimento_date)}</p>`;
            }
        } else if (chamado.resposta) {
            html += `<p><strong>Resposta:</strong> ${chamado.resposta.length > 50 ? chamado.resposta.substring(0, 50) + '...' : chamado.resposta}</p>`;
        }

        html += `
                </div>
            </div>
        `;

        return html;
    }

    /**
     * Obter informações do status
     */
    function getStatusInfo(status) {
        const statusMap = {
            'A': {
                title: 'Chamados em Aberto',
                icon: 'fas fa-list',
                type: 'aberto',
                class: 'status-aberto'
            },
            'B': {
                title: 'Chamados Devolvidos',
                icon: 'fas fa-undo',
                type: 'devolvido',
                class: 'status-devolvido'
            },
            'E': {
                title: 'Chamados em Andamento',
                icon: 'fas fa-spinner',
                type: 'andamento',
                class: 'status-andamento'
            },
            'F': {
                title: 'Chamados Aguardando Confirmação',
                icon: 'fas fa-clock',
                type: 'aguardando',
                class: 'status-aguardando'
            },
            'G': {
                title: 'Chamados Confirmados',
                icon: 'fas fa-check-circle',
                type: 'confirmado',
                class: 'status-confirmado'
            },
            'C': {
                title: 'Chamados Concluídos',
                icon: 'fas fa-check-circle',
                type: 'concluido',
                class: 'status-concluido'
            }
        };
        return statusMap[status] || {
            title: 'Todos os Chamados',
            icon: 'fas fa-list',
            type: 'todos',
            class: 'status-todos'
        };
    }

    /**
     * Obter texto do status
     */
    function getStatusText(status) {
        const textMap = {
            'A': 'Aberto',
            'B': 'Devolvido',
            'E': 'Em Andamento',
            'F': 'Aguardando Confirmação',
            'G': 'Confirmado',
            'C': 'Concluído'
        };
        return textMap[status] || 'Desconhecido';
    }

    /**
     * Formatar data para exibição
     */
    function formatarData(dataString) {
        if (!dataString) return 'N/A';
        const data = new Date(dataString);
        return data.toLocaleDateString('pt-BR') + ' ' + data.toLocaleTimeString('pt-BR', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    /**
     * Atualizar controles de paginação
     */
    function atualizarPaginacao() {
        if (!paginationData) return;

        // Atualizar informações
        const infoText = `Página ${paginationData.current_page} de ${paginationData.total_pages} (${paginationData.total_records} registros)`;
        document.getElementById('pagination-info-text').textContent = infoText;

        // Atualizar botões de navegação
        document.getElementById('btn-first-page').disabled = !paginationData.has_prev;
        document.getElementById('btn-prev-page').disabled = !paginationData.has_prev;
        document.getElementById('btn-next-page').disabled = !paginationData.has_next;
        document.getElementById('btn-last-page').disabled = !paginationData.has_next;

        // Gerar números de página
        gerarNumerosPagina();
    }

    /**
     * Gerar números de página
     */
    function gerarNumerosPagina() {
        const container = document.getElementById('pagination-numbers');
        container.innerHTML = '';

        const current = paginationData.current_page;
        const total = paginationData.total_pages;

        // Calcular range de páginas a mostrar
        let start = Math.max(1, current - 2);
        let end = Math.min(total, current + 2);

        // Ajustar se estamos no início ou fim
        if (current <= 3) {
            end = Math.min(total, 5);
        }
        if (current >= total - 2) {
            start = Math.max(1, total - 4);
        }

        // Adicionar primeira página se necessário
        if (start > 1) {
            container.appendChild(criarBotaoPagina(1));
            if (start > 2) {
                container.appendChild(criarEllipsis());
            }
        }

        // Adicionar páginas do range
        for (let i = start; i <= end; i++) {
            container.appendChild(criarBotaoPagina(i, i === current));
        }

        // Adicionar última página se necessário
        if (end < total) {
            if (end < total - 1) {
                container.appendChild(criarEllipsis());
            }
            container.appendChild(criarBotaoPagina(total));
        }
    }

    /**
     * Criar botão de página
     */
    function criarBotaoPagina(numero, ativo = false) {
        const button = document.createElement('button');
        button.className = `pagination-number ${ativo ? 'active' : ''}`;
        button.textContent = numero;
        button.onclick = () => irParaPagina(numero);
        return button;
    }

    /**
     * Criar ellipsis (...)
     */
    function criarEllipsis() {
        const span = document.createElement('span');
        span.className = 'pagination-ellipsis';
        span.textContent = '...';
        span.style.padding = '8px 4px';
        span.style.color = '#6c757d';
        return span;
    }

    /**
     * Navegar para página específica
     */
    function irParaPagina(pagina) {
        if (pagina !== currentPage && pagina >= 1 && pagina <= totalPages) {
            currentPage = pagina;
            carregarChamadosPaginados();
        }
    }

    /**
     * Ir para primeira página
     */
    function irParaPrimeiraPagina() {
        irParaPagina(1);
    }

    /**
     * Ir para página anterior
     */
    function irParaPaginaAnterior() {
        irParaPagina(currentPage - 1);
    }

    /**
     * Ir para próxima página
     */
    function irParaProximaPagina() {
        irParaPagina(currentPage + 1);
    }

    /**
     * Ir para última página
     */
    function irParaUltimaPagina() {
        irParaPagina(totalPages);
    }

    /**
     * Alterar tamanho da página
     */
    function alterarTamanhoPagina() {
        const select = document.getElementById('page-size');
        currentLimit = parseInt(select.value);
        currentPage = 1; // Resetar para primeira página
        carregarChamadosPaginados();
    }

    /**
     * Mostrar/ocultar loading
     */
    function mostrarLoading(mostrar) {
        const loading = document.getElementById('loading');
        loading.style.display = mostrar ? 'block' : 'none';
    }

    /**
     * Integrar busca com paginação
     */
    function filtrarChamadosComPaginacao() {
        const searchInput = document.getElementById('search-input');
        currentSearch = searchInput.value.trim();
        currentPage = 1; // Resetar para primeira página

        if (currentStatus) {
            carregarChamadosPaginados();
        } else {
            // Se não há filtro de status, usar busca original
            filtrarChamados();
        }
    }

    // Sobrescrever funções de busca existentes para integrar com paginação
    const originalFiltrarChamados = filtrarChamados;
    filtrarChamados = function() {
        if (currentStatus) {
            filtrarChamadosComPaginacao();
        } else {
            originalFiltrarChamados();
        }
    };

    const originalLimparFiltro = limparFiltro;
    limparFiltro = function() {
        if (currentStatus) {
            document.getElementById('search-input').value = '';
            currentSearch = '';
            currentPage = 1;
            carregarChamadosPaginados();
        } else {
            // Restaurar visualização original
            document.getElementById('pagination-container').style.display = 'none';
            document.getElementById('chamados-content').style.display = 'block';
            originalLimparFiltro();
        }
    };
</script>
<?php echo $this->endSection(); ?>