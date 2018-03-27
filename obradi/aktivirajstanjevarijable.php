<?php
$tabela = 'setovanjevarijabli';
$kolonaId = 'imestanja';
$kolonaActivate = 'vrednoststanja';


if($string == 'aktiviraj')
{$activate = 1;}
elseif($string == 'deaktiviraj')
{$activate = 0;}


if (isset($string)) {

    $update_query = Array(
        $kolonaActivate => $activate
    );

    $db->where($kolonaId, $naziv);
    $db->update($tabela, $update_query);

    header("Location:$url");
} else {
    $error_msg["error"] = 'Greska pri brisanju jezika';
}
echo $m = json_encode($error_msg);


header("Location:" . URLVRATI . "");