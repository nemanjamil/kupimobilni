<?php
$KategorijaArtikalaI = 11185;
$podaIn = $db->rawQueryOne("SELECT svePodkat($KategorijaArtikalaI) as svePodk");

$podIn = rtrim($podaIn['svePodk'], ",");

//$poArr = explode(',',$podaIn['svePodk']);

/* $cols = Array ("ArtikalId", "KategorijaArtikalId", "ArtikalNaziv","ArtikalLink");
 $limitKate = Array (0, 2);
 $db->where('KategorijaArtikalId', $poArr, 'IN');
 $db->orderBy("ArtikalBrPregleda","DESC");
 $keyArtAr = $db->get('artikli',$limitKate,$cols);*/
// * (V.PdvZemljValuta/100 + 1)

$podInUpitu = ($podIn) ? 'AND KA.KategorijaArtikalaId IN ('.$podIn.')' : '';

require(DCROOT.'/stranice/vidljivMp.php');

$footArtiPoc = "
SELECT *,
(CASE WHEN KomitentUPdv = 1 THEN
((SELECT GetKurs (KomitentiValuta, $valutasession))) *

(ArtikalMPCena - mpjac) *
MarzaMarza * (PorezVrednost/100 + 1)
ELSE ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
(ArtikalMPCena - mpjac)
* MarzaMarza END) AS pravaMp,

(CASE WHEN KomitentUPdv = 1 THEN ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
(ArtikalVPCena - vpjac)
  * MarzaVP * (PorezVrednost/100 + 1)
 ELSE ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
 (ArtikalVPCena -  vpjac)  * MarzaVP END) AS pravaVp
