<?php
include_once 'topo.php';
include_once('api_sms.php');
@$totalsms = saldoSms($idempresa, $conta);
@$todos = todosClientes();
@$ativo = todosAtivo();
@$bloqueado = todosBloqueado();
@$cancelado = todosCancelado();
echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content" style="font-size:75%; !important; ">
      <div class="row">
      <div class="col-xs-12">
          <!-- interactive chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-commenting"></i>

              <h3 class="box-title">SMS - Saldo: ' . @$totalsms . '</h3>

              <div class="box-tools pull-right">
                <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                </div>
              </div>
            </div>
            <div class="box-body">
            <form id="formEncurtar" autocomplete="off">
                <div class="col-lg-8 col-sm-12">
                <label class="form-label">Encurtar link</label>
                <input type="text" class="form-control" placeholder="Cole aqui seu link" name="link" required/>
                </div>  
                
                <div class="col-lg-2  col-sm-12">
                <label class="form-label"><br></label><br>
                    <button type="submit" class="btn btn-primary">Encurtar</button>
                </div>
                <div class="col-lg-12  col-sm-12">
                    <p class="fa-2x text-red" id="linkcurto"></p>
                </div>
            </form>
            <div class="row"></div><hr>
            <form id="formSms">            
                <label class="col-lg-4  col-sm-12">Tipo
                    <select class="form-control" name="tipo" id="tipo" required>
                        <option value="Manual">Manual</option>
                        <option value="Todos">Todos</option>
                    </select>
                </label>
               
                <label class="col-lg-4  col-sm-12 todos" style="display:none">Todos
                    <input type="text" class="form-control" name="todos" value="' . @$todos . '" readonly/>
                </label>
                
                  <label class="col-lg-4  col-sm-12 ativos" style="display:none">Ativo
                    <input type="text" class="form-control" name="ativo" value="' . @$ativo . '" readonly/>
                </label>
                
                  <label class="col-lg-4  col-sm-12 bloqueado" style="display:none">Bloqueado
                    <input type="text" class="form-control" name="bloqueado" value="' . @$bloqueado . '" readonly/>
                </label>
                
                  <label class="col-lg-4  col-sm-12 cancelado" style="display:none">Cancelado
                    <input type="text" class="form-control" name="cancelado" value="' . @$cancelado . '" readonly/>
                </label>
           
                <label class="col-lg-4  col-sm-12 manual" style="display:none">Digite o telefone
                    <input type="text" class="form-control celular manual" placeholder="Número" name="manual"/>
                </label>
               
                <label class="col-lg-12  col-sm-12">Texto do sms (mínimo 20 caracteres)
                <textarea row="3" class="form-control" placeholder="Texto do SMS até 160 caracteres pra cada SMS" name="mensagem" id="textosms" minlength="20" maxlength="160" required></textarea>
                Total de caracteres: <i class="totaltexto" style="font-size: 18px;"></i>
                </label>  
                
                <div class="row"></div><br> 

                    <center>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </center>
                </div>                             
            </form> 
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

        </div>

      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->';
include_once('rodape.php'); ?>
<script>
  $('.gestao').addClass('active menu-open');
  $('#sms').addClass('active');
  //encurtar link
  $('#formEncurtar').submit(function() {
    $('#processando').modal('show');
    $.ajax({
      type: 'post',
      url: 'sms-encurtar-link.php',
      data: $('#formEncurtar').serialize(),
      success: function(data) {
        $('#processando').modal('hide');
        $('#linkcurto').show().html(data);
      }
    });
    return false;
  });
  //contar texto
  var espaco = 0;
  $('#textosms').focus();
  $('#textosms').keyup(function(e) {
    if (e.keyCode == 8 || e.keyCode == 46) {
      espaco = 0;
      $('#textosms').val("");
    }
    var text = $('#textosms').val();
    if (text[text.length - 1] != ' ') {
      $('.totaltexto').text((text.length));
    } else {
      espaco++;
    }
  });
  //tipo
  $(function($) {
    $('#tipo').on('change', function() {
      var valor = $(this).val();
      if (valor == 'Todos') {
        $('.todos').show();
        $('.manual').hide().removeAttr('required', false);

      } else {
        $('.manual').show();
        $('.todos').hide().removeAttr('required', false);
      }
    }).trigger('change');
  });
  //formSms
  $('#formSms').submit(function() {
    $('#enviando').modal('show');
    $.ajax({
      type: 'post',
      url: 'sms-envia-manual.php',
      data: $('#formSms').serialize(),
      success: function(data) {
        $('#enviando').modal('hide');
        $('#retorno').show().fadeOut(10000).html(data);
      }
    });
    return false;
  });
</script>