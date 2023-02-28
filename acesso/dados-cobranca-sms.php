<?php
session_start();
include_once('conexao.php'); 
include_once('funcoes.php');
$idempresa = $_SESSION['idempresa'];
$iduser = $_SESSION['iduser'];
$nomeuser = $_SESSION['usuario'];//pega usuario que est� executando a a�o
$situacaouser = $_SESSION['situacaouser'];
$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

@$token_sms = $_POST['token_sms'];
@$contasms = $_POST['contasms'];
@$antesdovencimento = $_POST['antesdovencimento'];
@$textosmsantes = AspasBanco($_POST['textosmsantes']);
@$depoisdovencimento = $_POST['depoisdovencimento'];
@$textosmsdepois = AspasBanco($_POST['textosmsdepois']);
@$smsaniversario = $_POST['smsaniversario'];
@$smsamiversariante = AspasBanco($_POST['smsamiversariante']);
@$alertabaixa = limpaCPF_CNPJ($_POST['alertabaixa']);	

    $query = mysqli_query($conexao,"SELECT * FROM dadoscobranca WHERE idempresa='$idempresa'") or die (mysqli_error($conexao));
    //se não existir
    if(mysqli_num_rows($query) == 0){
        //verifica se dados obrigatorios estão preenchidos
        mysqli_query($conexao,"INSERT INTO dadoscobranca (idempresa,token_sms,contasms,smsamiversariante,alertabaixa,	
        smsaniversario,textosmsantes,antesdovencimento,depoisdovencimento,textosmsdepois) 
        VALUES ('$idempresa','$token_sms','$contasms','$smsamiversariante','$alertabaixa',	
        '$smsaniversario','$textosmsantes','$antesdovencimento','$depoisdovencimento','$textosmsdepois')")
         or die (mysqli_error($conexao));
            
        echo insert();        
    //se sim
    }else{
            $dd = mysqli_fetch_array($query);
            $id = $dd['id'];

            mysqli_query($conexao,"UPDATE dadoscobranca SET 
            idempresa='$idempresa',
            token_sms='$token_sms',
            contasms='$contasms',
            smsamiversariante='$smsamiversariante',
            alertabaixa='$alertabaixa',	
            smsaniversario='$smsaniversario',
            textosmsantes='$textosmsantes',
            antesdovencimento='$antesdovencimento',
            depoisdovencimento='$depoisdovencimento',
            textosmsdepois='$textosmsdepois',
            atualizado=NOW() WHERE idempresa='$idempresa'") or die (mysqli_error($conexao));
                
            echo update();
    }
