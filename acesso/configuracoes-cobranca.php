<?php
include_once('topo.php');
$query0 = mysqli_query($conexao, "SELECT * FROM dadoscobranca WHERE idempresa='$idempresa'") or die(mysqli_error($conexao));
if (mysqli_num_rows($query0) >= 1) {
  $dd0 = mysqli_fetch_array($query0);
}

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
$url = str_replace("configuracoes-cobranca.php", "", $url . 'notificacoes.php');

echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">  

     <form method="post" id="formDadosCobranca">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Parâmetros</h3>
              <div class="box-tools pull-right">
              	<button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o"></i> Salvar</button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <input type="text" class="hidden" name="idempresa" value="' . @$dd0['idempresa'] . '"/>                  
                <label class="col-lg-3 col-md-3 col-sm-6">Após vencimento
                  <input type="number" class="form-control" name="aposvencimento" value="' . @$dd0['aposvencimento'] . '" required/>
                </label>
                <label class="col-lg-3 col-md-3 col-sm-6">Dias p/ desconto
                  <input type="text" class="form-control" placeholder="Exemplo:5 dias antes" name="diasdesconto" value="' . @$dd0['diasdesconto'] . '"/>
                </label>
                <label class="col-lg-3 col-md-3 col-sm-6">Desconto
                  <input type="text" class="form-control real" name="valordesconto" value="' . Real(@$dd0['valordesconto']) . '"/>
                </label>
                <label class="col-lg-3 col-md-3 col-sm-6">Multa 
                  <input type="text" class="form-control real" name="multaapos" value="' . Real(@$dd0['multaapos']) . '"/>
                </label>
                <label class="col-lg-3 col-md-3 col-sm-6">Juros
                  <input type="text" class="form-control real" name="jurosapos" value="' . Real(@$dd0['jurosapos']) . '"/>
                </label>
                <label class="col-lg-3 col-md-3 col-sm-6">Dias/bloqueio 
                  <input type="number" class="form-control" name="diasbloqueio" value="' . @$dd0['diasbloqueio'] . '"/>
                </label>
                <label class="col-lg-3 col-md-3 col-sm-6">Bloqueio
                    <select type="text" class="form-control" name="bloqueioautomatico" required>';
if (!empty($dd0['bloqueioautomatico'])) {
  echo '<option value="' . $dd0['bloqueioautomatico'] . '">' . $dd0['bloqueioautomatico'] . '</option>';
}
echo '
                        <option value="sim">sim</option>
                        <option value="não">não</option>
                    </select>
                </label>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!--./col-xs-12-->      
      </div>
      </form>';

$query = mysqli_query($conexao, "SELECT * FROM dadoscobranca WHERE idempresa='$idempresa' AND recebercom='Banco Juno'") or die(mysqli_error($conexao));
if (mysqli_num_rows($query) >= 1) {
  $dd = mysqli_fetch_array($query);
}
echo '

      <form method="post" id="formDadosCobrancaJuno">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Banco JUNO</h3>
              <div class="box-tools pull-right">
              	<button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o"></i> Salvar</button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <input type="text" class="hidden" name="id" value="' . @$dd['id'] . '"/>
                  <label class="col-lg-4 col-md-4 col-sm-6">Receber com:
                      <input type="text" class="form-control" name="recebercom" value="Banco Juno" readonly/>
                  </label>                
                  <label class="col-lg-12 col-md-12 col-sm-12">Token privado
                    <input type="text" class="form-control" name="tokenprivado" value="' . AspasForm(@$dd['tokenprivado']) . '"/>
                  </label>
                  <label class="col-lg-6 col-md-6 col-sm-6">Cliente id
                    <input type="text" class="form-control" name="clienteid" value="' . AspasForm(@$dd['clienteid']) . '"/>
                  </label>
                  <label class="col-lg-6 col-md-6 col-sm-6">Cliente secret
                    <input type="text" class="form-control" name="clientesecret" value="' . AspasForm(@$dd['clientesecret']) . '"/>
                  </label>
                  <label class="col-lg-6 col-md-6 col-sm-6">Chave PIX aleatória
                    <input type="text" class="form-control" name="chavepixaleatoria" value="' . AspasForm(@$dd['chavepixaleatoria']) . '"/>
                  </label>
                  <label class="col-lg-6 col-md-6 col-sm-6">Segunda chave PIX <i class="text-red">*(para cliente fazer o pix direto)</i>
                    <input type="text" class="form-control" name="chavepixsecundaria" value="' . AspasForm(@$dd['chavepixsecundaria']) . '"/>
                  </label>
                  <label class="col-lg-12 col-md-12 col-sm-12">URL de notificação de pagamento
                    <input type="text" class="form-control" name="url" value="' . $url . '" readonly/>
                  </label>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!--./col-xs-12-->      
      </div>
      </form>';

