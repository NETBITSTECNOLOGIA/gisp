<?php
include_once('../acesso/conexao.php');
include_once('../acesso/funcoes.php');
@$id = $_GET['id'];
$query = mysqli_query($conexao, "SELECT user.logomarca,contato FROM user WHERE idempresa='$id'");
$ret = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="GISP CLIENTE">
  <meta name="keywords" content="SISTEMA DE ATENDIMENTO AO CLIENTE">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <title>CLIENTE SUPORTE</title>

  <!-- bootstrap 4.3.1 -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <!-- font awesome 6.1.1 -->
  <link rel="stylesheet" href="css/all.min.css" />

  <script type="text/javascript" async="" src="js/ga.js"></script>

  <link rel="manifest" href="./manifest.json" />

  <link rel="preload" href="./app.js" as="script" />

  <!-- Favicon icon -->
  <link rel="shortcut icon" type="../acesso/logocli/<?php echo @$ret['logomarca']; ?>" href="icone.png">
</head>
<style>
  /*

@media screen and (min-device-width: 480px) {
    body {
        display: none;
    }
}
*/
</style>

<body style="background:white !important;">
  <header class="header" role="banner">
    <h3 CLASS="text_header">GISP CLIENTE</h3>
  </header>
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <?php
      if (!empty($ret['logomarca'])) {
        echo '
              <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="../acesso/logocli/' . $ret['logomarca'] . '" class="img-fluid" alt="" style="width: 50%"/>
          </div>';
      } else {
        echo '
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="icone.png" class="img-fluid" alt="" style="width: 50%"/>
      </div>';
      }

      ?>

      <form method="post" id="valida-form" autocomplete="off">

        <div class="row">
          <div class="col-lg-12">
            <div class="col-12">
              <center>
                <label for="inputDefault">
                  <h2 class="label_text">CPF/CNPJ</h2>
                </label>
                <input type="number" class="form-control form-control-lg contar" id="acesso" name="acesso" placeholder="Apenas números" style="text-align:center;" required>
                <label for="inputDefault">
                  <h2 class="label_text" id="teste2">DATA DE NASCIMENTO</h2>
                </label>
              </center>
              <input type="text" class="form-control form-control-lg data" name="data" placeholder="Exemplo: 01022022" style="text-align:center;" required>
            </div>
            <div class="col-12">
              <label for="inputDefault"></label>
              <button type="submit" class="btn btn-info btn-block btn-lg btn_login" id="btn2">ENTRAR</button>
            </div>
            <br />
            <div class="col-12">
              <label for="inputDefault">
                <h4 style="font-family: bebas;">Lembrar login </h4>
              </label>
              <input type="checkbox" class="input-checkbox" name="lembrete" value="SIM" style="width: 20px;
        height: 20px;" />
            </div>
            <br />
            <div class="col-12">
              <h2 style="font-family: bebas;">SUPORTE: <?php echo '<b class="celular">' . @$ret['contato'] . '</b>'; ?></h2>
            </div>

            <div class="col-12" id="error">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>
<!-- jQuery 3 -->
<script src="../acesso/bower_components/jquery/dist/jquery.min.js"></script>
<!-- mascaras -->


<script src="../acesso/dist/js/jquery.mask.js"></script>
<script src="../acesso/dist/js/jquery.maskMoney.js"></script>
<script src="../acesso/dist/js/meusscripts.js"></script>

<script src="./app.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<!-- font awesome 6.1.1 js -->
<script src="js/all.min.js"></script>
<script>
  $('#valida-form').submit(function() {
    $('#btn2').html('Aguarde, Processando...');
    $.ajax({
      type: 'post',
      url: 'valida-cliente.php',
      data: $('#valida-form').serialize(),
      success: function(data) {
        $('#btn2').show().html('ENTRAR');
        $('#error').show().fadeOut(5000).html(data);
      }
    });
    return false;
  });
  //contar texto
  var espaco = 0;
  $('.contar').focus();
  $('.contar').keyup(function(e) {
    if (e.keyCode == 8 || e.keyCode == 46) {
      espaco = 0;
      $('.contar').val("");
    }
    var text = $('.contar').val();
    if (text[text.length - 1] != ' ') {
      //$('.totaltexto').text((text.length));
      if (text.length > 11) {
        $('#teste2').text('DATA DE CRIAÇÃO');
      } else {
        $('#teste2').text('DATA DE NASCIMENTO');
      }
    } else {
      espaco++;
    }
  });
</script>

</html>