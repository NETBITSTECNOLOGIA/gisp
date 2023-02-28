<?php
session_start();
setCookie('idcliente');
setCookie('idempresa');
setCookie('nomecliente');
setCookie('acesso');
setCookie('lembrete');
session_unset();
ob_end_clean();
echo "<script>location.href='login.php'</script>";

?>
