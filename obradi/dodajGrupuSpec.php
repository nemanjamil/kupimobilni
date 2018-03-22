<?php

foreach ($_POST['grupe'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}


if ($artiN) {

        $error_msg = false;

        //$db->setTrace (true);
        $db->startTransaction();

        // Prvo ubacujemo u SpecifikacijaGrupe
        $insert_query = Array(
            'OpisSpecGrupe' => $string


        );
        $idTag = $db->insert('specifikacijagrupe', $insert_query);
        if ($idTag) {
            $error_msg = true;
        } else {
            $error_msg = false;
        }


        if ($idTag) {
            foreach ($artiN as $key => $val) {
                $insert_query = Array('IdSpecGrupe' => $idTag, 'IdLanguage' => $key, 'NazivSpecGrupe' => $val);
                $db->setQueryOption(Array('IGNORE'));
                $idArtNewInsert = $db->insert('specgrupenaz', $insert_query);

                if ($idArtNewInsert) {
                    $error_msg = true;
                } else {
                    $error_msg = false;
                }

            }
        }


        if ($error_msg) {
            $db->commit();
        } else {
            $db->rollback();
        }
        //var_dump($db->trace);




} else {
    $error_msg .= 'Nema id';
}
header("Location: " . URLVRATI . "/?e=$error_msg");

?>

