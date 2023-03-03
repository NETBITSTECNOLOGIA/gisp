<?php
//verificar quantidade de sms disparado hoje

class SmsController
{
    private $idempresa;

    public function getIdempresa()
    {
        return $this->idempresa;
    }

    public function setIdempresa($idempresa)
    {
        if (empty($idempresa)) {
            $this->idempresa = $idempresa;
        } else {
            return '';
        }
    }
}

/* protected $idempresa;

public function __construct(int $idempresa)
{
    if (empty($idempresa)) :
        $this->idempresa = $idempresa;
    else :
        return '';
    endif;
} */