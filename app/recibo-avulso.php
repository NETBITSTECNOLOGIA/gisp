<?php
include_once 'topo.php';
echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">   
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Recibo avulso</h3>
              <div class="box-tools pull-right">';
if ($_SESSION['tipouser'] == 'Admin' or PermissaoCheck($idempresa, 'recibos-emitir', $iduser) == 'checked') {
  echo '
              	<button class="btn btn-primary" data-toggle="modal" data-target="#modalcadastrar"><i class="fa fa-plus"></i> Emitir</button>';
}
echo '
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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

<!-- cadastrar-->
<div class="modal" id="modalcadastrar" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formcadastrar">
      <div class="modal-body">
        	<div class="row">
        		<div class="col-lg-12">
	        		<label class="col-lg-12">Nome<small class="text-red">*obrigatório</small>
		        		<input type="text" class="form-control" placeholder="Nome" name="nome" required/>
		        	</label>
		        	<label class="col-lg-12">CPF/CNPJ <small class="text-red">*obrigatório</small>
			        	<input type="number" class="form-control" placeholder="Apenas números" name="cpf_cnpj" required/>
		        	</label>
		        	<label class="col-lg-12">Referente/Descrição
			        	<textarea rows="3" class="form-control" placeholder="Refente a:" name="descricao"></textarea>
		        	</label>
		        	<label class="col-lg-12">Valor
			        	<input type="text" class="form-control real" placeholder="Valor" name="valor"/>
		        	</label>
		        	<label class="col-lg-12">Data
			        	<input type="date" class="form-control" placeholder="Data" name="data"/>
		        	</label>
	        	</div>
        	</div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- cadastrar-->

<!-- alterar-->
<div class="modal" id="modalalterar" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alterar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formalterar">
      <div class="modal-body">
        	<div class="row">
        		<div class="col-lg-12" id="retornoRecibo">	        		
	        	</div>
        	</div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- alterar-->';

include_once('rodape.php');
?>
<script>
  $('.financeiro').addClass('active menu-open');
  $('#reciboavulso').addClass('active');
  //tabCli
  $().ready(function() {
    tabela();
  })

  function tabela() {
    $.ajax({
      type: 'post',
      url: 'tab-recibo-avulso.php',
      data: 'html',
      success: function(data) {
        $('#tabela').html(data);
      }
    });
    return false;
  };
  //cadastrar
  $('#formcadastrar').submit(function() {
    $('#modalcadastrar').modal('hide');
    $.post({
      type: 'post',
      url: 'insert-recibo.php',
      data: $('#formcadastrar').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
        tabela();
        $('#formcadastrar').each(function() {
          this.reset();
        });
      }
    });
    return false;
  });
  //alterar
  function alterar(id) {
    $('#modalalterar').modal('show');
    $.get('retorno-recibo.php', {
      id: id
    }, function(data) {
      $('#retornoRecibo').show().html(data);
    });
    return false;
  }
  $('#formalterar').submit(function() {
    $('#modalalterar').modal('hide');
    $.post({
      type: 'post',
      url: 'insert-recibo.php',
      data: $('#formalterar').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
        window.setTimeout(function() {
          history.go();
        }, 3001);
      }
    });
    return false;
  });
  //excluir
  function excluir(id) {
    var r = confirm("Deseja excluir?");
    if (r == true) {
      $('#processando').modal('show');
      $.get('excluir-recibo.php', {
        id: id
      }, function(data) {
        $('#processando').modal('hide');
        $('#retorno').show().fadeOut(6000).html(data);
        window.setTimeout(function() {
          history.go();
        }, 3001);

      });
      return false;
    }
  }
</script>