<?php
include_once('topo.php');
//verifica acesso
echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">   
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
            <div class="col-lg-4">
              <h3 class="box-title">Alertas</h3>
              </div>
              <div class="col-lg-8">';
if ($_SESSION['tipouser'] == 'Admin' || PermissaoCheck($idempresa, 'alertas-enviar', $iduser) == 'checked') {
  echo '
              	<button class="btn btn-primary" data-toggle="modal" data-target="#CadastrarAlerta"><i class="fa fa-plus"></i> Enviar</button>';
}
echo '
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="tabela"></div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!--./col-xs-12-->      
      </div>
      <!--/.row-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal alertas-->
<div class="modal" id="CadastrarAlerta" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Abrir chamado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formEnviarAlerta" autocomplete="off">
      <div class="modal-body">
        	<div class="row">
            <div class="col-lg-12">
                <label class="col-xs-12 col-lg-6 col-md-6 col-sm-12">Tipo
                <select type="text" class="form-control" name="tipo" required>
                  <option value="selecione">selecione</option>
                  <option value="Para todos">Para todos</option>
                  <option value="Único">Único</option>
              </select>
              </label>
            </label>
              <label class="col-xs-12 col-lg-6 col-md-6 col-sm-12">Cliente
                <select type="text" class="form-control" name="cliente" required>
                  <option value="0">Para todos</option>';
$queryc = mysqli_query($conexao, "SELECT cliente.id,nome,idempresa FROM cliente
                    WHERE idempresa='$_SESSION[idempresa]' ORDER BY nome ASC") or die(mysqli_error($conexao));
while ($c = mysqli_fetch_array($queryc)) {
  echo '<option value="' . $c['id'] . '">' . $c['nome'] . '</option>';
}
echo '
              </select>
              </label>
              <label class="col-xs-12 col-lg-12 col-md-12 col-sm-12">Descrição
                  <textarea rows="3" class="form-control" placeholder="Descrição" name="descricao"></textarea>
              </label>
	        	</div>
        	</div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>';
include_once('rodape.php');
?>
<script>
  $('.parametros').addClass('active menu-open');
  $('#alertas').addClass('active');
  //tabalertas
  $().ready(function() {
    tabela();
  })

  function tabela() {
    $.ajax({
      type: 'post',
      url: 'tab-alertas.php',
      data: 'html',
      success: function(data) {
        $('#tabela').html(data);
      }
    });
    return false;
  };
  //formEnviarAlerta
  $('#formEnviarAlerta').submit(function() {
    $('#CadastrarAlerta').modal('hide');
    $.post({
      type: 'post',
      url: 'insert-alerta.php',
      data: $('#formEnviarAlerta').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
        tabela();
      }
    });
    return false;
  });
</script>