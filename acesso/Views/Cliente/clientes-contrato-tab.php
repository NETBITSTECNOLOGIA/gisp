<?php
session_start();
include_once 'conexao.php';
include_once 'funcoes.php';
@$idempresa = $_SESSION['idempresa'];
@$usercargo = $_SESSION['cargo'];
@$iduser = $_SESSION['iduser'];
@$iduser = $_SESSION['iduser'];
@$tipouser = $_SESSION['tipouser'];
if (isset($_SESSION['iduser']) != true and isset($_SESSION['situacaouser']) != true) {
  echo '<script>location.href="sair.php";</script>';
}
@$id = $_GET['id'];
$query = mysqli_query($conexao, "SELECT * FROM contratos WHERE idcliente='$id'") or die(mysqli_error($conexao));
while ($dd = mysqli_fetch_array($query)) {


  $idcontrato = $dd['id'];
  //plano, login
  $sql2 = mysqli_query($conexao, "SELECT * FROM contratos WHERE id='$idcontrato'") or die(mysqli_error($conexao));
  $ddc2 = mysqli_fetch_array($sql2);
  $login2 = $ddc2['login'];
  $plano2 = $ddc2['plano'];
  $porta = $ddc2['porta'];

  //servidor
  $sql22 = mysqli_query($conexao, "SELECT plano.*, servidor.ip,user,password FROM plano 
    LEFT JOIN servidor ON plano.servidor = servidor.id
    WHERE plano.id='$plano2'");
  $dds2 = mysqli_fetch_array($sql22);
  require_once 'routeros_api_class.php';
  $mk = new RouterosAPI();
  if ($mk->connect($dds2['ip'], decrypt($dds2['user']), decrypt($dds2['password']))) {
    $find = @$mk->comm("/ppp/active/print", array("?name" =>  utf8_decode($login2),));
    if (count($find) >= 1) {
      foreach ($find as $key => $value) {
        $ip = AspasForm($find[$key]['address']);
        $tempo = AspasForm($find[$key]['uptime']);
        $status = 1;
      }
    } else {
      $status = '';
    }
  } else {
    $status = '';
  }

  echo '
<tr>
    <td>' . $dd['id'] . '</td>
    <td>' . AspasForm($dd['nomeplano']) . '</td>
    <td>' . AspasForm($dd['login']) . '</td>
    <td>';

  if ($status == 1) {
    echo '<i class="fa live" title="online"></i> online';
  } else {
    echo '<i class="fa fa-chain-broken text-red"></i> off-line';
  }

  echo '</td>
    <td><a href="#" onclick="testarConexao(' . $dd['id'] . ')" class="btn btn-primary ajax"><i class="fa fa-spin fa-refresh"></i> Verifica conexão</a></td>
    <td>';
  if ($porta != '' and $status == 1) {
    echo '<a href="http://' . @$ip . ':' . @$porta . '" target="blank"><img src="dist/img/ap2.png"  style="width:40px"/> accesar</a>';
  } elseif ($porta == '' and $status == 1) {
    echo '<a href="http://' . @$ip . '" target="blank"><img src="dist/img/ap2.png" style="width:40px"/> accesar</a>';
  } else {
    echo '<i class="fa fa-chain-broken text-red"></i> off-line';
  }

  echo '    
    </td>
    <td>' . @$tempo . '</td>
    <td>';
  if ($_SESSION['tipouser'] == 'Admin') {
    echo '
        <a href="clientes-contrato-exibir.php?id=' . $dd['id'] . '" target="_blank"><i class="fa fa-edit fa-2x"></i></a>&ensp;
        <a href="#" onclick="excluirContrato(' . $dd['id'] . ')"><i class="fa fa-trash fa-2x text-red"></i></a>';
  }

  echo '
    </td>
</tr>';
  sleep(3);
}
?>
<style>
  .live {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    background-color: #00EE00;
    animation: pulse 1500ms infinite;
  }

  @keyframes pulse {
    0% {
      box-shadow: #00EE00 0 0 0 0;
    }

    75% {
      box-shadow: #ff69b400 0 0 0 16px;
    }
  }
</style>