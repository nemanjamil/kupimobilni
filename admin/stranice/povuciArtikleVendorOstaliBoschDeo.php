<?php


//$db->startTransaction();

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

$pokazi .= '<ul style="border: 1px dashed coral;background-color: #DEDEDE">';
$pokazi .= '<li>Id artikla ubacenog na sajtu : <a target="_blank" href="' . DPROOT . '/lalala/' . $idArt . '">' . $idArt . '</a></li>';
$pokazi .= '<li>Id artikla kod nas u bazi je  : <a target="_blank" href="' . DPROOTADMIN . '/str/editartikal/' . $idArt . '">' . $idArt . '</a></li>';
$pokazi .= '</ul>';

// nova tabela za Nazive Artikala
$pokazi .=  '<ul class="pozadinasvplava">';
require('ubaciNaziveArtNewVendor.php');
$pokazi .=  '</ul>';

// stara tabela za Nazive Artikala
//require('ubaciNaziveArtOld.php');


/*
 * SADA UBACUJEMO SLIKE ARTIKLA
 */
$pokazi .= $common->microtime_floatProlaz($start,1);
if ($idArt) {
    require('dodatna/ubaciSlikeAriklaDodatna.php');
}
$pokazi .= $common->microtime_floatProlaz($start,2);

//var_dump($db->trace);

/*
* UBACUJEMO OPIS
 * ArtikliTekstovi
*/
$db->where("ArtikalId", $idArt);
$user = $db->getOne("artiklitekstovinew");
$IdArtikliTekstovi = $user['ArtikalId'];

$sve = '<div class="opisBoschUvlacenje">' . $opisDetaljan . '</div>';
require(DCROOT . '/admin/stranice/dodatna/ubaciArtNazivArtOpisBosch.php');



