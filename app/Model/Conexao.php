<?php
require_once '../config/database';

$conexao = mysqli_connect($host,$username,$pass,$dbname);
/* check connection */
if (mysqli_connect_errno()) {
    //printf('Falha na conexão: %s\n', mysqli_connect_error());
    //exit();
}else{
    $conexao->set_charset("utf8");
    //print('Conectado com sucesso!');
    //printf("inicio caracter set: %s\n", $conexao->character_set_name());
}