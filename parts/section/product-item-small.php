<!-- ============================================== PRODUCT ITEM SMALL ============================================== -->
<?php
if($KategorijaArtikalaIdOS){$KategArtIdOS = $KategorijaArtikalaIdOS;}else{ $KategArtIdOS = '0';}
/*
$footArtiPoc = "
SELECT
*,
  IF ( $KomiRabatKupi > 0,  CAST(pravaMpNeRabat * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaMpNeRabat) AS pravaMp,
  IF ( $KomiRabatKupi > 0,  CAST(pravaVpNeRabat * (100-$KomiRabatKupi)/100 AS DECIMAL (12, 2)),  pravaVpNeRabat) AS pravaVp
  FROM (
      SELECT *,

CAST(
    (
      CASE
        WHEN KomitentUPdv = 1
        THEN ( (SELECT  GetKurs (KomitentiValuta, $valutasession)) ) * (ArtikalMPCena - mpjac) * MarzaMarza * (PorezVrednost / 100 + 1)
        ELSE ( (SELECT   GetKurs (KomitentiValuta, $valutasession))) * (ArtikalMPCena - mpjac) * MarzaMarza
          END
    )  AS DECIMAL (12, 3)) AS pravaMpNeRabat,
CAST(
    (
      CASE
        WHEN KomitentUPdv = 1
        THEN ( (SELECT  GetKurs (KomitentiValuta, $valutasession))    ) * (ArtikalVPCena - vpjac) * MarzaVP * (PorezVrednost / 100 + 1)
        ELSE ( (SELECT   GetKurs (KomitentiValuta, $valutasession))    ) * (ArtikalVPCena - vpjac) * MarzaVP
      END
   )  AS DECIMAL (12, 3)) AS  pravaVpNeRabat


FROM (
    SELECT
    A.ArtikalId,
    A.KategorijaArtikalId,
    A.ArtikalMPCena,
    A.ArtikalVPCena,
    A.ArtikalLink,
    A.ArtikalStanje,
    A.ArtikalNaAkciji,
    A.ArtikalBrendId,
    A.MinimalnaKolArt,
    A.ArtikalBrPregleda,
    ANN.OpisArtikla,
    AKO.OpisKratakOpis,
    KA.KategorijaArtikalaLink,
    KAN.NazivKategorije,
    BI.BrendIme,
    BR.BrendLink,
    BR.BrendId,
    K.KomitentiValuta,
    K.KomitentKolona,
    V.ValutaValuta,
    TUN.TipUnit,
    TUN.TipUnitCelo,
    K.KomitentUPdv,
    PLP.PorezVrednost,
    CAST(
          (SELECT  IF($KomiRabatKupi> 0, MA.MarzaVP-((MA.MarzaVP-1)/100*10), MA.MarzaVP)) AS DECIMAL(5,3)
    ) AS MarzaVP,
    CAST(
        (SELECT  IF($KomiRabatKupi> 0, MA.MarzaMarza-((MA.MarzaMarza-1)/100*10), MA.MarzaMarza)) AS DECIMAL(5,3)
    ) AS MarzaMarza,
    CAST( (A.ArtikalBrOcena / A.ArtikalBrKlikova)	AS SIGNED ) AS ocenaut,
    DATEDIFF(A.ArtikalDostupnoOd, NOW()) as dani,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
    (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS slikaMain

  FROM
    artikli A
    JOIN artikalnazivnew ANN
      ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId
    LEFT JOIN artiklikratakopisnew AKO
      ON AKO.IdArtiklaAkon = A.ArtikalId AND  AKO.IdLanguageAkon = $jezikId

    JOIN kategorijeartikala KA
      ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
    JOIN kategorijeartikalanaslov KAN
      ON KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId

    JOIN pdvkategzemlja PKZ
      ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
    JOIN pdvlistaporeza PLP
      ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja

    JOIN unit UN
      ON UN.IdUnit = A.TipKatUnitArt
    JOIN tipunitnew TUN
      ON TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jezikId

    JOIN brendovi BR
      ON BR.BrendId = A.ArtikalBrendId
    LEFT JOIN brendoviime BI
      ON BI.BrendId = BR.BrendId AND BI.IdLanguage = $jezikId
    JOIN komitenti K
      ON K.KomitentId = A.ArtikalKomitent
    JOIN valuta V
      ON V.ValutaId = K.KomitentiValuta
    JOIN marza MA
      ON MA.MarzaId = A.ArtikalMarzaId

WHERE
  A.ArtikalAktivan >= 1
  AND A.KategorijaArtikalId = $KategArtIdOS
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$tipUsera)) = 1
  ORDER BY A.ArtikalBrPregleda DESC
  LIMIT 8
 ) AS T1)
  AS T2;
";*/

$footArtiPoc = "CALL listaArtikalaRazno(18,$valutasession,$jezikId,$KomitentId,'');";



