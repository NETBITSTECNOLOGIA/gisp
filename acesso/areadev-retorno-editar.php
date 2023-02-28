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
    <input type="hidden" name="id" value="'.$ret['id'].'"/>
    <label class="col-lg-6 col-md-12 col-sm-12 col-xs-12">Área
    <select type="text" class="form-control" name="area" required>
      <option value="'.$ret['area'].'">'.$ret['area'].'</option>
      <option value="Cliente">Cliente</option>
      <option value="Financeiro">Financeiro</option>
      <option value="Parametros">Parametros</option>
      <option value="Chamados">Chamados</option>
      <option value="Usuaários-ISP">Usuários-ISP</option>
      <option value="Relatórios">Relatórios</option>
    </select>
    </label>

    <label class="col-lg-12">Descrição
    <textarea rows="6" class="form-control" placeholder="Descreva a tarefa" name="descricao" required>'.AspasForm($ret['descricao']).'</textarea>
    </label>

    <label class="col-lg-12">Imagem (JPG OU JPEG)
        <input type="file" class="form-control" name="arquivo" accept="image/jpg, image/jpeg"/>
    </label>
    <label class="col-lg-12">Imagem (JPG OU JPEG)
    <input type="file" class="form-control" name="arquivo2" accept="image/jpg, image/jpeg"/>
    </label>
    <label class="col-lg-12">Imagem (JPG OU JPEG)
    <input type="file" class="form-control" name="arquivo3" accept="image/jpg, image/jpeg"/>
    </label>';
