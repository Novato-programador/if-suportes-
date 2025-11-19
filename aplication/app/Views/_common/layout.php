<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ControlChamados - Sistema de Gerenciamento</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- <style>
    :root {
      --primary: #4361ee;
      --secondary: #3f37c9;
      --success: #4cc9f0;
      --warning: #f72585;
      --info: #4895ef;
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
      background: var(--dark);
      color: var(--white);
      padding: 20px 0;
      transition: var(--transition);
      height: 100vh;
      position: fixed;
      overflow-y: auto;
    }

    .sidebar-header {
      padding: 0 20px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 20px;
    }

    .sidebar-header h2 {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1.5rem;
    }

    .sidebar-header h2 i {
      color: var(--info);
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
      color: var(--light);
      text-decoration: none;
      transition: var(--transition);
      gap: 10px;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
      background: rgba(255, 255, 255, 0.1);
      border-left: 4px solid var(--info);
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
      background: rgba(247, 37, 133, 0.2);
      color: var(--warning);
    }

    .stat-icon.progress {
      background: rgba(67, 97, 238, 0.2);
      color: var(--primary);
    }

    .stat-icon.completed {
      background: rgba(76, 201, 240, 0.2);
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
      background: rgba(247, 37, 133, 0.1);
      color: var(--warning);
    }

    .status-progress {
      background: rgba(67, 97, 238, 0.1);
      color: var(--primary);
    }

    .status-completed {
      background: rgba(76, 201, 240, 0.1);
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
      background: rgba(67, 97, 238, 0.1);
      color: var(--primary);
    }

    .btn-edit {
      background: rgba(76, 201, 240, 0.1);
      color: var(--success);
    }

    .btn-close {
      background: rgba(247, 37, 133, 0.1);
      color: var(--warning);
    }

    .action-btn:hover {
      opacity: 0.9;
      transform: scale(1.05);
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
    }
  </style> -->
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
      /* Menu com a cor especificada */
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
      /* Verde mais claro para contraste */
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

    .action-btn:hover {
      opacity: 0.9;
      transform: scale(1.05);
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
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <h2><i style="color: #ffffff;" class="fas fa-headset"></i> <span>IFPA - Suportes</span></h2>
    </div>
    <ul class="sidebar-menu">
      <li><a href="<?php echo base_url("/home"); ?>"><i class="fas fa-home"></i> <span>Home</span></a></li>
      <li><a href="<?php echo base_url("chamados/create"); ?>"><i class="fas fa-plus"></i> <span>Abrir Chamado</span></a></li>
      <li><a href="<?php echo base_url("/meus-chamados"); ?>"><i class="fas fa-search"></i> <span>Meus Chamados</span></a></li>
      <li><a style="display:<?= checkePermissao() ?>;" href="<?php echo base_url("/chamados"); ?>"><i class="fas fa-ticket-alt"></i> <span>Chamados</span></a></li>
      <li><a href="<?php echo base_url("/dashboard"); ?>"><i class="fas fa-chart-bar"></i> <span>Dashboard</span></a></li>
      <li><a style="display:<?= checkePermissao() ?>;" href="<?php echo base_url("/relatorios"); ?>"><i class="fas fa-chart-pie"></i> <span>Relatórios</span></a></li>
      <li><a style="display:<?= checkePermissao() ?>;" href="<?php echo base_url("usuario"); ?>"><i class="fas fa-users"></i> <span>Usuários</span></a></li>
      <li><a style="display:<?= checkePermissao() ?>;" href="<?php echo base_url("solicitacoes"); ?>"><i class="fas fa-clipboard-list"></i> <span>Solicitações</span></a></li>
      <li><a href="<?php echo base_url("login/signout"); ?>"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a></li>
    </ul>
  </aside>

  <main class="main-content">

    <?php echo $this->renderSection('content'); ?>
    </div>

    <script>
      // Função para gerenciar a classe active no menu
      function setActiveMenuItem() {
        // Obter a URL atual
        const currentPath = window.location.pathname;

        // Remover classe active de todos os links do menu
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
          link.classList.remove('active');
        });

        // Encontrar o link correspondente à URL atual e adicionar classe active
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
          const linkPath = new URL(link.href).pathname;

          // Verificar correspondência exata ou se a URL atual contém o caminho do link
          if (currentPath === linkPath ||
            (linkPath !== '/' && currentPath.startsWith(linkPath)) ||
            (linkPath === '/home' && (currentPath === '/' || currentPath === '/home'))) {
            link.classList.add('active');
          }
        });

        // Caso especial: se nenhum link foi marcado como ativo e estamos na raiz, ativar Home
        const hasActive = document.querySelector('.sidebar-menu a.active');
        if (!hasActive && (currentPath === '/' || currentPath === '/home')) {
          const homeLink = document.querySelector('.sidebar-menu a[href*="/home"]');
          if (homeLink) {
            homeLink.classList.add('active');
          }
        }
      }

      // Executar quando a página carregar
      document.addEventListener('DOMContentLoaded', function() {
        // Definir o menu ativo baseado na URL atual
        setActiveMenuItem();

        // Adicionar event listeners para os cliques nos links do menu
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
          link.addEventListener('click', function(e) {
            // Remover active de todos os links
            document.querySelectorAll('.sidebar-menu a').forEach(l => l.classList.remove('active'));
            // Adicionar active no link clicado
            this.classList.add('active');
          });
        });
      });

      // Simulação de troca de abas
      document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', () => {
          document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
          tab.classList.add('active');
        });
      });
    </script>
    <script src="<?php echo base_url("/assets/switchAlert/switchAlert.js"); ?>"></script>
</body>

</html>