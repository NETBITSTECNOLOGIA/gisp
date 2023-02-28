<?php
session_start();
include_once('conexao.php'); 
include_once('funcoes.php');

$idempresa = $_SESSION['idempresa'];
$logomarcauser = $_SESSION['logomarcauser'];
$iduser = $_SESSION['iduser'];
$nomeuser = $_SESSION['usuario'];//pega usuario que est� executando a a��o
$situacaouser = $_SESSION['situacaouser'];
$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
if(isset($_SESSION['iduser'])!=true || empty($_SESSION['iduser'])){echo '<script>location.href="sair.php";</script>'; }

$id = $_POST['id'];
@$parceiro = $_POST['parceiro'];
$tipo = $_POST['tipo'];
$nome = AspasBanco($_POST['nome']);
@$fantasia = AspasBanco($_POST['fantasia']);
@$cpf = limpaCPF_CNPJ($_POST['cpf']);
@$cnpj = limpaCPF_CNPJ($_POST['cnpj']);
@$ie = limpaCPF_CNPJ($_POST['ie']);
$rg = limpaCPF_CNPJ($_POST['rg']);
if($_POST['nascimento'] != ''){ $nascimento = dataBanco($_POST['nascimento']);}else{ $nascimento = '';}
$rguf = $_POST['rguf'];
$emissor = $_POST['emissor'];
$contato = limpaCPF_CNPJ($_POST['contato']);
$contato2 = limpaCPF_CNPJ($_POST['contato2']);
@$voip = limpaCPF_CNPJ($_POST['voip']);
$email = $_POST['email'];
$cep = limpaCPF_CNPJ($_POST['cep']);
$rua = AspasBanco($_POST['rua']);
$numero = $_POST['numero'];
$bairro = AspasBanco($_POST['bairro']);
$municipio = AspasBanco($_POST['municipio']);
$estado = $_POST['estado'];
$complemento = AspasBanco($_POST['complemento']);
$ibge = $_POST['ibge'];
$tipodecobranca = AspasBanco($_POST['tipodecobranca']);
$formadecobranca = AspasBanco($_POST['formadecobranca']);
$periododecobranca = AspasBanco($_POST['periododecobranca']);
@$banco = $_POST['banco'];
$vencimento = $_POST['vencimento'];
$situacao = $_POST['situacao'];
@$ativacao = dataBanco($_POST['ativacao']);
@$latitude = AspasBanco($_POST['latitude']);
@$longitude = AspasBanco($_POST['longitude']);
@$emitirnota = $_POST['emitirnota'];
if($id == ''){
      if($cpf != ''){
        $query = mysqli_query($conexao,"SELECT * FROM cliente WHERE cpf='$cpf'") or die (mysqli_error($conexao));
    }else{
        $query = mysqli_query($conexao,"SELECT * FROM cliente WHERE cnpj='$cnpj'") or die (mysqli_error($conexao));
    }
    //se não existir
    if(mysqli_num_rows($query) == 0){

        //verifica se dados obrigatorios estão preenchidos
        if(!empty($tipo) || !empty($nome) || !empty($contato) || !empty($rua) || !empty($bairro) || !empty($municipio)){

            mysqli_query($conexao,"INSERT INTO cliente (idempresa,parceiro,tipo,nome,cpf,cnpj,ie,rg,nascimento,contato,contato2,voip,email,cep,rua,numero,bairro,municipio,estado,ibge,data) 
            VALUES ('$idempresa','$parceiro','$tipo','$nome','$cpf','$cnpj','$ie','$rg','$nascimento','$contato','$contato2','$voip','$email','$cep','$rua','$numero','$bairro','$municipio','$estado','$ibge',NOW())") or die (mysqli_error($conexao));
            
            $idnovo = mysqli_insert_id($conexao);
            echo "<script>window.location = 'clientes-exibir.php?id=".$idnovo."'</script>";

        //caso não
        }else{
            echo persona('Preencher campos obrigatórios 1.');
        }
    //se sim
    }else{
        $dd = mysqli_fetch_array($query);
        $id = $dd['id'];
        echo "<script>window.location='clientes-exibir.php?id=".$id."'</script>";
    }
  
}elseif(!empty($id)){  
  
        mysqli_query($conexao,"UPDATE cliente SET 
        parceiro='$parceiro',tipo='$tipo',nome='$nome',fantasia='$fantasia',cpf='$cpf',cnpj='$cnpj',ie='$ie',rg='$rg',nascimento='$nascimento',contato='$contato',contato2='$contato2',voip='$voip',email='$email',
        cep='$cep',rua='$rua',numero='$numero',bairro='$bairro',municipio='$municipio',estado='$estado',complemento='$complemento',ibge='$ibge',tipodecobranca='$tipodecobranca',
        formadecobranca='$formadecobranca',periododecobranca='$periododecobranca',
        banco='$banco',vencimento='$vencimento',situacao='$situacao',latitude='$latitude',longitude='$longitude',rguf='$rguf',emissor='$emissor',emitirnota='$emitirnota',atualizado=NOW() 
        WHERE id='$id'") or die (mysqli_error($conexao)); 
        
        echo update();       
}else{
    echo persona('Preencher campos obrigatórios');
}
