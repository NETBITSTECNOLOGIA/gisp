<?php
//receber dados do controller
include_once '../../database/conexao.php';
include_once '../../controllers/sms/sms_controller.php';


//sms
class SmsModel
{

    public function readDia(SmsController $valor)
    {
        //sms enviados hoje
        $sql = 'SELECT COUNT(id) as totalsms FROM log_sms WHERE idempresa=? AND data="NOW()"';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $valor->getIdempresa());
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($resultado as $key) {
                return $key['totalsms'];
            }
        }
    }
}
