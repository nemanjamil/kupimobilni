<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 08. 2015.
 * Time: 17:18
 */

$SenzorSifra = $common->clearvariable($_POST[SenzorSifra]);
$IdListaSenzora = $common->clearvariable($_POST[IdListaSenzora]);

if (isset($SenzorSifra)) {
    $updatespec = Array(
        "SenzorSifra" => "$SenzorSifra"
    );

//    $db->setTrace(true);
    $db->where("IdListaSenzora", $IdListaSenzora);
    $db->update('listasenzora', $updatespec);
//var_dump($db->trace);

    header("Location:/admin/senzori");

} else {
    $error_msg["error"] = 'Greska pri izmeni senzora';
}

echo $m = json_encode($error_msg);
?>