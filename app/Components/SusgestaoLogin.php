<?php
//sugestão de login
function sugestaoLogin($nome, $id)
{
    $partes = explode(' ', $nome);
    $primeiroNome = array_shift($partes);
    $ultimoNome = array_pop($partes);
    $sugestaologin = $primeiroNome . '.' . $ultimoNome . $id;
}
