<?php
session_start();
include_once 'conexao.php';
include_once 'funcoes.php';
@$idempresa = $_SESSION['idempresa'];
@$logomarcauser = $_SESSION['logomarcauser'];
@$iduser = $_SESSION['iduser'];
@$nomeuser = $_SESSION['usuario']; //pega usuario que est� executando a a��o
@$usercargo = $_SESSION['cargo'];
@$situacaouser = $_SESSION['situacaouser'];
@$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
if (isset($_SESSION['iduser']) != true || empty($_SESSION['iduser'])) {
  echo '<script>location.href="sair.php";</script>';
}

@$id = $_POST['id'];
@$area = $_POST['area'];
@$descricao = AspasBanco($_POST['descricao']);
@$resposta = AspasBanco($_POST['resposta']);

if (!empty($id) and !empty($area) and !empty($descricao)) {

  mysqli_query($conexao, "UPDATE dev SET area='$area',descricao='$descricao',resposta='$resposta' WHERE id='$id'") or die(mysqli_error($conexao));

  //img2
  if ($_FILES['arquivo']['name'] != '') {
    $diretorio = "img-dev/";
    $extensao = strrchr($_FILES['arquivo']['name'], '.');
    $novonome = mb_strtolower(md5(uniqid(rand(), true)) . '.jpeg');
    $filename = $_FILES['arquivo']['tmp_name'];
    $width = 1500;
    $height = 1500;
    list($width_orig, $height_orig) = getimagesize($filename);
    $ratio_orig = $width_orig / $height_orig;
    if ($width / $height > $ratio_orig) {
      $width = $height * $ratio_orig;
    } else {
      $height = $width / $ratio_orig;
    }
    $image_p = imagecreatetruecolor($width, $height);
    if ($extensao == '.jpg' or $extensao == '.jpeg' or $extensao == '.JPG' or $extensao == '.JPEG') {
      $image = imagecreatefromjpeg($filename);
      imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
      imagejpeg($image_p, $diretorio . $novonome, 99);
      mysqli_query($conexao, "UPDATE dev SET img='$novonome' WHERE id='$id'") or die(mysqli_error($conexao));
    }
  }

  //img2
  if ($_FILES['arquivo2']['name'] != '') {
    $diretorio = "img-dev/";
    $extensao = strrchr($_FILES['arquivo2']['name'], '.');
    $novonome2 = mb_strtolower(md5(uniqid(rand(), true)) . '.jpeg');
    $filename = $_FILES['arquivo2']['tmp_name'];
    $width = 1500;
    $height = 1500;
    list($width_orig, $height_orig) = getimagesize($filename);
    $ratio_orig = $width_orig / $height_orig;
    if ($width / $height > $ratio_orig) {
      $width = $height * $ratio_orig;
    } else {
      $height = $width / $ratio_orig;
    }
    $image_p = imagecreatetruecolor($width, $height);
    if ($extensao == '.jpg' or $extensao == '.jpeg' or $extensao == '.JPG' or $extensao == '.JPEG') {
      $image = imagecreatefromjpeg($filename);
      imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
      imagejpeg($image_p, $diretorio . $novonome2, 99);
      mysqli_query($conexao, "UPDATE dev SET img2='$novonome2' WHERE id='$id'") or die(mysqli_error($conexao));
    }
  }

  //img2
  if ($_FILES['arquivo3']['name'] != '') {
    $diretorio = "img-dev/";
    $extensao = strrchr($_FILES['arquivo3']['name'], '.');
    $novonome3 = mb_strtolower(md5(uniqid(rand(), true)) . '.jpeg');
    $filename = $_FILES['arquivo3']['tmp_name'];
    $width = 1500;
    $height = 1500;
    list($width_orig, $height_orig) = getimagesize($filename);
    $ratio_orig = $width_orig / $height_orig;
    if ($width / $height > $ratio_orig) {
      $width = $height * $ratio_orig;
    } else {
      $height = $width / $ratio_orig;
    }
    $image_p = imagecreatetruecolor($width, $height);
    if ($extensao == '.jpg' or $extensao == '.jpeg' or $extensao == '.JPG' or $extensao == '.JPEG') {
      $image = imagecreatefromjpeg($filename);
      imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
      imagejpeg($image_p, $diretorio . $novonome3, 99);
      mysqli_query($conexao, "UPDATE dev SET img3='$novonome3' WHERE id='$id'") or die(mysqli_error($conexao));
    }
  }

  echo update();
} else {
  echo persona('Erro inesperado!');
}
