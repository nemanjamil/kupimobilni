<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 06.10.15.
 * Time: 15:37
 */

$IdOSnPodaci = $common->clearvariableTekst($_POST['IdOSnPodaci']);

if (isset($IdOSnPodaci)) {
    $updatezdravlje = Array(
        'zdravljeNaslov' => $_POST['zdravljeNaslov'],
        'zdravljeOpis' => $_POST['zdravljeOpis'],
        'zdravljeTbNaslov1' => $_POST['zdravljeTbNaslov1'],
        'zdravljeTbOpis1' => $_POST['zdravljeTbOpis1'],
        'zdravljeTbNaslov2' => $_POST['zdravljeTbNaslov2'],
        'zdravljeTbOpis2' => $_POST['zdravljeTbOpis2'],

    );


//$db->setTrace(true);
    $db->where("IdOsnPodaci", $id);
    $db->update('osnpodaci', $updatezdravlje);
//print_r($db->trace);

    header("Location:admin/txtzdravlje");

} else {
    $error_msg["error"] = 'Greska pri izmeni tekstova';
}


echo $m = json_encode($error_msg);


?>