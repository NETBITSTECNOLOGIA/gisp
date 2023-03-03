<?php
include_once '../../components/permissao.php';

echo '
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">';
if (!empty($_SESSION['gisp_logomarcauser'])) {
  $filename = '../../public/dist/img/logocli/' . $_SESSION['gisp_logomarcauser'];
  if (file_exists($filename)) {
    echo '<img src="../../public/dist/img/logocli/' . $_SESSION['gisp_logomarcauser'] . '" class="img-circle" alt="User Image">';
  } else {
    echo '<img src="../../public/dist/img/user.png" class="img-circle" alt="User Image">';
  }
} else {
  echo '<img src="../../public/dist/img/user.png" class="img-circle" alt="User Image">';
}
echo '
        </div>
        <div class="pull-left info">
          <p>' . $primeironome . '</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       
        <li class="treeview clientes">
          <a href="#">
            <i class="fa fa-user"></i> <span>Cliente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
if (PermissaoCheck($_SESSION['gisp_idempresa'], 'clientes', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="clientes-busca"><a href="clientes.php"><i class="fa fa-circle-o text-primary"></i>Listar</a></li>';
}
if (PermissaoCheck($_SESSION['gisp_idempresa'], 'clientes-online', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="clientes-online"><a href="clientes-online.php"><i class="fa fa-circle-o text-primary"></i>Online</a></li>';
}

echo '
            <li id="clientes-pre"><a href="clientes-pre.php"><i class="fa fa-circle-o text-primary"></i>Pré-Cadastro</a></li>
          </ul>
        </li>

        <li class="treeview relatorios">
        <a href="#">
          <i class="fa fa-clipboard"></i> <span>Relatórios</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="relatorios-relatorio"><a href="relatorio-cliente.php"><i class="fa fa-circle-o"></i>Data de vencimento</a></li>
          <li id="relatorios-por-vencimento"><a href="clientes-por-vencimento.php"><i class="fa fa-circle-o text-primary"></i>Dia vencimento</a></li>
          <li id="relatorios-sem-cobranca"><a href="cobranca-relatorio-clientes-sem.php"><i class="fa fa-circle-o text-primary"></i>Sem cobrança</a></li>
          <li id="relatorios-relatorio-ativacao"><a href="relatorio-cliente-ativacao.php"><i class="fa fa-circle-o text-primary"></i>Data de ativação</a></li>
        </ul>
      </li>        

              
        <li class="treeview financeiro">
          <a href="#">
            <i class="fa fa-calculator"></i> <span>Financeiro</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'cobrancas', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="cobrancas"><a href="cobrancas.php"><i class="fa fa-circle-o text-primary"></i>Cobranças</a></li>';
}

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'controle-caixa', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="controle-caixa"><a href="controle-de-caixa.php"><i class="fa fa-circle-o text-primary"></i>Controle de caixa</a></li>';
}

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'gastos-mensais', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="gastos-mensais"><a href="gastos-mensais.php"><i class="fa fa-circle-o text-primary"></i>Gastos mensais</a></li>';
}


echo '    
          </ul>
        </li>        
        
        <li class="treeview parametros">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Parâmetros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'estoque', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="controle-estoque"><a href="controle-estoque.php"><i class="fa fa-circle-o text-primary"></i>Estoque</a></li>';
}

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'conf-de-cobranca', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="configuracoes"><a href="configuracoes-cobranca.php"><i class="fa fa-circle-o text-primary"></i>Parâmetros</a></li>';
}

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'usuarios', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="usuarios"><a href="usuarios.php"><i class="fa fa-circle-o text-primary"></i>Usuários</a></li>';
}

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'servidor', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="servidor"><a href="servidor.php"><i class="fa fa-circle-o text-primary"></i>Servidor</a></li>';
}

if (PermissaoCheck($_SESSION['gisp_idempresa'], 'alertas', $_SESSION['gisp_iduser']) == 'checked' or $_SESSION['gisp_tipouser'] == 'Admin') {
  echo '<li id="alertas"><a href="alertas.php"><i class="fa fa-circle-o text-primary"></i>Alertas APP</a></li>';
}
echo '  
          </ul>
        </li>

        <li id="chamados"><a href="chamados.php"><i class="fa fa-headphones"></i> <span>Chamados</span></a></li>
        <li><a href="verificar-pendente.php" target="_blank"><i class="fa fa-circle-o  text-primary"></i>Verificar pendentes</a></li>
        <li><a href="verificar-vencidos-bloqueio.php?idempresa=' . $_SESSION['idempresa'] . '" target="_blank"><i class="fa fa-circle-o  text-primary"></i>Verificar e bloquear</a></li> 
        <li><a href="desbloqueio-geral.php?idempresa=' . $_SESSION['idempresa'] . '" target="_blank"><i class="fa fa-circle-o  text-primary"></i>Desbloquear todos</a></li>        

        <li class="treeview mapa">
          <a href="#">
            <i class="fa fa-map-marker"></i> <span>Mapa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="mapa"><a href="mapa.php"><i class="fa fa-circle-o  text-primary"></i> Mapa</a></li>
          </ul>
        </li>';

if ($_SESSION['gisp_idempresa'] == 9999999999) {
  echo '
        <li class="treeview gestao">
          <a href="#">
            <i class="fa fa-gear"></i> <span>Gestão GISP</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="clientes2"><a href="clientes2.php"><i class="fa fa-circle-o  text-primary"></i>Usuários ISP</a></li>
            <li id="vpn"><a href="vpn-gisp.php"><i class="fa fa-circle-o  text-primary"></i>Usuários VPN</a></li>
            <li id="log-cobranca"><a href="log-cobrancas.php"><i class="fa fa-circle-o  text-primary"></i>Log cobranças</a></li>
            <li id="sms"><a href="sms.php"><i class="fa fa-circle-o  text-primary"></i>SMS Manual</a></li>
            <li id="log-sms"><a href="log-sms.php"><i class="fa fa-circle-o  text-primary"></i>Log SMS</a></li>
            <li><a href="sms-envia-automatico-antes.php" target="_blank"><i class="fa fa-circle-o  text-primary"></i>Automático SMS Antes</a></li>
            <li><a href="sms-envia-automatico-depois.php" target="_blank"><i class="fa fa-circle-o text-primary"></i>Automático SMS Depois</a></li> 
            <li><a href="areadev.php"><i class="fa fa-circle-o text-danger"></i>Tarefas DEV</a></li>
            <li><a href="controledeversao.php"><i class="fa fa-circle-o text-warning"></i>Controle de Versão</a></li>
          </ul>
        </li>';
}
echo '
      </ul>
    </section>
  </aside>';
