<?php

//receber dados do controller
include_once '../database/conexao.php';
include_once '../controllers/auth/auth_controller.php';


class AuthModel
{
    /*
    public function create(AuthController $p)
    {
        $sql = 'INSERT INTO produtos (nome,descricao) VALUES (?,?)';
        $stmt = Conexao::getConn()->prepare($sql); //prepare transforma todos os dados em string (texto), para evitar sqlinjecto
        $stmt->bindValue(1, $p->getNome());
        $stmt->bindValue(2, $p->getDescricao());
        $stmt->execute();
    }
    */

    public function read(AuthController $valor)
    {
        //se for tipo 1 mandar pra user se for tipo 2 mandar pra usuario

        $sql = 'SELECT * FROM user WHERE email=? AND senha=? AND situacao=1 LIMIT 1';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $valor->getEmail());
        $stmt->bindValue(2, $valor->getSenha());
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }
    /*
    public function update(AuthController $p)
    {

        $sql = 'UPDATE produtos SET nome=?, descricao=? WHERE id=?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getNome());
        $stmt->bindValue(2, $p->getDescricao());
        $stmt->bindValue(3, $p->getId());
        $stmt->execute();
    }

    public function delete($id)
    {

        $sql = 'DELETE FROM produtos WHERE id=?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
*/
}

/*
if ($tipo == 1) {
    if (isset($user) != '' and isset($senha) != '') {
        $sql = mysqli_query($conexao, "SELECT * FROM user WHERE user='$user' AND senha='$senha' AND situacao=1 LIMIT 1") or die(mysqli_error($conexao));
        $ddu = mysqli_fetch_array($sql);
        if (empty($ddu)) {
            echo '<button class="alert alert-danger btn-block"><i class="fa fa-exclamation-triangle"></i> Usuário ou senha inválido!</button>';
        }  //se $dados_uu for vazio mostrar o erro
        else {
            $_SESSION['idempresa'] = $ddu['idempresa'];
            if ($ddu['tipo'] != '') {
                $_SESSION['tipouser'] = $ddu['tipo'];
            } else {
                $_SESSION['tipouser'] = 'comum';
            }

            $_SESSION['tipouser'] = $ddu['tipo'];
            $_SESSION['cargo'] = $ddu['cargo'];
            $_SESSION['iduser'] = $ddu['id'];
            $_SESSION['usuario'] = $ddu['nome'];
            $_SESSION['situacaouser'] = $ddu['situacao'];
            $_SESSION['logomarcauser'] = $ddu['logomarca'];

            $idempresa = $_SESSION['idempresa'];
            $tipouser = $_SESSION['tipouser'];
            $usercargo = $_SESSION['cargo'];
            $iduser = $_SESSION['iduser'];
            $nomeuser = $_SESSION['usuario']; //pega usuario que est� executando a a��o
            $situacaouser = $_SESSION['situacaouser'];
            $logomarcauser = $_SESSION['logomarcauser'];
            $ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
            $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

            echo "<script>location.href='../Views/Home/';</script>";
        }
    } else {
        echo '<button class="alert alert-danger btn-block"><i class="fa fa-exclamation-triangle"></i> Usuário ou senha inválido!</button>';
    }
    //user staff
} elseif ($tipo == 2) {
    if (isset($user) != '' and isset($senha) != '') {
        $sql = mysqli_query($conexao, "SELECT * FROM usuarios WHERE login='$user' AND senha='$senha' AND situacao=1 LIMIT 1") or die(mysqli_error($conexao));
        $ddu = mysqli_fetch_array($sql);
        if (empty($ddu)) {
            echo '<button class="alert alert-danger btn-block"><i class="fa fa-exclamation-triangle"></i> Usuário ou senha inválido!</button>';
        }  //se $dados_uu for vazio mostrar o erro
        else {
            $_SESSION['idempresa'] = $ddu['idempresa'];
            $_SESSION['tipouser'] = 'Staff';
            $_SESSION['cargo'] = 'Staff';
            $_SESSION['iduser'] = $ddu['id'];
            $_SESSION['usuario'] = $ddu['nome'];
            $_SESSION['situacaouser'] = $ddu['situacao'];
            $_SESSION['logomarcauser'] = $ddu['logomarca'];

            $idempresa = $_SESSION['idempresa'];
            $tipouser = $_SESSION['tipouser'];
            $usercargo = $_SESSION['cargo'];
            $iduser = $_SESSION['iduser'];
            $nomeuser = $_SESSION['usuario']; //pega usuario que est� executando a a��o
            $situacaouser = $_SESSION['situacaouser'];
            $logomarcauser = $_SESSION['logomarcauser'];
            $ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
            $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

            echo "<script>location.href='index.php';</script>";
        }
    } else {
        echo '<button class="alert alert-danger btn-block"><i class="fa fa-exclamation-triangle"></i> Usuário ou senha invlido!</button>';
    }
} else {
    echo 'erro maluco ;)';
}

*/