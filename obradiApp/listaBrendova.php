<?php

$m['tag'] = 'listaBrendova';
$m['success'] = true;
$m['error'] = 0;
$m['error_msg'] = "Nema Errora";


$specPoKategArr = array();


$data = $db->rawQuery('CALL listaBrendovaJezik('.$jezikId.',2)');

$brand = '';
if ($data) {

    foreach ($data as $sds => $link) {
        $BrendId = $link['BrendId'];
        $BrendIme = $link['BrendIme'];
        $BrendLink = $link['BrendLink'];
        $BrendSlika = $link['BrendSlika'];
        $BrendActive = $link['BrendActive'];
        $BrendNaslovna = $link['BrendNaslovna'];
        $BrendShow = $link['BrendShow'];
        $BrendSajt = $link['BrendSajt'];

        $linkB = $BrendLink . '/b';

        $slaa = $common->locationslikaOstalo(BRENDSLIKELOK, $BrendId);

        $ext = pathinfo($BrendSlika, PATHINFO_EXTENSION);
        $fileName = pathinfo($BrendSlika, PATHINFO_FILENAME);

        $mala_slika = $fileName . '_mala.' . $ext;
        $lok = $slaa . '/' . $mala_slika;
        $slikaMala = DPROOT.$common->nemaSlikeBezCrte($lok);

        $slika = $fileName . '_172.' . $ext;
        $lok = $slaa . '/' . $slika;
        $slika172 = DPROOT.$common->nemaSlikeBezCrte($lok);


        $spcK['BrendId'] = $BrendId;
        $spcK['BrendIme'] = $BrendIme;
        $spcK['BrendLink'] = $BrendLink;
        $spcK['BrendSlikaMala'] = $slikaMala;
        $spcK['BrendSlika172'] = $slika172;
        $spcK['BrendActive'] = $BrendActive;
        $spcK['BrendNaslovna'] = $BrendNaslovna;
        $spcK['BrendShow'] = $BrendShow;
        $spcK['BrendSajt'] = $BrendSajt;

        $f[] = $spcK;

    }

    $m['listaBrend'] = $f;

}


echo json_encode($m, JSON_UNESCAPED_UNICODE);

?>

