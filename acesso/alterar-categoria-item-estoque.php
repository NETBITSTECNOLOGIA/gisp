<?php
session_start();
include_once('conexao.php'); 
include_once('funcoes.php');
$idempresa = $_SESSION['idempresa'];
$iduser = $_SESSION['iduser'];
$nomeuser = $_SESSION['usuario'];//pega usuario que est� executando a a��o
$situacaouser = $_SESSION['situacaouser'];
$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
if(isset($_SESSION['iduser'])!=true || empty($_SESSION['iduser'])){echo '<script>location.href="sair.php";</script>'; }

$id = $_POST['id'];
$nome_cat = AspasBanco($_POST['nome_cat']);
if(!empty($_POST['id']) || !empty($_POST['nome_cat'])){
    mysqli_query($conexao,"UPDATE j_categoria_estoque SET nome_cat='$nome_cat' WHERE id='$id'")
    or die (mysqli_error($conexao));

    echo update();

}else{
    echo persona('Erro inesperado');
}
