<?php
function primeiraLetraNome($nome)
{
    // Remove espaços extras e pega a primeira letra
    $nome = trim($nome);
    return strtoupper(substr($nome, 0, 1));
}
