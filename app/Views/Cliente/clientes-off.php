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
<?php
include_once 'topo.php';
echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Clientes off-line</h3>

              <div class="hidden box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <div class="card-body table-responsive p-0">
              <table id="example" style="width:100%">
                <thead><tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Plano</th>
                  <th>#</th>
                </tr></thead><tbody>';
//se houver session mikrotik ativa

$query0 = mysqli_query($conexao, "SELECT * FROM servidor WHERE idempresa='$idempresa' LIMIT 1") or die(mysqli_error($conexao));
$retS = mysqli_fetch_array($query0);
require_once 'routeros_api_class.php';
$mk = new RouterosAPI();
$mk->connect($retS['ip'], decrypt($retS['user']), decrypt($retS['password']));
$query = mysqli_query($conexao, "SELECT cliente.login,cliente.plano,cliente.porta, plano.plano AS nomeplano FROM cliente 
                  LEFT JOIN plano ON cliente.plano = plano.id
                  WHERE cliente.idempresa='$idempresa' ORDER BY cliente.login ASC") or die(mysqli_error($conexao));
$tt = mysqli_num_rows($query);
$n = 1;
for ($i = 1; $i <= $tt; $i++) {
  @$ret = mysqli_fetch_array($query);
  @$id = $ret['id'];
  @$login = utf8_decode($ret['login']);
  @$plano = $ret['nomeplano'];
  $find = @$mk->comm("/ppp/active/print", array("?name" => $login));
  if (count($find) == 0) {
    echo '
                            <tr style="color:red">
                              <td>' . $n . '</td>
                              <td><a href="clientes-exibir.php?id=' . $id . '">' . $login . '</a></td>
                              <td>';
    if (!empty($plano)) {
      echo $plano;
    } else {
      echo 'sem';
    }
    echo '</td>
                              <td><i class="fa fa-circle" style="color:red"></i> off-line</td>
                            </tr>';
    $n++;
  }
}
echo '
              </tbody></table>
              </div>             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->';

include_once('rodape.php'); ?>

<script type="text/javascript" src="plugins/dataTable/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="plugins/dataTable/jquery.dataTables.min.css" />
<script>
  $('.clientes').addClass('active menu-open');
  $('#clientes-offline').addClass('active');
  $().ready(function() {
    $('#example').DataTable({
      "language": {
        "lengthMenu": "Exibir _MENU_ linhas",
        "zeroRecords": "Sem registro",
        "info": "Linhas de _PAGE_ at&eacute; _PAGES_",
        "infoEmpty": "Nenhum registro dispon&iacute;vel",
        "infoFiltered": "(filtrados de _MAX_ total de linhas)"
      },
      stateSave: true,
      "order": [
        [0, "asc"]
      ],
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ]
    });
  });
</script>