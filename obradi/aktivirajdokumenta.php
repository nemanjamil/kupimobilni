<?php
if($naziv == 'tip')
{$tabela = 'tipovidokumenata'; $kolonaId = 'TipDokumenataId'; $kolonaActivate = 'TipDokumenataActive';}
elseif($naziv == 'vrsta')
{$tabela = 'vrstedokumenata'; $kolonaId = 'VrsteDokumenataId'; $kolonaActivate = 'VrsteDokumenataActive';}
elseif($naziv == 'komitenti')
{$tabela = 'komitenti'; $kolonaId = 'KomitentId'; $kolonaActivate = 'KomitentActive';}


if($string == 'aktiviraj')
{$activate = 1;}
elseif($string == 'deaktiviraj')
{$activate = 0;}


if (isset($id)) {

    $update_query = Array(
        $kolonaActivate => $activate

    );

    $db->where($kolonaId, $id);
    $db->update($tabela, $update_query);

//var_dump($db);
//die;
    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju jezika';
}
echo $m = json_encode($error_msg);


header("Location:" . URLVRATI . "");