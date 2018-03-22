<?php


$ArtikalId = $common->clearvariable($_POST[ArtikalId]);
$SenzorSifraSenzora = $common->clearvariable($_POST[SenzorSifraSenzora]);


if ($ArtikalId) {
    $data = Array(
        'SenzorZaArtikal' => $ArtikalId,
        'SenzorSifraSenzora' => $SenzorSifraSenzora


    );

    $db->startTransaction();

   $db->insert('senzorizaartikal', $data);


        $db->commit();

    } else {
        $error_msg["error"] = 'Greska pri izmeni taga';
    }


header("Location: " . URLVRATI . "/?e=$error_msg");

?>

