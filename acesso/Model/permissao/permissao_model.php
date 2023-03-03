<?php

//permissao atualzia��o //recebe informa��es vindas do array de permiss�o
function Permissao($idempresa, $item, $id, $iduser)
{
    include_once 'conexao.php';
    $hoje0 = date('Y-m-d');
    $sql = mysqli_query($conexao, "SELECT * FROM permissao WHERE idempresa='$idempresa' AND usuario='$id' AND item='$item'") or die(mysqli_error($conexao));;
    if (mysqli_num_rows($sql) >= 1) {
        mysqli_query($conexao, "UPDATE permissao SET valor='ativo',datacad='$hoje0',usuariocad='$iduser' WHERE idempresa='$idempresa' AND usuario='$id' AND item='$item'") or die(mysqli_error($conexao));
    } else {
        mysqli_query($conexao, "INSERT INTO permissao (idempresa,usuario,item,valor,datacad,usuariocad) VALUES ('$idempresa','$id','$item','ativo',NOW(),'$iduser')") or die(mysqli_error($conexao));
    }
};

//verifica permissões
function PermissaoCheck($idempresa, $item, $id)
{
    include_once 'conexao.php';
    $sql1 = mysqli_query($conexao, "SELECT * FROM permissao 
    WHERE idempresa='$idempresa' AND usuario='$id' AND item='$item' AND valor='ativo'") or die(mysqli_error($conexao));
    if (mysqli_num_rows($sql1) >= 1) {
        return 'checked';
    }
};
