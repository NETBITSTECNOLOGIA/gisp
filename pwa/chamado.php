<?php
include_once 'topo.php';
echo '
<style>
body{
  background: #ecf0f5 !important;
}
</style> 
      <div class="row" style="font-size: 14px; margin: 8px;";>
        <div style="text-align:center;" class="col-lg-12">
          <div class="page-header" style="text-align:center;">
            <h4 style="margin-top: 1em;font-family: bebas;letter-spacing: 1px;font-size: 2.5em;background: #d9d9d9;border-radius: 0.2em;">CHAMADOS DE SUPORTE</h4>
            <center><a href="abrir-chamado.php" style="margin-bottom: 1em;" class="btn btn-primary">ABRIR CHAMADO</a></center>
          </div>
              <div>
                </div>
                  <div> 
                  <main class="main2" role="main">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Status</th>
                        <th scope="col">Protocolo</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Abertura</th>
                      </tr>
                    </thead>
                    <tbody>';
$query0 = mysqli_query($conexao, "SELECT * FROM chamado WHERE idcliente='$idcliente' ORDER BY datacad ASC") or die(mysqli_error($conexao));
if ($rows = mysqli_num_rows($query0) >= 1) {
  while ($ddc = mysqli_fetch_array($query0)) {
    if ($ddc['situacao'] ==  'SOLUCIONADO') {
      echo '<tr onclick="exibir(' . $ddc['id'] . ')">
                      <td><i style="color: green; font-size:1.7em;" class="fa-solid fa-circle-check"></i></td>
                      <td>' . $ddc['nchamado'] . '</td>
                      <td>' . $ddc['tipo'] . '</td>
                      <td>' . date('d-m-Y', strtotime($ddc['datacad'])) . '</td>
                    </tr>';
    } else {
      echo '<tr onclick="exibir(' . $ddc['id'] . ')">
                        <td><i style="color: red; font-size:1.7em;" class="fa-solid fa-triangle-exclamation"></i></td>
                        <td>' . $ddc['nchamado'] . '</td>
                        <td>' . $ddc['tipo'] . '</td>
                        <td>' . date('d-m-Y', strtotime($ddc['datacad'])) . '</td>
                      </tr>';
    }
  }
} else {
  echo ' 
                  <h5 style="margin-top:2em;margin-left: 0.5em;text-aling:center;">SEM CHAMADOS</h5>';
}
echo '
                  </tbody>
                 </table>  
                </main>
                <main class="main4" role="main">
                <hr style="border-top: 2px solid #00000036;margin-top: 1em;" class="hr">
                  <h3 class="title">LEGENDAS</h3>           
                    <h6>Chamado Solucionado </6><i style="color: green; font-size:1.7em;" class="fa-solid fa-circle-check"></i>
                    <h6>Chamado em aberto </6><i style="color: red; font-size:1.7em; text-aling:right;margin-left: 0.5em;" class="fa-solid fa-triangle-exclamation"></i>
                </main>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>         
          ';
include_once 'rodape.php'; ?>
<script>
  function exibir(id) {
    window.location.href = 'exibir-chamado.php?id=' + id;
  }
</script>