<?php

/**
 * Converte uma data para o formato brasileiro (dd/mm/yyyy)
 *
 * @param string $dataHoraString Data e hora no formato 'yyyy-mm-dd hh:mm:ss'
 * @return string Data formatada no formato brasileiro (dd/mm/yyyy)
 */
function toDataBR($dataHoraString)
{
    if (empty($dataHoraString)) {
        return '';
    }

    $partes = explode(' ', $dataHoraString);
    $data = $partes[0];
    $tempo = isset($partes[1]) ? $partes[1] : '';

    $partesData = explode('-', $data);
    $ano = $partesData[0];
    $mes = $partesData[1];
    $dia = $partesData[2];

    return $dia . '/' . $mes . '/' . $ano . ($tempo ? ' ' . $tempo : '');
}
