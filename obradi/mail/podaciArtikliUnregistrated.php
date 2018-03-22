<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 23.8.15.
 * Time: 17.33
 */

$cartArtKorlis = '';
$ukupnaKolArt = '';
$ukupnaKorpa = '';


$bodyMail .= '<tr>';
$bodyMail .= '<td align="center" valign="top">';

$bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
$bodyMail .= '<tr>';
$bodyMail .= '<td align="center" valign="top">';

$bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="flexibleContainer">';
$bodyMail .= '<tr>';
$bodyMail .= '<td align="center" valign="top" width="600" class="flexibleContainerCell bottomShim">';
/*$bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="nestedContainer">';
    $bodyMail .= '<tr>';
        $bodyMail .= '<td align="center" valign="top" class="nestedContainerCell">';*/


$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';

$bodyMail .= '<thead>';
$bodyMail .= '<tr>';

/*$bodyMail .= '<th class="product-thumbnail item">Image</th>';*/
$bodyMail .= '<th class="product-name item">' . $jsonlang[244][$jezikId] . '</th>';

$bodyMail .= '<th class="product-quantity item" style="text-align:center ">' . $jsonlang[130][$jezikId] . '</th>';
$bodyMail .= '<th class="product-price item" style="text-align:center ">' . $jsonlang[71][$jezikId] . '</th>';
$bodyMail .= '<th class="product-subtotal" style="text-align:center ">' . $jsonlang[131][$jezikId] . '</th>';
$bodyMail .= '</tr>';
$bodyMail .= '</thead>';


$bodyMail .= '<tbody>';

if ($korpaUnregistrated) {


    foreach ($korpaUnregistrated as $k):


        $artikalID = $k->artikalID;
        $cena = $k->cena;
        $kolicina = $k->kolicina;


        require "daLiPostojeVarijableAppUnregistra.php";

        // posto imamo $valutaId a treba nam string

        $valSesString = $common->valutaIdUString($valutaId);

        $upitArtArray = "CALL infoproizApp($artikalID,'$valSesString', $jezikId, $userId);";
        $keyArt = $db->rawQueryOne($upitArtArray);

                if (!$keyArt) {
                    $m['tag'] = 'kupovinaKorpaUnregistered';
                    $m['success'] = false;
                    $m['error'] = 30;
                    $m['error_msg'] = "Nema Artikla Kod Nas U bazi -> " . $artikalID;
                    echo json_encode($m, JSON_UNESCAPED_UNICODE);
                    die;
                }

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $ArtikalMPCena = $keyArt['ArtikalMPCena'];
        $ArtikalVPCena = $keyArt['ArtikalVPCena'];
        $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
        $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
        $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
        $BrendIme = $keyArt['BrendIme'];
        $BrendId = $keyArt['BrendId'];
        $KomitentiValuta = $keyArt['KomitentiValuta'];
        $ValutaValuta = $keyArt['ValutaValuta'];
        $MarzaMarza = $keyArt['MarzaMarza'];
        $odnosKursArt = $keyArt['odnosKursArt'];
        $pravaMp = $keyArt['pravaMp'];
        $pravaVp = $keyArt['pravaVp'];
        $ArtikalLink = $keyArt['ArtikalLink'];
        $ArtikalKratakOpis = $keyArt['OpisKratakOpis'];
        $ArtikalStanje = $keyArt['ArtikalStanje'];
        $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];
        $OpisArtikliTekstovi = $keyArt['OpisArtTekst'];
        $TipUnit = $keyArt['TipUnit'];
        $TipUnitcelo = $keyArt['TipUnitCelo'];
        $MinimalnaKol = $keyArt['MinimalnaKolArt'];
        $OpisVerKomit = $keyArt['OpisVerKomit'];
        $OcenaVeriKomi = $keyArt['OcenaVeriKomi'];
        $ImeLokSamoa = $keyArt['ImeLokSamo'];
        $IdLokSamo = $keyArt['IdLokSamo'];
        $ocenaut = $keyArt['ocenaut'];
        $KomitentIdArtikal = $keyArt['KomitentId'];
        $BojaVeriKomi = $keyArt['BojaVeriKomi'];
        $SlikaLokSamo = $keyArt['SlikaLokSamo'];
        $LinkLokSamoa = $keyArt['LinkLokSamo'];
        $ArtikalDostupnoOd = $keyArt['ArtikalDostupnoOd'];
        $ArtikalAktivan = $keyArt['ArtikalAktivan'];
        $OpisKatTekst = $keyArt['TekstKategorije'];
        $LokSamoText = $keyArt['LokSamoNaslov'];
        $dani = $keyArt['dani'];
        $ArtikalBrPregleda = $keyArt['ArtikalBrPregleda'];
        $porez = $keyArt['KomitentUPdv'];
        $vidimikirec = $keyArt['vidimikirec'];
        $KomitentKolona = $keyArt['KomitentKolona'];
        $MinimalnaKolArt = $keyArt['MinimalnaKolArt'];


        $nakasdInfoProiz = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $valutaId, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $userTip, $dani);

        require(DCROOT.'/stranice/cenaPrikazVarijableInfoProiz.php');


        if (!$cenaPrikazBrojInfo) {
                $m['tag'] = 'kupovinaKorpaUnregistered';
                $m['success'] = false;
                $m['error'] = 31;
                $m['error_msg'] = "Nema cenaPrikazBroj kod Artikal ID -> " . $artikalID;
                echo json_encode($m, JSON_UNESCAPED_UNICODE);
                die;
        }


        $lokFolder = $common->locationslika($ArtikalId);

        $urlArtiklaLink = DPROOT . '/' . $ArtikalLink . '/' . $ArtikalId;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);


        $ukupnaKolArt += $kolicina;
        $cenaPoArtKol = $cenaPrikazBrojInfo * $kolicina;

        $ukupnaKorpa += $cenaPoArtKol;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

        $ukupnaKorpapoArt = $common->formatCenaId($cenaPoArtKol, $valutaId);

       // $pravaCena = $common->formatCena($cenaPrikazBrojInfo, $valuta);


        $bodyMail .= '<tr class="okvIzbrisi">';


        /*$bodyMail .= '<td class="product-thumbnail">';
        $bodyMail .= '<a target="_blank" class="entry-thumbnail" href="'.$urlArtiklaLink.'">';
        $bodyMail .= '<img width="140px" src="'.$mala_slika.'" alt="">';
        $bodyMail .= '</a>';
        $bodyMail .= '</td>';*/

        $bodyMail .= '<td class="product-name">';
        $bodyMail .= '<ul>';
        $bodyMail .= '<li><b><a target="_blank" class="name" href="' . $urlArtiklaLink . '">' . $ArtikalNaziv . '</a></b></li>';
        //   $bodyMail .= '<li>'.$PdvOznakaValuta.' : <span>'.$PdvZemljValuta.'</span></li>';
        //$bodyMail .= '<li>' . $jsonlang[132][$jezikId] . ' : <span>' . $ImeZemljeValuta . ', ' . $KomitentMesto . '</span></li>';
        $bodyMail .= '<li>' . $jsonlang[133][$jezikId] . ' : <span>' . $TipUnit . '</span></li>';
        //   $bodyMail .= '<li>Porez je uracunat u cenu</span></li>';
        $bodyMail .= '</ul>';


        $bodyMail .= '</td>';


        $bodyMail .= '<td class="product-quantity">';
        $bodyMail .= '<div class="qty" style="text-align:center ">';

        $bodyMail .= $kolicina;

        $bodyMail .= '</div>';
        $bodyMail .= '</td>';

        $bodyMail .= '<td class="product-price" style="text-align:center "><span class="price">' . $cenaSamoBrojFormatInfo . '</span></td>';

        $bodyMail .= '<td class="product-total" style="text-align:center "><span class="total">' . $ukupnaKorpapoArt . '</span></td>';

        $bodyMail .= '</tr>';

    endforeach;
}