$query2 = mysqli_query($conexao, "SELECT * FROM dadoscobranca WHERE idempresa='$idempresa' AND recebercom='Gerencianet'") or die(mysqli_error($conexao));
if (mysqli_num_rows($query2) >= 1) {
  $dd2 = mysqli_fetch_array($query2);
}
echo '
      <form method="post" id="formDadosCobrancaGerencianet">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Banco Gerencianet</h3>
              <div class="box-tools pull-right">
              	<button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o"></i> Salvar</button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <input type="text" class="hidden" name="id" value="' . @$dd2['id'] . '"/>

                <label class="col-lg-4 col-md-4 col-sm-6">Banco
                    <input type="text" class="form-control" name="recebercom" value="Gerencianet" readonly/>
                </label>
                <div class="row"></div><br />
                  <label class="col-lg-6 col-md-6 col-sm-6">Cliente id
                    <input type="text" class="form-control" name="clienteid" value="' . AspasForm(@$dd2['clienteid']) . '"/>
                  </label>
                  <label class="col-lg-6 col-md-6 col-sm-6">Cliente secret
                    <input type="text" class="form-control" name="clientesecret" value="' . AspasForm(@$dd2['clientesecret']) . '"/>
                  </label>
                  <label class="col-lg-12 col-md-12 col-sm-12">URL de notificação de pagamento
                  <input type="text" class="form-control" name="url" value="' . $url . '" readonly/>
                </label>               
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!--./col-xs-12-->      
      </div>
      </form>';

$query3 = mysqli_query($conexao, "SELECT * FROM dadoscobranca WHERE idempresa='$idempresa' AND recebercom='Banco do Brasil'") or die(mysqli_error($conexao));
if (mysqli_num_rows($query3) >= 1) {
  $dd3 = mysqli_fetch_array($query3);
}
echo '
      <form method="post" id="formDadosCobrancaBB">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Banco do Brasil</h3>
              <div class="box-tools pull-right">
              	<button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o"></i> Salvar</button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <input type="text" class="hidden" name="id" value="' . @$dd3['id'] . '"/>

                <label class="col-lg-4 col-md-4 col-sm-6">Banco
                    <input type="text" class="form-control" name="recebercom" value="Banco do Brasil" readonly/>
                </label>
                <div class="row"></div><br />

              <label class="col-lg-4 col-md-4 col-sm-4">Contrato
                <input type="text" class="form-control" name="contrato" value="' . @$dd3['contrato'] . '"/>
              </label>
              <label class="col-lg-2 col-md-2 col-sm-4">Agência
                <input type="text" class="form-control" name="agencia" value="' . @$dd3['agencia'] . '"/>
              </label>
              <label class="col-lg-2 col-md-2 col-sm-4">Conta sem digito
                <input type="text" class="form-control" name="conta" value="' . @$dd3['conta'] . '"/>
              </label>
              <label class="col-lg-4 col-md-4 col-sm-4">Código do cedente
                <input type="text" class="form-control" name="codigocedente" value="' . @$dd3['codigocedente'] . '"/>
              </label>
              <div class="row"></div>

                  <label class="col-lg-4 col-md-4 col-sm-4">Convênio
                    <input type="text" class="form-control" name="convenio" value="' . @$dd3['convenio'] . '"/>
                  </label>
                  <label class="col-lg-4 col-md-4 col-sm-4">Carteira
                    <input type="text" class="form-control" name="carteira" value="' . @$dd3['carteira'] . '"/>
                  </label>
                  <label class="col-lg-4 col-md-4 col-sm-4">Variação carteira
                    <input type="text" class="form-control" name="variacaocarteira" value="' . @$dd3['variacaocarteira'] . '"/>
                  </label>

                <label class="col-lg-4 col-md-4 col-sm-6">APP KEY
                  <input type="text" class="form-control" name="keydev" value="' . AspasForm(@$dd3['keydev']) . '"/>
                </label>
                <label class="col-lg-4 col-md-4 col-sm-6">Cliente id
                  <input type="text" class="form-control" name="clienteid" value="' . AspasForm(@$dd3['clienteid']) . '"/>
                </label>
                <label class="col-lg-4 col-md-4 col-sm-6">Cliente secret
                  <input type="text" class="form-control" name="clientesecret" value="' . AspasForm(@$dd3['clientesecret']) . '"/>
                </label>
                <label class="col-lg-12 col-md-12 col-sm-12">URL de notificação de pagamento
                <input type="text" class="form-control" name="url" value="' . $url . '" readonly/>
              </label>
               
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!--./col-xs-12-->      
      </div>
      </form>

      
   
      <!--/.row-->';

