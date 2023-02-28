<?php
session_start();
include_once('conexao.php');
include_once('funcoes.php');
@$idempresa = $_SESSION['idempresa'];
@$tipouser = @$_SESSION['tipouser'];
@$iduser = $_SESSION['iduser'];
$query = mysqli_query($conexao, "SELECT * FROM recibosavulso WHERE idempresa='$idempresa'") or die(mysqli_error($conexao));

echo '
<div class="card-body table-responsive p-0">
<table id="example" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Valor</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>';
while ($dd = mysqli_fetch_array($query)) {
    echo '
            <tr>
                <td>' . $dd['id'] . '</td>
                <td>' . $dd['nome'] . '</td>
                <td>' . $dd['cpf_cnpj'] . '</td>
                <td>' . substr(AspasForm($dd['descricao']), 0, 30) . '</td>
                <td>' . $dd['data'] . '</td>
                <td>' . Real($dd['valor']) . '</td>
                <td>';
    if ($_SESSION['tipouser'] == 'Admin' || PermissaoCheck($idempresa, 'recibos-imprimir', $iduser) == 'checked') {
        echo '
                    <a href="#" class="btn btn-social-icon btn-black" data-fancybox data-type="iframe" data-src="imprimir-recibo.php?id=' . @$dd['id'] . '"><i class="fa fa-print"></i></a>&ensp; ';
    }
    if ($_SESSION['tipouser'] == 'Admin' || PermissaoCheck($idempresa, 'recibos-editar', $iduser) == 'checked') {
        echo '
                    <a href="#" onclick="alterar(' . $dd['id'] . ')" class="btn btn-social-icon btn-edit" aria-hidden="true" title="Alterar recibo"><i class="fa fa-edit"></i></a>&ensp;';
    }
    if ($_SESSION['tipouser'] == 'Admin' || PermissaoCheck($idempresa, 'recibos-excluir', $iduser) == 'checked') {
        echo '
                    <a href="#" onclick="excluir(' . $dd['id'] . ')" class="btn btn-social-icon btn-trash" aria-hidden="true" title="Excluir"><i class="fa fa-trash"></i></a>';
    }
    echo '
                </td>
            </tr>';
}
echo '
    </tbody>
</table></div>';
?>
<script type="text/javascript" src="plugins/dataTable/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="plugins/dataTable/jquery.dataTables.min.css" />
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "lengthMenu": "Exibir _MENU_ linhas",
                "zeroRecords": "Sem registro",
                "info": "Linhas de _PAGE_ at&eacute; _PAGES_",
                "infoEmpty": "Nenhum registro dispon&iacute;vel",
                "infoFiltered": "(filtrados de _MAX_ total de linhas)"
            },
            stateSave: true,
            "order": [
                [0, "asc"]
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
    });
</script>