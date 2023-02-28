<?php

function alert($msg, $tipo, $ico)
{
    echo '<div class="alert alert-"' . $tipo . '>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
    <i class="icon fa fa-"' . $ico . '></i> <strong> ' . $msg . '</strong>
    </div>';
};
