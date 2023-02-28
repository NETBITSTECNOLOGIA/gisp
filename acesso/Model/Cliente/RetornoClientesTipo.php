<?php
function todosClientes()
{
    include_once 'conexao.php';
    $query = mysqli_query($conexao, "SELECT contato FROM cliente WHERE
    idempresa='9999999999' AND contato <> ''") or die(mysqli_error($conexao));
    $rows = mysqli_num_rows($query);
    if ($rows >= 1) {
        return $rows;
    } else {
        return 0;
    }
}

function todosAtivo()
{
    include_once 'conexao.php';
    $query = mysqli_query($conexao, "SELECT contato FROM cliente WHERE idempresa='9999999999' AND situacao='Ativo' AND
    contato <> ''") or die(mysqli_error($conexao));
    $rows = mysqli_num_rows($query);
    if ($rows >= 1) {
        return $rows;
    } else {
        return 0;
    }
}

function todosBloqueado()
{
    include_once 'conexao.php';
    $query = mysqli_query($conexao, "SELECT contato FROM cliente WHERE idempresa='9999999999' AND
        situacao='Bloqueado' AND contato <> ''") or die(mysqli_error($conexao));
    $rows = mysqli_num_rows($query);
    if ($rows >= 1) {
        return $rows;
    } else {
        return 0;
    }
}

function todosCancelado()
{
    include_once 'conexao.php';
    $query = mysqli_query($conexao, "SELECT contato FROM cliente WHERE idempresa='9999999999' AND
            situacao='Cancelado' AND contato <> ''") or die(mysqli_error($conexao));
    $rows = mysqli_num_rows($query);
    if ($rows >= 1) {
        return $rows;
    } else {
        return 0;
    }
}

function totalVencidos()
{
    include_once 'conexao.php';
    $query = mysqli_query($conexao, "SELECT vencimento,valorpago,idcliente FROM cobranca WHERE valorpago=0.00
                AND CURDATE() > vencimento GROUP BY idcliente")
        or die(mysqli_error($conexao));
    $rows = mysqli_num_rows($query);
    if ($rows >= 1) {
        return $rows;
    } else {
        return 0;
    }
}
