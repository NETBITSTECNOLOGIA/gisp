<?php
//converter para megas
function formatBytes($valor, $precision = 2)
{
     ///construir construtor que só crie o obejto se preencher os parametros solicitados se nao retornar msn
    $base = log($valor, 1024);
    $suffixes = array('', 'Kbs', 'Mbs', 'Gbs', 'Tbs');

    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}