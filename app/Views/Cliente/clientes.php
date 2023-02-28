<?php
include_once 'topo.php';
$sql0 = mysqli_query($conexao, "SELECT cliente.id FROM cliente WHERE idempresa='$idempresa'");
@$rows = mysqli_num_rows($sql0);

echo '
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
    <!-- Main content -->
    <section class="content">  
      <div class="row">
      <form method="post" action="clientes.php">

          <div class="col-lg-2 col-md-2 col-sm-12">Buscar por
            <select type="type" class="form-control" id="tipo2" name="tipo2" required>';
if (!empty($_POST['tipo2'])) {
  echo '<option value="' . $_POST['tipo2'] . '">' . $_POST['tipo2'] . '</option>';
} else {
  echo '<option value="">Seleciona</option>';
}
echo '
                <option value="NOME">NOME</option>
                <option value="CPF">CPF</option>
                <option value="CNPJ">CNPJ</option>
                <option value="ENDERECO">ENDEREÇO</option>
                <option value="CEP">CEP</option>
                <option value="VOIP">VOIP</option>
                <option value="LOGIN">LOGIN</option>
                <option value="PARCEIRO">PARCEIRO</option>
          </select>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-12 NOME">Nome
            <input type="text" class="form-control" name="nome">
          </div>  
          <div class="col-lg-2 col-md-2 col-sm-12 CPF0">CPF
            <input type="number" class="form-control" name="cpf">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 VOIP">VOIP
            <input type="number" class="form-control" name="voip">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 LOGIN">Login
            <input type="text" class="form-control" name="login">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 CNPJ2">CNPJ
            <input type="number" class="form-control" name="cnpj">
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 PARCEIRO">Parceiro
          <select type="text" class="form-control" name="parceiro">';
$sqlp = mysqli_query($conexao, "SELECT * FROM user") or die(mysqli_error($conexao));
while ($rp = mysqli_fetch_array($sqlp)) {
  echo '<option value="' . $rp['id'] . '">' . $rp['nome'] . '</option>';
}
echo '
          </select>
          </div>
           <div class="col-lg-2 col-md-2 col-sm-12 ENDERECO">Endereço
            <input type="text" class="form-control" name="endereco">
          </div>

          <div class="col-lg-2 col-md-2 col-sm-12 CEP">CEP
          <input type="text" class="form-control" name="cep">
        </div>   
          
  
          <div class="col-lg-2 col-md-2 col-sm-12"></br>
          <button type="submit" class="btn btn-primary btn-block reclickar"><i class="fa fa-search"></i> Buscar</button>
          </div>
      </form>
      </div>
      <br>

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
            <div class="col-lg-2">
              <h3 class="box-title">Clientes</h3>
              </div>
              <div class="col-lg-10">   
              <div class="col-lg-2 col-md-6 col-sm-12">       
              <a href="clientes-all.php" class="btn bg-olive  btn-block">Clientes: ' . @$rows . '</a></div>';

if (PermissaoCheck($idempresa, 'clientes-cadastrar', $iduser) == 'checked' || $_SESSION['tipouser'] == 'Admin') {
  echo '
                  <div class="col-lg-2 col-md-6 col-sm-12">  
              	  <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#ClienteCadastrar"><i class="fa fa-plus"></i> Cadastrar</button></div>';
}
if (PermissaoCheck($idempresa, 'clientes-excluir', $iduser) == 'checked' or $_SESSION['tipouser'] == 'Admin') {
  echo '
                  <div class="col-lg-2 col-md-6 col-sm-12">  
                  <button class="btn btn-danger  btn-block" btn-block onclick="ExcluirCliente()"><i class="fa fa-trash"></i> Excluir</button></div>';
}
echo '
                <div class="col-lg-2 col-md-6 col-sm-12">  <a href="clientes-bloqueados.php"><button class="btn btn-black btn-block"><i class="fa fa-trash"></i> Bloqueados</button></a></div>
                <div class="col-lg-2 col-md-6 col-sm-12">  <a href="clientes-cancelados.php"><button class="btn btn-warning btn-block"><i class="fa fa-ban"></i> Cancelados</button></a></div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <center>';
if (!empty($_POST['nome'])) {
  echo 'Filtro Nome: <i class="text-red">' . @$_POST['nome'] . '</i>';
}
if (!empty($_POST['cpf'])) {
  echo 'Filtro CPF: <i class="text-red">' . @$_POST['cpf'] . '</i>';
}
if (!empty($_POST['cnpj'])) {
  echo 'Filtro CNPJ: <i class="text-red">' . @$_POST['cnpj'] . '</i>';
}
if (!empty($_POST['endereco'])) {
  echo 'Filtro Endereço: <i class="text-red">' . @$_POST['endereco'] . '</i>';
}
if (!empty($_POST['voip'])) {
  echo 'Filtro VOIP: <i class="text-red">' . @$_POST['voip'] . '</i>';
}
if (!empty($_POST['login'])) {
  echo 'Filtro Login: <i class="text-red">' . @$_POST['login'] . '</i>';
}

