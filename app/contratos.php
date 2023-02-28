<?php
include_once 'topo.php';
echo '
<style>
body{
  background: #ecf0f5 !important;
}
</style> 
  <div class="row" style="font-size: 14px";>
    <div style="text-align:center;" class="col-lg-12">
    <h3 style="margin-top:1em;background: #d9d9d9;border-radius: 0.2em;" class="title">CONTRATOS DO CLIENTE</h3>
  <div style="text-align:center;">';
$queryp = mysqli_query($conexao, "SELECT contratos.*, plano.valor,plano.nomeservidor FROM contratos 
  LEFT JOIN plano ON contratos.plano = plano.id
  WHERE idcliente='$idcliente'") or die(mysqli_error($conexao));
while ($ddp = mysqli_fetch_array($queryp)) {
  echo '
    <div class="row">
    <div class="col-lg-4 col-md-12">
    <label for="inputDefault">N° contrato</label>
    <input type="text" class="form-control" value="' . $ddp['id'] . '" id="inputDefault" disabled="">
  </div>
        <div class="col-lg-4 col-md-12">
          <label for="inputDefault">Situação do plano</label>
          <input type="text" class="form-control" value="' . $ddp['situacao'] . '" id="inputDefault" disabled="">
        </div>
        <div class="col-lg-4 col-md-12">
        <label for="inputDefault">Servidor</label>
        <input type="text" class="form-control" value="' . $ddp['nomeservidor'] . '" placeholder="Servidor" id="inputDefault" disabled="">
      </div>
        <div class="col-lg-4 col-md-12">
          <label for="inputDefault">Plano</label>
          <input type="text" class="form-control" value="' . $ddp['nomeplano'] . '" placeholder="Nome do plano" id="inputDefault" disabled="">
        </div>
        <div class="col-lg-4 col-md-12">
          <label for="inputDefault">Valor</label>
          <input type="text" class="form-control" value="R$ ' . Real($ddp['valor']) . '" placeholder="Valor do plano" id="inputDefault" disabled="">
        </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-12">
              <label for="inputDefault">CEP</label>
              <input type="text" class="form-control" value="' . @$ddp['cep'] . '" placeholder="00000-000" id="inputDefault" disabled="">
            </div>
  
            <div class="col-lg-4 col-md-12">
              <label for="inputDefault">Endereço</label>
              <input type="text" class="form-control" value="' . @$ddp['rua'] . '" placeholder="Av.Perdido, número 0" id="inputDefault" disabled="">
            </div>
  
          
            <div class="col-lg-2 col-md-12">
              <label for="inputDefault">Bairro</label>
              <input type="text" class="form-control" value="' . @$ddp['bairro'] . '" placeholder="Bairro" id="inputDefault" disabled="">
            </div>
  
            <div class="col-lg-2 col-md-12">
              <label for="inputDefault">Município</label>
              <input type="text" class="form-control" value="' . @$ddp['municipio'] . '" placeholder="Município" id="inputDefault" disabled="">
            </div>
            <div class="col-lg-2 col-md-12">
            <label for="inputDefault">UF</label>
            <input type="text" class="form-control" value="' . @$ddp['uf'] . '" placeholder="UF" id="inputDefault" disabled="">
          </div>
            </div>
            <div class="row"></div><hr style="border: 1px solid black">';
}
echo '<br>';
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