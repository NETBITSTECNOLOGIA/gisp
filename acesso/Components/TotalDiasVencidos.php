<?php
function diasVencidos($valor)
{
    ///construir construtor que só crie o obejto se preencher os parametros solicitados se nao retornar msn
    // Calcula a diferença em segundos entre as datas
    $diferenca = strtotime(date('Y-m-d')) - strtotime($valor);
    //Calcula a diferença em dias
    $dias = floor($diferenca / (60 * 60 * 24));
    if ($dias <= 0) {
        $dias = 'não vencido';
    }
    return $dias;
}