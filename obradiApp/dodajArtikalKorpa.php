<?php


/*
 * $id = artikal id
 * $br = kolicina
 * $userId = korisnik
 * */

// ovde nam fali podatak da mi posaljes za usera da znam da je on
// tipa nesto sto ti dajem pri registraciji ili

if (!$id) {

    $m['tag'] = 'dodajArtikalKorpa';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Artikla";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if (!$br) {

    $m['tag'] = 'dodajArtikalKorpa';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Kolicine Artikla";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}
if (!$userTip) {
    $m['tag'] = 'dodajArtikalKorpa';
    $m['success'] = false;
    $m['error'] = 5;
    $m['error_msg'] = "Ne postoji registrovan user";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if ($id && $br) {

        $db->startTransaction();


        $db->where ("ArtikalId", $id);
        $user = $db->getOne ("artikli",  "MinimalnaKolArt");
        $minKol = $user['MinimalnaKolArt'];

        if ($minKol>=$br) {
            $br = $minKol;
        }

        /*
         * Prvo proveravamo da li ima artikla u korpi */
        $cols = Array ("*");
        $db->where ('IdArtTempArt', $id);
        $db->where ('KomiTempArt', $userId);
        $users = $db->get ("tempart", null, $cols);
        if ($db->count > 0) {

            $data = Array (
                'KolTempArt' => $br
            );
            $db->where ('IdArtTempArt', $id);
            $db->where ('KomiTempArt', $userId);



            if ($db->update ('tempart', $data)) {

                $m['tag'] = 'dodajArtikalKorpa';
                $m['success'] = true;
                $m['error'] = 6;
                $m['error_msg'] = "Uradjen Update Kolicina Artikala";

            } else {

                $m['tag'] = 'dodajArtikalKorpa';
                $m['success'] = false;
                $m['error'] = 7;
                $m['error_msg'] = $db->getLastError();

            }




        } else {

            // INSERT
            $insert_query = Array('IdArtTempArt' => $id, 'KolTempArt' => $br, 'KomiTempArt' => $userId);
            $db->setQueryOption(Array('IGNORE'));
            $idTag = $db->insert('tempart', $insert_query);

            if($idTag){
                $m['tag'] = 'dodajArtikalKorpa';
                $m['success'] = true;
                $m['error'] = 0;
                $m['error_msg'] = "Sve je ok";
            } else {
                $m['tag'] = 'dodajArtikalKorpa';
                $m['success'] = false;
                $m['error'] = 3;
                $m['error_msg'] = $db->getLastError();
            }

        }




        $db->commit();


       require('kolikoArtuKorpi.php');

} else {
    $m['tag'] = 'dodajArtikalKorpa';
    $m['success'] = false;
    $m['error'] =4;
    $m['error_msg'] = "Nema ArtikaID ili Kolicina";
}




echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);


?>

