<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<script>
    const base_url = "<?= base_url() ?>";
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    /* Breadcrumb */
    .breadcrumb {
        list-style: none;
        display: flex;
        padding: 8px 16px;
        background-color: var(--light);
        border-radius: 8px;
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
        color: var(--gray);
    }

    .breadcrumb a {
        text-decoration: none;
        color: var(--primary);
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb .active {
        color: var(--gray);
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
    select,
    textarea {
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
    select:focus,
    textarea:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    /* Button Group */
    .button-group {
        display: flex;
        gap: 15px;
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

    /* Error messages */
    .error-message {
        color: #f44336;
        font-size: 0.85rem;
        margin-top: 5px;
        display: none;
    }

    .file-input {
        margin-top: 5px;
    }

    .file-note {
        display: block;
        margin-top: 5px;
        color: var(--gray);
        font-size: 0.85rem;
    }

    /* Anexos existentes */
    .existing-attachments {
        margin-top: 25px;
    }

    .attachments-title {
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .attachment-item {
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border-left: 3px solid var(--primary);
        margin-bottom: 15px;
    }

    .attachment-name {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .attachment-preview {
        margin-top: 10px;
    }

    .attachment-preview img {
        max-width: 100%;
        max-height: 150px;
        border-radius: 4px;
    }

    .attachment-link {
        display: inline-block;
        margin-top: 10px;
        padding: 6px 12px;
        background-color: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.85rem;
        transition: var(--transition);
    }

    .attachment-link:hover {
        background-color: var(--secondary);
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

        .button-group {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
    }
</style>

<!-- Main Content -->
<div class="header">
    <h1>Atribuir Chamado</h1>
    <div class="user-info">
        <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
        <span><?php echo $user; ?></span>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("/home"); ?>">Início</a></li>
        <li><a href="<?php echo base_url("/chamados"); ?>">Chamados</a></li>
        <li class="active" aria-current="page">Atribuir Chamado</li>
    </ol>
</nav>

<div class="form-container">
    <h2 class="form-title"><i class="fas fa-user-cog"></i> Detalhes do Chamado</h2>

    <?php echo form_open_multipart("chamados/atribuirChamado", ["method" => "POST", "id" => "editChamadoForm"]); ?>
    <input type="text" name="chave" id="chave" hidden value="<?php echo !empty($chave) ? $chave : ''; ?>">

    <!-- Campo: Status do chamado -->
    <div class="form-group">
        <label for="usuario">Responsável pelo Atendimento:</label>
        <select name="usuario" id="usuario" class="form-control" required>
            <option value="">Selecione um usuário</option>
        </select>
        <div class="error-message" id="usuarioError"></div>
    </div>

    <!-- Campo: Observações adicionais -->
    <div class="form-group">
        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" id="observacoes" class="form-control"></textarea>
        <div class="error-message" id="observacoesError"></div>
    </div>

    <!-- Botões de ação -->
    <div class="button-group">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Alterações</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo base_url("/chamados"); ?>'">
            <i class="fas fa-times"></i> Cancelar
        </button>

    </div>
    <?php echo form_close(); ?>
</div>
</main>

<script>
    async function obterUsuarios() {
        fetch(base_url + "usuario/obterUsuarios")
            .then(response => response.json())
            .then(data => {
                const usuariosSelect = document.getElementById('usuario');
                usuariosSelect.innerHTML = '';
                const optionSelect = document.createElement('option');
                optionSelect.value = "";
                optionSelect.textContent = "Selecione um atendente";
                usuariosSelect.appendChild(optionSelect);
                data.forEach(usuario => {
                    const option = document.createElement('option');
                    option.value = usuario.id;
                    option.textContent = usuario.nome + " - " + usuario.funcao;
                    usuariosSelect.appendChild(option);

                });
            })
            .catch(error => console.error('Erro ao obter usuários:', error));
    }

    async function carregarUsuarios() {
        await obterUsuarios();
    }
    //carregar apos inializar o DOM
    document.addEventListener('DOMContentLoaded', function() {
        carregarUsuarios();
        // Validação do formulário
        document.getElementById('editChamadoForm').addEventListener('submit', function(e) {
            let isValid = true;

            // Validar observações (se status for "Concluído")
            const usuario = document.getElementById('usuario');
            if (!usuario.value.trim()) {

                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'O resposável pelo atendimento é obrigatório',
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


                document.getElementById('usuarioError').textContent = 'O resposável pelo atendimento é obrigatório';
                document.getElementById('usuarioError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('usuarioError').style.display = 'none';
            }
            if (!observacoes.value.trim()) {

                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Observações são obrigatórias',
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


                document.getElementById('observacoesError').textContent = 'Observações são obrigatórias';
                document.getElementById('observacoesError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('observacoesError').style.display = 'none';
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>

<?php echo $this->endSection('content'); ?>