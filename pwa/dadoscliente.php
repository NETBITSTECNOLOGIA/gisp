<?php
include_once 'topo.php';
$query = mysqli_query($conexao, "SELECT * FROM cliente WHERE cliente.id=$_SESSION[idcliente] AND idempresa='$idempresa'") or die(mysqli_error($conexao));
$dd = mysqli_fetch_array($query);
echo '
<style>
body{
  background: #ecf0f5 !important;
}
</style> 
  <div class="row" style="font-size: 14px";>
    <div style="text-align:center;" class="col-lg-12">
    <h3 style="margin-top:1em;background: #d9d9d9;border-radius: 0.2em;" class="title">DADOS DO CLIENTE</h3>
  <div style="text-align:center;">
  
  <div class="row">
      <div class="col-lg-4 col-md-12">
        <label for="inputDefault">Nome</label>
        <input type="text" class="form-control" value="' . $dd['nome'] . '" placeholder="Fulado de tal" id="inputDefault" disabled="">
      </div>

      <div class="col-lg-3 col-md-12">
        <label for="inputDefault">CPF/CNPJ</label>
        <input type="text" class="form-control" value="';
if ($dd['cpf'] == '') {
  echo $dd['cnpj'];
} else {
  echo $dd['cpf'];
}
echo '" id="inputDefault" disabled="">
      </div>


      <div class="col-lg-3 col-md-12">
        <label for="inputDefault">';
if ($dd['cnpj'] != '') {
  echo 'Criação';
} else {
  echo 'Nascimento';
}
echo '
        </label>
        <input type="text" class="form-control" value="' . dataForm(@$dd['nascimento']) . '" placeholder="00-00-0000" id="inputDefault" disabled="">
      </div>
      </div>


        <div class="row">
          <div class="col-lg-3 col-md-12">
            <label  for="inputDefault">Contato</label>
            <input type="text" class="form-control" value="' . $dd['contato'] . '" placeholder="(00)00000-0000" id="inputDefault" disabled="">
          </div>

          <div class="col-lg-3 col-md-12">
            <label  for="inputDefault">Contato 2</label>
            <input type="text" class="form-control" value="' . $dd['contato2'] . '" placeholder="(00)00000-0000" id="inputDefault" disabled="">
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-2 col-md-12">
            <label for="inputDefault">CEP</label>
            <input type="text" class="form-control" value="' . $dd['cep'] . '" placeholder="00000-000" id="inputDefault" disabled="">
          </div>

          <div class="col-lg-4 col-md-12">
            <label for="inputDefault">Rua</label>
            <input type="text" class="form-control" value="' . $dd['rua'] . '" placeholder="Av.Perdido, número 0" id="inputDefault" disabled="">
          </div>

        
          <div class="col-lg-2 col-md-12">
            <label for="inputDefault">Bairro</label>
            <input type="text" class="form-control" value="' . $dd['bairro'] . '" placeholder="Bairro" id="inputDefault" disabled="">
          </div>

          <div class="col-lg-2 col-md-12">
            <label for="inputDefault">Município</label>
            <input type="text" class="form-control" value="' . $dd['municipio'] . '" placeholder="Município" id="inputDefault" disabled="">
          </div>
          <div class="col-lg-2 col-md-12">
          <label for="inputDefault">UF</label>
          <input type="text" class="form-control" value="' . $dd['estado'] . '" placeholder="UF" id="inputDefault" disabled="">
        </div>
        </div>
      
      ';
if ($dd['latitude'] == '') {
  echo '
        <hr>
  <div class="page-header"  style="text-align:center;">
  <h3 style="margin-top:1em;background: #d9d9d9;border-radius: 0.2em;" class="title">LOCALIZAÇÃO DA INSTALAÇÃO</h3>
  </div>
   	<form method="post" action="localizacao.php">
  <div class="row"> 
    <input type="text" name="idcliente" value="' . $dd['id'] . '" style="display:none"/>
    <input type="text" name="idempresa" value="' . $dd['idempresa'] . '" style="display:none"/>
      <div class="col-lg-4 col-md-12">
        <label for="inputDefault">Latitude</label>
        <input type="text" class="form-control" value="' . $dd['latitude'] . '" name="latitude" placeholder="Latitude" id="latitude"/>
      </div>
      <div class="col-lg-4 col-md-12">
        <label for="inputDefault">Longitude</label>
        <input type="text" class="form-control" value="' . $dd['longitude'] . '" name="longitude" placeholder="Longitude" id="longitude"/>
      </div>
      <div class="col-lg-4 col-md-12">
        <label class="col-lg-12"><br>
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </label>
      </div>    
  </div>
    </form>
<br><hr>
';
}
include_once 'rodape.php';
?>
<script>
  window.onload = getLocation();

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
      x.innerHTML = "Seu browser não suporta Geolocalização.";
    }
  };

  function showPosition(position) {
    x = position.coords.latitude;
    y = position.coords.longitude;

    document.getElementById('latitude').value = x;
    document.getElementById('longitude').value = y;
  }

  function showError(error) {
    switch (error.code) {
      case error.PERMISSION_DENIED:
        x.innerHTML = "Usuário rejeitou a solicitação de Geolocalização."
        break;
      case error.POSITION_UNAVAILABLE:
        x.innerHTML = "Localização indisponível."
        break;
      case error.TIMEOUT:
        x.innerHTML = "A requisição expirou."
        break;
      case error.UNKNOWN_ERROR:
        x.innerHTML = "Algum erro desconhecido aconteceu."
        break;
    }
  }
</script>