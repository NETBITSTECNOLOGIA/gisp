<?php
//data form
class DataForm
{
    function dataForm($valor)
    {
        if ($valor != 0000 - 00 - 00) {
            $valor = date('d-m-Y', strtotime($valor));
            return $valor;
        }
    }
}
