/**
 * Envia uma mensagem no WhatsApp
 * @param {string} numero - O número de telefone do destinatário (com DDD)
 * @param {string} [texto=""] - O texto da mensagem (opcional)
 * @returns {void}  - Abre uma nova janela do WhatsApp com o número e o texto preenchidos
 */
handleSendWhatsapp = (numero, texto = "") => {
    // Remove caracteres não numéricos
    const numeroLimpo = numero.replace(/\D/g, '');
    
    if (numeroLimpo.length < 10 || numeroLimpo.length > 11) {
        alert("Número de telefone inválido!");
        return;
    }
    
    const parametrosTexto = texto ? `&text=${encodeURIComponent(texto)}` : '';
    window.open(`https://api.whatsapp.com/send?l=pt&phone=55${numeroLimpo}${parametrosTexto}`, "minhaJanela", "height=600,width=600");
}