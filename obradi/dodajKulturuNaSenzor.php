<?php

$IdListaSenzora = $common->isEmpty($_POST['IdListaSenzora'], FILTER_SANITIZE_NUMBER_INT);
$PripadaKulLok = $common->isEmpty($_POST['PripadaKulLok'], FILTER_SANITIZE_NUMBER_INT);

if (!$IdListaSenzora) {
    echo 'Ne postoji IdListaSenzora';
    die;
}
if (!$PripadaKulLok) {
    echo 'Ne postoji $PripadaKulLok';
    die;
}


$data = Array(
    'IdListaSenzora' => $IdListaSenzora,
    'IdKulture' => $PripadaKulLok
);


$db->startTransaction();

if (!$db->insert('kulturasenzor', $data)) {
    $db->rollback();
    echo 'Nije dobro ubacio';
    die;
} else {
    //OK
    $db->commit();
}

header("Location: " . URLVRATI);

?>

