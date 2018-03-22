<?php

$KategorijaArtikalaNaziv = $common->clearvariable($_POST[KategorijaArtikalaNaziv]);
//$KategorijaArtikalaOpis = $common->clearvariable($_POST[KategorijaArtikalaOpis]);



if (true) {



    $cols = Array("KategorijaArtikalaIdZdravlje");
    $db->where ("ParentKategorijaArtikalaIdZdravlje", $id);
    $users = $db->get ("kategorijezdravlje", null, $cols);
    // ako ima vise od 0 onda moze da se doda nova kategorija
    if ($db->count > 0) {


        $cols = Array("KategorijaArtikalaIdZdravlje", "", "",
            "KategorijaArtikalaMestoZdravlje","KategorijaArtikalaActiveZdravlje","KategorijaArtikalaSlikaZdravlje");

         $insertData = Array(
            'ParentKategorijaArtikalaIdZdravlje' => $id,
            'KategorijaArtikalaLinkZdravlje' => $common->friendly_convert($string)
        );



        try {
            //$db->setTrace (true);
            // First of all, let's begin a transaction
            $db->startTransaction();
            // A set of queries; if one fails, an exception should be thrown
            $idub = $db->insert('kategorijezdravlje', $insertData);

            $insertDataOpis = Array( 'IdKategZdravljeOpis' => $idub  );
            $insertDataIme = Array( 'IdKategZdravlje' => $idub );
             $db->insert('KategZdravljeOpis', $insertDataOpis);
             $db->insert('KategImeZdravlje', $insertDataIme);

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
        $insertData = Array( 'ParentKategorijaArtikalaIdZdravlje' => $id,'KategorijaArtikalaLinkZdravlje' => $common->friendly_convert($string));
        try {

            $db->startTransaction();

            $idub = $db->insert('kategorijezdravlje', $insertData);

            $insertDataOpis = Array( 'IdKategZdravljeOpis' => $idub  );
            $insertDataIme = Array( 'IdKategZdravlje' => $idub );
            $db->insert('KategZdravljeOpis', $insertDataOpis);
            $db->insert('KategImeZdravlje', $insertDataIme);


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