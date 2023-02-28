<?php
session_start();
include_once('conexao.php');
include_once('funcoes.php');
$query = mysqli_query($conexao,"SELECT * FROM dev ORDER BY area ASC") or die (mysqli_error($conexao));
    
if(mysqli_num_rows($query) >= 1){
    while ($dd = mysqli_fetch_array($query)) {
        
        echo'<tr>
            <td>'.$dd['id'].'</td>
            <td>'.$dd['area'].'</td>
            <td>
                '.AspasForm($dd['descricao']).'
                <br />';

                echo '<i style="color: red">Resposta:</i> '.AspasForm(@$dd['resposta']);

                echo'
            </td>
            <td>'.dataForm($dd['data']).'</td>
            <td>';
            if($dd['conclusao'] != null){ echo dataForm($dd['conclusao']); }
            echo'</td>
            <td>';
            if($dd['conclusao'] == null){echo'
                <a href="#" title="editar('.$dd['id'].')" onclick="editar('.$dd['id'].')"><i class="fa fa-pencil fa-2x"></i></a>
                <a href="#" title="exibir('.$dd['id'].')" onclick="exibir('.$dd['id'].')"><i class="fa fa-eye fa-2x"></i></a>
                <a href="#" title="excluir" onclick="excluir('.$dd['id'].')"><i class="fa fa-trash fa-2x text-red"></i></a>';
            }echo'
            </td>
        </tr>';
    }
}
