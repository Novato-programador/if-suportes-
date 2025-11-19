<?php echo $this->extend("_common/layout"); ?>
<?php echo $this->section("content"); ?>

<style>
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

  /* Container */
  .container {
    background: var(--white);
    border-radius: 12px;
    padding: 30px;
    box-shadow: var(--card-shadow);
    margin-bottom: 30px;
  }

  .section-title {
    font-size: 1.5rem;
    color: var(--dark);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .section-title i {
    color: var(--info);
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
    color: var(--dark);
  }

  tr:last-child td {
    border-bottom: none;
  }

  tr:hover {
    background-color: rgba(67, 97, 238, 0.03);
  }

  /* Form Elements */
  select {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: var(--transition);
  }

  select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
  }

  /* Buttons */
  .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .btn-success {
    background: var(--success);
    color: white;
  }

  .btn-success:hover {
    background: #3ab7d8;
    transform: translateY(-2px);
  }

  .btn-danger {
    background: var(--warning);
    color: white;
  }

  .btn-danger:hover {
    background: #d11467;
    transform: translateY(-2px);
  }

  .actions {
    display: flex;
    gap: 10px;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .container {
      padding: 20px;
    }

    .header {
      flex-direction: column;
      align-items: flex-start;
      gap: 15px;
    }

    table,
    thead,
    tbody,
    th,
    td,
    tr {
      display: block;
    }

    thead tr {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }

    tr {
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
    }

    td {
      position: relative;
      padding-left: 50%;
      border: none;
      border-bottom: 1px solid #eee;
    }

    td:last-child {
      border-bottom: none;
    }

    td:before {
      content: attr(data-label);
      position: absolute;
      left: 10px;
      width: 45%;
      padding-right: 10px;
      white-space: nowrap;
      font-weight: bold;
      color: var(--dark);
    }

    .actions {
      flex-direction: column;
      align-items: stretch;
    }
  }
</style>
<div class="header">
  <h1><i class="fas fa-user-lock"></i> Solicitações de Cadastro</h1>
  <div class="user-info">
    <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
    <span><?php echo $user; ?></span>
  </div>
</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url("/home"); ?>">Início</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url("/usuario"); ?>">Usuários</a></li>
    <li class="breadcrumb-item active" aria-current="page">Solicitações de Cadastro</li>
  </ol>
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
  <h2 class="section-title"><i class="fas fa-clock"></i> Solicitações Pendentes</h2>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Setor</th>
          <th>Responsável</th>
          <th>Permissão</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($solicitacoes as $solicitante): ?>
          <tr>
            <td data-label="Nome"><?= htmlspecialchars($solicitante['nome']) ?></td>
            <td data-label="Setor"><?= htmlspecialchars($solicitante['setor']) ?></td>
            <td data-label="Responsável"><?= htmlspecialchars($solicitante['responsavel']) ?></td>
            <?php echo form_open("usuario/processar_solicitacao", ["method" => "POST"]); ?>
            <input type="hidden" name="chave" value="<?= $solicitante['chave'] ?>">
            <td data-label="Permissão">
              <select name="permissao">
                <option value="colab">Colaborador</option>
                <option value="admin">Administrador</option>
              </select>
            </td>
            <td data-label="Ações" class="actions">
              <button type="submit" name="acao" value="aceitar" class="btn btn-success">
                <i class="fas fa-check"></i> Aceitar
              </button>
              <button type="submit" name="acao" value="recusar" class="btn btn-danger">
                <i class="fas fa-times"></i> Recusar
              </button>
            </td>
            <?php echo form_close(); ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

</body>

</html>

<?php echo $this->endSection("content"); ?>