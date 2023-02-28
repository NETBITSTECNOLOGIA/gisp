<?php
@session_start();
include_once 'conexao.php';
include_once 'funcoes.php';
include_once('api_sms.php');
@$idempresa = $_SESSION['idempresa'];
@$iduser = $_SESSION['iduser'];
@$nomeuser = $_SESSION['usuario']; //pega usuario que est executando a a��o
@$tipouser = $_SESSION['tipouser'];
@$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

@$tipo = $_POST['tipo'];
@$contato = limpar($_POST['manual']);
@$mensagem = AspasBanco($_POST['mensagem']);
if ($tipo == 'Manual') {

  enviaSms($idempresa, $contato, $mensagem, $nomeuser);
  $mensagem2 = AspasBanco($mensagem);

  mysqli_query($conexao, "INSERT INTO log_sms (idempresa,contato,mensagem,user,data) VALUES ('$idempresa','$contato','$mensagem2','$nomeuser',NOW())") or die(mysqli_error($conexao));

  echo persona2('Enviado com sucesso');
} elseif ($tipo == 'Todos') {
  $query = mysqli_query($conexao, "SELECT * FROM cliente WHERE idempresa='$idempresa' AND situacao='Ativo' AND contato <> ''") or die(mysqli_error($conexao));
  if (mysqli_num_rows($query) >= 1) {
    $n = 1;
    while ($ret = mysqli_fetch_array($query)) {
      if (@$i2 != $ret['contato'] and $ret['contato'] <> 1) {
        $contato = $ret['contato'];
        enviaSms($idempresa, $contato, $mensagem, $nomeuser);
        //salvar log - tabela SELECT * FROM `log_sms`
        $mensagem2 = AspasBanco($mensagem);
        mysqli_query($conexao, "INSERT INTO log_sms (idempresa,contato,mensagem,user,data) VALUES ('$idempresa','$contato','$mensagem2','$nomeuser',NOW())") or die(mysqli_error($conexao));
        //echo persona('SMS enviado com sucesso !');
      }
      @$i2 = $ret['contato'];
      echo persona2('Enviado com sucesso: ' . $n);
      sleep(2);
      $n++;
    }
  }
}
