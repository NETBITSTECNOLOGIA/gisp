<?php
function gerarCobrancaSemBoleto($idempresa, $idcliente, $nomecliente, $vencimento, $valor)
{
    include_once 'conexao.php';
    $codigocobranca = $idcliente . date('dmYHis');
    mysqli_query($conexao, "INSERT INTO cobranca
    (idempresa,idcliente,tipo,tipocobranca,ncobranca,cliente,vencimento,valor,situacao) VALUES
    ('$idempresa','$idcliente','Manual','plano','$codigocobranca','$nomecliente','$vencimento','$valor','PENDENTE')") or
        die(mysqli_error($conexao));
}
