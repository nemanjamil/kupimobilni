<?php
$db->where("IdArtikalNaziv", $idArt);
$user = $db->getOne("ArtikalNaziv");
$IdArtikliNazivProvera = $user['IdArtikliTekstovi'];

if ($IdArtikliNazivProvera) {


    /*
    * UPDATE
    */

    $pokazi .= '<li><strong style="color: orange"> UPDATE NAZIV</strong></li>';
    $data = Array(

        'ArtNazsrblat' => $model,
        'ArtNazsrb' => $kategorijeDodatna->vice_versa_cySR($model,'cy')
    );
    $db->where('IdArtikalNaziv', $idArt);
    if ($db->update('ArtikalNaziv', $data)) {

        $pokazi .= '<li>' . $db->count . ' ArtikliNaziv records were UPDATE</li>';

    } else {
        $pokazi .= '<li>update failed ArtikliNaziv kod id : ' . $idArt . ' => error : ' . $db->getLastError() . '</li>';
    }

} else {

    /*
     * INSERT
     */
    $data = Array(
        'IdArtikalNaziv' => $idArt,
        'ArtNazsrblat' => $model,
        'ArtNazsrb' => $kategorijeDodatna->vice_versa_cySR($model, 'cy')
    );

    $idNaziv = $db->insert('ArtikalNaziv', $data);

    if (!$idNaziv) {
        $pokazi .= '<br><div><strong class="bojacrvena" ">Fail INSERT u bazu ->  ARIKAL NAZIV: </strong></div><br>' . $db->getLastError();
        $db->rollback();
    } else {
        $pokazi .= 'Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $idArt . '">' . $idArt . '</a><br>';
        $pokazi .= 'Vebsop ID je : ' . $idArtDodatna . '<br>';
        $pokazi .= 'Naziv artikla  : ' . $model . '<br>';
        $pokazi .= '<br/>';
        $db->commit();
    }


}

?>