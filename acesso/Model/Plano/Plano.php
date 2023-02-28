<?php
//planos
function planosServidor($idempresa)
{
    include_once 'conexao.php';
    $sql = mysqli_query($conexao, "SELECT id,plano,nomeservidor FROM plano WHERE idempresa='$idempresa'");
    if (mysqli_num_rows($sql) >= 1) {
        while ($d = mysqli_fetch_array($sql)) {
            echo '<option value="' . $d['id'] . '">' . $d['nomeservidor'] . '-' . $d['plano'] . '</option>';
        }
    }
}
