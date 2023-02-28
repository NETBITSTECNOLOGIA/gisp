<?php
//idadeCerta
function idadeCerta($valor)
{
    //cronstuir um construtor que só chame a função se preencher corretamente 
    
    // Declara a data! :P
    $data = $valor;
    // Separa em dia, m�s e ano
    list($dia, $mes, $ano) = explode('-', $data);
    // Descobre que dia � hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $valor = mktime(0, 0, 0, $mes, $dia, $ano);
    // Depois apenas fazemos o c�lculo j� citado :)
    $idade = floor((((($hoje - $valor) / 60) / 60) / 24) / 365.25);
    return $idade;
};