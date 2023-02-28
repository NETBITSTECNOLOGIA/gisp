<?php 

session_start();

include_once('../acesso/conexao.php');

include_once('../acesso/funcoes.php');



	if(isset($_POST['acesso']) || isset($_POST['data']));{

		if(strlen($_POST['acesso']) == 0) {

			echo "Preencha com CPF ou CNPJ";

		} else if(strlen($_POST['data']) == 0) {

			echo "Preencha com a data de nascimento";

		} else{

			$acesso = $conexao->real_escape_string($_POST['acesso']);

			$data = dataBanco($conexao->real_escape_string($_POST['data']));

		}

	}

@$lembrete = "SIM";

if (!empty(@$acesso)):

	if(strlen($acesso) == 11){

		$sql = mysqli_query($conexao,"SELECT * FROM cliente WHERE cpf='$acesso' AND nascimento='$data' AND situacao <> 'CANCELADO' LIMIT 1");

	}else{

		$sql = mysqli_query($conexao,"SELECT * FROM cliente WHERE cnpj='$acesso' AND nascimento='$data' AND situacao <> 'CANCELADO' LIMIT 1");

	}

	$dados = mysqli_fetch_assoc($sql);

	if(!empty($dados)):

        @$_SESSION['idcliente'] = $dados['id'];

		@$_SESSION['idempresa'] = $dados['idempresa'];

		@$_SESSION['nomecliente'] = $dados['nome'];

        @$_SESSION['acesso'] = md5($dados['cpf_cnpj']);

		@$_SESSION['logado'] = TRUE;

		$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina

		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina		



		if($lembrete == 'SIM'):

		   $expira = time() + 60*60*24*30; //expira em 30 dias

		   setCookie('lembrete', 'SIM', $expira);

		   setCookie('idcliente',$_SESSION['idcliente'], $expira);  

		   setCookie('idempresa',$_SESSION['idempresa'], $expira);  

		   setCookie('acesso', $_SESSION['acesso'], $expira);

           setCookie('nomecliente',$_SESSION['nomecliente'], $expira);

		else:

			setCookie('idcliente');

			setCookie('idempresa');

            setCookie('nomecliente');

            setcookie('acesso');

		   setCookie('lembrete');

		endif;

		echo "<script>window.location = 'index.php'</script>";

	else:

		@$_SESSION['logado'] = FALSE;

	    echo '<button class="btn btn-danger btn-block btn-lg">Usuário ou senha inválido!</button>';

	endif;

endif;
