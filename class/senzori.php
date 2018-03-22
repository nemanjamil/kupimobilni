<?php

class senzori extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }

    function idImeOdIdKulture($idKulture)
    {

        $idKulture = (int)$idKulture; // proveravamo da li je ID

        if ($idKulture) {

            $this->dbConn->where("IdKulture", $idKulture);
            $user = $this->dbConn->getOne("kulture");
            $ImeKulture =  $user['ImeKulture'];
        } else {
            $ImeKulture = false;
        }
        return $ImeKulture;
    }

    function getImeOdIdSenzora($idSenzora)
    {

        $idSenzora = (int) $idSenzora; // proveravamo da li je ID

        if ($idSenzora) {

            $this->dbConn->where("IdSenzorTip", $idSenzora);
            $user = $this->dbConn->getOne("senzortip");
            $senzorTipIme =  $user['senzorTipIme'];
        } else {
            $senzorTipIme = false;
        }
        return $senzorTipIme;
    }

    function getIdfromPodaciToSenzor($id)
    {

        $id = (int) $id; // proveravamo da li je ID

        if ($id) {
            $this->dbConn->where("IdPodaciKulTipLok", $id);
            $user = $this->dbConn->getOne("podacikultiplok");
            $idPod = $user['IdKulLokPodaci'];
        } else {
            $idPod = false;
        }
        return $idPod;
    }

    function getIdFromKomitentOdIdSenzora($id)
    {

        $id = (int) $id; // proveravamo da li je ID

        if ($id) {
            $this->dbConn->where("IdListaSenzora", $id);
            $user = $this->dbConn->getOne("listasenzora");
            $idPod = $user['KomitentId'];
        } else {
            $idPod = false;
        }
        return $idPod;
    }



}