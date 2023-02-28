<?php 
include_once('../topo.php');
include_once('./dashboard.php');
echo'
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content" style="font-size:75%; !important; ">
      <!-- linha 1-->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">';
        
          if(PermissaoCheck($idempresa,'dashboard-online',$iduser)=='checked' OR $_SESSION['tipouser'] == 'Admin' ){ echo'
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-gray">
            <a href="clientes-online.php"><span class="info-box-icon text-black"><i class="fa fa-link"></i></span></a>
                <div class="info-box-content mause">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number" style="display:none" id="online"></span>
                        <div class="progress">
                          <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                          Online
                        </span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->';}
          
          if(PermissaoCheck($idempresa,'dashboard-clientestotal',$iduser)=='checked' OR $_SESSION['tipouser'] == 'Admin' ){ echo'          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
            <a href="clientes.php">
              <span class="info-box-icon text-black"><i class="fa fa-users"></i></span>
               </a>
              <div class="info-box-content" onclick="exibirTotalClientes()">
                <span class="info-box-text">Clientes</span>
                <span class="info-box-number" style="display:none" id="totalclientes">'.$totClientes.'</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 50%"></div>
                </div>
                    <span class="progress-description">
                      Cadastrado
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->';}
          
          if(PermissaoCheck($idempresa,'dashboard-conlinecancelados',$iduser)=='checked' OR $_SESSION['tipouser'] == 'Admin' ){ echo'          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <a href="clientes-bloqueados.php"><span class="info-box-icon text-black"><i class="fa fa-user-times"></i></span> </a> 
              <div class="info-box-content">
                <span class="info-box-number">'.@$totCancelados.'</span>
                <div class="progress">
                  <div class="progress-bar" style="width: 50%"></div>
                </div>
                    <span class="progress-description">
                      Bloqueados
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>               
          <!-- /.col --> ';}
          
          if(PermissaoCheck($idempresa,'dashboard-chamados',$iduser)=='checked' OR $_SESSION['tipouser'] == 'Admin' ){ echo'          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
            <a href="chamados.php"><span class="info-box-icon"><i class="fa fa-headphones text-black"></i></span> </a> 
              <div class="info-box-content">
                <span class="info-box-text">Chamados</span>
                <span class="info-box-number">'.$totChamados.'</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 50%"></div>
                </div>
                    <span class="progress-description">
                      30 Dias
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>               
          <!-- /.col --> ';}
          
          echo'
        </div>
      </div>';
      
      if(PermissaoCheck($idempresa,'dashboard-cobrancas',$iduser)=='checked' OR $_SESSION['tipouser'] == 'Admin' ){ echo'
        <!-- financeiro -->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="col-md-3 col-sm-6 col-xs-12 mause" onclick="exibirTotalCobrancas()">
              <div class="info-box bg-gray">
                <span class="info-box-icon"><i class="ion ion-stats-bars"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">R$</span>
                  <span class="info-box-number" style="display:none" id="exibirTotalCobrancas">'.Real($rett['totalcobrancas']).'</span>
  
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Total cobranças
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>          
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-blue mause" onclick="exibirAbertas()">
                <span class="info-box-icon"><i class="fa fa-line-chart"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">R$</span>
                  <span class="info-box-number" style="display:none" id="exibirAbertas">'.Real($retabertas['totalabertas']).'</span>
  
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Em aberto (ano)
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>                
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red" onclick="totalAtraso()">
                <span class="info-box-icon"><i class="fa fa-pie-chart"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">R$</span>
                  <span class="info-box-number" style="display:none" id="totalAtraso">'.Real($retatraso['totalatraso']).'</span>
  
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Em atraso (até hoje)
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green" onclick="totalRecebidas()">
                <span class="info-box-icon"><i class="fa fa-area-chart"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">R$</span>
                  <span class="info-box-number" style="display:none" id="totalRecebidas" onclick="sometotalRecebidas()">'.Real($retrecebidas['totalrecebidas']).'</span>
  
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Efetuados
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        </div>';
      }echo'
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Links importantes</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <hr>
          <h5>Link de pré-cadastro: https://gisp.digital/acesso/cad-cliente.php?id='.$_SESSION['idempresa'].'</h5>
        <h5>Link: <a href="https://gisp.digital/acesso/cad-cliente.php?id='.$_SESSION['idempresa'].'"> Pré-cadastro</a></h5>
        <hr>
        <h5>Acesso cliente: https://gisp.digital/app/login.php?id='.$_SESSION['idempresa'].'</h4>
        <h5>Link Acesso cliente: <a href="https://gisp.digital/app/login.php?id='.$_SESSION['idempresa'].'"> Acesso cliente</a> </h5>
        </div>
        </div>
      </div>
      </div>';

      
      if(PermissaoCheck($idempresa,'dashboard-chamados',$iduser) == 'checked' || $_SESSION['tipouser'] == 'Admin'){
      echo'

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Chamados recentes</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-hover" style="font-size: 12px !important">
              <thead><tr>
                <th>#</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Data</th>
                <th>Situação</th>
              </tr>              
            </thead>
            <tbody id="tabelaChamado2"></tbody>
            </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>';}echo'
      </div>

      <div class="row">
      <div class="col-lg-12">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title">Meus Chamados</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <table class="table table-hover" style="font-size: 12px !important">
            <thead><tr>
              <th>#</th>
              <th>Tipo</th>
              <th>Nome</th>
              <th>Data</th>
              <th>Situação</th>
            </tr>              
          </thead>
          <tbody id="tabelaMeusChamados"></tbody>
          </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
      </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->';
include_once('rodape.php'); ?>
<script>
function exibirOnline() {
    $('#online').show();
}

function exibirTotalClientes() {
    $('#totalclientes').show();
}

function exibirTotalCobrancas() {
    $('#exibirTotalCobrancas').show();
}

function exibirAbertas() {
    $('#exibirAbertas').show();
}

function totalAtraso() {
    $('#totalAtraso').show();
}

function totalRecebidas() {
    $('#totalRecebidas').show();

} //
$().ready(function() {
    tabelaChamado2();
})

function tabelaChamado2() {
    $.ajax({
        type: 'post',
        url: 'tab-chamado-recentes.php',
        data: 'html',
        success: function(data) {
            $('#tabelaChamado2').show().html(data);
        }
    });
    return false;
};

$().ready(function() {
    tabelaMeusChamados();
})

function tabelaMeusChamados() {
    $.ajax({
        type: 'post',
        url: 'tab-chamado-tecnico.php',
        data: 'html',
        success: function(data) {
            $('#tabelaMeusChamados').show().html(data);
        }
    });
    return false;
};
</script>