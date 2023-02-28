<?php
session_start();
include_once('../../acesso/conexao.php');
include_once('../../acesso/funcoes.php');
@$idempresa = $_SESSION['idempresa'];
@$logomarcauser = $_SESSION['logomarcauser'];
@$iduser = $_SESSION['iduser'];
@$nomeuser = $_SESSION['usuario']; //pega usuario que est  executando a a  o
@$usercargo = $_SESSION['cargo'];
@$situacaouser = $_SESSION['situacaouser'];
@$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
//if(isset($_SESSION['iduser'])!=true || empty($_SESSION['iduser'])){echo '<script>location.href="sair.php";</script>'; }

$querye = mysqli_query($conexao, "SELECT * FROM user WHERE idempresa='$idempresa'") or die(mysqli_error($conexao));
$rete = mysqli_fetch_array($querye);
//dados cobranca empresa
$queryc = mysqli_query($conexao, "SELECT * FROM dadoscobranca WHERE idempresa='$idempresa'") or die(mysqli_error($conexao));
$retc = mysqli_fetch_array($queryc);
$diasdesconto0 = $retc['diasdesconto'];
$valordesconto = Real($retc['valordesconto']);

if (!$rete['nome']) {
  $nome_empresa = strtoupper($rete['nome']);
} else {
  $nome_empresa = strtoupper($rete['fantasia']);
}
if (!$rete['rua']) {
  $endereco_empresa = "";
} else {
  $endereco_empresa = addslashes($rete['rua'] . '-' . $rete['bairro'] . '-' . $rete['cidade'] . '/' . $rete['estado']);
}
if (!$rete['contato']) {
  $tel_empresa = "";
} else {
  $tel_empresa = addslashes($rete['contato']);
}
if (!$logomarcauser) {
  $logo = "";
} else {
  $logo = $logomarcauser;
}
if (!$rete['cpf_cnpj']) {
  $docempresa = "";
} else {
  $docempresa = $rete['cpf_cnpj'];
}

