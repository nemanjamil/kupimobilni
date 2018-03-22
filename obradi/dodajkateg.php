<?php

$KategorijaArtikalaNaziv = $common->clearvariable($_POST[KategorijaArtikalaNaziv]);
//$KategorijaArtikalaOpis = $common->clearvariable($_POST[KategorijaArtikalaOpis]);



if (true) {

    $s = "SELECT daLiImaPodkat($id) AS kolikoImaPodkat";
    $kipodKat = $db->rawQuery($s);
    $kolikoredova = $kipodKat[0]['kolikoImaPodkat'];
    // ako ima vise od 0 onda moze da se doda nova kategorija
    if ($kolikoredova > 0) {


         $insertData = Array(
            'ParentKategorijaArtikalaId' => $id,
            'KategorijaArtikalaLink' => $common->friendly_convert($string)
        );

        try {
            //$db->setTrace (true);
            // First of all, let's begin a transaction
            $db->startTransaction();
            // A set of queries; if one fails, an exception should be thrown
            $idub = $db->insert('kategorijeartikala', $insertData);
            // TODO nikola dodaj ime kategorije
            //'KategorijaArtikalaNaziv' => $string,

            $insert_Naziv_query = Array(
                'IdKategorije' => $idub,
                'IdLanguage' => 5,
                'NazivKategorije' => $KategorijaArtikalaNaziv,
            );
            $idUbac = $db->insert('kategorijeartikalanaslov', $insert_Naziv_query);

            //print_r ($db->trace);

            $db->commit();

        } catch (Exception $e) {
            // An exception has been thrown
            // We must rollback the transaction
            $db->rollback();
        }

        if ($idub) {
            $error_msg["ok"] = 'Dodata kategorija kod kategorije koja ima podkategorije';
            $error_msg["id"] = $idub;
        } else {
            $error_msg["error"] = 'Nesto ne valja kod - IMA podkategorije pId : ' . $id . ' Error : ' . $db->getLastError();
        }


    } else {
        // ovde treba proveriti da li postoje artikli u ovoj kategoriji ako postoje onda ne moze da se doda podkategorija
        // ovde treba staviti upit u atikle koji pripadaju datoj kategoriji
        // ako ne postoje artikli u datoj kategoriji onda moze da se pravi podkategorija
        $insertData = Array(
                            'ParentKategorijaArtikalaId' => $id,
                            'KategorijaArtikalaLink' => $common->friendly_convert($string));
        try {

            $db->startTransaction();

            $idub = $db->insert('kategorijeartikala', $insertData);

            $insert_Naziv_query = Array(
                'IdKategorije' => $idub,
                'IdLanguage' => 5,
                'NazivKategorije' => $KategorijaArtikalaNaziv,
            );
            $idUbac = $db->insert('kategorijeartikalanaslov', $insert_Naziv_query);

            $db->commit();

        } catch (Exception $e) {

            $db->rollback();

        }

        if ($idub) {
            $error_msg["ok"] = 'Dodata kategorija od jedne kategorije';
            $error_msg["id"] = $idub;
        } else {
            $error_msg["error"] = 'Nesto ne valja kod - jedne kategorije pId : ' . $id . ' => Error : ' . $db->getLastError();
        }

    }
} // kraj od isset id

else {
    $error_msg["error"] = 'Nema Id';
}


echo $m = json_encode($error_msg);


?>