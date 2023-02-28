<?php
include_once 'conexao.php';
include_once 'funcoes.php';
include_once('api_sms.php');
$query = mysqli_query($conexao, "SELECT * FROM dadoscobranca WHERE idempresa='9999999999' AND depoisdovencimento > 0 AND textosmsantes <> ''") or die(mysqli_error($conexao));
if (mysqli_num_rows($query) >= 1) {
  $d = mysqli_fetch_array($query);
  $diasantes = $d['depoisdovencimento'];
  $textoaenviar = $d['textosmsantes'];
  $hoje = date('Y-m-d');
  $acharvencimento = date('Y-m-d', strtotime('-' . $diasantes . 'days', strtotime($hoje)));

  $query = mysqli_query($conexao, "SELECT cobranca.*, cliente.contato FROM cobranca
        INNER JOIN cliente ON cobranca.idcliente = cliente.id
        WHERE cobranca.idempresa='9999999999' AND cobranca.vencimento='$acharvencimento' AND cobranca.codigobarra <> '' AND cliente.contato <> ''") or die(mysqli_error($conexao));
  if (mysqli_num_rows($query) >= 1) {
    while ($ret = mysqli_fetch_array($query)) {
      $stringvalor = str_replace('{valor}', Real($ret['valor']), $textoaenviar);
      $stringcommes = str_replace('{vencimento}', dataForm($ret['dataVencimento']), $stringvalor);
      $stringcodigobarras = str_replace('{codigobarra}', $ret['codigobarra'], $stringcommes);
      $contato = $ret['contato'];
      $mensagem = $stringcodigobarras;
      $idempresa = '9999999999';
      enviaSms($idempresa, $contato, $mensagem, 'Automático');
      //salvar log - tabela SELECT * FROM `log_sms`
      $mensagem2 = AspasBanco($mensagem);
      mysqli_query($conexao, "INSERT INTO log_sms (idempresa,contato,mensagem,user,data) VALUES ('$idempresa','$contato','$mensagem2','Automatico',NOW())") or die(mysqli_error($conexao));
      echo 'Dias antes:' . $diasantes . ' | Enviaado para: ' . $contato . ' | Mensagem: ' . $mensagem . '<br>';
    }
  } else {
    echo 'Sem envio de sms para hoje';
  }
}
