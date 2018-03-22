<?php


$cols = Array("IdArtikliSlike", "ImeSlikeArtikliSlike", "MainArtikliSlike");
$db->where('IdArtikliSlikePov', $ArtikalIdSmall);
$db->orderBy("MainArtikliSlike", "DESC");
$slikeArtikla = $db->get("artiklislike", null, $cols);
$lokFolder = $common->locationslika($ArtikalIdSmall);
$slSve = '';

$sli = 1;
if (!$slikeArtikla) {
    $velika_slika = $common->nemaSlike('');
}

if ($slikeArtikla) {

    $sliki = array();

    foreach ($slikeArtikla as $sl => $vs):


        $ImeSlikeArtikliSlike = $vs['ImeSlikeArtikliSlike'];
        $IdArtikliSlike = $vs['IdArtikliSlike'];
        $MainArtikliSlike = $vs['MainArtikliSlike'];

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $slikica['IdArtikliSlike'] = $IdArtikliSlike;

        if ($MainArtikliSlike == 1) {
            $slikica['glavna'] = 1;
        } else {
            $slikica['glavna'] = 0;
        }


        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $lok = DCROOT . $mala_slika;
        if (is_file($lok)) {
            $mala_slika = DPROOT . $mala_slika;
        } else {
            $mala_slika = DPROOT . '/assets/images/banners/2.jpg';
        }
        $slikica['mala_slika'] = $mala_slika;

        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $lok = DCROOT . $srednja_slika;
        if (is_file($lok)) {
            $srednja_slika = DPROOT . $srednja_slika;
        } else {
            $srednja_slika = DPROOT . '/assets/images/banners/2.jpg';
        }
        $slikica['srednja_slika'] = $srednja_slika;


        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;
        $lok = DCROOT . $velika_slika;
        if (is_file($lok)) {
            $velika_slika = DPROOT . $velika_slika;
        } else {
            $velika_slika = DPROOT . '/assets/images/banners/2.jpg';
        }
        $slikica['velika_slika'] = $velika_slika;


        array_push($sliki, $slikica);

        $products['slike'] = $sliki;
    endforeach;
}

?>