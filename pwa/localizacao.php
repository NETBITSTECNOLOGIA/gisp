<?php
include_once('../acesso/conexao.php');
include_once('../acesso/funcoes.php');

$idcliente = $_POST['idcliente'];
$idempresa = $_POST['idempresa'];
$latitude = AspasBanco($_POST['latitude']);
$longitude = AspasBanco($_POST['longitude']);

if(!empty($idempresa) AND !empty($idcliente)){
    mysqli_query($conexao,"UPDATE cliente SET latitude='$latitude',longitude='$longitude' WHERE id='$idcliente'") or die (mysqli_error($conexao));

    echo "<script>alert('Obrigado!')</script>";
    echo "<script>window.location.href='dadoscliente.php';</script>";
}else{
    echo "<script>window.location.href='dadoscliente.php';</script>";
}
