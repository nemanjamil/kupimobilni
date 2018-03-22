<?php

$breadC = array();

$upitBreArr = "CALL breadCrumpNew($id,$jezikId)";
$uptBC = $db->rawQuery($upitBreArr);

if ($uptBC) {
    $uptBC = array_reverse($uptBC);


    foreach ($uptBC as $bk => $bv) {

        $bcime = $bv['KatIme'];
        $bclink = $bv['link'];
        $idBc = $bv['id'];

        $breadCrump['BrendIme'] = $bcime;
        $breadCrump['link'] = $bclink;
        $breadCrump['idBc'] = $idBc;

        array_push($breadC, $breadCrump);

    }

}


?>

