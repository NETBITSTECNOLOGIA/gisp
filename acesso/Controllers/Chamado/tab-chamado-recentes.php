<?php
session_start();
include_once 'conexao.php';
include_once 'funcoes.php';
$idempresa = $_SESSION['idempresa'];
//nchamado idcliente	idempresa	nome	tipo	usuariocad	datacad	obs	usuarioatendeu	dataatendimento	obsusuario	situacao	
$query = mysqli_query($conexao, "SELECT * FROM chamado
WHERE chamado.idempresa='$idempresa' AND chamado.situacao IN ('ABERTO','PENDENTE') ORDER BY chamado.id DESC LIMIT 10") or die(mysqli_error($conexao));

while ($dd = mysqli_fetch_array($query)) {
    echo '
<tr>
    <td><a href="exibir-chamado.php?id=' . $dd['id'] . '">' . $dd['nchamado'] . '</a></td>
    <td>' . $dd['tipo'] . '</td>
    <td>' . $dd['nomecliente'] . '</td>
    <td>' . dataForm($dd['datacad']) . '</td>
    <td>';
    if ($dd['situacao'] == 'ABERTO') {
        echo '<span class="label label-info">' . $dd['situacao'] . '</span>';
    }
    if ($dd['situacao'] == 'PENDENTE' or $dd['situacao'] == 'PENDENTE TERCEIRO') {
        echo '<span class="label label-warning">' . $dd['situacao'] . '</span>';
    }
    echo '</td>
</tr>';
}
