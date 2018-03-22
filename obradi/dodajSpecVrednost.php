<?php
foreach ($_POST['grupe'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}




if ($id) {

    try {
        // $db->setTrace (true);
        $db->startTransaction();


        // Prvo ubacujemo u specvrednosti
        $insert_query = Array(
            'IdSpecVrednostiGrupe' => $id

        );
        $idTag = $db->insert('specvrednosti', $insert_query);
        if ($idTag) {
            $error_msg = true;
        } else {
            $error_msg = false;
        }



        foreach ($artiN as $key => $val) {
            $insert_query = Array('IdSpecVrednosti' => $idTag, 'IdLanguage' => $key, 'SpecVredNaziv' => $val);
            $db->setQueryOption(Array('IGNORE'));
            $idArtNewInsert = $db->insert('specvrednaziv', $insert_query);

            if ($idArtNewInsert) {
                $error_msg = true;
            } else {
                $error_msg = false;
            }

        }

        if ($error_msg) {
            $db->commit();
        } else {
            $db->rollback();
        }


    } catch (Exception $e) {
        // An exception has been thrown
        // We must rollback the transaction
        $db->rollback();
        $error_msg .= 'Uradjen roll back';
    }

} else {
    $error_msg .= 'Nema id';
}
header("Location: " . URLVRATI . "/?e=$error_msg");

?>

