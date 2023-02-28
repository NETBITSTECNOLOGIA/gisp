<?php
include_once('topo.php');

echo '
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">   
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">          
            <!-- /.box-header -->
            <div class="box-body">

                <div class="box-header ui-sortable-handle">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Lista de tarefa</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCad"><i class="fa fa-plus"></i> Add tarefa</button>
                    </div>
                </div>    

                <div class="box-body">            
                  <div class="table-responsive no-padding">
                    <table class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                                <th>Área</th>
                                <th>Descrição</th>
                                <th>Criação</th>
                                <th>Conclusão</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaDev">
                        <tbody>
                    </table>
                  </div>
                </div> 

            </div>
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
<!-- /.content-wrapper -->';


echo '
<!-- modal-->
<div class="modal" id="modalCad" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tarefa DEV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formCad" autocomplete="off" enctype="multipart/form-data">
      <div class="modal-body">
        	<div class="row"> 

            <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Área
            <select type="text" class="form-control" name="area" required>
              <option value="">selecione</option>
              <option value="Cliente">Cliente</option>
              <option value="Financeiro">Financeiro</option>
              <option value="Parametros">Parametros</option>
              <option value="Chamados">Chamados</option>
              <option value="Usuaários-ISP">Usuários-ISP</option>
              <option value="Relatórios">Relatórios</option>
            </select>
            </label>
           
            <label class="col-lg-12">Descrição
            <textarea rows="6" class="form-control" placeholder="Descreva a tarefa" name="descricao" required></textarea>
            </label>

            <label class="col-lg-12">Imagem (JPG OU JPEG)
              <input type="file" class="form-control" name="arquivo" accept="image/jpg, image/jpeg"/>
            </label>

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
<!-- modal-->';

echo '
<!-- modal-->
<div class="modal" id="modalExibir" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tarefa DEV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row" id="retornoExibir"></div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- modal-->';

echo '
<!-- modal-->
<div class="modal" id="modalEditar" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tarefa DEV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formEditar" autocomplete="off" enctype="multipart/form-data">
      <div class="modal-body">
        	<div class="row" id="retornoEditar"></div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal-->';
include_once('rodape.php');
?>
<script>
  $().ready(function() {
    tabela();
  });

  function tabela() {
    $.ajax({
      type: 'post',
      url: 'areadev-tab.php',
      data: 'html',
      success: function(data) {
        $('#tabelaDev').show().html(data);
      }
    });
    return false;
  };

  $('#formCad').submit(function() {
    $('#modalCad').modal('hide');
    $('#processando').modal('show');
    var formData = new FormData(this);
    $.ajax({
      type: 'post',
      url: 'insert-tarefa.php',
      data: formData,
      success: function(data) {
        $('#processando').modal('hide');
        $('#retorno').show().html(data);
        tabela();
      },
      cache: false,
      contentType: false,
      processData: false,
    });
    return false;
  });
  //
  function excluir(id) {
    $.get('insert-tarefa.php', {
      id: id
    }, function(data) {
      $('#retorno').show().html(data);
      tabela();
    });
    return false;
  }
  //
  function exibir(id) {
    $('#modalExibir').modal('show');
    $.get('areadev-retorno.php', {
      id: id
    }, function(data) {
      $('#retornoExibir').show().html(data);
    });
    return false;
  }

  function editar(id) {
    $('#modalEditar').modal('show');
    $.get('areadev-retorno-editar.php', {
      id: id
    }, function(data) {
      $('#retornoEditar').show().html(data);
    });
    return false;
  }
  $('#formEditar').submit(function() {
    $('#modalEditar').modal('hide');
    $('#processando').modal('show');
    var formData = new FormData(this);
    $.ajax({
      type: 'post',
      url: 'update-tarefa.php',
      data: formData,
      success: function(data) {
        $('#processando').modal('hide');
        $('#retorno').show().html(data);
        tabela();
      },
      cache: false,
      contentType: false,
      processData: false,
    });
    return false;
  });
</script>