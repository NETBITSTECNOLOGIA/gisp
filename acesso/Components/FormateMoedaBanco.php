<?php
function Moeda($get_valor)
{
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
    if (empty($valor)) {
        return 0;
    } else {
        return $valor;
    } //retorna o valor formatado para gravar no banco
}; //moeda