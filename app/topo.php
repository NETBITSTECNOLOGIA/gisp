<?php
session_start();
include_once('../acesso/conexao.php');
include_once('../acesso/funcoes.php');
@$idcliente = (isset($_COOKIE['idcliente'])) ? $_COOKIE['idcliente'] : '';
@$idempresa = (isset($_COOKIE['idempresa'])) ? $_COOKIE['idempresa'] : '';
@$nomecliente = (isset($_COOKIE['nomecliente'])) ? $_COOKIE['nomecliente'] : '';
@$acesso = (isset($_COOKIE['acesso'])) ? $_COOKIE['acesso'] : '';
@$lembrete = (isset($_COOKIE['CookieLembrete'])) ? $_COOKIE['CookieLembrete'] : '';
@$checked = (@$lembrete == 'SIM') ? 'checked' : '';
@$idempresa = $_SESSION['idempresa'];
@$idcliente = $_SESSION['idcliente'];
if(isset($_SESSION['idcliente'])!=true){echo '<script>location.href="sair.php";</script>'; }
echo'
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>GISP CLIENTE</title>
    <meta name="description" content="GISP CLIENTE">
    <meta name="keywords" content="SISTEMA DE ATENDIMENTO AO CLIENTE">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <!-- bootstrap 4.3.1 -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- font awesome 6.1.1 -->
    <link rel="stylesheet" href="css/all.min.css"/>

    <script src="js/all.min.js"></script>
    
    <script type="text/javascript" async="" src="js/ga.js"></script>

    <link rel="manifest" href="./manifest.json"/>

    <link rel="preload" href="./app.js" as="script"/>
    


    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="icone.png">
    <style>

/*
    @media screen and (min-device-width: 480px) {
        body {
            display: none;
        }
    }*/
      </style>
</head>
<body>
<header class="header" role="banner">
<h3 CLASS="text_header">GISP CLIENTE</h3>
</header>
';
