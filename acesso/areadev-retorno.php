<?php
session_start();
include_once('conexao.php'); 
include_once('funcoes.php');
@$idempresa = $_SESSION['idempresa'];
@$logomarcauser = $_SESSION['logomarcauser'];
@$iduser = $_SESSION['iduser'];
@$nomeuser = $_SESSION['usuario'];//pega usuario que est� executando a a��o
@$usercargo = $_SESSION['cargo'];
@$situacaouser = $_SESSION['situacaouser'];
@$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
if(isset($_SESSION['iduser'])!=true || empty($_SESSION['iduser'])){echo '<script>location.href="sair.php";</script>'; }

@$id = $_GET['id'];
$sql = mysqli_query($conexao,"SELECT * FROM dev WHERE id='$id'") or die (mysqli_error($conexao));
$ret = mysqli_fetch_array($sql);
echo'
    <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Área
        <input type="text" class="form-control" name="area" value="'.$ret['area'].'"/>
    </label>

    <label class="col-lg-12">Descrição
    <textarea rows="6" class="form-control" placeholder="Descreva a tarefa" name="descricao" required>'.AspasForm($ret['descricao']).'</textarea>
    </label>';
    if($ret['img'] != null){echo'
    <label class="col-lg-12">Imagem (JPG OU JPEG)
        <a href="img-dev/'.$ret['img'].'"  target="_blank"><img src="img-dev/'.$ret['img'].'" alt="imagem tarefa" width="200px"/></a>
    </label>';
    }

    if($ret['img2'] != null){echo'
        <label class="col-lg-12">Imagem (JPG OU JPEG)
        <a href="img-dev/'.$ret['img2'].'"  target="_blank"><img src="img-dev/'.$ret['img2'].'" alt="imagem tarefa" width="200px"/></a>
        </label>';
        }

        if($ret['img3'] != null){echo'
            <label class="col-lg-12">Imagem (JPG OU JPEG)
            <a href="img-dev/'.$ret['img3'].'"  target="_blank"><img src="img-dev/'.$ret['img3'].'" alt="imagem tarefa" width="200px"/></a>
            </label>';
            }
