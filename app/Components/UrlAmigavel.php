<?php
function url_amigavel($string)
{
    $table = array(
        '�' => 'S', '�' => 's', '�' => 'D', 'd' => 'd', '�' => 'Z',
        '�' => 'z', 'C' => 'C', 'c' => 'c', 'C' => 'C', 'c' => 'c',
        '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A',
        '�' => 'A', '�' => 'A', '�' => 'C', '�' => 'E', '�' => 'E',
        '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I',
        '�' => 'I', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O',
        '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'U', '�' => 'U',
        '�' => 'U', '�' => 'U', '�' => 'Y', '�' => 'B', '�' => 'Ss',
        '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a',
        '�' => 'a', '�' => 'a', '�' => 'c', '�' => 'e', '�' => 'e',
        '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i',
        '�' => 'i', '�' => 'o', '�' => 'n', '�' => 'o', '�' => 'o',
        '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'u',
        '�' => 'u', '�' => 'u', '�' => 'y', '�' => 'y', '�' => 'b',
        '�' => 'y', 'R' => 'R', 'r' => 'r',
    );
    // Traduz os caracteres em $string, baseado no vetor $table
    $string = strtr($string, $table);
    // converte para min�sculo
    $string = strtolower($string);
    // remove caracteres indesej�veis (que n�o est�o no padr�o)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    // Remove m�ltiplas ocorr�ncias de h�fens ou espa�os
    $string = preg_replace("/[\s-]+/", " ", $string);
    // Transforma espa�os e underscores em h�fens
    $string = preg_replace("/[\s_]/", " ", $string);
    // retorna a string
    return $string;
};//url_amigavel