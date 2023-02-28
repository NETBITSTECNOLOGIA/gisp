<?php
session_start();
include_once('../acesso/conexao.php');
include_once('../acesso/funcoes.php');
@$idcliente = (isset($_COOKIE['idcliente'])) ? $_COOKIE['idcliente'] : '';
@$idempresa = (isset($_COOKIE['idempresa'])) ? $_COOKIE['idempresa'] : '';
@$nomecliente = (isset($_COOKIE['nomecliente'])) ? $_COOKIE['nomecliente'] : '';

//nchamado,idcliente,idempresa,nomecliente,tipo,usuariocad,datacad,obs,situacao
@$tipo = strtoupper(@$_POST['tipo']);
@$obs = AspasBanco(@$_POST['obs']);
@$nchamado = date('dmYHms') . '-' . $idcliente;

if (!empty(@$idempresa) and !empty(@$tipo) and !empty(@$obs)) {
  mysqli_query($conexao, "INSERT INTO chamado 
    (nchamado,idcliente,idempresa,nomecliente,tipo,usuariocad,datacad,obs,situacao) 
    VALUES ('$nchamado','$idcliente','$idempresa','$nomecliente','$tipo','$nomecliente',NOW(),'$obs','ABERTO')
    ") or die(mysqli_error($conexao));

  $idNovo = mysqli_insert_id($conexao);

  //img1
  if ($_FILES['img1']['name'] != '') {
    $diretorio = "../acesso/docchamado/";
    $extensao = strrchr($_FILES['img1']['name'], '.');
    $novonome = mb_strtolower(md5(uniqid(rand(), true)) . '.jpeg');
    $filename = $_FILES['img1']['tmp_name'];
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
      mysqli_query($conexao, "UPDATE chamado SET img1='$novonome' WHERE id='$idNovo'") or die(mysqli_error($conexao));
    }
  }

  //img2
  if ($_FILES['img2']['name'] != '') {
    $diretorio = "../acesso/docchamado/";
    $extensao = strrchr($_FILES['img2']['name'], '.');
    $novonome = mb_strtolower(md5(uniqid(rand(), true)) . '.jpeg');
    $filename = $_FILES['img2']['tmp_name'];
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
      mysqli_query($conexao, "UPDATE chamado SET img2='$novonome' WHERE id='$idNovo'") or die(mysqli_error($conexao));
    }
  }
  //pdf
  if ($_FILES['pdf']['name'] != '') {
    $diretorio = "../acesso/docchamado/";
    $extensao = strrchr($_FILES['pdf']['name'], '.');
    $novonome = mb_strtolower(md5(uniqid(rand(), true)) . '.pdf');
    $arquivo_tmp = $_FILES['pdf']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $diretorio . $novonome);
    mysqli_query($conexao, "UPDATE chamado SET pdf='$novonome' WHERE id='$idNovo'") or die(mysqli_error($conexao));
  }



  echo "<script>alert('chamado aberto com sucesso!')</script>";
  echo "<script>window.location.href='chamado.php';</script>";
} else {
  echo "<script>window.location.href='abrir-chamado.php';</script>";
}
