<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<script>
    const base_url = "<?= base_url() ?>";
</script>
<style>
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

    /* Form Styles */
    .form-container {
        background: var(--white);
        border-radius: 12px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-title {
        font-size: 1.8rem;
        color: var(--dark);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    select:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--secondary);
    }

    .btn-secondary {
        background: #e0e0e0;
        color: #333;
    }

    .btn-secondary:hover {
        background: #d0d0d0;
    }

    .btn-danger {
        background: #f44336;
        color: white;
    }

    .btn-danger:hover {
        background: #d32f2f;
    }

    .btn-warning {
        background: var(--warning);
        color: white;
    }

    .btn-warning:hover {
        background: #f57c00;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: var(--success);
    }

    input:checked+.slider:before {
        transform: translateX(30px);
    }

    .status-label {
        margin-left: 10px;
        font-weight: 500;
    }

    .status-active {
        color: var(--success);
    }

    .status-inactive {
        color: #f44336;
    }

    a {
        text-decoration: none;
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
        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-actions {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
    }
</style>

<div class="header">
    <h1><i class="fas fa-user"></i> Editar Usuário</h1>
    <div class="user-info">
        <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
        <span><?php echo $user; ?></span>
    </div>
</div>

<div class="form-container">
    <h2 class="form-title"><i class="fas fa-user-edit"></i> Dados do Usuário</h2>

    <?php echo form_open("usuario/store", ["method" => "POST", "id" => "userForm", "name" => "userForm"]); ?>
    <input type="hidden" name="chave" id="chave" value="<?php echo $chave ?? set_value("chave"); ?>">
    <div class="form-row">
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input value="<?php echo $data["nome"] ?? set_value("nome"); ?>" type="text" id="nome" name="nome" value="João da Silva" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input value="<?php echo $data["email"] ?? set_value("email"); ?>" type="email" id="email" name="email" value="joao.silva@ifpa.edu.br" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input value="<?php echo $data["telefone"] ?? set_value("telefone"); ?>" type="tel" id="telefone" name="telefone" value="(91) 99999-9999">
        </div>
        <div class="form-group">
            <?php $optionSetor = [
                "" => "Selecione",
                "TI" => "TI",
                "Secretaria" => "Secretaria",
                "Estágio" => "Estágio",
                "Direção" => "Direção",
            ];

            ?>
            <label for="setor">Setor</label>
            <?php echo form_dropdown("setor", $optionSetor, $data["setor"] ??  set_value("setor"), ["id" => "setor", "name" => "setor", "required"]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <?php $optionNivel = [
            "" => "Selecione",
            "admin" => "Administrador",
            "colab" => "Colaborador",
        ];

        ?>
        <label for="setor">Nível</label>
        <?php echo form_dropdown("nivel", $optionNivel, $data["nivel"] ??  set_value("nivel"), ["id" => "nivel", "name" => "nivel", "required"]);
        ?>
    </div>
    <div class="form-group">
        <label>Status do Acesso</label>
        <div style="display: flex; align-items: center; margin-top: 10px;">
            <label class="toggle-switch">
                <input type="checkbox" id="acesso" name="acesso" <?php echo $data["status"] == "A" ? "checked" : ""; ?>>
                <span class="slider"></span>
            </label>
            <span id="statusLabel" class="status-label <?php echo $data["status"] == "A" ? "checked" : ""; ?> <?php echo $data["status"] == "A" ? "status-active" : "status-inactive"; ?>"><?php echo $data["status"] == "A" ? "Acesso Liberado" : "Acesso Bloqueado"; ?></span>
        </div>
    </div>


    <div class="form-actions">
        <div>
            <button type="button" class="btn btn-warning" id="resetPassword">
                <i class="fas fa-key"></i> Redefinir Senha
            </button>
        </div>

        <div style="display: flex; gap: 10px;">
            <a href="<?php echo base_url("usuario"); ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salvar Alterações
            </button>
        </div>
    </div>
    <?php form_close(); ?>
</div>
</main>

<script>

</script>
<script src="<?php echo base_url("assets/js/usuario/form.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/api.whatsapp.js"); ?>"></script>
<?php echo $this->endSection('content'); ?>