<?php
//dias entre datas antes
function diasDatas($data_inicial, $data_final)
{
    $diferenca = strtotime($data_final) - strtotime($data_inicial);
    $dias = floor($diferenca / (60 * 60 * 24));
    return $dias;
}