echo '
            </center>

            <form method="post" id="FormExcluirCliente">

            <div class="table-responsive no-padding">
              <table class="table table-hover" style="width:100%">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>NOME</th>
                          <th>CPF/CNPJ</th>
                          <th>VOIP</th>
                          <th>LOGIN</th>
                          <th>CEP</th>
                          <th>PARCEIRO</th>
                          <th>VENC.</th>
                          <th>#</th>
                      </tr>
                  </thead>
                  <tbody>';

if (@$_POST['nome'] != '') {
  $variavel = 'AND cliente.nome LIKE "%' . @$_POST['nome'] . '%" ORDER BY cliente.nome ASC';
} elseif (@$_POST['cpf'] != '') {
  $variavel = 'AND cliente.cpf LIKE "%' . @$_POST['cpf'] . '%" ORDER BY cliente.nome ASC';
} elseif (@$_POST['cnpj'] != '') {
  $variavel = 'AND cliente.cnpj LIKE "%' . @$_POST['cnpj'] . '%" ORDER BY cliente.nome ASC';
} elseif (@$_POST['endereco'] != '') {
  $variavel = 'AND cliente.rua LIKE "%' . @$_POST['endereco'] . '%" ORDER BY cliente.nome ASC';
} elseif (@$_POST['cep'] != '') {
  $variavel = 'AND cliente.cep=' . @$_POST['cep'] . ' ORDER BY cliente.nome ASC';
} elseif (@$_POST['voip'] != '') {
  $variavel = 'AND cliente.voip LIKE "%' . @$_POST['voip'] . '%" ORDER BY cliente.nome ASC';
} elseif (@$_POST['login'] != '') {
  $variavel = 'AND contratos.login LIKE "%' . @$_POST['login'] . '%" ORDER BY cliente.nome ASC';
} elseif (@$_POST['parceiro'] != '') {
  $variavel = 'AND cliente.parceiro="' . @$_POST['parceiro'] . '" AND cliente.parceiro <> 0 ORDER BY cliente.nome ASC';
} else {
  $variavel = '';
}
if ($variavel != '') {
  $query = mysqli_query($conexao, "SELECT cliente.*, contratos.login AS logincontrato, user.nome AS nomeparceiro FROM cliente 
                    LEFT JOIN contratos ON cliente.id = contratos.idcliente
                    LEFT JOIN user ON cliente.parceiro = user.id
                    WHERE cliente.idempresa='$idempresa' $variavel")
    or die(mysqli_error($conexao));
  $n = 1;
  if (mysqli_num_rows($query) >= 1) {
    while ($dd = mysqli_fetch_array($query)) {
      echo '
                          <tr>
                              <td><input type="checkbox" class="meucheckbox" name="id[]" value="' . $dd['id'] . '">
                              
                              </td><td>';


      if ($dd['situacao'] == 'Ativo') {
        echo '<a href="clientes-exibir.php?id=' . $dd['id'] . '" style="color:green;font-weight: bold;" title="' . @$dd['situacao'] . '">' . $dd['nome'] . '</a>';
      } else {
        echo '<a href="clientes-exibir.php?id=' . $dd['id'] . '" style="color:red; font-weight: bold;" title="' . @$dd['situacao'] . '">' . $dd['nome'] . '</a>';
      }



      echo '</td>
                              <td>';
      if ($dd['cnpj'] != '') {
        echo $dd['cnpj'];
      } else {
        echo $dd['cpf'];
      }
      echo '</td>
                              <td>' . @$dd['voip'] . '</td>
                              <td>' . @$dd['logincontrato'] . '</td>
                              <td>' . @$dd['cep'] . '</td>
                              <td>' . $dd['nomeparceiro'] . '</td>
                              <td>' . @$dd['vencimento'] . '</td>
                              <td  style="padding:2px !important">';
      if (PermissaoCheck($idempresa, 'clientes-financeiro', $_SESSION['iduser']) == 'checked' || $_SESSION['tipouser'] == 'Admin') {
        echo '
                                  <a href="clientes-financeiro-exibir.php?id=' . $dd['id'] . '" title="receber"><i class=" fa fa-dollar fa-2x text-green"></i></a>&ensp;';
      }
      if (PermissaoCheck($idempresa, 'clientes-chamado', $_SESSION['iduser']) == 'checked' || $_SESSION['tipouser'] == 'Admin') {
        echo '
                                  <a onclick="abrirChamado(' . $dd['id'] . ')"><i class="fa fa-headphones fa-2x"></i></a>&ensp;';
      }
      if (PermissaoCheck($idempresa, 'clientes-whatsapp', $_SESSION['iduser']) == 'checked' || $_SESSION['tipouser'] == 'Admin') {
        echo '
                                  <a onclick="whatsapp(' . $dd['contato'] . ')"><i class="fa fa-whatsapp fa-2x text-green"></i></a>';
      }
      if ($dd['situacao'] == 'Ativo') {
        echo '
                                <a title="Bloquear" onclick="bloquearCliente(' . $dd['id'] . ')"><i class="fa fa-user-times fa-2x text-red"></i></a>&ensp;
                                <a title="Derrubar" onclick="derrubar(' . $dd['id'] . ')"><i class="fa fa-chain-broken fa-2x text-black"></i></a>';
      } elseif ($dd['situacao'] != 'Ativo') {
        echo '
                                  <a title="Ativar" onclick="ativarCliente(' . $dd['id'] . ')"><i class="fa fa-thumbs-up fa-2x text-green"></i></a>';
      }
      echo '
                              </td>
                          </tr>';
      @$n++;
    }
  }
}
echo '                
                  </tbody>
              </table></div>
              </form>

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
<!-- /.content-wrapper -->

<!-- modal cliente cadastrar-->
<div class="modal" id="ClienteCadastrar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formCadastroCliente">
      <div class="modal-body">
        	<div class="row">
        		<div class="col-lg-12">
              <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Pessoa <small class="text-red">*obrigatrio</small>
                <select type="text" class="form-control" name="tipo" id="tipoPessoaCad" required>
                  <option value="Física">Física</option>
                  <option value="Jurídica">Jurídica</option>
                </select>
              </label>
              <div class="row"></div>
	        		<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Nome
		        		<input type="text" class="form-control" placeholder="Nome" name="nome" required/>
		        	</label>
              <div class="pessoafisica">
              <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">CPF
              <input type="text" class="form-control" placeholder="Apenas números" name="cpf"/>
              </label>
              <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">RG
              <input type="text" class="form-control" placeholder="Apenas números" name="rg"/>
              </label>
              </div>
              <div class="pessoajuridica">
              <label class="col-lg-6 col-md-6 col-sm-12">Fantasia
              <input type="text" class="form-control" placeholder="Fantasia" name="fantasia"/>
              </label>
              <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">CNPJ
                <input type="text" class="form-control" placeholder="Apenas números" name="cnpj"/>
              </label>
              <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">IE
                <input type="text" class="form-control" placeholder="Apenas números" name="ie"/>
              </label>
              </div>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Nascimento
			        	<input type="text" class="form-control data" placeholder="00-00-0000" name="nascimento"/>
		        	</label>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Contato/whatsapp <small class="text-red">*obrigatório</small>
			        	<input type="text" class="form-control celular" placeholder="Apenas números" name="contato"/>
		        	</label>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">E-mail
		        		<input type="email" class="form-control" placeholder="E-mail" name="email"/>
		        	</label>
				      <div class="row"></div><hr>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">CEP <small class="text-red">*obrigatório</small>
			        	<input type="text" class="form-control cep cepBusca" placeholder="Apenas números" name="cep"/>
		        	</label>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Rua/Alameda/Avenida/etc <small class="text-red">*obrigatório</small>
			        	<input type="text" class="form-control enderecoBusca" placeholder="Rua/Alameda/Avenida/etc" name="rua" required/>
		        	</label>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Número <small class="text-red">*obrigatório</small>
			        	<input type="text" class="form-control" placeholder="Número" name="numero"/>
		        	</label>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Bairro <small class="text-red">*obrigatório</small>
			        	<input type="text" class="form-control bairroBusca" placeholder="Bairro" name="bairro" required/>
		        	</label>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Múnicipio <small class="text-red">*obrigatório</small>
			        	<input type="text" class="form-control cidadeBusca" placeholder="Múnicipio" name="municipio" required/>
		        	</label>
		        	<label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Estado <small class="text-red">*obrigatório</small>
			        	<input type="text" class="form-control ufBusca" placeholder="Estado" name="estado" required/>
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
<!-- modal cliente cadastrar-->

<!-- modal abrir chamado-->
<div class="modal" id="CadastrarChamado" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Abrir chamado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formCadastroChamado" autocomplete="off">
      <div class="modal-body">
        	<div class="row" id="retornoChamado">        	
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
<!-- modal cliente cadastrar-->
';
include_once('rodape.php');
?>
<script>
  $('.clientes').addClass('active menu-open');
  $('#clientes-busca').addClass('active');

  //formCadastrarCliente
  $('#formCadastroCliente').submit(function() {
    $('#ClienteCadastrar').modal('hide');
    $.post({
      type: 'post',
      url: 'clientes-update.php',
      data: $('#formCadastroCliente').serialize(),
      success: function(data) {
        $('#retorno').show().html(data);
      }
    });
    return false;
  });
  //sincronizar clientes
  function sincronzarClientes() {
    $('#processando').modal('show');
    $.ajax({
      type: 'post',
      url: 'sincronizar-clientes.php',
      data: 'html',
      success: function(data) {
        $('#processando').modal('hide');
        $('#retorno').show().fadeOut(6000).html(data);
        //tabela();
      }
    });
    return false;
  }
  //excuir
  function ExcluirCliente() {
    $('#processando').modal('show');
    $.ajax({
      type: 'post',
      url: 'excluir-cliente.php',
      data: $('#FormExcluirCliente').serialize(),
      success: function(data) {
        $('#processando').modal('hide');
        $('#retorno').show().fadeOut(6000).html(data);
        window.setTimeout(function() {
          history.go();
        }, 6001);

      }
    });
    return false;
  };
  //abrir chamado
  function abrirChamado(idcliente) {
    $('#CadastrarChamado').modal('show');
    $.get('clientes-chamado-retorno.php', {
      idcliente: idcliente
    }, function(data) {
      $('#retornoChamado').show().html(data);
    })
    return false;
  }
  //salvar chamado
  $('#formCadastroChamado').submit(function() {
    $('#CadastrarChamado').modal('hide');
    $('#processando').modal('show');
    $.ajax({
      type: 'post',
      url: 'insert-chamado.php',
      data: $('#formCadastroChamado').serialize(),
      success: function(data) {
        $('#processando').modal('hide');
        $('#retorno').show().fadeOut(6000).html(data);
      }
    });
    return false;
  });
  //chamar whatsapp
  function whatsapp(fone) {
    window.open('https://api.whatsapp.com/send?phone=55' + fone + '&text=Ol%C3%A1%2Ctudo+bem');
  }
  //tipo pessoa
  $(function($) {
    $('#tipoPessoaCad').on('change', function() {
      var valor = ($(this).val());
      if (valor == 'Física') {
        $('.pessoafisica').show();
        $('.pessoajuridica').hide().removeAttr('required', true);
      } else {
        $('.pessoafisica').hide().removeAttr('required', true);
        $('.pessoajuridica').show();
      }
    }).trigger('change');
  });
  //derrubar cliente
  function derrubar(id) {
    $.get('derrubar-cliente-lista.php', {
      id: id
    }, function(data) {
      $('#retorno').show().fadeOut(3000).html(data);
    });
    return false;
  }
  //bloquear cliente
  function bloquearCliente(id) {
    $.get('bloquear-cliente.php', {
      id: id
    }, function(data) {
      $('#retorno').show().fadeOut(3000).html(data);
      window.setTimeout(function() {
        history.go();
      }, 3001);

    });
    return false;
  }
  //ativar cliente
  function ativarCliente(id) {
    $.get('ativar-cliente.php', {
      id: id
    }, function(data) {
      $('#retorno').show().fadeOut(3000).html(data);
      window.setTimeout(function() {
        history.go();
      }, 3001);
    });
    return false;
  }


  $(function($) {
    $('#tipo2').on('change', function() {
      var valor = ($(this).val());
      if (valor == 'NOME') {
        $('.NOME').show();
        $('.CPF0').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);

      } else if (valor == 'CPF') {
        $('.CPF0').show();
        $('.NOME').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);

      } else if (valor == 'CNPJ') {
        $('.CNPJ2').show();
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);

      } else if (valor == 'ENDERECO') {
        $('.ENDERECO').show();
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);

      } else if (valor == 'VOIP') {
        $('.VOIP').show();
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);

      } else if (valor == 'LOGIN') {
        $('.LOGIN').show();
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);

      } else if (valor == 'PARCEIRO') {
        $('.PARCEIRO').show();
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);

      } else if (valor == 'VENCIMENTO') {
        $('.VENCIMENTO').show();
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);
      } else if (valor == 'CEP') {
        $('.CEP').show();
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
      } else {
        $('.NOME').hide().removeAttr('required', true);
        $('.CPF0').hide().removeAttr('required', true);
        $('.VOIP').hide().removeAttr('required', true);
        $('.LOGIN').hide().removeAttr('required', true);
        $('.CNPJ2').hide().removeAttr('required', true);
        $('.ENDERECO').hide().removeAttr('required', true);
        $('.PARCEIRO').hide().removeAttr('required', true);
        $('.VENCIMENTO').hide().removeAttr('required', true);
        $('.CEP').hide().removeAttr('required', true);
      }
    }).trigger('change');
  });
</script>