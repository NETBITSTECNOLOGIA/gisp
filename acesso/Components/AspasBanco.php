<?php
function AspasBanco($string)
{
    $string = str_replace(chr(146) . chr(146), '"', $string);
    $string = str_replace(chr(146), "'", $string);
    return addslashes($string);
}