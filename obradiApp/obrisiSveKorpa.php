<?php


/*
 * $id = artikal id
 * $br = kolicina
 * $userId = korisnik
 * */

// ovde nam fali podatak da mi posaljes za usera da znam da je on
// tipa nesto sto ti dajem pri registraciji ili

/*if (!$id) {

    $m['tag'] = 'obrisiArtikalKorpa';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Artikla";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}*/

/*if (!$br) {

    $m['tag'] = 'obrisiArtikalKorpa';
    $m['success'] = false;
    $m['error'] = 2;
    $m['error_msg'] = "Nema Kolicine Artikla";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}*/
if (!$userTip) {
    $m['tag'] = 'obrisiSveKorpa';
    $m['success'] = false;
    $m['error'] = 0;
    $m['error_msg'] = "Ne postoji registrovan user";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}

if ($userTip) {

    $db->where ("KomiTempArt", $userId);
    $daliImaArt = $db->getOne ("tempart");
    if ($daliImaArt) {

        $db->where('KomiTempArt', $userId);
        if ($db->delete('tempart')) {

            $m['tag'] = 'obrisiSveKorpa';
            $m['success'] = true;
            $m['error'] = 1;
            $m['error_msg'] = "Sve Obrisano";

        } else {

            $m['tag'] = 'obrisiSveKorpa';
            $m['success'] = false;
            $m['error'] = 2;
            $m['error_msg'] = "Neki je bag pri brisanju";

        }


    } else {

        $m['tag'] = 'obrisiSveKorpa';
        $m['success'] = false;
        $m['error'] = 4;
        $m['error_msg'] = "Nema artikala u temp ali cemo za svaki slucaj jos jedno da pobrisemo sve";

        $db->where('KomiTempArt', $userId);
        if ($db->delete('tempart')) {

            $m['tag'] = 'obrisiSveKorpa';
            $m['success'] = true;
            $m['error'] = 5;
            $m['error_msg'] = "Sve Obrisano za svaki slucaj";

        }

    }




} else {
    $m['tag'] = 'obrisiSveKorpa';
    $m['success'] = false;
    $m['error'] = 3;
    $m['error_msg'] = "Ne postoji registrovan user";
}


echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);


?>

