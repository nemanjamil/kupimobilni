<?php
$pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: lightsalmon">';
// UBACIMO ARTIKAL OPIS ArtikliTekstovi
$pokazi .= '<li><strong style="color: #0016b0"> INSERT TEKSTOVI OPIS BOSCH </strong></li>';
$pokazi .= '<li><strong style="color: #0016b0"> ID ARTIKLA KOJI BRISEMO TEKST '.$idArti0.' </strong></li>';

if ($opis64) {
    if ($idArti0) {
        $db->where('ArtikalId', $idArti0);
        if ($db->delete('artiklitekstovinew')) {
            $pokazi .= '<li>Obrisali smo sve tekstove za taj artikal iz baze</li>';
        } else {
            $pokazi .= '<li>NISMO Obrisali smo sve tekstove za taj artikal iz baze</li>';
        }


        foreach ($jezLan as $k => $v):
            $ShortLanguage = $v['ShortLanguage'];
            $IdLanguage = $v['IdLanguage'];


            $data = Array(
                'ArtikalId' => $idArti0,
                'LanguageId' => $IdLanguage,
                'OpisArtTekst' => $opis64deco  //$kategorijeDodatna->vice_versa_cySR($sve,'cy')
            );

            $idNazivTekst = $db->insert('artiklitekstovinew', $data);
            if (!$idNazivTekst) {
                echo 'insert failed ARIKAL TEKST u bazi ArtikliTekstovi ->  file je admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php : ' . $db->getLastError();
                $db->rollback();
                die;
            } else {
                $pokazi .= '<li>Id artikla kod nas u bazi je : ' . $idArti0 . '<br></li>';
                $pokazi .= '<li>Vebsop ID je : ' . $ArtikalIdDodatna . '<br></li>';
                $pokazi .= '<li>Naziv artikla  : ' . $naziv . '<br><br></li>';
                $db->commit();
            }


        endforeach;
    } else {
        $pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: lightcoral">Ne postoji id kada brisemo tekstove</div>';
    }

} else {
    $pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: lightcoral">Ne postoji opis na Dodatnoj Opremu</div>';
}
$pokazi .= '</div>';


