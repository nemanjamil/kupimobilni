<?php
$pokazi .= '<div style="border: 1px solid #000000; padding: 40px;background-color: lightsalmon">';
// UBACIMO ARTIKAL OPIS ArtikliTekstovi
$pokazi .= '<li><strong style="color: #0016b0"> INSERT  KRATAK TEKSTOVI OPIS BOSCH </strong></li>';
$pokazi .= '<li><strong style="color: #0016b0"> ID ARTIKLA KRATAK KOJI BRISEMO TEKST KRATAK '.$idArti0.' </strong></li>';

if ($opis64) {
    if ($idArti0) {
        $db->where('IdArtiklaAkon', $idArti0);
        if ($db->delete('artiklikratakopisnew')) {
            $pokazi .= '<li>Obrisali smo sve tekstove za taj artikal iz baze</li>';
        } else {
            $pokazi .= '<li>NISMO Obrisali smo sve tekstove za taj artikal iz baze</li>';
        }


        foreach ($jezLan as $k => $v):
            $ShortLanguage = $v['ShortLanguage'];
            $IdLanguage = $v['IdLanguage'];


            $data = Array(
                'IdArtiklaAkon' => $idArti0,
                'IdLanguageAkon' => $IdLanguage,
                'OpisKratakOpis' => $opis64deco  //$kategorijeDodatna->vice_versa_cySR($sve,'cy')
            );

            $idNazivTekst = $db->insert('artiklikratakopisnew', $data);
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


