<?php
class PrimeiroNome
{
    function primeiroNome($valor)
    {
        $primeiroNome = explode(" ", $valor);
        return $primeiroNome[0];
    }
}
