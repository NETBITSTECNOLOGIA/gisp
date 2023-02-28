<?php
session_start();
include_once 'conexao.php';
include_once 'funcoes.php';
@$idempresa = $_SESSION['idempresa'];
@$logomarcauser = $_SESSION['logomarcauser'];
@$iduser = $_SESSION['iduser'];
@$nomeuser = $_SESSION['usuario']; //pega usuario que est� executando a a��o
@$usercargo = $_SESSION['cargo'];
@$situacaouser = $_SESSION['situacaouser'];
@$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
if (isset($_SESSION['iduser']) != true || empty($_SESSION['iduser'])) {
    echo '<script>location.href="sair.php";</script>';
}

$query = mysqli_query($conexao, "SELECT * FROM vpn_gisp ORDER BY ip ASC") or die(mysqli_error($conexao));
if (mysqli_num_rows($query) >= 1) {
    while ($dd = mysqli_fetch_array($query)) {
        echo '
        <tr>
            <td>' . $dd['id'] . '</td>
            <td>' . $dd['login'] . '</td>
            <td>' . $dd['senha'] . '</td>
            <td>' . $dd['ip'] . '</td>
            <td>' . $dd['login'] . ' * ' . $dd['senha'] . ' ' . $dd['ip'] . '</td>
            <td><a href="" onclick="excluir(1,' . $dd['id'] . ')"><i class="fa fa-trash text-red fa-2x"></i></a></td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="8">Sem registro</td></tr>';
}
