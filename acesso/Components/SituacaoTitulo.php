<?php

class Situacao
{
    public static function situacao($valor){
        if ($valor == 'RECEBIDO') {
            return '<small class="label label-success">' . $valor . '</small>';
        } elseif ($valor == 'PENDENTE') {
            return '<small class="label label-primary">' . $valor . '</small>';
        } elseif ($valor == 'VENCIDO') {
            return '<small class="label label-danger">' . $valor . '</small>';
        } elseif ($valor == 'CANCELADO') {
            return '<small class="label label-dark">' . $valor . '</small>';
        }
    }
}