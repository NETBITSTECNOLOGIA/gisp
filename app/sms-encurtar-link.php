<?php
include_once 'funcoes.php';
include_once('api_sms.php');
$url = AspasForm($_POST['link']);

echo encurtaLink($API_KEY, $url);
