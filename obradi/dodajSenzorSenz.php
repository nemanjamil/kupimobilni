<?php
//var_dump($_POST);
$SenzorZaArtikal = $common->clearvariable($_POST[id]);
$SenzorSifraSenzora = $common->clearvariable($_POST[ArtikalId]);


if ($SenzorZaArtikal) {
    $data = Array(
        'SenzorZaArtikal' => $SenzorZaArtikal,
        'SenzorSifraSenzora' => $SenzorSifraSenzora

    );

    $db->startTransaction();
    $db->insert('senzorizaartikal', $data);

    $db->commit();


} else {
    $error_msg["error"] = 'Greska pri izmeni Senzora';
}


header("Location: " . URLVRATI . "/?e=$error_msg");

?>