$id = $_GET['id'];
$query = mysqli_query($conexao, "SELECT cobranca.*, cliente.rua,numero,bairro,municipio,estado,cep,cpf,cnpj FROM cobranca 
LEFT JOIN cliente ON cobranca.idcliente = cliente.id
WHERE cobranca.id='$id'") or die(mysqli_error($conexao));
$ret = mysqli_fetch_array($query);
@$idcliente = $ret['idcliente'];

if (!@$ret['cliente']) {
  $nome = "";
} else {
  $nome = strtoupper(@$ret['cliente']);
}
if (!@$ret['rua']) {
  $endereco = "";
} else {
  $endereco = AspasForm(@$ret['rua'] . ',' . @$ret['numero'] . ' - ' . @$ret['bairro'] . ' - ' . @$ret['municipio'] . '/' . @$ret['estado'] . '<br>&emsp;&emsp;' . @$ret['cep']);
}
if (!@$ret['cpf'] && !@$ret['cnpj']) {
  $cpf = "";
  $cnpj = "";
} else {
  $cpf = addslashes(@$ret['cpf']);
  $cnpj = addslashes(@$ret['cnpj']);
}
if (!@$ret['valor']) {
  $valor = "";
} else {
  $valor = Real($ret['valor']);
}
if (!@$ret['parcela']) {
  $parcela = "";
} else {
  $parcela = $ret['parcela'];
}
if (!@$ret['nparcela']) {
  $qtd = "";
} else {
  $qtd = addslashes($ret['nparcela']);
}
if (!@$ret['vencimento']) {
  $vence = "";
} else {
  $vence = dataForm($ret['vencimento']);
}
if (!@$ret['datagerado']) {
  $datagerado = "";
} else {
  $datagerado = dataForm(@$ret['datagerado']);
}
if (!@$ret['ncobranca']) {
  $ncobranca = "";
} else {
  $ncobranca = @$ret['ncobranca'];
}
if (!@$ret['obs']) {
  $obs = "";
} else {
  $obs = AspasForm(@$ret['obs']);
}
if (!@$_POST['primeiromes']) {
  @$primeiro_mes = "";
} else {
  @$primeiro_mes = addslashes($_POST['primeiromes']);
}
if (!@$_POST['primeiroano']) {
  @$primeiro_ano = "";
} else {
  @$primeiro_ano = addslashes($_POST['primeiroano']);
}

$hoje = date("d/m/Y");

if ($qtd > 212) {
  header("Location: index.php?error=qtd_limite");
}
?>

<!DOCTYPE HTML>
<!-- SPACES 2 -->
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="Resource-type" content="document">
  <meta name="Robots" content="all">
  <meta name="Rating" content="general">
  <meta name="author" content="Gabriel Masson">
  <title>Carnê</title>
  <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <div class="bto">
    <button class="btn-impress" onclick="window.print()">Imprimir</button>&nbsp;
    <?php
    echo '<a href="capa.php?id=' . $idcliente . '" class="btn-impress" target="_blank">Capa do carnê</a>
  </div>';


    $id = $_GET['id'];
    $query = mysqli_query($conexao, "SELECT cobranca.*, cliente.rua,numero,bairro,municipio,estado,cpf,cnpj FROM cobranca 
LEFT JOIN cliente ON cobranca.idcliente = cliente.id
WHERE cobranca.idcobrancaprincipal='$id'") or die(mysqli_error($conexao));

    $count = 1;

    while ($ret = mysqli_fetch_array($query)) {

      if (!$ret['cliente']) {
        $nome = "";
      } else {
        $nome = strtoupper($ret['cliente']);
      }
      if (!$ret['rua']) {
        $endereco = "";
      } else {
        $endereco = AspasForm($ret['rua'] . ',' . $ret['numero'] . ' - ' . $ret['bairro'] . ' - ' . $ret['municipio'] . '/' . $ret['estado']);
      }
      if (!$ret['cpf'] && !$ret['cnpj']) {
        $cpf = "";
        $cnpj = "";
      } else {
        $cpf = addslashes($ret['cpf']);
        $cnpj = addslashes($ret['cnpj']);
      }
      if (!$ret['valor']) {
        $valor = "";
      } else {
        $valor = Real($ret['valor']);
      }
      if (!$ret['nparcela']) {
        $qtd = "";
      } else {
        $qtd = addslashes($ret['nparcela']);
      }
      if (!$ret['vencimento']) {
        $vence = "";
      } else {
        $vence = dataForm($ret['vencimento']);
      }
      if (!$ret['ncobranca']) {
        $ncobranca = "";
      } else {
        $ncobranca = $ret['ncobranca'];
      }
      if (!$ret['obs']) {
        $obs = "";
      } else {
        $obs = AspasForm($ret['obs']);
      }

      @$diasdesconto = date('Y-m-d', strtotime('-' . $diasdesconto0 . ' days', strtotime(@$ret['vencimento'])));

      echo '<!-- PARCELA -->
  <div class="parcela" style="font-family: sans-serif; font-size: 14px">
    <div class="grid">
      <div class="col2">
        <div class="destaca">
          <b>' . $nome_empresa . ' | 0001</b>
          <table style="width:100%; border: 3px solid black">
            <tr>
              <td style="border-top: none">
                <small>Nosso número</small>
                <br><b>' . $ncobranca . '</b>
              </td>
            </tr>
            <tr><td style="border-top: 3px solid"><small>Vencimento</small><br><b>' . $vence . '</b></td></tr>
            <tr><td style="border-top: 3px solid"><small>Agência/Código do beneficiário</small><br>0000 / 00000-0</td></tr>
            <tr><td style="border-top: 3px solid"><small>Valor</small><br><b>R$ ' . $valor . '</b></td></tr>
            <tr><td style="border-top: 3px solid"><small>(-) Desconto</small><br>&nbsp;</td></tr>
            <tr><td style="border-top: 3px solid"><small>(-) Outras deduções/Abatimentos</small><br>&nbsp;</td></tr>
            <tr><td style="border-top: 3px solid"><small>(+) Mora/Multas/Juros</small><br>&nbsp;</td></tr>
            <tr><td style="border-top: 3px solid"><small>(+) Outros acréscimos</small><br>&nbsp;</td></tr>
            <tr><td style="border-top: 3px solid"><small>(=) Valor cobrado</small><br>&nbsp;</td></tr>
            <tr><td style="border-top: 3px solid"><small>Número do documento</small><br>' . $ncobranca . '</td></tr>
            <tr><td style="border-top: 3px solid"><small>Pagador</small><br>' . $nome . '</td></tr>
          </table>
          <b> ' . $nome_empresa . ' <br> ' . $docempresa . '</b>
          <br><hr style="border: 1px dashed gray">
          <h3>Recibo do pagador</h1>
        </div>
      </div>
      <div class="col10">
        <b> ' . $nome_empresa . ' | 0001 |  ' . $ncobranca . '</b>
        <table style="width:100%; border: 3px solid black;">        
        <tr>
          <td colspan="5" style="border-right: 3px solid; border-top: none">
            <small>Local de pagamento</small><br>' . $nome_empresa . '
          </td>
          <td style="border-top: none">
            <small>Vencimento</small><br><b>' . $vence . '</b>
          </td>
        </tr>
        <tr>
          <td colspan="5" style="border-right: 3px solid; border-top: 3px solid">
            <small>Beneficiário</small><br>' . $nome_empresa . '  /  ' . $docempresa . '
          </td>
          <td style="border-top: 3px solid">
            <small>Agência/Código do beneficiário</small><br>0000 / 00000-0
          </td>
        </tr>
        <tr>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Data documento</small><br>' . $datagerado . '</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Número documento</small><br>' . $ncobranca . '</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Espécie DOC</small><br>DM</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Aceite</small><br>Não</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Data processamento</small><br>' . $datagerado . '</td>
        <td colspan="5" style="border-top: 3px solid">
          <small>Nosso número</small><br>' . $ncobranca . '
        </td>
        </tr>
        <tr>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Uso da empresa</small><br>&nbsp;</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Carteira</small><br>0001</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Espécie</small><br>R$</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>Qtde Moeda</small><br>&nbsp;</td>
          <td style="border-right: 3px solid; border-top: 3px solid"><small>(x) Valor</small><br>R$ ' . $valor . '</td>
        <td colspan="5" style="border-top: 3px solid">
          <small>(=) Valor do documento</small><br><b>R$ ' . $valor . '</b>
        </td>
        </tr>
        <tr>
        <td colspan="5" rowspan="5" style="border-right: 3px solid; border-top: 3px solid; font-size: 18px !important">
          <small>Instruções - Texto de responsabilidade do beneficiário</small>
          <p>Parcela ' . $count . ' de ' . $qtd . ' 
          <br> 
          Não receber após
          <br><br>
          Após vencimento não cobrar multa/juros
          <br>
          Até ' . dataForm($diasdesconto) . ' conceder desconto de R$ ' . $valordesconto . '
          <br>
          <b>Não receber pagamento em cheque</b>
          </p>
        </td>
        <td style="border-top: 3px solid">
          <small>(-) Desconto</small><br>&nbsp;
        </td>
        </tr>
        <tr>       
        <td style="border-top: 3px solid">
          <small>(-) Outras deduções/Abatimentos</small><br>&nbsp;
        </td>
        </tr>
        <tr>       
        <td style="border-top: 3px solid">
          <small>(+) Mora/Multas/Juros</small><br>&nbsp;
        </td>
        </tr>
        <tr>       
        <td style="border-top: 3px solid">
          <small>(+) Outros acréscimos</small><br>&nbsp;
        </td>
        </tr>
        <tr>       
        <td style="border-top: 3px solid">
          <small>(=) Valor cobrado</small><br>&nbsp;
        </td>
        </tr>
        <tr>
          <td colspan="6" style="border-top: 3px solid; font-size: 18px !important">
            <small>Pagador</small>
            <p>
            <b>
            &emsp;&emsp;' . $nome . '
              <br>
              &emsp;&emsp;' . $endereco . '
            </b>
            </p>            
            Sacador avalista ' . $nome_empresa . '</small>
          </td>
        </tr>    
        </table>
        <b> ' . $nome_empresa . ' | 0001 | ' . $ncobranca . '</b>
      </div>
    </div>
  </div>';
      $count++;
    }
    ?>
</body>

</html>