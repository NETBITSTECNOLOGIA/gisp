<?php
include_once 'conexao.php';
include_once 'funcoes.php';
$idcontrato = $_POST['idcontrato'];
$idcliente = $_POST['idcliente'];
$idempresa = $_POST['idempresa'];
$latitude = AspasBanco($_POST['latitude']);
$longitude = AspasBanco($_POST['longitude']);

if ($idcliente != '' and $latitude != '' and $longitude != '') {
    mysqli_query($conexao, "UPDATE contratos SET latitude='$latitude',longitude='$longitude' WHERE id='$idcontrato'") or die(mysqli_error($conexao));
}
echo "<script>window.location='obrigado.php?id=$idempresa'</script>";
