<?php
$upitBrend = 'CALL listaBrendovaJezikNaslovna('.$jezikId.',1,1)';
$dataBrend = $db->rawQuery($upitBrend);


if ($dataBrend) {
    $ik = 1;
    foreach ($dataBrend as $k => $v) {


        $m['tag'] = 'sviBrendoviNaslovna';
        $m['success'] = true;
        $m['error'] = 0;
        $m['error_msg'] = "Nema Errora";

        $BrendId = $v['BrendId'];
        $BrendIme = $v['BrendIme'];
        $BrendLink = $v['BrendLink'];
        $BrendSlika = $v['BrendSlika'];
        $BrendActive = $v['BrendActive'];
        $BrendNaslovna = $v['BrendNaslovna'];
        $BrendShow = $v['BrendShow'];
        $BrendSajt = $v['BrendSajt'];
        $BrendSajtMasine = $v['BrendSajtMasine'];


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
        $spcK['BrendSajtMasine'] = $BrendSajtMasine;



        $f[] = $spcK;


    }

    $m['listaBrend'] = $f;

} else {

    $m['tag'] = 'sviBrendoviNaslovna';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Kategorija";

}


echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);


?>

