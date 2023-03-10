<?php
ob_start();
session_start(['cookie_lifetime' => 86400,]);
include_once '../../database/conexao.php';
if (isset($_SESSION['gisp_iduser']) != true) {
  echo '<script>location.href="sair.php";</script>';
}

//components -> funções
include_once '../../components/primeiro_nome.php';
$primeironome = primeiroNome($_SESSION['gisp_usuario']);

//sms mudar para componentes pasta sms
include_once '../../controllers/sms/sms_controller.php';
include_once '../../model/sms/sms_model.php';
$smsController = new SmsController();
$smsModel = new SmsModel();
$smsController->setIdempresa($_SESSION['gisp_idempresa']);
$totalsms = $smsModel->readDia($smsController);

//$pessoa1=new Pessoa('Antenor',’26’);


echo '
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GISP v1.1.1</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="shortcut icon" href="../../public/dist/img/icone.png">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../public/bower_components/Ionicons/css/ionicons.min.css">
  <!--funcybox-->
  <link rel="stylesheet" href="../../public/plugins/fancybox/dist/jquery.fancybox.css"/> 
  <!-- Theme style -->
  <link rel="stylesheet" href="../../public/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../public/dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GISP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>GISP v1.1.1</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
                 <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background:red !important">
              <i class="fa fa-warning hidden"></i> <b>SISTEMA EM ATUALIZAÇÃO</b></a>
          </li>
                 <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-clock-o"></i> ' . date('d-m-Y') . '
            </a>
          </li>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">' . $totalsms . '</span>
            </a>
            <ul class="dropdown-menu hidden">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="../../public/dist/img/user.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../../public/dist/img/user.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          ';
//$queryc = mysqli_query($conexao, "SELECT chamado.*, cliente.nome FROM chamado
//  LEFT JOIN cliente ON chamado.idcliente = cliente.id WHERE chamado.idempresa='$idempresa' AND chamado.situacao <> 'SOLUCIONADO' GROUP BY nchamado") or die(mysqli_error($conexao));
//$totalchamados = mysqli_num_rows($queryc);

echo '<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">';
/* if ($totalchamados >= 1) {
  echo $totalchamados;
} else {
  echo '0';
} */
echo '</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">';
/* if ($totalchamados >= 1) {
  echo $totalchamados;
} else {
  echo '0';
} */
echo ' <b class="text-blue">notificaçes</b></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">';
/* if ($totalchamados >= 1) {
  while ($ret = mysqli_fetch_array($queryc)) {
    echo '
                    <li><a href="exibir-chamado.php?id=' . $ret['id'] . '"><i class="fa fa-headphones text-blue"></i>' .
      $ret['tipo'] . ' - ';
    if ($ret['situacao'] == 'ABERTO') {
      echo '<span class="label label-info">' . $ret['situacao'] . '</span>';
    }
    if ($ret['situacao'] == 'CANCELADO') {
      echo '<span class="label label-danger">' . $ret['situacao'] . '</span>';
    }
    if ($ret['situacao'] == 'REABERTO') {
      echo '<span class="label label-default">' . $ret['situacao'] . '</span>';
    }
    if ($ret['situacao'] == 'PENDENTE' or $ret['situacao'] == 'PENDENTE') {
      echo '<span class="label label-warning">' . $ret['situacao'] . '</span>';
    }
    echo '
                      </a></li>';
  }
} else {
  echo '
                <li><a href="#"><i class="fa fa-headphones"></i> Sem chamados abertos</a></li>';
} */
echo '
                </ul>
              </li>
              <li class="footer"><a href="chamados.php">Ver todos</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->';
/* $hoje = date('Y-m-d');
$queryr = mysqli_query($conexao, "SELECT valorpago FROM cobranca WHERE datapagamento='$hoje' AND idempresa='$idempresa' AND situacao='RECEBIDO'") or die(mysqli_error($conexao));
$recebido = mysqli_num_rows($queryr); */
echo '
          <li class="dropdown tasks-menu">
            <a href="cobrancas.php" title="Recebido hoje">
              <i class="fa fa-money"></i>
              <span class="label label-success">' . @$recebido . '</span>
            </a>
            <ul class="dropdown-menu hidden">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">';
/* if (!empty($_SESSION['logomarcauser'])) {
  $filename = 'logocli/' . $_SESSION['logomarcauser'];
  if (file_exists($filename)) {
    echo '<img src="logocli/' . $_SESSION['logomarcauser'] . '" class="user-image" alt="User Image">';
  } else {
    echo '<img src="dist/img/user.png" class="user-image" alt="User Image">';
  }
} else {
  echo '<img src="dist/img/user.png" class="user-image" alt="User Image">';
}
echo '              <span class="hidden-xs">' . primeiroNome(@$_SESSION['usuario']) . '</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">';
if (!empty($_SESSION['logomarcauser'])) {
  echo '<img src="../../public/dist/img/logocli/' . $_SESSION['logomarcauser'] . '" class="img-circle" alt="User Image">';
} else {
  echo '<img src="../../public/dist/img/user.png" class="img-circle" alt="User Image">';
} */
echo '
                <p>
                ' . $primeironome . ' - ' . $_SESSION['gisp_cargo'] . '
                  <small>Seja Bem Vindo</small>
                </p>
              </li>
              <!-- Menu Body -->              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">';
if ($_SESSION['gisp_tipouser'] == 'Admin') {
  echo '
                  <a href="perfil-usuario.php" class="btn btn-default btn-flat">Perfil</a>';
} else {
  echo '
                    <a href="perfil-usuario-staff.php?id=' . $_SESSION['gisp_iduser'] . '" class="btn btn-default btn-flat">Perfil</a>';
}
echo '
                </div>
                <div class="pull-right">
                  <a href="sair.php" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <li class="hidden">
            <a href="#" data-toggle="control-sidebar"title="Skins - Tema"><i class="fa fa-paint-brush"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="divRetorno" id="retorno"></div>';
include_once('menu.php');
