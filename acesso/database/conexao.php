<?php

//padrão singleton apenas uma conexão
class Conexao
{
    //static chamar com self::   <--- lembra
    private static $instance;

    public static function getConn()
    {
        //se existir ele retorna
        if (!isset(self::$instance)) {
            self::$instance = new \PDO('mysql:host=localhost;dbname=gisp;charset=utf8', 'root', '');
        }
        //se não ele cria
        return self::$instance;
    }
}
