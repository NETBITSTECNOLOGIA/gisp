<?php
session_start();
include_once('conexao.php'); 
include_once('funcoes.php');
@$idempresa = $_SESSION['idempresa'];
@$logomarcauser = $_SESSION['logomarcauser'];
@$iduser = $_SESSION['iduser'];
@$nomeuser = $_SESSION['usuario'];//pega usuario que est� executando a a��o
@$usercargo = $_SESSION['cargo'];
@$situacaouser = $_SESSION['situacaouser'];
@$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
if(isset($_SESSION['iduser'])!=true || empty($_SESSION['iduser'])){echo '<script>location.href="sair.php";</script>'; }

@$id = $_GET['id'];
$query = mysqli_query($conexao,"SELECT cobranca.*, cliente.contato FROM cobranca 
LEFT JOIN cliente ON cobranca.idcliente = cliente.id
WHERE cobranca.idcliente='$id' AND cobranca.idempresa='$idempresa' AND cobranca.situacao='CANCELADO' ORDER BY cobranca.vencimento DESC") or die (mysqli_error($conexao));

if(mysqli_num_rows($query) >= 1){
while($dd = mysqli_fetch_array($query)){echo'
<tr title="'.$dd['obs'].'">
    <td>'; if($dd['code'] != ''){ echo $dd['code']; }else{ echo $dd['ncobranca']; } echo'</td>
    <td>'.$dd['banco'].'</td>
    <td>'.date('d-m-Y',strtotime($dd['vencimento'])).'</td>
    <td>R$ '.Real($dd['valor']).'</td>
    <td>'; if($dd['datapagamento'] != '0000-00-00'){ echo date('d-m-Y',strtotime($dd['datapagamento']));} echo'</td>
    <td>R$ '.Real($dd['valorpago']).'</td>
    <td>'.situacao($dd['situacao']).'</td>
    <td>#</td>
</tr>';}} else { echo'<div class="col-lg-12 text-red">Sem cobranças</div>';}
