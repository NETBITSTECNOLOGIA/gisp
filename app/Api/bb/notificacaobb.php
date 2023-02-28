<?php
include_once 'funcoes.php';
header('Access-Control-Allow-Origin: *; Content-Type: application/json;');
$data = file_get_contents('php://input');
$data = json_decode($data, true);
if ($data != '') {
    foreach ($data as $item) {
        $numeroTituloCliente = $item['id'];
        $valorOriginal = $item['valorOriginal'];
        $valorPagoSacado = $item['valorPagoSacado '];
        $codigoEstadoBaixaOperacional = $item['codigoEstadoBaixaOperacional'];
        //salvar o codigo vindo do banco
        if ($item['codigoEstadoBaixaOperacional'] == 1) {
            $sitbanco = '1 - BAIXA OPERACIONAL EMITIDA PELO BB';
        } elseif ($item['codigoEstadoBaixaOperacional'] == 2) {
            $sitbanco = '2 - BAIXA OPERACIONAL EMITIDA POR OUTRO BANCO';
        } elseif ($item['codigoEstadoBaixaOperacional'] == 3) {
            $sitbanco = '10 - CANCELAMENTO DE BAIXA OPERACIONAL';
        }

        $msg = 'Notificação: ' . date('d-m-Y H:m:s') . ' | Número do titulo: ' . $item['id'] . ' | Valor: ' . $valorOriginal . ' | Valor Pago: ' . $valorPagoSacado . ' | Código OP: ' . $item['codigoEstadoBaixaOperacional'] . ' | Descrição: ' . $sitbanco . PHP_EOL;
        file_put_contents('notificacoes-recebidas.txt', $msg, FILE_APPEND);

        include_once 'conexao.php';
        mysqli_query($conexao, "UPDATE cobranca SET infobanco='$sitbanco' WHERE ncobranca='$numeroTituloCliente'") or die(mysqli_error($conexao));
        $query = mysqli_query($conexao, "SELECT * FROM cobranca WHERE ncobranca='$numeroTituloCliente'") or die(mysqli_error($conexao));
        //if(mysqli_num_rows($query) >= 1){
        $ret = mysqli_fetch_array($query);
        include_once('api_bb.php');
        $id = $ret['id'];
        consultarCobranca($id);
        //} 
    }
}
