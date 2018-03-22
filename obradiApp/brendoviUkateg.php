<?php


$upitBrendArray = "CALL listaBrendUKateg($id,$userId,$jezikId);";
$upitBrendKat = $db->rawQuery($upitBrendArray);


$brendovi = array();

if ($upitBrendKat) {
    foreach ($upitBrendKat as $k => $v):
        $ArtikalBrendId  = $v['ArtikalBrendId'];
        $BrendIme = $v['BrendIme'];
        $BrendLink = $v['BrendLink'];
        $BrendSlika = $v['BrendSlika'];

        //$kodBrend = ($ArtikalBrendId == $kontrole['brend']) ? 'selected' : '';

        $linkB = $BrendLink . '/b';

        $slaa = $common->locationslikaOstalo(BRENDSLIKELOK, $BrendId);

        $ext = pathinfo($BrendSlika, PATHINFO_EXTENSION);
        $fileName = pathinfo($BrendSlika, PATHINFO_FILENAME);
        $mala_slika = $fileName . '_mala.' . $ext;
        $lok = DPROOT . $slaa . $mala_slika;

        //$slika = $fileName . '_172.' . $ext;


        $brd['ArtikalBrendId'] = $ArtikalBrendId;
        $brd['BrendIme'] = $BrendIme;
        $brd['BrendLink'] = $BrendLink;
        $brd['BrendSlika'] = $lok;




        array_push($brendovi, $brd);

    endforeach;
}
?>


