<?php
session_start();
include_once 'conexao.php';
include_once 'funcoes.php';
$idempresa = $_SESSION['idempresa'];
$iduser = $_SESSION['iduser'];
$nomeuser = $_SESSION['usuario']; //pega usuario que est� executando a a�o
$situacaouser = $_SESSION['situacaouser'];
$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

//idempresa,tokenprivado,clienteid,clientesecret,recebercom,diagerar,aposvencimento,multaapos,jurosapos,diasbloqueio,bloqueioautomatico,data,user	
@$id = $_POST['id'];
@$recebercom = $_POST['recebercom'];
@$tokenprivado = AspasBanco($_POST['tokenprivado']);
@$clienteid = AspasBanco($_POST['clienteid']);
@$clientesecret = AspasBanco($_POST['clientesecret']);
@$diagerar = 1;
@$keydev = AspasBanco($_POST['keydev']);;
@$chavepixaleatoria = AspasBanco($_POST['chavepixaleatoria']);
@$chavepixsecundaria = AspasBanco($_POST['chavepixsecundaria']);
@$url = AspasBanco($_POST['url']);
@$convenio = $_POST['convenio'];
@$carteira = $_POST['carteira'];
@$variacaocarteira = $_POST['variacaocarteira'];
@$agencia = $_POST['agencia'];
@$conta = $_POST['conta'];
@$codigocedente = $_POST['codigocedente'];
@$contrato = $_POST['contrato'];



if ($id == '') {        //verifica se dados obrigatorios estão preenchidos

    mysqli_query($conexao, "INSERT INTO dadoscobranca (
    idempresa,tokenprivado,keydev,clienteid,clientesecret,chavepixaleatoria,chavepixsecundaria,convenio,carteira,variacaocarteira,agencia,conta,codigocedente,contrato,recebercom,data,user,url) 
    VALUES (
    '$idempresa','$tokenprivado','$keydev','$clienteid','$clientesecret','$chavepixaleatoria','$convenio','$carteira','$variacaocarteira','$chavepixsecundaria','$agencia','$conta','$codigocedente','$contrato','$recebercom',NOW(),'$nomeuser','$url')")
        or die(mysqli_error($conexao));

    echo insert();
} else {

    mysqli_query($conexao, "UPDATE dadoscobranca SET 
    idempresa='$idempresa',
    tokenprivado='$tokenprivado',
    keydev='$keydev',
    clienteid='$clienteid',
    clientesecret='$clientesecret',
    chavepixaleatoria='$chavepixaleatoria',
    chavepixsecundaria='$chavepixsecundaria',
    recebercom='$recebercom',
    convenio='$convenio',
    carteira='$carteira',
    variacaocarteira='$variacaocarteira',
    agencia='$agencia',
    conta='$conta',
    codigocedente='$codigocedente',
    contrato='$contrato',
    atualizado=NOW(),
    url='$url' WHERE id='$id'") or die(mysqli_error($conexao));

    echo update();
}
