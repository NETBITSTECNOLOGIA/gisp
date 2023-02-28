<?php
require_once '../config/database';

namespace App\Model;
//padrão singleton apenas uma conexão
class Conexao{
    //static chamar com self::   <--- lembra
    private static $instance;

    public static function getConn(){
        //se existir ele retorna
        if(!isset(self::$instance)){
            self::$instance = new \PDO('mysql:host=$host;dbname=$dbname;charset=utf8,$username,$pass');
        }
        //se não ele cria
        return self::$instance;
    }
}