$bodyMail .= '</tbody>';
$bodyMail .= '</table>';


$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';
$bodyMail .= '<tbody>';
$bodyMail .= '<tr>';
$bodyMail .= '<br>';
$bodyMail .= '<td class="sub-total"><b>' . $jsonlang[277][$jezikId] . ' :</b></td>';
$bodyMail .= '<td class="sub-amount"><span>' . $common->formatCena($ukupnaKorpa, $valutasession) . ' ' . $valutasessionUpper . '</span></td>';
$bodyMail .= '</tr>';

$bodyMail .= '<tr>';
$bodyMail .= '<br>';
$bodyMail .= '<td></td>';
$bodyMail .= '<td class="sub-amount">' . $jsonlang[287][$jezikId] . '</td>';
$bodyMail .= '</tr>';

$bodyMail .= '</tbody>';
$bodyMail .= '</table>';
$bodyMail .= '<br>';

$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';
$bodyMail .= '<tbody>';
$bodyMail .= '<tr>';
$bodyMail .= '<td>';
$bodyMail .= '<br>';
$bodyMail .= '<span class="estimate-title"><b>' . $jsonlang[278][$jezikId] . ' </b></span>';

$upikPr = "SELECT GetKurs (1, '$valutasession') * " . TROSKOVIPREVOZA . " as cenaPrevoz";
$kPrevoz = $db->rawQueryOne($upikPr);
$cprev = $kPrevoz['cenaPrevoz'];
$cenaPrevoz = $common->formatCena($cprev, $valutasession);

$bodyMail .= '<p>' . $jsonlang[279][$jezikId] . '<b> ' . $cenaPrevoz . ' ' . $valutasessionUpperXXX . '</b>  <br> ' . $jsonlang[280][$jezikId] . $jsonlang[283][$jezikId] . '</p>';

$bodyMail .= '</td>';
$bodyMail .= '</tr>';
$bodyMail .= '</tbody>';
$bodyMail .= '</table>';


$bodyMail .= '<table class="table table-bordered shop-table cart" id="artikli" style="width: 100%">';
$bodyMail .= '<tbody>';
$bodyMail .= '<tr style="background-color: #d6e9c6;font-weight: bold">';
$bodyMail .= '<td class="grand-total"><span><h2>' . $jsonlang[281][$jezikId] . '</h2></span></td>';
$bodyMail .= '<td  class="total-amount"><span><h2>' . $common->formatCena($ukupnaKorpa + $cprev, $valutasession) . '</h2></span></td>';
$bodyMail .= '</tr>';
$bodyMail .= '</tbody>';
$bodyMail .= '</table>';


/*            $bodyMail .= '</td>';
        $bodyMail .= '</tr>';
    $bodyMail .= '</table>';*/
$bodyMail .= '</td>';
$bodyMail .= '</tr>';
$bodyMail .= '</table>';

$bodyMail .= '</td>';
$bodyMail .= '</tr>';
$bodyMail .= '</table>';

$bodyMail .= '</td>';
$bodyMail .= '</tr>';