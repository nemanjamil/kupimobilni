<?php
//$postdata = file_get_contents("php://input");
require "snimiTxt.php";

//var_dump($ipAdresa);
if (isset($_POST['id'])) { $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);} else {  $id = ''; }
if (isset($_POST['katLink'])) { $katLink = filter_var($_POST['katLink'], FILTER_SANITIZE_STRING);} else {  $katLink = ''; }

if (!$id) {
    $m['tag'] = 'promena';
    $m['success'] = false;
    $m['error'] = 5;
    $m['error_msg'] = "Nema ID";
    echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);
}

if (!$katLink) {
    $m['tag'] = 'promena';
    $m['success'] = false;
    $m['error'] = 6;
    $m['error_msg'] = "Nema katLink";
    echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);
}

if ($id && $katLink) {

    // proveriti da li postoji dati artikal kao ID ArtikalIdDodatna
    $db->where("ArtikalIdDodatna", $id);
    $user = $db->getOne("artikli");


    if ($user['ArtikalId']) {

        // Prvo vidimo koja je ta kateogija po linku
        $db->where("KategorijaArtikalaLink", $katLink);
        $kategorija = $db->getOne("kategorijeartikala");
        $KategorijaArtikalaId = $kategorija['KategorijaArtikalaId'];
        if ($KategorijaArtikalaId) {

            $data = Array(
                'KategorijaArtikalId' => $KategorijaArtikalaId
            );

            $db->where('ArtikalIdDodatna', $id);

            if ($db->update('artikli', $data)) {

                $m['tag'] = 'promena';
                $m['success'] = true;
                $m['error'] = 0;
                $m['error_msg'] = "Uspesno promenjeno na MasineAlati";


            } else {
                $m['tag'] = 'promena';
                $m['success'] = false;
                $m['error'] = 4;
                $m['error_msg'] = "Nije uspesno uradjen update na MasineAlati";
            }



        } else {

            $m['tag'] = 'promena';
            $m['success'] = false;
            $m['error'] = 3;
            $m['error_msg'] = "Ne postoji kategorija linl u Bazi na MasineAlati - ".$katLink;

        }




    } else {

        $m['tag'] = 'promena';
        $m['success'] = false;
        $m['error'] = 1;
        $m['error_msg'] = "Nema datog artikla u BaziPodataka na MasineAlati";
    }


} else {
    $m['tag'] = 'promena';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Id ili br  na MasineAlati ".var_dump($_POST);
}


echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);

