<?php
$BrendId = $common->clearvariable($_POST['id']);
$BrendActive = $common->clearvariable($_POST[BrendActive]);

$BrendLinkLink = $common->clearvariable($_POST[BrendLinkLink]);
$BrendLink = $common->friendly_convert($BrendLinkLink);

$BrendShow = $common->clearvariable($_POST[BrendShow]);
$BrendNaslovna = $common->clearvariable($_POST[BrendNaslovna]);

$BrendSajtMasine = $common->clearvariable($_POST['BrendSajtMasine']);
$BrendSajt = $common->clearvariable($_POST['BrendSajt']);



if (isset($BrendId)) {



    $updatebrend = Array(
        "BrendLink" => "$BrendLink",
        "BrendShow" => $BrendShow,
        "BrendNaslovna" => $BrendNaslovna,
        "BrendActive" => $BrendActive,
        "BrendSajt" => 1,
        "BrendSajtMasine" => 1
    );


    $db->where("BrendId", $BrendId);
    $idubacenog = $db->update('brendovi', $updatebrend);



    require_once('ubaciBrendIme.php');

    require_once('ubaciBrendOpis.php');

    require_once('ubaciBrendSliku.php');


    header("Location:admin/brendovifull");

}
else {
    $error_msg["error"] = 'Greska pri izmeni Brenda';
}


echo $m = json_encode($error_msg);


?>