FROM (
SELECT
A.ArtikalId,
A.ArtikalNaAkciji,
A.top1,
A.top2,
A.top3,
A.KategorijaArtikalId,
UN.TipUnit,
A.ArtikalMPCena,
A.ArtikalVPCena,
A.ArtikalLink,
A.ArtikalStanje,
ANN.OpisArtikla,
ATT.OpisArtTekst,
AKO.OpisKratakOpis,
KAN.NazivKategorije,
K.KomitentiValuta,
MA.MarzaMarza,
MA.MarzaVP,
KA.KategorijaArtikalaLink,
KA.MinimalnaKol,
K.KomitentUPdv,
PLP.PorezVrednost,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
(SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
(SELECT ImeSlikeArtikliSlike FROM artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS slikaMain

FROM artikli A


    JOIN artikalnazivnew ANN
        ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId
    JOIN artiklitekstovinew ATT
        ON ATT.ArtikalId = A.ArtikalId AND  ATT.LanguageId = $jezikId
    LEFT JOIN artiklikratakopisnew AKO
        ON AKO.IdArtiklaAkon = A.ArtikalId AND  AKO.IdLanguageAkon = $jezikId

    JOIN kategorijeartikala KA
        ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
    JOIN kategorijeartikalanaslov KAN
        ON KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId


JOIN komitenti K
	ON K.KomitentId = A.ArtikalKomitent
JOIN valuta V
	ON V.ValutaId = K.KomitentiValuta
JOIN marza MA
ON MA.MarzaId = A.ArtikalMarzaId
LEFT JOIN unit UN
	ON UN.IdUnit = KA.TipKatUnit
  JOIN pdvkategzemlja PKZ
      ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
  JOIN pdvlistaporeza PLP
      ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja

WHERE
A.ArtikalAktivan >= 1
$podInUpitu
$userUpit
AND (IdZemljePdvKatZem=K.KomitentiZemlja)
ORDER BY RAND () DESC
LIMIT 15) AS T1";

$keyArtAr = $db->rawQuery($footArtiPoc);

$i = 0;
$dp = '';
    if ($keyArtAr) {
        foreach ($keyArtAr as $k => $keyArt) {

            $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];


            $ArtikalId = $keyArt['ArtikalId'];
            $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
            $top1 = $keyArt['top1'];
            $top2 = $keyArt['top2'];
            $top3 = $keyArt['top3'];
            $ArtikalNaziv = $keyArt['OpisArtikla'];
            $ArtikalMPCena = $keyArt['ArtikalMPCena'];
            $ArtikalVPCena = $keyArt['ArtikalVPCena'];
            $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
            $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
            $BrendIme = $keyArt['BrendIme'];
            $KomitentiValuta = $keyArt['KomitentiValuta'];
            $ValutaValuta = $keyArt['ValutaValuta'];
            $MarzaMarza = $keyArt['MarzaMarza'];
            $odnosKursArt = $keyArt['odnosKursArt'];
            $pravaMp = $keyArt['pravaMp'];
            $pravaVp = $keyArt['pravaVp'];
            $ArtikalLink = $keyArt['ArtikalLink'];
            $OpisKratakOpis = $keyArt['OpisKratakOpis'];
            $ArtikalStanje = $keyArt['ArtikalStanje'];
            $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];
            $pozovite = $jsonlang[117][$jezikId];
            $opisDetaljnije = $jsonlang[117][$jezikId];


            $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

            if ($ArtikalStanje > 0) {
                $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCenaExt($pravaVp, $sesValuta) : $common->formatCenaExt($pravaMp, $sesValuta);
            } else {
                $mozedase = 'disabled="disabled"';
            }


            $ImeSlikeArtikliSlike = $keyArt['slikaMain'];

            $lokFolder = $common->locationslika($ArtikalId);

            $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

            $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
            $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

            $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
            $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
            $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;



            $srednja_slika = $common->nemaSlike($srednja_slika);



            $i++;
            if ($i>10){ continue; }


            $oldPrice = '';

            $dp .= '<div class="item category-product">';
            $dp .= '<div class="products grid-v3 wow fadeInUp animated" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">';
            $dp .= '<div class="product">';
            $dp .= '<div class="product-image">';
            //$dp .= '<a href="'.$velika_slika.'" data-lightbox="image-'.$ArtikalId.'">';
            $dp .= '<a href="' . $urlArtiklaLink . '">';
            $dp .= '<div class="image">';
            //$dp .= '<img src="assets/images/blank.gif" data-echo="'.$srednja_slika.'" class="img-responsive" alt="">';
            $dp .= '<img src="' . $srednja_slika . '" class="img-responsive" alt="' . $ArtikalNaziv . '">';
            $dp .= '</div>';

            if ($NaAkciji == 6):
                $dp .= '<div class="tag">';
                $dp .= '<div class="tag-text sale">sale</div></div>';
            endif;

            if ($NaAkciji == 7):
                $dp .= '<div class="tag">';
                $dp .= '<div class="tag-text new">new</div></div>';
            endif;

            if ($NaAkciji == 8):
                $dp .= '<div class="tag">';
                $dp .= '<div class="tag-text hot">hot</div></div>';
            endif;

            $dp .= '<div class="hover-effect"><i class="fa fa-search"></i></div>';
            $dp .= '</a>';
            $dp .= '</div>';

            $dp .= '<div class="product-info">';
            $dp .= '<h3 class="name"><a href="' . $urlArtiklaLink . '">' . $ArtikalNaziv . '</a></h3>';

            $dp .= '<div class="star-rating" title="Rated 4.50 out of 5">';
            $dp .= '<span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>';
            $dp .= '</div>';

            $dp .= '<div class="product-price">';

            if ($pravaMp > '0') {
                $dp .= '<ins>';
                $dp .= '<span class="amount">' . $cenaPrikaz . '</span>';
                $dp .= '</ins>';
            } else {
                $dp .= '<ins>';
                $dp .= '<span class="availability">Pozovite</span>';
                $dp .= '</ins>';
            }

            if ($oldPrice):
                $dp .= '<del><span class="amount">' . $cenaPrikaz . '</span></del>';
            endif;

            $dp .= '</div>';

            $dp .= '</div>';


            $dp .= '<div class="cart animate-effect">';
            $dp .= '<div class="action">';
            $dp .= '<ul class="list-unstyled">';
            $dp .= '<li class="add-cart-button">';
            $dp .= '<a class="btn btn-primary" href="' . $urlArtiklaLink . '">Detaljnije </a>';
            $dp .= '</li>';

            $dp .= '<li>';
            $dp .= '<a class="btn btn-primary compare dodajkompare" href="#" data-id="' . $ArtikalId . '" title="Uporedi">';
            $dp .= '<i class="fa fa-exchange"></i>';
            $dp .= '</a>';
            $dp .= '</li>';


            $dp .= '</ul>';
            $dp .= '</div>';

            $dp .= '</div>';
            $dp .= '</div>';
            $dp .= '</div>';
            $dp .= '</div>';
        }
    }

$fp = fopen(DCROOT.'/cron/crongotovo/preporuka-nedelje-cron.php', 'w+');
fwrite($fp, $dp);
fclose($fp);
