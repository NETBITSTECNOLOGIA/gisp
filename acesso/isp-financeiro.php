<?php
include_once('topo.php');
$id = $_GET['idcliente'];
$query = mysqli_query($conexao, "SELECT * FROM user WHERE id='$id'") or die(mysqli_error($conexao));
$dd = mysqli_fetch_array($query);
echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12 col-xs-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#">Financeiro</a></li>             
                <li><a href="perfil-usuario-isp.php?id=' . $id . '">Dados IPS</a></li>
                <li class="pull-left header"><i class="fa fa-th"></i> Cliente ISP</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
              <div class="box-header">
                <center>     
                    <a href="#" data-toggle="modal" data-target="#modalGerarBoleto" class="btn btn-primary" style="margin:2px"><i class="fa fa-barcode"></i> Boleto</a>                   
                </center>
              </div>

                <div class="box-body panel box box-primary table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Nº</th>
                                <th>Data Venc.</th>
                                <th>Valor</th>
                                <th>Data Pag.</th>
                                <th>Valor Pag.</th>
                                <th>Situação</th>
                                <th>#</th>
                            </tr>
                        </tbody>
                        <tfoot id="tabela">
                            <h1>em desenvolvimento</h1>
                        </tfoot>
                    </table>
                </div>

              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->';

include_once('rodape.php');
?>
<script>
  $('#clientes2').addClass('active');
</script>