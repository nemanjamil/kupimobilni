<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 9. 09. 2015.
 * Time: 12:03
 */


$IdOSnPodaci = $common->clearvariable($_POST['IdOSnPodaci']);
if (isset($IdOSnPodaci)) {
    $updatenaslovnu = Array(
        'welcomeNas' => $_POST['welcomeNas'],
        'welcomeOpis' => $_POST['welcomeOpis'],
        'welcomeTbNas1' => $_POST['welcomeTbNas1'],
        'welcomeTbOpis1' => $_POST['welcomeTbOpis1'],
        'welcomeTbNas2' => $_POST['welcomeTbNas2'],
        'welcomeTbOpis2' => $_POST['welcomeTbOpis2'],
        'welcomeTbNas3' => $_POST['welcomeTbNas3'],
        'welcomeTbOpis3' => $_POST['welcomeTbOpis3']

    );

    $db->where("IdOsnPodaci", $id);
    $db->update('osnpodaci', $updatenaslovnu);

    header("Location:admin/txtnaslovna");

} else {
    $error_msg["error"] = 'Greska pri izmeni tekstova';
}


echo $m = json_encode($error_msg);


?>