$keyArtAr = $db->rawQuery($footArtiPoc);

$item = 0;
$broj = 0;
$i = 0;
if ($keyArtAr) {
    foreach ($keyArtAr as $k => $keyArt):

        $KategorijaArtikalaId = $keyArt['KategorijaArtikalId'];

        /*if (!in_array($KategorijaArtikalaId, $pieces)) {
            continue;
        }*/

        $ArtikalId = $keyArt['ArtikalId'];
        //$KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $ArtikalMPCena = $keyArt['ArtikalMPCena'];
        //$ArtikalVPCena = $keyArt['ArtikalVPCena'];
        $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
        //$KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
        //$KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
        //$BrendIme = $keyArt['BrendIme'];
        //$BrendId = $keyArt['BrendId'];
        //$KomitentiValuta = $keyArt['KomitentiValuta'];
        //$ValutaValuta = $keyArt['ValutaValuta'];
        //$MarzaMarza = $keyArt['MarzaMarza'];
        //$odnosKursArt = $keyArt['odnosKursArt'];
        $pravaMp = $keyArt['pravaMp'];
        $pravaVp = $keyArt['pravaVp'];
        $ArtikalLink = $keyArt['ArtikalLink'];
        $ArtikalKratakOpis = $keyArt['OpisKratakOpis'];
        $ArtikalStanje = $keyArt['ArtikalStanje'];
        //$ocenaut = $keyArt['ocenaut'];
        $ArtikalAktivan = $keyArt['ArtikalAktivan'];
        $dani = $keyArt['dani'];
        $ArtikalBrPregleda = $keyArt['ArtikalBrPregleda'];
        $slikaMain = $keyArt['slikaMain'];


        $nakasd = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena,
            $valutasession, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
        require(DCROOT . '/stranice/cenaPrikazVarijable.php');


        $lokFolder = $common->locationslika($ArtikalId);
        $urlArtiklaLinkSmall = DPROOT . '/' . $ArtikalLink . '/' . $ArtikalId;
        $ext = pathinfo($slikaMain, PATHINFO_EXTENSION);
        $fileName = pathinfo($slikaMain, PATHINFO_FILENAME);
        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $mala_slika = $common->nemaSlikeMala($mala_slika);


        $products[$item][$i]['ArtikalId'] = $ArtikalId;
        $products[$item][$i]['ArtikalNaziv'] = $ArtikalNaziv;
        $products[$item][$i]['ArtikalNaAkciji'] = $ArtikalNaAkciji;
        $products[$item][$i]['mala_slika'] = $mala_slika;
        $products[$item][$i]['srednja_slika'] = $srednja_slika;
        $products[$item][$i]['urlArtiklaLink'] = $urlArtiklaLinkSmall;
        $products[$item][$i]['cenaSamoBrojFormat'] = $cenaSamoBrojFormat;
        $products[$item][$i]['cenaPrikazExt'] = $cenaPrikazExt;
        $products[$item][$i]['slikaMain'] = $slikaMain;
        $products[$item][$i]['pravaMpSmall'] = $ArtikalMPCena;
        $products[$item][$i]['pozovite'] = $pozovite;


        if ($broj == 2) {
            $item++;
            $broj = 0;
        } else {
            $broj++;
        }

        $i++;

    endforeach;
}




?>
<div class="product-item-small-owl">
    <?php
    $listaSmall = '';
    if ($products) {
    foreach($products as $product):

        echo '<div class="item">';

        foreach ($product as $listPro):


            echo  $common->smallProduct(
                $listPro['ArtikalId'],
                $listPro['ArtikalNaziv'],
                $listPro['ArtikalNaAkciji'],
                $listPro['mala_slika'],
                $listPro['srednja_slika'],
                $listPro['urlArtiklaLink'],
                $listPro['cenaSamoBrojFormat'],
                $listPro['cenaPrikazExt'],
                $listPro['slikaMain'],
				$listPro['pravaMpSmall'],
				$listPro['pozovite']);


           /* echo '<div class="row products-small">
			<div class="col-md-4 col-xs-4 product-image">
				<a href="#"><img src="'.$mala_slika.'" class="img-responsive" alt=""></a>
			</div>
			<div class="col-md-8 col-xs-8 product-info">
				<h5><a href="'.$urlArtiklaLink.'">asdad</a></h5>

    <div class="star-rating" title="Rated 4.50 out of 5">
					<span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
				</div>

				<div class="product-price">
					<ins><span class="amount">'.$cenaPrikaz.'</span></ins>

				</div>

			</div>
		</div>';*/



            endforeach;
        echo  '</div>';
    endforeach;
    }

    //echo $listaSmall;

    //$listaSmall = '';
    ?>



</div>
<!-- ============================================== PRODUCT ITEM SMALL : END ============================================== -->