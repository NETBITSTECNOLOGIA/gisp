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


if (empty($userModel->read($userController))) {
	echo '<button class="alert alert-danger btn-block"><i class="fa fa-exclamation-triangle"></i> Usuário ou senha inválido!</button>';
} else {
	echo 'passou, criar sessão e mandar pra dashboar';
}

echo '<br />';
/* 
foreach ($userModel->read($userController) as $key) {
	echo $key['email'] . ' - ' . $key['senha'] . '<hr>';
}
 */

/*
$produtoModel->create($produto);

// $produtoDao->delete(8);
$produtoModel->read();
foreach ($produtoModel->read() as $key) {
	echo $key['id'] . ' - ' . $key['nome'] . ' - 
    ' . $key['descricao'] . '<hr>';
}
*/