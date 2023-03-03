<?php

class PermissaoController
{
    public $idempresa, $item, $id, $iduser;

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
