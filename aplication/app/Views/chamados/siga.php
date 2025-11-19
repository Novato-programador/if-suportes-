<?php echo $this->extend('_common/layout'); ?>
<?php echo $this->section('content'); ?>
<script>
    const base_url = "<?php echo base_url(); ?>";
    const chave = "<?= $chave ?>";
</script>
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        text-align: center;
        margin-bottom: 40px;
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 2.2rem;
    }

    .description {
        color: #7f8c8d;
        font-size: 1.1rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .process-wrapper {
        margin: auto;
        max-width: 1080px;
    }

    #progress-bar-container {
        position: relative;
        width: 90%;
        margin: 50px auto;
        height: 100px;
    }

    #progress-bar-container ul {
        padding: 0;
        margin: 0;
        padding-top: 15px;
        z-index: 9999;
        position: absolute;
        width: 100%;
        margin-top: -40px;
    }

    #progress-bar-container li:before {
        content: " ";
        display: block;
        margin: 0 auto;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        border: solid 2px #aaa;
        transition: all ease 0.3s;
    }

    #progress-bar-container li.active:before,
    #progress-bar-container li:hover:before {
        border: solid 2px #fff;
        background: #3498db;
    }

    #progress-bar-container li {
        list-style: none;
        float: left;
        width: 33.33%;
        text-align: center;
        color: #aaa;
        text-transform: uppercase;
        font-size: 11px;
        cursor: pointer;
        font-weight: 700;
        transition: all ease 0.2s;
        vertical-align: bottom;
        height: 60px;
        position: relative;
    }

    #progress-bar-container li .step-inner {
        position: absolute;
        width: 100%;
        bottom: 0;
        font-size: 14px;
    }

    #progress-bar-container li.active,
    #progress-bar-container li:hover {
        color: #444;
    }

    #progress-bar-container li:after {
        content: " ";
        display: block;
        width: 6px;
        height: 6px;
        background: #777;
        margin: 0 auto;
        border: solid 7px #fff;
        border-radius: 50%;
        margin-top: 40px;
        box-shadow: 0 2px 13px -1px rgba(0, 0, 0, 0.3);
        transition: all ease 0.2s;
    }

    #progress-bar-container li:hover:after {
        background: #555;
    }

    #progress-bar-container li.active:after {
        background: #3498db;
    }

    #progress-bar-container #line {
        width: 80%;
        margin: auto;
        background: #eee;
        height: 6px;
        position: absolute;
        left: 10%;
        top: 57px;
        z-index: 1;
        border-radius: 50px;
        transition: all ease 0.9s;
    }

    #progress-bar-container #line-progress {
        content: " ";
        width: 3%;
        height: 100%;
        background: #3498db;
        position: absolute;
        z-index: 2;
        border-radius: 50px;
        transition: all ease 0.9s;
    }

    #progress-content-section {
        width: 90%;
        margin: auto;
        background: #f3f3f3;
        border-radius: 10px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }

    #progress-content-section .section-content {
        padding: 30px 40px;
        text-align: center;
    }

    #progress-content-section .section-content h2 {
        color: #3498db;
        margin-bottom: 20px;
    }

    #progress-content-section .section-content p {
        color: #555;
        margin-bottom: 20px;
        line-height: 1.8;
    }

    .chamado-info {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        text-align: left;
    }

    .chamado-info h3 {
        color: #2c3e50;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }

    .info-item {
        margin-bottom: 10px;
    }

    .info-item strong {
        color: #7f8c8d;
        display: block;
        font-size: 0.9rem;
    }

    .info-item span {
        color: #2c3e50;
        font-weight: 500;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background: #3498db;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        margin: 10px 5px;
        transition: all 0.3s ease;
    }

    .btn:hover {
        background: #2980b9;
        transform: translateY(-2px);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #3498db;
        color: #3498db;
    }

    .btn-outline:hover {
        background: #3498db;
        color: white;
    }

    .section-content {
        display: none;
        animation: FadeInUp 0.7s ease;
    }

    .section-content.active {
        display: block;
    }

    @keyframes FadeInUp {
        0% {
            transform: translateY(15px);
            opacity: 0;
        }

        100% {
            transform: translateY(0px);
            opacity: 1;
        }
    }

    .status-badge {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        margin: 5px 0;
    }

    .status-aberto {
        background: #ffe6e6;
        color: #e74c3c;
    }

    .status-andamento {
        background: #fff4e6;
        color: #f39c12;
    }

    .status-concluido {
        background: #e6f7ee;
        color: #27ae60;
    }

    .action-buttons {
        margin-top: 25px;
    }

    @media screen and (max-width: 768px) {
        #progress-bar-container {
            height: 130px;
        }

        #progress-bar-container li {
            font-size: 10px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Modal Comentário: estilos seguindo o padrão do layout */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        /* inicial oculto */
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal {
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        width: 90%;
        max-width: 600px;
        overflow: hidden;
        animation: FadeInUp 0.3s ease;
    }

    .modal-header {
        padding: 16px 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .modal-header h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-body label {
        display: block;
        margin-bottom: 8px;
        color: #7f8c8d;
        font-weight: 600;
    }

    .modal-body textarea {
        width: 100%;
        min-height: 140px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 1rem;
        resize: vertical;
        outline: none;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 12px 20px 20px 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
    }
</style>
<div class="container">
    <header>
        <h1>Acompanhamento de Chamados</h1>
        <p class="description">Acompanhe o status do seu chamado em tempo real. Visualize todas as etapas do processo desde a abertura até a conclusão.</p>
    </header>

    <div class="process-wrapper">
        <div id="progress-bar-container">
            <ul>
                <li class="step step01 active">
                    <div id="step01" class="step-inner">CHAMADO ABERTO</div>
                </li>
                <li class="step step02">
                    <div id="step02" class="step-inner">CHAMADO EM ANDAMENTO</div>
                </li>
                <li class="step step03">
                    <div id="step03" class="step-inner">CHAMADO FINALIZADO</div>
                </li>
            </ul>

            <div id="line">
                <div id="line-progress"></div>
            </div>
        </div>

        <div id="progress-content-section">
            <div class="section-content aberto active">
                <h2 id="step01-content">Chamado Aberto <span class="status-badge status-aberto" id="chamado-status-aberto">Aberto</span></h2>
                <p>Seu chamado foi registrado em nosso sistema e está aguardando análise de nossa equipe.</p>

                <div class="chamado-info">
                    <h3>Informações do Chamado</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <strong>Número do Chamado</strong>
                            <span id="chamado-numero"></span>
                        </div>
                        <div class="info-item">
                            <strong>Data de Abertura</strong>
                            <span id="chamado-data-abertura"></span>
                        </div>
                        <div class="info-item">
                            <strong>Categoria</strong>
                            <span id="chamado-categoria"></span>
                        </div>
                        <div class="info-item">
                            <strong>Solicitante</strong>
                            <span id="chamado-solicitante"></span>
                        </div>
                    </div>
                </div>

                <div class="chamado-info">
                    <h3>Descrição do Problema</h3>
                    <p id="chamado-problema"></p>
                </div>

                <div class="action-buttons">
                    <a href="#" id="btn-editar-chamado" class="btn">Editar Chamado</a>
                    <a href="#" id="btn-cancelar-chamado" class="btn btn-outline">Cancelar Chamado</a>
                </div>
            </div>

            <div class="section-content andamento">
                <h2>Chamado em Andamento <span class="status-badge status-andamento" id="chamado-status-andamento"></span></h2>
                <p>Seu chamado está sendo analisado por nosso técnico. Acompanhe abaixo as atualizações.</p>

                <div class="chamado-info">
                    <h3>Informações do Chamado</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <strong>Número do Chamado</strong>
                            <span id="chamado-numero-andamento"></span>
                        </div>
                        <div class="info-item">
                            <strong>Data de Abertura</strong>
                            <span id="chamado-data-abertura-andamento"></span>
                        </div>
                        <div class="info-item">
                            <strong>Técnico Responsável</strong>
                            <span id="chamado-tecnico-andamento"></span>
                        </div>
                        <div class="info-item">
                            <strong>Início do Atendimento</strong>
                            <span id="chamado-data-inicio-atendimento-andamento"></span>
                        </div>
                        <div class="info-item">
                            <strong>Ultima Atualização</strong>
                            <span id="chamado-data-ultima-atualizacao-andamento"></span>
                        </div>
                    </div>
                </div>

                <div class="chamado-info">
                    <h3>Atualizações</h3>
                    <div id="chamado-historico-andamento"></div>
                </div>

                <div class="action-buttons">
                    <button id="btn-adicionar-comentario" class="btn">Adicionar Comentário</button>
                </div>
            </div>

            <div class="section-content concluido">
                <h2>Chamado Concluído <span class="status-badge status-concluido">Concluído</span></h2>
                <p>Seu chamado foi resolvido e finalizado. Avalie o atendimento recebido.</p>

                <div class="chamado-info">
                    <h3>Informações do Chamado</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <strong>Número do Chamado</strong>
                            <span id="chamado-numero-concluido"></span>
                        </div>
                        <div class="info-item">
                            <strong>Data de Abertura</strong>
                            <span id="chamado-data-abertura-concluido"></span>
                        </div>
                        <div class="info-item">
                            <strong>Data de Conclusão</strong>
                            <span id="chamado-data-conclusao-concluido"></span>
                        </div>
                        <div class="info-item">
                            <strong>Técnico Responsável</strong>
                            <span id="chamado-tecnico-concluido"></span>
                        </div>
                        <div class="info-item">
                            <strong>Tempo de Resolução</strong>
                            <span id="chamado-tempo-resolucao-concluido"></span>
                        </div>
                        <div class="info-item">
                            <strong>Avaliação</strong>
                            <span id="chamado-avaliacao-concluido"></span>
                        </div>
                    </div>
                </div>

                <div class="chamado-info">
                    <h3>Solução Aplicada</h3>
                    <p id="chamado-solucao-concluido"></p>
                </div>

                <div class="chamado-info" id="chamado-buttons-avaliacao">
                    <h3>Avalie o Atendimento</h3>
                    <p>Como foi seu atendimento? Sua opinião é importante para melhorarmos nossos serviços.</p>
                    <div class="action-buttons">
                        <button type="button" id="btn-excelente" class="btn">Excelente</button>
                        <button type="button" id="btn-bom" class="btn">Bom</button>
                        <button type="button" id="btn-regular" class="btn">Regular</button>
                        <button type="button" id="btn-ruim" class="btn">Ruim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Comentário: estrutura do modal -->
<div id="modal-comentario-overlay" class="modal-overlay" aria-hidden="true">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-comentario-title">
        <div class="modal-header">
            <h3 id="modal-comentario-title">Adicionar Comentário</h3>
        </div>
        <div class="modal-body">
            <label for="textarea-comentario">Comentário</label>
            <textarea id="textarea-comentario" placeholder="Digite seu comentário..."></textarea>
        </div>
        <div class="modal-actions">
            <button type="button" id="btn-gravar-comentario" class="btn">Gravar</button>
            <button type="button" id="btn-cancelar-comentario" class="btn btn-outline">Cancelar</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const steps = document.querySelectorAll(".step");
        const progressBar = document.getElementById("line-progress");
        const progressContent = document.querySelectorAll(".section-content");

        steps.forEach((step, index) => {
            step.addEventListener("click", () => {
                // Remove active class from all steps and content
                steps.forEach(s => s.classList.remove("active"));
                progressContent.forEach(c => c.classList.remove("active"));

                // Add active class to clicked step and corresponding content
                step.classList.add("active");
                progressContent[index].classList.add("active");

                // Update progress bar
                progressBar.style.width = (index * 50) + "%";
            });
        });

        const obterDados = async () => {
            const response = await fetch(base_url + 'profile/carregarViewSiga', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    'chave': chave
                })
            });
            if (response.ok) {
                const data = await response.json();
                return data;
            } else {
                throw new Error('Erro ao carregar dados');
            }
        }

        // Função principal assíncrona para executar o código
        const carregarDadosSiga = async () => {
            const chamadoNumeroAndamento = document.getElementById("chamado-numero-andamento");
            const chamadoDataAberturaAndamento = document.getElementById("chamado-data-abertura-andamento");
            const chamadoTecnicoAndamento = document.getElementById("chamado-tecnico-andamento");
            const chamadoHistoricoAndamento = document.getElementById("chamado-historico-andamento");
            const chamadoDataUltimaAtualizacao = document.getElementById("chamado-data-ultima-atualizacao-andamento");
            const chamadoDataInicioAtendimento = document.getElementById("chamado-data-inicio-atendimento-andamento");


            const chamadoNumeroConcluido = document.getElementById("chamado-numero-concluido");
            const chamadoDataAberturaConcluido = document.getElementById("chamado-data-abertura-concluido");
            const chamadoDataConclusaoConcluido = document.getElementById("chamado-data-conclusao-concluido");
            const chamadoTecnicoConcluido = document.getElementById("chamado-tecnico-concluido");
            const chamadoTempoResolucaoConcluido = document.getElementById("chamado-tempo-resolucao-concluido");
            const chamadoAvaliacaoConcluido = document.getElementById("chamado-avaliacao-concluido");
            const chamadoSolucaoConcluido = document.getElementById("chamado-solucao-concluido");
            const buttonsAvaliacao = document.getElementById("chamado-buttons-avaliacao");


            const chamadoNumero = document.getElementById("chamado-numero");
            const chamadoDataAbertura = document.getElementById("chamado-data-abertura");
            const chamadoCategoria = document.getElementById("chamado-categoria");
            const chamadoSolicitante = document.getElementById("chamado-solicitante");
            const chamadoProblema = document.getElementById("chamado-problema");
            try {

                const data = await obterDados();
                if (data.success == true) {
                    const dadosResponse = data.data;
                    const chamado = dadosResponse.chamado;
                    if (chamado.numero && chamadoNumero) {
                        chamadoNumero.innerText = chamado.numero;
                    }

                    if (chamado.registro && chamadoDataAbertura) {
                        chamadoDataAbertura.innerText = convertDataToBR(chamado.registro) ?? "";
                        // chamadoDataAbertura.innerText = chamado.registro;
                    }
                    if (chamado.tipo && chamadoCategoria) {
                        chamadoCategoria.innerText = chamado.tipo;
                    }
                    if (chamado.solicitante && chamadoSolicitante) {
                        chamadoSolicitante.innerText = chamado.solicitante;
                    }
                    if (chamado.observacao && chamadoProblema) {
                        chamadoProblema.innerText = chamado.observacao;
                    }
                    //Form Andamento
                    if (chamado.numero && chamadoNumeroAndamento) {
                        chamadoNumeroAndamento.innerText = chamado.numero;
                    }
                    if (chamado.registro && chamadoDataAberturaAndamento) {
                        chamadoDataAberturaAndamento.innerText = convertDataToBR(chamado.registro) ?? "";
                    }
                    if (chamado.tecnico && chamadoTecnicoAndamento) {
                        chamadoTecnicoAndamento.innerText = chamado.tecnico;
                    }
                    if (chamado.dataUltimaAtualizacao && chamadoDataUltimaAtualizacao) {
                        chamadoDataUltimaAtualizacao.innerText = convertDataToBR(chamado.dataUltimaAtualizacao) ?? "";
                    }
                    if (chamado.dataInicioAtendimento && chamadoDataInicioAtendimento) {
                        chamadoDataInicioAtendimento.innerText = convertDataToBR(chamado.dataInicioAtendimento) ?? "";
                    }
                    if (chamado.historico && chamadoHistoricoAndamento) {
                        chamadoHistoricoAndamento.innerHTML = "";
                        for (const item of chamado.historico) {
                            chamadoHistoricoAndamento.innerHTML += `<div class="info-item">
                                 <strong>${convertDataToBR(item.registro)??""} - ${item.atendente}</strong>
                                 <p>${item.descricao}</p>
                             </div>`;

                        }
                    }
                    //Formulario concluido
                    if (chamado.numero && chamadoNumeroConcluido) {
                        chamadoNumeroConcluido.innerText = chamado.numero;
                    }
                    if (chamado.registro && chamadoDataAberturaConcluido) {
                        chamadoDataAberturaConcluido.innerText = convertDataToBR(chamado.registro) ?? "";
                    }
                    if (chamado.tecnico && chamadoTecnicoConcluido) {
                        chamadoTecnicoConcluido.innerText = chamado.tecnico;
                    }
                    if (chamado.solucao && chamadoSolucaoConcluido) {
                        chamadoSolucaoConcluido.innerText = chamado.solucao;
                    }
                    if (chamado.tempoDeResolucao && chamadoTempoResolucaoConcluido) {
                        chamadoTempoResolucaoConcluido.innerText = chamado.tempoDeResolucao;
                    }
                    if (chamadoAvaliacaoConcluido) {
                        chamadoAvaliacaoConcluido.innerText = chamado.avaliacao ? chamado.avaliacao : "Pendente";
                    }
                    if (buttonsAvaliacao) {
                        buttonsAvaliacao.style.display = chamado.avaliacao ? "none" : "block";
                    }

                    if (chamado.status) {
                        switch (chamado.status) {
                            case 'A':
                                document.getElementById("chamado-status-aberto").innerText = "Aberto";
                                document.querySelector(".step01").click();
                                break;
                            case 'B':
                                document.getElementById("chamado-status-aberto").innerText = "Devolvido";
                                document.getElementById("step01").innerText = "CHAMADO DEVOLVIDO";
                                document.querySelector(".step01").click();
                                break;
                            case 'E':
                                document.querySelector(".step02").click();
                                break;
                            case 'F':
                                document.getElementById("step02").innerText = "AGUARDANDO CONFIRMAÇÃO";
                                document.querySelector(".step02").click();
                                break;
                            case 'G':
                                document.getElementById("step02").innerText = "CHAMADO EM ANDAMENTO";
                                document.querySelector(".step02").click();
                                break;
                            case 'C':
                                document.querySelector(".step03").click();
                                break;
                            case 'X':
                                document.getElementById("step01").innerText = "CHAMADO CANCELADO";
                                document.getElementById("chamado-status-aberto").innerText = "Cancelado";
                                document.querySelector(".step01").click();
                                // Ocultar botões de avaliação para chamados cancelados
                                if (buttonsAvaliacao) {
                                    buttonsAvaliacao.style.display = "none";
                                }
                                break;
                            default:
                                break;
                        }

                        // Configurar botões de ação baseado no status
                        configurarBotoesAcao(chamado.status);
                    }

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
        carregarDadosSiga();
        // Função para atualizar dados em tempo real (opcional)
        function iniciarAtualizacaoTempoReal() {
            setInterval(() => {
                // Recarregar dados do dashboard periodicamente
                carregarDadosSiga();
            }, 30000); // Atualizar a cada 30 segundos
        }
        // Iniciar atualização em tempo real
        iniciarAtualizacaoTempoReal();

        const avaliarChamado = () => {
            const btnExcelente = document.getElementById("btn-excelente");
            const btnBom = document.getElementById("btn-bom");
            const btnRegular = document.getElementById("btn-regular");
            const btnRuim = document.getElementById("btn-ruim");
            if (btnExcelente) {
                btnExcelente.addEventListener("click", () => {
                    enviarAvaliacao("Excelente");
                });
            }
            if (btnBom) {
                btnBom.addEventListener("click", () => {
                    enviarAvaliacao("Bom");
                });
            }
            if (btnRegular) {
                btnRegular.addEventListener("click", () => {
                    enviarAvaliacao("Regular");
                });
            }
            if (btnRuim) {
                btnRuim.addEventListener("click", () => {
                    enviarAvaliacao("Ruim");
                });
            }


        }
        avaliarChamado();

        // Função para enviar avaliação (escopo global)
        const enviarAvaliacao = async (avaliacao) => {
            try {
                const response = await fetch(base_url + 'profile/sendAvaliacao', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams({
                        'chave': chave,
                        'avaliacao': avaliacao
                    })
                });
                if (response.ok) {
                    const data = await response.json();
                    // Atualiza a avaliação exibida e desativa os botões para evitar múltiplos envios
                    const avaliacaoSpan = document.getElementById('chamado-avaliacao-concluido');
                    if (avaliacaoSpan) {
                        avaliacaoSpan.textContent = avaliacao;
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Avaliação enviada com sucesso',
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
                    }
                    const buttonsContainer = document.querySelector('#chamado-buttons-avaliacao .action-buttons');
                    if (buttonsContainer) {
                        buttonsContainer.querySelectorAll('button').forEach(btn => {
                            btn.disabled = true;
                            btn.classList.add('disabled');
                        });
                    }
                    const buttonsAvaliacao = document.getElementById("chamado-buttons-avaliacao");
                    if (buttonsAvaliacao) {
                        buttonsAvaliacao.style.display = 'none';
                    }
                    return data;
                } else {
                    throw new Error('Erro ao enviar avaliação');
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Erro ao enviar avaliação. Tente novamente.',
                    confirmButtonText: 'OK'
                });
            }
        };

        // Modal Comentário: lógica de abertura/fechamento e gravação
        const modalOverlay = document.getElementById('modal-comentario-overlay');
        const btnAddComentario = document.getElementById('btn-adicionar-comentario');
        const btnGravarComentario = document.getElementById('btn-gravar-comentario');
        const btnCancelarComentario = document.getElementById('btn-cancelar-comentario');
        const textareaComentario = document.getElementById('textarea-comentario');

        function abrirModalComentario() {
            if (modalOverlay) {
                modalOverlay.style.display = 'flex';
                modalOverlay.setAttribute('aria-hidden', 'false');
            }
        }

        function fecharModalComentario() {
            if (modalOverlay) {
                modalOverlay.style.display = 'none';
                modalOverlay.setAttribute('aria-hidden', 'true');
            }
            if (textareaComentario) {
                textareaComentario.value = '';
            }
        }

        if (btnAddComentario) {
            btnAddComentario.addEventListener('click', function() {
                abrirModalComentario();
            });
        }

        if (btnCancelarComentario) {
            btnCancelarComentario.addEventListener('click', function() {
                fecharModalComentario();
            });
        }

        if (modalOverlay) {
            modalOverlay.addEventListener('click', function(event) {
                if (event.target === modalOverlay) {
                    fecharModalComentario();
                }
            });
        }
        const enviarComentario = async () => {
            try {
                const response = await fetch(base_url + 'profile/sendComentario', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams({
                        'chave': chave,
                        'comentario': textareaComentario.value.trim()
                    })
                });
                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Comentário enviado com sucesso',
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
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                } else {
                    throw new Error('Erro ao enviar comentário');
                }
            } catch (error) {
                console.error(error);
            }
        }
        if (btnGravarComentario) {
            btnGravarComentario.addEventListener('click', async function() {
                const comentario = textareaComentario ? textareaComentario.value.trim() : '';
                if (!comentario) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Comentário vazio',
                        text: 'Por favor, escreva seu comentário antes de gravar.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                enviarComentario();
                fecharModalComentario();
            });
        }

        // Funcionalidade dos botões Editar, Cancelar Chamado e Adicionar Comentário
        const configurarBotoesAcao = (statusChamado) => {
            const btnEditarChamado = document.getElementById('btn-editar-chamado');
            const btnCancelarChamado = document.getElementById('btn-cancelar-chamado');
            const btnAdicionarComentario = document.getElementById('btn-adicionar-comentario');
            const actionButtonsAberto = document.querySelector('.aberto .action-buttons');
            const actionButtonsAndamento = document.querySelector('.andamento .action-buttons');

            // Controlar botões da seção "Aberto" - só mostrar se status for 'A' (Aberto)
            if (statusChamado === 'A') {
                if (actionButtonsAberto) {
                    actionButtonsAberto.style.display = 'block';
                }

                if (btnEditarChamado) {
                    btnEditarChamado.addEventListener('click', function(e) {
                        e.preventDefault();
                        // Redirecionar para a página de edição do chamado
                        window.location.href = base_url + 'chamados/' + chave + '/edit';
                    });
                }

                if (btnCancelarChamado) {
                    btnCancelarChamado.addEventListener('click', function(e) {
                        e.preventDefault();
                        // Mostrar confirmação antes de cancelar
                        Swal.fire({
                            title: 'Cancelar Chamado',
                            text: 'Tem certeza que deseja cancelar este chamado? Esta ação não pode ser desfeita.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sim, cancelar!',
                            cancelButtonText: 'Não, manter'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirecionar para cancelar o chamado
                                window.location.href = base_url + 'chamados/' + chave + '/cancel';
                            }
                        });
                    });
                }
            } else {
                // Ocultar os botões se o status não for 'A' (Aberto)
                if (actionButtonsAberto) {
                    actionButtonsAberto.style.display = 'none';
                }
            }

            // Controlar botão "Adicionar Comentário" - só mostrar se status for 'A' (Aberto) ou 'E' (Em Andamento) ou 'F' (Aguardamdo confirmação)
            if (statusChamado === 'A' || statusChamado === 'E' || statusChamado === 'F' || statusChamado === 'G') {
                if (actionButtonsAndamento) {
                    actionButtonsAndamento.style.display = 'block';
                }
            } else {
                if (actionButtonsAndamento) {
                    actionButtonsAndamento.style.display = 'none';
                }
            }
        };
    });
</script>
<script src="<?php echo base_url("assets/js/convertDataToBR.js") ?>"></script>
<?php echo $this->endSection('content'); ?>