<?php
//recebre e enviar os dadosao cotroller valida e controlle enviar para model <-aguardar retorno e direciona

//carregar todas as class, necessario apenas chamar
include_once '../database/conexao.php';
include_once '../controllers/auth/auth_controller.php';
include_once '../model/auth/auth_model.php';

$userController = new AuthController();
$userModel = new AuthModel();

$userController->setEmail($_POST['email']);
$userController->setSenha($_POST['senha']);
$userController->setTipouser($_POST['tipo']);

//var_dump($userModel->read($userController));

if ($userModel->read($userController) != []) {

	// This sends a persistent cookie that lasts a day. (sessão durar apenas um dia)
	session_start(['cookie_lifetime' => 86400,]);
	foreach ($userModel->read($userController) as $key) {
		$_SESSION['gisp_idempresa'] = $key['idempresa'];
		$_SESSION['gisp_tipouser'] = $key['tipo'];
		$_SESSION['gisp_cargo'] = $key['cargo'];
		$_SESSION['gisp_iduser'] = $key['id'];
		$_SESSION['gisp_usuario'] = $key['nome'];
		$_SESSION['gisp_situacaouser'] = $key['situacao'];
		$_SESSION['gisp_logomarcauser'] = $key['logomarca'];
	}

	$_SESSION['gisp_ip'] = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
	$_SESSION['gisp_host'] = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

	echo "<script>location.href='../acesso/views/home/index.php';</script>";
} else {

	echo '<button class="alert alert-danger btn-block btn-flat"><i class="fa fa-exclamation-triangle"></i> Usuário ou senha inválido!</button>';
}

//email é unico assim como user, email não é cryptografado apenas o user