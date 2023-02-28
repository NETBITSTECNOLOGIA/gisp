<?php
//permissao atualzia��o //recebe informa��es vindas do array de permiss�o
function Permissao($item,$id){
include_once('conexao.php');
$sql = mysqli_query($conexao,"select * from permissao where usuario='".$id."' and item='".$item."'");
if(mysqli_num_rows($sql)>=1){mysqli_query($conexao,"update permissao set valor='ativo' where usuario='".$id."' and item='".$item."' ");}
else{mysqli_query($conexao,"insert into permissao (usuario,item,valor) VALUES ('$id','$item','ativo') ");}
};

//fun��o verifica se existem libera��o apra acesso ao menu
function PermissaoCheck($item,$id){
include_once('conexao.php');
$sql1 = mysqli_query($conexao,"select * from permissao where usuario='".$id."' and item='".$item."' and valor='ativo'");
if(mysqli_num_rows($sql1)>=1){ return 'checked';}
};

//fun��o limpa ponto e tra�o

function limpaCPF_CNPJ($valor){
$valor = trim($valor);
$valor = str_replace(".", "", $valor);
$valor = str_replace(",", "", $valor);
$valor = str_replace("-", "", $valor);
$valor = str_replace("/", "", $valor);
$valor = str_replace("(", "", $valor);
$valor = str_replace(")", "", $valor);
$valor = str_replace(" ", "", $valor);
return $valor;
};

function Moeda($get_valor) {
$source = array('.', ',');
$replace = array('', '.');
$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
if(empty($valor)){return 0;}else{return $valor;} //retorna o valor formatado para gravar no banco
};//moeda

function Moeda2($valor) {
$valor = number_format($valor,2);
$source = array(',', '.');
$replace = array('.', '');
$valor = str_replace($source, $replace, $valor);
return $valor;
};//moeda2

function Real($valor){ if($valor==true){ return number_format($valor,2,',','.');} else { return '0,00';}};


//case de meses por valor

switch (date("m")) {
    case "01":    @$mes = 'Janeiro';     break;
    case "02":    @$mes = 'Fevereiro';   break;
    case "03":    @$mes = 'Março';       break;
    case "04":    @$mes = 'Abril';       break;
    case "05":    @$mes = 'Maio';        break;
    case "06":    @$mes = 'Junho';       break;
    case "07":    @$mes = 'Julho';       break;
    case "08":    @$mes = 'Agosto';      break;
    case "09":    @$mes = 'Setembro';    break;
    case "10":    @$mes = 'Outubro';     break;
    case "11":    @$mes = 'Novembro';    break;
    case "12":    @$mes = 'Dezembro';    break; 
};

//idadeCerta
function idadeCerta($nascimento){
    // Declara a data! :P
    $data = $nascimento;
    // Separa em dia, m�s e ano
    list($dia, $mes, $ano) = explode('-', $data);
    // Descobre que dia � hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    // Depois apenas fazemos o c�lculo j� citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
};

function AspasForm($string){
	$string = str_replace('"',chr(146).chr(146), $string);
	$string = str_replace("'",chr(146), $string);
	return $string;
};

function AspasBanco($string){
	$string = str_replace(chr(146).chr(146),'"', $string);
	$string = str_replace(chr(146),"'",$string);
	return addslashes($string);
};

function url_amigavel($string){
    $table = array(
        '�'=>'S', '�'=>'s', '�'=>'D', 'd'=>'d', '�'=>'Z',
        '�'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
        '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
        '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E',
        '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I',
        '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O',
        '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U',
        '�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss',
        '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a',
        '�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e',
        '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i',
        '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o',
        '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u',
        '�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b',
        '�'=>'y', 'R'=>'R', 'r'=>'r',  );
    // Traduz os caracteres em $string, baseado no vetor $table
    $string = strtr($string, $table);
    // converte para min�sculo
    $string = strtolower($string);
    // remove caracteres indesej�veis (que n�o est�o no padr�o)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    // Remove m�ltiplas ocorr�ncias de h�fens ou espa�os
    $string = preg_replace("/[\s-]+/", " ", $string);
    // Transforma espa�os e underscores em h�fens
    $string = preg_replace("/[\s_]/", " ", $string);
    // retorna a string
    return $string;
};//url_amigavel

function insert(){
    echo'
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X</button>
        <strong><i class="icon fa fa-check"></i><strong> Salvo! &ensp; 
    </div>';
};

function update(){
    echo'
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X</button>
        <strong><i class="icon fa fa-warning"></i></strong> Atualizado! &ensp; 
    </div>';
};

function delete(){
    echo'
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> X</button>
        <strong><i class="icon fa fa-ban"></i></strong> Excluido! &ensp; 
    </div>';
};

function persona($valor){
    echo'<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
    <i class="fa fa-exclamation-triangle"></i> <strong> '.$valor.'&ensp;</strong>
    </div>';
};

function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
    $senha = '';
    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
    $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
    $nu = "0123456789"; // $nu contem os números
    $si = "!@#$%¨&*()_+="; // $si contem os símbolos

  if ($maiusculas){
        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($ma);
  }

    if ($minusculas){
        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($mi);
    }

    if ($numeros){
        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($nu);
    }

    if ($simbolos){
        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($si);
    }

    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
    return substr(str_shuffle($senha),0,$tamanho);
}

//data form
function dataForm($valor){
    if($valor != 0000-00-00){
        $valor = date('d-m-Y',strtotime($valor));
        return $valor;
    }
}
//data certa
function dataBanco($valor){
    if($valor != 0000-00-00){
        $valor = date('Y-m-d',strtotime($valor));
        return $valor;
    }
}

function diasVencidos($data){
    // Calcula a diferença em segundos entre as datas
    $diferenca = strtotime(date('Y-m-d')) - strtotime($data);
    //Calcula a diferença em dias
    $dias = floor($diferenca / (60 * 60 * 24));
    if($dias <= 0){ $dias = 'não vencido'; }        
    return $dias;
}

function primeiroNome($valor){
    $primeiroNome = explode(" ", $valor);
    return $primeiroNome[0];    
}

function gerarCobrancaSemBoleto($idempresa,$idcliente,$nomecliente,$vencimento,$valor){
    include_once('conexao.php');
    $codigocobranca = $idcliente.date('dmYHis');

    mysqli_query($conexao,"INSERT INTO cobranca (idempresa,idcliente,tipo,tipocobranca,ncobranca,cliente,vencimento,valor,situacao) 
    VALUES ('$idempresa','$idcliente','Manual','plano','$codigocobranca','$nomecliente','$vencimento','$valor','PENDENTE')") or die (mysqli_error($conexao));

    //return persona('Criado com sucesso');
}
