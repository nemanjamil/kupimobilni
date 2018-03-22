<?php


$pokazi .= '<li><strong style="color: orange"> UPDATE NASVLOV DREMEL</strong></li>';
$data = Array(

    'ArtNazsrblat' => $naslov,
    'ArtNazsrb' => $kategorijeDodatna->vice_versa_cySR($naslov,'cy')
);
$db->where ('IdArtikalNaziv', $idArt);
if ($db->update ('ArtikalNaziv', $data)) {

    $pokazi .= '<li>'.$db->count . ' ArtikliTekstovi records were UPDATE DREMEL</li>';

}    else {
    $pokazi .= '<li>update failed ArtikliTekstovi kod id : '.$idArt.' => error : ' . $db->getLastError().'</li>';
}




?>
