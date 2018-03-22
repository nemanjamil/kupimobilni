<?php
$db->startTransaction();

/*
 * SADA radimo INSERT datih podataka u nasu bazu
 */
$db->setTrace(true);
$data = Array(
    'ArtikalIdDodatna' => $idArtDodatna,
    'KategorijaArtikalId' => $kategorijaAgro,  // ovo dobijamo od upita sa linije 52
    'ArtikalBrendId' => $brendAgro, // bosch
    'ArtikalLink' => $url_artikla,
    'CodeBosch' => $codebosch,
    'CodeBoschLink' => $codeboschlink,
    'ArtikalMarzaId' => $marzaid,
    'ArtikalKomitent' => $vendorAgro, // to je komitent nemanja je VENDOR
    'TipKatUnitArt' => 8,  // kom
    'ArtikalMPCena' => $cena,
    'ArtikalVPCena' => $cena
);



$idArt = $db->insert('artikli', $data);
if (!$idArt) {
    echo '<div><strong style="color: red;"> Fail INSTER u bazu -> ARTIKLI : </strong></div><br>   ' . $db->getLastError();
    print_r($db->trace);
    die;
}


$db->where('ArtikalId', $idArt);
if($db->delete('artikalnazivnew')) {
    $obr = true;
} else {
    $obr = false;
}


/*
 * Ubacujemo Artikal Naziv
 * */
foreach ($jezLan as $key => $val):
    $ShortLanguage = $val['ShortLanguage'];
    $IdLanguage = $val['IdLanguage'];

    $modelSta = ($IdLanguage == 1) ? $kategorijeDodatna->vice_versa_cySR($model, 'cy') : $model;

    $insert_query = Array('ArtikalId' => $idArt, 'IdLanguage' => $IdLanguage, 'OpisArtikla' => $modelSta);
    $db->setQueryOption(Array('IGNORE'));
    $idArtNewInsert = $db->insert('artikalnazivnew', $insert_query);


endforeach;

if (!$idArtNewInsert) {
    $pokazi .= '<br><div><strong class="bojacrvena" ">Fail INSERT u bazu ->  ARIKAL NAZIV: </strong></div><br>' . $db->getLastError();
    $db->rollback();
} else {
    $pokazi .= 'Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $idArt . '">' . $idArt . '</a><br>';
    $pokazi .= 'Vebsop ID je : ' . $idArtDodatna . '<br>';
    $pokazi .= 'Naziv artikla  : ' . $model . '<br>';
    $pokazi .= '<br/>';
    $db->commit();
}


/*
 * SADA UBACUJEMO SLIKE ARTIKLA
 */
if ($idArtNewInsert) {
    require('dodatna/ubaciSlikeAriklaDodatna.php');
}

//var_dump($db->trace);

/*
* UBACUJEMO OPIS
 * ArtikliTekstovi
*/
$db->where ("ArtikalId", $idArt);
$user = $db->getOne ("artiklitekstovinew");
$IdArtikliTekstovi = $user['ArtikalId'];

$sve = '<div class="opisBoschUvlacenje">' . $opisDetaljan . '</div>';
require(DCROOT . '/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');