$query4 = mysqli_query($conexao, "SELECT * FROM dadoscobranca WHERE idempresa='$idempresa'") or die(mysqli_error($conexao));
$dd4 = mysqli_fetch_array($query4);

if ($idempresa == 9999999999) {
  echo '
      <form method="post" id="formDadosCobranca2">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">SMS</h3>
              <div class="box-tools pull-right">
              	<button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o"></i> Salvar</button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">   
            
            <h4>Site da empresa para contratar pacote de SMS: <a href="https://comtele.com.br/" target="_blank">Contele</a>
            
            </h4>
            <hr>
            
                <label class="col-lg-4 col-md-6 col-sm-6 col-xs-12">Token SMS
                  <input type="text" class="form-control" name="token_sms" value="' . AspasForm(@$dd4['token_sms']) . '"/>
                </label>
                <label class="col-lg-2 col-md-2 col-sm-6 col-xs-12">Nº Conta
                  <input type="text" class="form-control" name="contasms" value="' . AspasForm(@$dd4['contasms']) . '"/>
                </label>
                <div class="row"></div>
                <label class="col-lg-2 col-md-2 col-sm-6 col-xs-12">Antes do Venc.
                  <input type="number" class="form-control" name="antesdovencimento" value="' . $dd4['antesdovencimento'] . '"/>
                </label>    
                <label class="col-lg-2 col-md-2 col-sm-6 col-xs-12">Depois do Venc.
                  <input type="number" class="form-control" name="depoisdovencimento" value="' . $dd4['depoisdovencimento'] . '"/>
                </label>     
                <label class="col-lg-2 col-md-4 col-sm-6">SMS Aniversário
                <select type="text" class="form-control" name="smsaniversario">';
  if ($dd4['smsaniversario'] != '') {
    echo '<option value="' . $dd4['smsaniversario'] . '">' . $dd4['smsaniversario'] . '</option>';
  }
  echo '
                <option value="">selecione</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
                </select>
                </label>         
                <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Texto SMS (Exemplo: Boleto próximo a vencer: Valor: {valor}, Mes: {vencimento}, código de barras: {codigobarra})
                  <textarea row="2" class="form-control" placeholder="Exemplo a cima" name="textosmsantes">' . AspasForm(@$dd4['textosmsantes']) . '</textarea>
                </label>             
                <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Texto SMS aniversariante
                  <textarea row="2" class="form-control" placeholder="Exemplo a cima" name="smsamiversariante">' . AspasForm(@$dd4['smsamiversariante']) . '</textarea>
                </label>
                <label class="col-lg-4 col-md-4 col-sm-6 hidden">Alerta Baixa
                  <input type="text" class="form-control celular" name="alertabaixa" value="' . @$dd4['alertabaixa'] . '" />
                </label>
               
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!--./col-xs-12-->      
      </div>
      <!--sms-->';
}
echo '
      </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->';

include_once('rodape.php');
?>
<script>
  $('.parametros').addClass('active menu-open');
  $('#configuracoes').addClass('active');

  //formDadosCobrana
  $('#formDadosCobranca').submit(function() {
    $.post({
      type: 'post',
      url: 'dados-cobranca-parametros.php',
      data: $('#formDadosCobranca').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
      }
    });
    return false;
  });

  //formDadosCobrana
  $('#formDadosCobrancaJuno').submit(function() {
    $.post({
      type: 'post',
      url: 'dados-cobranca.php',
      data: $('#formDadosCobrancaJuno').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
      }
    });
    return false;
  });

  //formDadosCobrana
  $('#formDadosCobrancaGerencianet').submit(function() {
    $.post({
      type: 'post',
      url: 'dados-cobranca.php',
      data: $('#formDadosCobrancaGerencianet').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
      }
    });
    return false;
  });

  //formDadosCobrana
  $('#formDadosCobrancaBB').submit(function() {
    $.post({
      type: 'post',
      url: 'dados-cobranca.php',
      data: $('#formDadosCobrancaBB').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
      }
    });
    return false;
  });

  //formDadosCobrana2
  $('#formDadosCobranca2').submit(function() {
    $.post({
      type: 'post',
      url: 'dados-cobranca-sms.php',
      data: $('#formDadosCobranca2').serialize(),
      success: function(data) {
        $('#retorno').show().fadeOut(6000).html(data);
      }
    });
    return false;
  });
</script>