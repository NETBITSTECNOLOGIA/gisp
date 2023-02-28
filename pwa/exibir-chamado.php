<?php
include_once 'topo.php';
$id = $_GET['id'];
$query0 = mysqli_query($conexao,"SELECT * FROM chamado WHERE id='$id'") or die (mysqli_error($conexao));       
$dd= mysqli_fetch_array($query0);
echo'
<div class="row" style="font-size: 14px; margin: 8px; margin-top: -40px";>
    <div style="margin-top: 4em;" class="col-lg-12">
        <div class="page-header"  style="text-align:center;">
            <h3 style="font-family:bebas;font-size: 2.5em;letter-spacing: 1px; background: #d9d9d9;border-radius: 0.2em;">CHAMADO</h3>
            <div style="text-align:center;">
                <div>
                    <p>'.$id.'</p>
                    <label for="inputDefault">Protocolo</label>
                    <input type="text" class="form-control" name="nchamado" value="'.$dd['nchamado'].'" id="inputDefault" readonly/>
                    </div>
                <div>
                    <label for="inputDefault">Tipo</label>
                    <input type="text" class="form-control" name="tipo" value="'.$dd['tipo'].'" id="inputDefault" readonly/>
                </div>
                <div>
                    <label for="inputDefault">SITUAÇÃO</label>
                    <input type="text" class="form-control" name="situcao" value="'.$dd['situacao'].'" id="inputDefault" readonly/>
                </div>';
                if($dd['img1'] != '' OR $dd['img2'] != '' OR $dd['pdf'] != ''){echo'
                <hr><label for="inputDefault">Anexos</label><br>';
                    if($dd['img1'] != ''){echo'<a href="../acesso/docchamadp/'.$dd['img1'].'" download><img src="../acesso/docchamado/'.$dd['img1'].'" style="border-radius:5px; width:150px; margin:5px"/></a>&emsp;';}
                    if($dd['img2'] != ''){echo'<a href="../acesso/docchamadp/'.$dd['img2'].'" download><img src="../acesso/docchamado/'.$dd['img2'].'" style="border-radius:5px; width:150px; margin:5px"/></a>&emsp;';}
                    if($dd['pdf'] != ''){echo'<a href="../acesso/docchamadp/'.$dd['pdf'].'" download class="btn btn-primary text-white" style="margin:5px"><i class="fa-solid fa-note-sticky text-white"></i> Baixar anexo</a>';}
                echo'<hr>';}
                echo'                
                <div>
                    <label for="inputDefault">Descrição do cliente</label>
                    <textarea rows="4" style="color: red;" class="form-control" name="obs" id="inputDefault" readonly>'.AspasForm($dd['obs']).'</textarea>
                </div>
                <div>
                    <label for="inputDefault">Descrião suporte</label>'; 
                    $query1 = mysqli_query($conexao,"SELECT * FROM log_chamado WHERE nchamado='$dd[nchamado]' ORDER BY id DESC LIMIT 1") or die (mysqli_error($conexao));       
                    $dd2= mysqli_fetch_array($query1); 
                    echo'
                    <textarea rows="4" style="color: red;" class="form-control" placeholder="Sem descrição por enquanto" id="inputDefault" readonly>'.AspasForm(@$dd2['obs']).'</textarea>
                    
                       ';
                  
                     if($dd2['imgRetorno'] != '' OR $dd2['docRetorno'] != ''){
                    if($dd2['imgRetorno'] != ''){echo'                    
                    <a href="../acesso/docchamado/'.$dd2['imgRetorno'].'" download>
                    <img src="../acesso/docchamado/'.$dd2['imgRetorno'].'" style="border-radius:5px; width:150px; margin:5px"/></a>&emsp;
                    ';}
                    if($dd2['docRetorno'] != ''){echo'
                    <a href="../acesso/docchamado/'.$dd2['docRetorno'].'" download class="btn btn-primary text-white" style="margin:5px"><i class="fa-solid fa-note-sticky text-white"></i> Baixar anexo</a>
                
                    ';}
                }echo'
                
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <center>
        <footer id="myFooter">
                <div class="footer-social">
                    <a href="chamado.php" class="social-icons"><i class="fa fa-circle-left social-icons"></i></a>
                </div>
        </footer>
        </center>
    </div>
</div>
';
