<?php echo $this->extend("_common/layout"); ?>
<?php echo $this->section("content"); ?>

<style>
  :root {
    --primary: #2e7d32;
    --primary-light: #4caf50;
    --primary-dark: #1b5e20;
    --secondary: #ff9800;
    --success: #4caf50;
    --warning: #ff9800;
    --info: #2196f3;
    --dark: #1e1e2c;
    --light: #f8f9fa;
    --gray: #6c757d;
    --white: #ffffff;
    --card-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
    --border-radius: 12px;
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

  /* Sidebar - Mantido igual */
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
    padding: 24px;
    transition: var(--transition);
  }

  /* Header melhorado */
  /* .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 16px 24px;
    border-radius: var(--border-radius);
    background: var(--white);
    box-shadow: var(--card-shadow);
  } */

  /* .header h1 {
    font-size: 1.8rem;
    font-weight: 600;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .header h1 i {
    color: var(--primary);
  } */

  .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .user-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
    box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
  }

  /* Breadcrumb melhorado */
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

  .breadcrumb-item {
    display: flex;
    align-items: center;
  }

  .breadcrumb-item+.breadcrumb-item::before {
    content: "›";
    padding: 0 10px;
    color: var(--gray);
  }

  .breadcrumb a {
    text-decoration: none;
    color: var(--primary);
    font-weight: 500;
    transition: var(--transition);
  }

  .breadcrumb a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
  }

  .breadcrumb .active {
    color: var(--gray);
    font-weight: 500;
  }

  /* Container principal */
  .container {
    background: var(--white);
    border-radius: var(--border-radius);
    padding: 28px;
    box-shadow: var(--card-shadow);
    margin-bottom: 30px;
    border: 1px solid rgba(0, 0, 0, 0.05);
  }

  .container-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
  }

  .container-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--dark);
  }

  .text-right {
    text-align: right;
  }

  .mb-20 {
    margin-bottom: 20px;
  }

  /* Botão principal */
  .btn-view {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(46, 125, 50, 0.25);
  }

  .btn-view:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary));
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
  }

  /* Barra de pesquisa melhorada */
  .search-bar {
    display: flex;
    align-items: center;
    margin-bottom: 24px;
    background: var(--light);
    border-radius: 10px;
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid transparent;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  }

  .search-bar:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.15);
    background: var(--white);
  }

  .search-bar input {
    flex: 1;
    padding: 14px 18px;
    border: none;
    font-size: 15px;
    outline: none;
    background: transparent;
  }

  .icon {
    background-color: var(--primary);
    color: var(--primary);
    padding: 0 15px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50px;
    width: 50px;
    height: 50px !important;
    padding: 5px;
    margin: 3px;
  }

  .search-bar .icon {
    background-color: var(--primary);
    color: white;
    padding: 0 18px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
  }

  .search-bar .icon:hover {
    background-color: var(--primary-dark);
  }

  /* Tabela melhorada */
  .table-container {
    background: var(--white);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    border: 1px solid rgba(0, 0, 0, 0.05);
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }

  th {
    background: linear-gradient(to bottom, #f8f9fa, #f1f3f5);
    padding: 16px 20px;
    text-align: left;
    font-weight: 600;
    color: var(--dark);
    border-bottom: 2px solid rgba(0, 0, 0, 0.08);
  }

  td {
    padding: 16px 20px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    transition: var(--transition);
  }

  tr:last-child td {
    border-bottom: none;
  }

  /* Efeito hover nas linhas da tabela */
  tr:hover {
    background-color: rgba(46, 125, 50, 0.03);
  }

  tr:hover td {
    transform: translateX(4px);
  }

  /* Status badges melhorados */
  .status {
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-block;
    text-align: center;
    min-width: 80px;
  }

  .status-ativo {
    background: rgba(76, 175, 80, 0.15);
    color: var(--success);
    border: 1px solid rgba(76, 175, 80, 0.3);
  }

  .status-inativo {
    background: rgba(255, 152, 0, 0.15);
    color: var(--warning);
    border: 1px solid rgba(255, 152, 0, 0.3);
  }

  /* Ações */
  .actions {
    text-align: right;
  }

  .action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
  }

  .btn-edit {
    background: rgba(76, 175, 80, 0.1);
    color: var(--success);
    border: 1px solid rgba(76, 175, 80, 0.2);
  }

  .btn-edit:hover {
    background: rgba(76, 175, 80, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(76, 175, 80, 0.15);
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
    .container {
      padding: 20px;
    }

    .header {
      flex-direction: column;
      align-items: flex-start;
      gap: 15px;
      padding: 16px;
    }

    .text-right {
      text-align: left;
      margin-top: 10px;
    }

    table {
      display: block;
      overflow-x: auto;
    }

    .container-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 16px;
    }
  }
</style>

<div class="header">
  <h1><i class="fas fa-users"></i> Usuários do Sistema</h1>
  <div class="user-info">
    <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
    <span><?php echo $user; ?></span>
  </div>
</div>

<nav aria-label="breadcrumb">
  <div class="breadcrumb">
    <div class="breadcrumb-item"><a href="<?php echo base_url("/home"); ?>">Início</a></div>
    <div class="breadcrumb-item active" aria-current="page">Usuários</div>
  </div>
</nav>

<div class="container">
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
  <div class="container-header">
    <h2 class="container-title">Gerenciamento de Usuários</h2>
    <div class="text-right">
      <a href="<?= base_url('solicitacoes') ?>" class="btn-view">
        <i class="fas fa-user-lock"></i> Ver Solicitações de Cadastro
      </a>
    </div>
  </div>

  <div class="search-bar">
    <input type="text" id="pesquisa" onkeyup="filtrar()" placeholder="Pesquisar por nome, setor, status...">
    <div class="icon"><i class="fas fa-search"></i></div>
  </div>

  <div class="table-container">
    <table id="tabelaUsuarios">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Setor</th>
          <th>Status</th>
          <th>Nível de Permissão</th>
          <th class="actions">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 0; $i < count($data); $i++): ?>
          <tr>
            <td><?php echo $data[$i]["nome"]; ?></td>
            <td><?php echo $data[$i]["telefone"]; ?></td>
            <td><?php echo $data[$i]["setor"]; ?></td>
            <?php
            $optionStatus = [
              'A' => 'Ativo',
              'I' => 'Bloqueado',
              'S' => 'Solicitação'
            ];
            $optionNivel = [
              'admin' => 'Administrador',
              'colab' => 'Colaborador',
              '' => 'Nenhum nível atribuído'
            ];
            $statusClass = $data[$i]["status"] == 'A' ? 'status-ativo' : 'status-inativo';
            ?>
            <td><span class="status <?php echo $statusClass; ?>"><?php echo $optionStatus[$data[$i]["status"]]; ?></span></td>
            <td><?php echo $optionNivel[$data[$i]["nivel"]]; ?></td>
            <td class="actions">
              <a href="<?php echo base_url('usuario/' . $data[$i]["chave"] . '/edit'); ?>" class="action-btn btn-edit">
                <i class="fas fa-edit"></i> Editar
              </a>
            </td>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  function filtrar() {
    const input = document.getElementById("pesquisa").value.toLowerCase();
    const linhas = document.querySelectorAll("#tabelaUsuarios tbody tr");

    linhas.forEach(linha => {
      const textoLinha = linha.innerText.toLowerCase();
      linha.style.display = textoLinha.includes(input) ? "" : "none";
    });
  }
</script>

<?php echo $this->endSection("content"); ?>