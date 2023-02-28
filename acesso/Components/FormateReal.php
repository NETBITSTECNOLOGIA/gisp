<?php
function Real($valor)
{
    if ($valor == true) {
        return number_format($valor, 2, ',', '.');
    } else {
        return '0,00';
    }
};
