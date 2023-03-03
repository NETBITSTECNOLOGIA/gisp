<?php

class AuthController
{

    private $id, $user, $email, $senha, $tipouser, $cargo, $nome, $situacao, $logomarca, $ip, $hostname;

    //criar __constructor de receber request
    //valiar dados
    //se passar manda pro modela injetar no banco

    //buscar dado
    public function getId()
    {
        return $this->id;
    }
    //setar dado
    public function setId($id)
    {
        $this->id = $id;
    }
    //buscar dado
    public function getUser()
    {
        return $this->user;
    }
    //setar dado
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = md5($senha);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        // Remove all illegal characters from email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate Email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            return "";
        }
    }

    public function getTipoUser()
    {
        return $this->tipouser;
    }

    public function setTipoUser($tipouser)
    {
        $this->tipouser = $tipouser;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSituacao()
    {
        return $this->situacao;
    }

    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    public function getLogomarca()
    {
        return $this->logomarca;
    }

    public function setLogomarca($logomarca)
    {
        $this->logomarca = $logomarca;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }
}
