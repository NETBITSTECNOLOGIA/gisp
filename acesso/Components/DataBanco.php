<?php
//data certa
function dataBanco($valor)
{
    if ($valor != 0000 - 00 - 00) {
        $valor = date('Y-m-d', strtotime($valor));
        return $valor;
    }
}