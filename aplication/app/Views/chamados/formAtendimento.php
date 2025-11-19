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

    .card-apresentacao {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
        margin-bottom: 25px;
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

    /* Estilos para área de upload */
    .file-upload-area {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        background-color: #fafafa;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: var(--primary);
        background-color: #f0f8f0;
    }

    .file-upload-area.dragover {
        border-color: var(--primary);
        background-color: #e8f5e8;
        transform: scale(1.02);
    }

    .upload-content i {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .upload-content p {
        margin: 8px 0;
        color: var(--dark);
    }

    .file-info {
        font-size: 0.85rem;
        color: var(--gray);
    }

    .paste-info {
        font-size: 0.8rem;
        color: var(--primary);
        font-style: italic;
    }

    /* Preview dos arquivos */
    .files-preview {
        margin-top: 15px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }

    .file-preview-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background-color: white;
        position: relative;
        text-align: center;
    }

    .file-preview-item img {
        max-width: 100%;
        max-height: 80px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .file-preview-item .file-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .file-preview-item .file-name {
        font-size: 0.8rem;
        color: var(--dark);
        word-break: break-word;
        margin-bottom: 5px;
    }

    .file-preview-item .file-size {
        font-size: 0.7rem;
        color: var(--gray);
    }

    .file-preview-item .remove-file {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #f44336;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        cursor: pointer;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-preview-item .remove-file:hover {
        background: #d32f2f;
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

    /* Estilos para lista de anexos */
    .anexos-lista {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .anexo-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid var(--primary);
        transition: var(--transition);
    }

    .anexo-item:hover {
        background-color: #e9ecef;
    }

    .anexo-nome {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: var(--dark);
        flex: 1;
    }

    .anexo-nome i {
        color: var(--primary);
        width: 16px;
    }

    .btn-visualizar {
        padding: 6px 12px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.85rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-visualizar:hover {
        background: var(--secondary);
        transform: translateY(-1px);
    }

    .sem-anexos {
        color: var(--gray);
        font-style: italic;
        padding: 10px 0;
    }

    /* Modal de Anexos */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(2px);
    }

    .modal-content {
        background-color: var(--white);
        margin: 5% auto;
        border-radius: 12px;
        width: 90%;
        max-width: 800px;
        max-height: 85vh;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
    }

    .modal-title {
        margin: 0;
        color: var(--dark);
        font-size: 1.3rem;
    }

    .close {
        color: var(--gray);
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition);
        line-height: 1;
    }

    .close:hover {
        color: var(--dark);
        transform: scale(1.1);
    }

    .modal-body {
        padding: 25px;
        max-height: 60vh;
        overflow-y: auto;
        text-align: center;
    }

    .modal-body img {
        max-width: 100%;
        max-height: 500px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-body iframe {
        width: 100%;
        height: 500px;
        border: none;
        border-radius: 8px;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        padding: 20px 25px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
    }

    .arquivo-nao-suportado {
        text-align: center;
        padding: 40px 20px;
        color: var(--gray);
    }

    .arquivo-nao-suportado i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: var(--warning);
    }

    /* Responsivo para modal */
    @media (max-width: 768px) {
        .modal-content {
            width: 95%;
            margin: 10% auto;
            max-height: 80vh;
        }

        .anexo-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .btn-visualizar {
            align-self: flex-end;
        }
    }
</style>

<!-- Main Content -->
<div class="header">
    <h1>Atender Chamado</h1>
    <div class="user-info">
        <div class="user-avatar"><?php echo primeiraLetraNome($user); ?></div>
        <span><?php echo $user; ?></span>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("/home"); ?>">Início</a></li>
        <li><a href="<?php echo base_url("/chamados"); ?>">Chamados</a></li>
        <li class="active" aria-current="page">Atender Chamado</li>
    </ol>
</nav>

<div class="form-container">
    <h2 class="form-title"><i class="fas fa-user-cog"></i> Detalhes do Atendimento</h2>
    <div class="card-apresentacao">
        <table width="100%">
            <tr>
                <td style="text-align: left;" width="5%"><strong>Solicitante:</strong></td>
                <td style="text-align: left;" width="40%"><?php echo $dados["solicitante"]; ?></td>
                <td width="20%"><strong>Telefone:</strong></td>
                <td width="20%"><?php echo $dados["telefone"]; ?></td>
            </tr>
            <tr>
                <td style="text-align: left;" width="5%"><strong>Local:</strong></td>
                <td style="text-align: left;" width="40%"><?php echo $dados["setor"]; ?></td>
                <td style="text-align: left;" width="5%"><strong>Categoria:</strong></td>
                <td style="text-align: left;" width="40%"><?php echo $dados["categoria"]; ?></td>
            </tr>
            <tr>
                <td style="text-align: left;" width="5%"><strong>Detalhes:</strong></td>
                <td colspan="3" style="text-align: left;" width="40%"><?php echo $dados["observacao"]; ?></td>
            </tr>
            <tr>
                <td style="text-align: left;" width="5%"><strong>Anexos:</strong></td>
                <td colspan="3" style="text-align: left;" width="40%">
                    <?php if (!empty($anexos) && is_array($anexos)): ?>
                        <div class="anexos-lista">
                            <?php foreach ($anexos as $index => $anexo): ?>
                                <div class="anexo-item">
                                    <span class="anexo-nome">
                                        <i class="fas <?= strpos($anexo['typeMine'], 'image') !== false ? 'fa-image' : (strpos($anexo['typeMine'], 'pdf') !== false ? 'fa-file-pdf' : 'fa-file') ?>"></i>
                                        <?= htmlspecialchars($anexo['nome']) ?>
                                    </span>
                                    <button type="button" class="btn-visualizar" onclick="abrirModalAnexo('<?= base_url('assets/uploads/' . $anexo['nome']) ?>', '<?= htmlspecialchars($anexo['nome']) ?>', '<?= $anexo['typeMine'] ?>')">
                                        <i class="fas fa-eye"></i> Visualizar
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <span class="sem-anexos">Nenhum anexo encontrado</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;" width="5%"><strong>Histórico de Atendimento:</strong></td>
                <!-- Accordion com histórico de atendimentos -->
                <td colspan="3" style="text-align: left;" width="40%">
                    <div class="accordion" id="atendimentoAccordion">
                        <!-- Item do Accordion -->
                        <div class="card">
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#atendimentoAccordion">
                                <div class="card-body">
                                    <!-- Detalhes do atendimento inicial -->
                                    <?php
                                    foreach ($dados["historico"] as $item) {
                                        echo "<p><strong>{$item["operacao"]}:</strong> {$item["descricao"]} <em>({$item["atendente"]}, " . toDataBR($item["registro"]) . ")</em></p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Outros itens do Accordion -->
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <?php echo form_open_multipart("chamados/registrarAtendimento", ["method" => "POST", "id" => "editChamadoForm"]); ?>
    <input type="text" name="chave" id="chave" hidden value="<?php echo !empty($chave) ? $chave : ''; ?>">

    <!-- Campo: Status do chamado -->
    <div class="form-group">
        <label for="status">Status do Chamado:</label>
        <select name="status" id="status" class="form-control" required>
            <option value="E">Em Atendimento</option>
            <option value="C">Atendimento Finalizado</option>
            <option value="B">Devolver Chamado</option>
            <option value="F">Aguadando Confirmação</option>
        </select>
        <div class="error-message" id="statusError"></div>
    </div>

    <!-- Campo: Observações adicionais -->
    <div class="form-group">
        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" id="observacoes" class="form-control"></textarea>
        <div class="error-message" id="observacoesError"></div>
    </div>

    <div class="form-group">
        <label for="anexo">Anexos (opcional):</label>
        <div class="file-upload-area" id="fileUploadArea">
            <div class="upload-content">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Arraste arquivos aqui ou clique para selecionar</p>
                <p class="file-info">Formatos aceitos: JPG, PNG, PDF. Tamanho máximo: 5MB por arquivo</p>
                <p class="paste-info">Você também pode colar imagens diretamente (Ctrl+V)</p>
            </div>
            <input type="file" name="anexo[]" id="anexo" class="form-control file-input" accept=".jpg,.jpeg,.png,.pdf" multiple style="display: none;">
        </div>
        <div class="files-preview" id="filesPreview"></div>
        <div class="error-message" id="anexoError"></div>
    </div>
    <!-- Botões de ação -->
    <div class="button-group">
        <button type="button" id="btnSalvar" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Alterações</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo base_url("/chamados"); ?>'">
            <i class="fas fa-times"></i> Cancelar
        </button>

    </div>
    <?php echo form_close(); ?>
</div>

<!-- Modal de Anexos -->
<div id="modalAnexo" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modalAnexoTitulo">Visualizar Anexo</h3>
            <span class="close" onclick="fecharModalAnexo()">&times;</span>
        </div>
        <div class="modal-body">
            <div id="modalAnexoConteudo">
                <!-- Conteúdo do anexo será inserido aqui -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="fecharModalAnexo()">
                <i class="fas fa-times"></i> Fechar
            </button>
            <a id="modalAnexoDownload" href="#" target="_blank" class="btn btn-primary">
                <i class="fas fa-download"></i> Baixar
            </a>
        </div>
    </div>
</div>
</main>
<script>
    // Array para armazenar arquivos selecionados
    let selectedFiles = [];

    /**
     * Valida o formulário antes do envio
     * @returns {boolean} true se válido, false caso contrário
     */
    function validarFormulario() {
        let isValid = true;

        // Validar descrição
        const observacoes = document.getElementById("observacoes");
        if (!observacoes.value.trim()) {
            mostrarErro('As observações são obrigatórias', 'observacoesError', 'As observações são obrigatórias');
            isValid = false;
        } else {
            ocultarErro('observacoesError');
        }

        // Validar anexos
        if (!validarAnexos()) {
            isValid = false;
        }

        return isValid;
    }

    /**
     * Mostra mensagem de erro
     * @param {string} titulo - Título do alerta
     * @param {string} elementoId - ID do elemento de erro
     * @param {string} mensagem - Mensagem de erro
     */
    function mostrarErro(titulo, elementoId, mensagem) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: titulo,
            showConfirmButton: false,
            timer: 1500,
            toast: true,
            background: '#f8f9fa',
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        const errorElement = document.getElementById(elementoId);
        if (errorElement) {
            errorElement.textContent = mensagem;
            errorElement.style.display = 'block';
        }
    }

    /**
     * Oculta mensagem de erro
     * @param {string} elementoId - ID do elemento de erro
     */
    function ocultarErro(elementoId) {
        const errorElement = document.getElementById(elementoId);
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }

    /**
     * Valida os arquivos anexados
     * @returns {boolean} true se válidos, false caso contrário
     */
    function validarAnexos() {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];

        for (let i = 0; i < selectedFiles.length; i++) {
            const file = selectedFiles[i];

            if (file.size > maxSize) {
                mostrarErro(`O arquivo ${file.name} excede o tamanho máximo de 5MB`, 'anexoError',
                    `O arquivo ${file.name} excede o tamanho máximo de 5MB`);
                return false;
            }

            if (!allowedTypes.includes(file.type)) {
                mostrarErro(`O arquivo ${file.name} não é de um tipo permitido`, 'anexoError',
                    `O arquivo ${file.name} não é de um tipo permitido. Apenas JPG, PNG e PDF são aceitos`);
                return false;
            }
        }

        ocultarErro('anexoError');
        return true;
    }

    /**
     * Formata o tamanho do arquivo para exibição
     * @param {number} bytes - Tamanho em bytes
     * @returns {string} Tamanho formatado
     */
    function formatarTamanhoArquivo(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    /**
     * Adiciona arquivo à lista de selecionados
     * @param {File} file - Arquivo a ser adicionado
     */
    function adicionarArquivo(file) {
        // Verificar se o arquivo já foi adicionado
        const jaExiste = selectedFiles.some(f => f.name === file.name && f.size === file.size);
        if (jaExiste) {
            mostrarErro('Arquivo já foi adicionado', 'anexoError', 'Este arquivo já foi selecionado');
            return;
        }

        selectedFiles.push(file);
        atualizarPreviewArquivos();
        atualizarInputFile();
    }

    /**
     * Remove arquivo da lista de selecionados
     * @param {number} index - Índice do arquivo a ser removido
     */
    function removerArquivo(index) {
        selectedFiles.splice(index, 1);
        atualizarPreviewArquivos();
        atualizarInputFile();
    }

    /**
     * Atualiza o preview dos arquivos selecionados
     */
    function atualizarPreviewArquivos() {
        const preview = document.getElementById('filesPreview');
        preview.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'file-preview-item';

            let conteudo = '';
            if (file.type.startsWith('image/')) {
                const url = URL.createObjectURL(file);
                conteudo = `<img src="${url}" alt="${file.name}" onload="URL.revokeObjectURL(this.src)">`;
            } else {
                conteudo = '<div class="file-icon"><i class="fas fa-file-pdf"></i></div>';
            }

            item.innerHTML = `
        ${conteudo}
        <div class="file-name">${file.name}</div>
        <div class="file-size">${formatarTamanhoArquivo(file.size)}</div>
        <button type="button" class="remove-file" onclick="removerArquivo(${index})" title="Remover arquivo">
          <i class="fas fa-times"></i>
        </button>
      `;

            preview.appendChild(item);
        });
    }

    /**
     * Atualiza o input file com os arquivos selecionados
     */
    function atualizarInputFile() {
        const input = document.getElementById('anexo');
        const dt = new DataTransfer();

        selectedFiles.forEach(file => {
            dt.items.add(file);
        });

        input.files = dt.files;
    }

    /**
     * Processa arquivos selecionados
     * @param {FileList} files - Lista de arquivos
     */
    function processarArquivos(files) {
        Array.from(files).forEach(file => {
            if (validarArquivoIndividual(file)) {
                adicionarArquivo(file);
            }
        });
    }

    /**
     * Valida um arquivo individual
     * @param {File} file - Arquivo a ser validado
     * @returns {boolean} true se válido
     */
    function validarArquivoIndividual(file) {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];

        if (file.size > maxSize) {
            mostrarErro(`Arquivo muito grande`, 'anexoError', `O arquivo ${file.name} excede o tamanho máximo de 5MB`);
            return false;
        }

        if (!allowedTypes.includes(file.type)) {
            mostrarErro(`Tipo não permitido`, 'anexoError', `O arquivo ${file.name} não é de um tipo permitido. Apenas JPG, PNG e PDF são aceitos`);
            return false;
        }

        return true;
    }

    // Inicialização quando o DOM estiver carregado
    document.addEventListener('DOMContentLoaded', function() {
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('anexo');

        // Click na área de upload
        fileUploadArea.addEventListener('click', function() {
            fileInput.click();
        });

        // Mudança no input file
        fileInput.addEventListener('change', function(e) {
            processarArquivos(e.target.files);
        });

        // Drag and Drop
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            processarArquivos(e.dataTransfer.files);
        });

        // Paste de imagens
        document.addEventListener('paste', function(e) {
            const items = e.clipboardData.items;

            for (let i = 0; i < items.length; i++) {
                const item = items[i];

                if (item.type.indexOf('image') !== -1) {
                    e.preventDefault();
                    const file = item.getAsFile();

                    // Criar nome para o arquivo colado
                    const timestamp = new Date().getTime();
                    const extension = file.type.split('/')[1];
                    const newFile = new File([file], `print_${timestamp}.${extension}`, {
                        type: file.type,
                        lastModified: Date.now()
                    });

                    if (validarArquivoIndividual(newFile)) {
                        adicionarArquivo(newFile);

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Imagem colada com sucesso!',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            background: '#f8f9fa',
                            timerProgressBar: true
                        });
                    }
                    break;
                }
            }
        });
    });

    const btnSalvar = document.getElementById("btnSalvar");
    if (btnSalvar) {
        btnSalvar.addEventListener("click", function(e) {
            e.preventDefault();
            if (validarFormulario()) {
                const editChamadoForm = document.getElementById("editChamadoForm");
                editChamadoForm.submit();
            }
        });
    }

    /**
     * Abre o modal para visualização de anexos
     * @param {string} url - URL do arquivo
     * @param {string} nome - Nome do arquivo
     * @param {string} tipo - Tipo MIME do arquivo
     */
    function abrirModalAnexo(url, nome, tipo) {
        const modal = document.getElementById('modalAnexo');
        const titulo = document.getElementById('modalAnexoTitulo');
        const conteudo = document.getElementById('modalAnexoConteudo');
        const downloadLink = document.getElementById('modalAnexoDownload');

        // Definir título do modal
        titulo.textContent = nome;

        // Configurar link de download
        downloadLink.href = url;
        downloadLink.download = nome;

        // Limpar conteúdo anterior
        conteudo.innerHTML = '';

        // Verificar tipo de arquivo e exibir adequadamente
        if (tipo.startsWith('image/')) {
            // Para imagens
            const img = document.createElement('img');
            img.src = url;
            img.alt = nome;
            img.style.maxWidth = '100%';
            img.style.height = 'auto';

            img.onerror = function() {
                conteudo.innerHTML = `
                    <div class="arquivo-nao-suportado">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h4>Erro ao carregar imagem</h4>
                        <p>Não foi possível carregar a imagem. Tente fazer o download do arquivo.</p>
                    </div>
                `;
            };

            conteudo.appendChild(img);
        } else if (tipo === 'application/pdf') {
            // Para PDFs
            const iframe = document.createElement('iframe');
            iframe.src = url;
            iframe.style.width = '100%';
            iframe.style.height = '500px';
            iframe.style.border = 'none';
            iframe.style.borderRadius = '8px';

            iframe.onerror = function() {
                conteudo.innerHTML = `
                    <div class="arquivo-nao-suportado">
                        <i class="fas fa-file-pdf"></i>
                        <h4>Visualização não disponível</h4>
                        <p>Não foi possível exibir o PDF no navegador. Clique em "Baixar" para visualizar o arquivo.</p>
                    </div>
                `;
            };

            conteudo.appendChild(iframe);
        } else {
            // Para outros tipos de arquivo
            conteudo.innerHTML = `
                <div class="arquivo-nao-suportado">
                    <i class="fas fa-file"></i>
                    <h4>Visualização não disponível</h4>
                    <p>Este tipo de arquivo não pode ser visualizado diretamente no navegador.</p>
                    <p>Clique em "Baixar" para fazer o download do arquivo.</p>
                    <p><strong>Tipo:</strong> ${tipo}</p>
                </div>
            `;
        }

        // Exibir modal
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll da página
    }

    /**
     * Fecha o modal de anexos
     */
    function fecharModalAnexo() {
        const modal = document.getElementById('modalAnexo');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll da página
    }

    // Fechar modal ao clicar fora dele
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('modalAnexo');
        if (event.target === modal) {
            fecharModalAnexo();
        }
    });

    // Fechar modal com a tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('modalAnexo');
            if (modal.style.display === 'block') {
                fecharModalAnexo();
            }
        }
    });
</script>

<?php echo $this->endSection('content'); ?>