<?php
session_start();
include_once 'conexao.php';
include_once 'funcoes.php';
$idempresa = $_SESSION['idempresa'];
@$iduser = $_SESSION['iduser'];
$nomeuser = $_SESSION['usuario'];
//nchamado idcliente	idempresa	nome	tipo	usuariocad	datacad	obs	usuarioatendeu	dataatendimento	obsusuario	situacao	
$query = mysqli_query($conexao, "SELECT chamado.*, cliente.nome FROM chamado 
LEFT JOIN cliente ON chamado.idcliente = cliente.id
WHERE chamado.idtecnico='$iduser' AND chamado.nometecnico='$nomeuser'AND chamado.situacao IN ('ABERTO','PENDENTE','PENDENTE TERCEIRO','REABERTO') ORDER BY chamado.situacao ASC") or die(mysqli_error($conexao));
if (mysqli_num_rows($query) >= 1) {
    while ($dd = mysqli_fetch_array($query)) {
        echo '
<tr>
    <td><a href="exibir-chamado.php?id=' . $dd['id'] . '">' . $dd['nchamado'] . '</a></td>
    <td>' . $dd['tipo'] . '</td>
    <td>' . $dd['nome'] . '</td>
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
} else {
    echo '<tr><td colspan="5">Sem chamados</td></tr>';
}
