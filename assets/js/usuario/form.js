 // Controle do toggle de acesso
    const acessoToggle = document.getElementById('acesso');
    const statusLabel = document.getElementById('statusLabel');

    acessoToggle.addEventListener('change', function() {
        if (this.checked) {
            statusLabel.textContent = 'Acesso Liberado';
            statusLabel.className = 'status-label status-active';
        } else {
            statusLabel.textContent = 'Acesso Bloqueado';
            statusLabel.className = 'status-label status-inactive';
        }
    });

    // Validação do formulário
    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();
        //Loading salvando alterações
        Swal.fire({
            title: 'Salvando...',
            text: 'Por favor, aguarde enquanto as alterações são salvas.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        const form = document.getElementById('userForm');
        const timeout = setTimeout(() => {
            form.submit();
        }, 1500);
    });

    // Botão de redefinir senha
    document.getElementById('resetPassword').addEventListener('click', function() {
        resetPassword();
    });


    function resetPassword() {
        var senhaConfirmacao = "";
        Swal.fire({
            title: 'Confirmar Redefinisão de Senha',
            html: `
                <div style="text-align: left; margin-bottom: 20px;">
                    <p style="color: #dc3545; font-weight: 600; margin-bottom: 15px;">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Atenção! Esta ação redefinirá a senha do usuário.
                    </p>
                    <p style="margin-bottom: 15px;">Para confirmar, digite sua senha atual:</p>
                    <input type="password" id="senhaConfirmacao" class="swal2-input" placeholder="Digite sua senha" style="margin: 0;">
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Redefinir Senha',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            focusConfirm: false,
            preConfirm: () => {
                const senha = document.getElementById('senhaConfirmacao').value;
                if (!senha) {
                    Swal.showValidationMessage('Por favor, digite sua senha');
                    return false;
                }
                senhaConfirmacao = senha;
                return senha;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const chave = document.getElementById('chave').value;
                redefinirSenhaAjax(chave, senhaConfirmacao);
            }
        });
    }

    function redefinirSenhaAjax(chave, senha) {
        fetch(base_url + '/resetPass', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'chave=' + encodeURIComponent(chave) + '&senha=' + encodeURIComponent(senha)
            })
            .then(response => {
                // Verificar se o content-type é JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new TypeError('Resposta não é JSON');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.message,
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
                    setTimeout(() => {
                        handleSendWhatsapp(data.telefone, "IFPA - Suportes\n" +
                            "REDEFINIÇÃO DE SENHA\n" +
                            "Senha gerada automáticamente: *" + data.senha + "*\n" +
                            "Essa é sua nova senha, após o primeiro acesso ela deve ser alterada imediatamente.\n" +
                            "Link para acesso: " + base_url + "\n" +
                            "Não responder esta mensagem.");
                    }, 2000);

                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: data.message,
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
            })
            .catch(error => {
                if (error.message.includes('não é JSON')) {
                    window.location.reload();
                }
            });
    }