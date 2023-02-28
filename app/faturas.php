<?php
include_once('topo.php');
include_once('../acesso/conexao.php');

$fatura_atual = "SELECT * FROM cobranca WHERE idcliente='$idcliente' AND situacao = 'PENDENTE' ORDER BY vencimento ASC LIMIT 1";
$query_proximas = mysqli_query($conexao, "SELECT * FROM cobranca WHERE idcliente='$idcliente' ORDER BY vencimento ASC") or die(mysqli_error($conexao));
$query_pagas = mysqli_query($conexao, "SELECT * FROM notas WHERE idcliente='$idcliente' ORDER BY id DESC ") or die(mysqli_error($conexao));
?>

<body>
  <div>
    <!-- ------- ↓↓↓  FATURA ATUAL ↓↓ ------- -->
    <?php
    $resultado_a = mysqli_query($conexao, $fatura_atual);
    if (($resultado_a) and ($resultado_a->num_rows != 0)) {
      while ($row = mysqli_fetch_assoc($resultado_a)) {
        if ($row['situacao'] == 'PENDENTE' and $row['banco'] != 'Carteira') {
    ?>
          <main class="main_fat">
            <h3 class="title">FATURA ATUAL</h3>
            <div class="gallery" aria-label="gallery">
              <a class="gallery__item_venc">
                <h1 class="vlr_fat_atual">Valor R$:<?php echo Real($row['valor']); ?></h1>
                <h1 class="vnc_fat_atual">Vence em : <?php echo date('d-m-Y', strtotime($row['vencimento'])); ?></h1>
                <button type="button" class="btn btn-success details_pag" data-toggle="modal" data-target="#exampleModal">Pagar</button>
              </a>
            </div>
            <!-- Modal Detalhes-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <i style="margin-left: 4.5em;font-size: 3em;position: absolute;margin-top: 1.5em;color: #ff4949;" class="fa-solid fa-file-circle-exclamation"></i>
                  <div class="modal-body">
                    <?php
                    echo ' <h3>Valor R$: ' . Real($row['valor']) . '</h3>';
                    echo ' <h4>Vence em: ' . date('d-m-Y', strtotime($row['vencimento'])) . '</h4>';
                    echo "<h4> Status: Pendente </h4>";
                    echo "<h4> Forma: Boleto </h4>";
                    if ($row['codigobarra'] != '') {
                      echo '<div><center><h4>Código de barras</h4>
                <input text="text" class="form-control" id="codigobarras" value="' . $row['codigobarra'] . '"/><br>
                <button type="button"class="btn btn-primary" onclick="copiarBarras()">Cópiar cdigo de barras</button></center></div>';
                    }
                    ?>
                  </div>
                  <br>
                  <center>
                    <h6 style="color:red">*Seu Boleto estar disponível abaixo</h6>
                  </center>
                  <br>
                  <center>
                    <h6> pagamento em banco, app banker ou lotérica.</h6>
                  </center>
                  <div style="justify-content: center;" class="modal-footer">
                    <?php
                    if ($row['banco'] == 'Gerencianet' or $row['banco'] == 'Banco Juno') {
                      echo '<a target="blank" href="' . $row['link'] . '"> <button type="button"class="btn btn-success">Boleto</button></a>';
                    }
                    if ($row['banco'] == 'Banco do Brasil') {
                      echo '<a target="blank" href="../acesso/boleto/boleto_bb.php?id=' . $row['id'] . '" target="_blank"> <button type="button"class="btn btn-success">Boleto</button></a>';
                    }

                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
        } elseif ($row['banco'] == 'Carteira' && $row['situacao'] == 'PENDENTE') { ?>
            <main class="main_fat" role="main">
              <h3 class="title">FATURA ATUAL</h3>
              <div class="gallery" aria-label="gallery">
                <a class="gallery__item_venc">
                  <h1 class="vlr_fat_atual">Valor R$:<?php echo Real($row['valor']); ?></h1>
                  <h1 class="vnc_fat_atual">Vence em : <?php echo date('d-m-Y', strtotime($row['vencimento'])); ?></h1>
                  <button type="button" class="btn btn-success details_pag" data-toggle="modal" data-target="#exampleModal">Pagar</button>
                </a>
              </div>
              <!-- Modal Detalhes-->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <i style="margin-left: 4.5em;font-size: 4em;position: absolute;margin-top: 1.5em;color: #ff4949;" class="fa-solid fa-file-circle-exclamation"></i>
                    <div class="modal-body">
                      <?php
                      echo ' <h3>Valor R$: ' . Real($row['valor']) . '</h3>';
                      echo ' <h4>Vence em: ' . date('d-m-Y', strtotime($row['vencimento'])) . '</h4>';
                      echo "<h4> Status: Pendente </h4>";
                      echo "<h4> Forma: Carnê pago na empresa </h4>";
                      ?>
                    </div>
                    <br>
                    <center>
                      <h6 style="color:red">*Seu Carnê está disponível abaixo</h6>
                      <h6>Carnê: pagamento empresa/escritório ou sua residência.</h6>
                    </center>
                    <div style="justify-content: center;" class="modal-footer">
                      <button type="button" class="btn btn-primary">NA EMPRESA</button>
                    </div>
                  </div>
                </div>
              </div>
        <?php
        }
      }
    } else {
      echo '<main class="main" role="main" style="margin-bottom:-4em">
        <center><h5 style="margin-top: 1em;background: #baffba;width: 75%;border-radius: 0.2em;font-size: 1.2em;padding: 0.5em;border: 1px solid #7ad67a;font-family: bebas;font-weight: 100;">Atualmente Você não tem cobranças </h5> <center></main>';
    }
        ?>
        <!-- ------- ↓↓ TABLES PROXIMAS FATURAS ↓↓↓ ------- -->
        <main class="main2" role="main">
          <h3 style="background: #d9d9d9;border-radius: 0.2em;" class="title">PRÓXIMAS FATURAS</h3>
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">VALOR</th>
                <th scope="col">VENCIMENTO</th>
                <th scope="col">PAGAMENTO</th>
              </tr>
            </thead>
            <tbody><?php
                    if ($rows = mysqli_num_rows($query_proximas) >= 1) {
                      while ($ddc = mysqli_fetch_array($query_proximas)) {
                        if ($ddc['situacao'] == 'PENDENTE') {
                          echo '
                <tr>
                  <th scope="row"><i style="color:#60a4df" class="fa-solid fa-calendar-days"></i></th>
                  <td>' . Real($ddc['valor']) . '</td>
                  <td>' . date('d-m-Y', strtotime($ddc['vencimento'])) . '</td><td>';
                          if ($ddc['banco'] == 'Gerencianet' or $ddc['banco'] == 'Banco Juno') {
                            echo '<a target="blank" href="' . $ddc['link'] . '"> <button type="button"class="btn btn-success  gera_bol_lite">Boleto</button></a>';
                          }

                          if ($ddc['banco'] == 'Banco do Brasil') {
                            echo '<a target="blank" href="../acesso/boleto/boleto_bb.php?id=' . $ddc['id'] . '" target="_blank"> <button type="button"class="btn btn-success  gera_bol_lite">Boleto</button></a>';
                          }

                          if ($ddc['banco'] == 'Carteira') {
                            echo '<button type="button"class="btn btn-primary gera_carne_lite">EMPRESA</button>';
                          }
                          echo '
                  </td>
                </tr>';
                        }
                      }
                    } ?>
            </tbody>
          </table>
        </main>

        <!-- ------- ↓↓↓ TABLES FATURAS VENCIDAS ↓↓ ------- -->
        <main class="main4" role="main">
          <h3 style="background: #d9d9d9;border-radius: 0.2em;" class="title">FATURAS VENCIDAS</h3>
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">VALOR</th>
                <th scope="col">VENCIMENTO</th>
                <th scope="col">PAGAMENTO</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query_vencido = "SELECT * FROM cobranca WHERE idcliente='$idcliente' ORDER BY id DESC";
              $resultado_f = mysqli_query($conexao, $query_vencido);
              if (($resultado_f) and ($resultado_f->num_rows >= 1)) {
                while ($v = mysqli_fetch_assoc($resultado_f)) {
                  if ($v['situacao'] == 'VENCIDO') {
              ?>
                    <tr>
                      <th scope="row"><i style="color:#ff7575" class="fa-solid fa-circle-exclamation"></i></th>
                      <td><?php echo Real($v['valor']); ?></td>
                      <td><?php echo date('d-m-Y', strtotime($v['vencimento'])); ?></td>
                      <td>
                        <?php
                        if ($v['banco'] == 'Carteira') {
                          echo '<button type="button"class="btn btn-primary gera_carne_lite">EMPRESA</button>';
                        } else {
                          echo '<a target="blank" href="' . $v['link'] . '"> <button type="button"class="btn btn-success gera_bol_lite">BOLETO</button></a>';
                        }
                        ?>
                      </td>
                    </tr>
              <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>
        </main>
        <!-- ------- ↓↓↓ TABLES FATURAS PAGAS ↓↓↓ ------- -->
        <main class="main3" role="main">
          <h3 style="background: #d9d9d9;border-radius: 0.2em;" class="title">NOTAS EMITIDAS</h3>
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">DESCRIÇÃO</th>
                <th scope="col">VENCIMENTO</th>
                <th scope="col">NOTA</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($rows = mysqli_num_rows($query_pagas) >= 1) {
                while ($ddc = mysqli_fetch_array($query_pagas)) {

              ?>
                  <tr>
                    <th scope="row"><i style="color:green" class="fa-solid fa-file"></i></th>
                    <td><?php echo $ddc['descricao']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($ddc['vencimento'])); ?></td>
                    <td><?php
                        if ($ddc['nota'] != '') {
                          echo
                          '<a href="../acesso/notas/' . $ddc['nota'] . '" download class="btn btn-primary text-white"><i class="fa-solid fa-note-sticky text-white"></i> Baixar</a>';
                        ?>
                    </td>
                  </tr>
  </div>
<?php
                        }
                      }
                    }
?>
</tbody>
</table>
</main>
</main> <!-- main raiz -->
<?php include_once("rodape.php"); ?>
</body>
<!-- bootstrap js and jquery -->
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
  function copiarBarras() {
    var tt = document.getElementById('codigobarras');
    tt.select();
    document.execCommand("Copy");
  }
</script>

</html>