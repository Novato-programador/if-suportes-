function convertDataToBR(d) {
    // Substituir espaço por 'T' para criar uma data ISO válida
    const dataISO = d.replace(' ', 'T');
    const data = new Date(dataISO);
    
    // Formatar manualmente para o formato brasileiro
    const dia = data.getDate().toString().padStart(2, '0');
    const mes = (data.getMonth() + 1).toString().padStart(2, '0');
    const ano = data.getFullYear();
    const hora = data.getHours().toString().padStart(2, '0');
    const minuto = data.getMinutes().toString().padStart(2, '0');
    const segundo = data.getSeconds().toString().padStart(2, '0');
    
    return `${dia}/${mes}/${ano} ${hora}:${minuto}:${segundo}`;
}