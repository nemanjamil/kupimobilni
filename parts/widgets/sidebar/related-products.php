<!-- ============================================== RELATED PRODUCTS============================================== -->
<?php
$cenaminus = $ArtikalVPCena - ((PROCPOVEZANIART / 100)* $ArtikalVPCena );
$cenaplus = $ArtikalVPCena + ((PROCPOVEZANIART / 100)* $ArtikalVPCena );

/*
var_dump($cenaSamoBrojFormatInfo);
echo "minus";
var_dump($cenaminus);
echo "plus";
var_dump($cenaplus);
*/

if($KategorijaArtikalaIdOS){$kateg = $KategorijaArtikalaIdOS;}else{$kateg = '1';};

$povezaniArtUpit = "
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
    MA.MarzaMarza,
    TUN.TipUnit,
    TUN.TipUnitCelo,
    K.KomitentUPdv,
    PLP.PorezVrednost,
    MarzaVP,
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
    JOIN brendoviime BI
      ON BI.BrendId = BR.BrendId AND BI.IdLanguage = $jezikId
    JOIN komitenti K
      ON K.KomitentId = A.ArtikalKomitent
    JOIN valuta V
      ON V.ValutaId = K.KomitentiValuta
    JOIN marza MA
      ON MA.MarzaId = A.ArtikalMarzaId

WHERE
  A.ArtikalAktivan >= 1
  AND A.KategorijaArtikalId = $kateg
  AND (A.ArtikalMPCena BETWEEN $cenaminus AND $cenaplus)
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$tipUsera)) = 1
  ORDER BY RAND()
  LIMIT 3
 ) AS T1)
  AS T2;
";



$keyArtArRel = $db->rawQuery($povezaniArtUpit);
if ($keyArtArRel) {
?>
<div class="related-products"><!--wow fadeIn" data-wow-delay="0.2s"-->
	<h3 class="section-title"><?php echo $jsonlang[118][$jezikId]; ?></h3>


    <?php
    $relatedPro .= '';
    foreach ($keyArtArRel as $k => $keyArt):

        $ArtikalIdRel = $keyArt['ArtikalId'];
        $ArtikalNazivRel = $keyArt['OpisArtikla'];
        $pravaMpRel = $keyArt['pravaMp'];
        $pravaVpRel = $keyArt['pravaVp'];
        $ArtikalLinkRel = $keyArt['ArtikalLink'];
        $ImeSlikeArtikliSlikeMainRel = $keyArt['slikaMain'];
        $ocenautRel = $keyArt['ocenaut'];

        $urlArtiklaLinkRel = '/' . $ArtikalLinkRel . '/' . $ArtikalIdRel;


        $lokFolderRel = $common->locationslika($ArtikalIdRel);

        $urlArtiklaLinkRel = '/' . $ArtikalLinkRel . '/' . $ArtikalIdRel;

        $ext = pathinfo($ImeSlikeArtikliSlikeMainRel, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlikeMainRel, PATHINFO_FILENAME);

        $mala_slikaRel = $lokFolderRel . '/' . $fileName . '_mala.' . $ext;

        $mala_slikaRel = $common->nemaSlikeMala($mala_slikaRel);
        //$srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        //$velika_slikaRel = $lokFolderRel . '/' . $ImeSlikeArtikliSlike;

        $cenaPrikazRel = ($tipUsera >= 3) ? $common->formatCena($pravaVpRel, $sesValuta) : $common->formatCena($pravaMpRel, $sesValuta);




        $relatedPro .= '<div class="media rel-products col-md-12 col-xs-12">';

            $relatedPro .= '<div class="media-left product-image col-md-4 col-xs-4">';
            $relatedPro .= '<a href="'.$urlArtiklaLinkRel.'"><img src="'.$mala_slikaRel.'" class="img-responsive" alt="'.$ArtikalNazivRel.'"></a>';
            $relatedPro .= '</div>';

            $relatedPro .= '<div class="media-body product-info col-md-8 col-xs-8">';
            $relatedPro .= '<h5 class="small"><a href="'.$urlArtiklaLinkRel.'">'.$ArtikalNazivRel.'</a></h5>';

               /* $relatedPro .= '<div class="star-rating" title="Rated 4.50 out of 5">';
                $relatedPro .= '<span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>';
                $relatedPro .= '</div>';*/

      /*  $relatedPro .= '<div class="clearfix kojijeId" data-ime="'.$ArtikalIdRel.'">';
                for($irp=1;$irp<=5;$irp++) {
                    $cekstar = ($irp==$ocenautRel)? 'checked':'';
                    $relatedPro .= '<input class="starri required" '.$cekstar.' type="radio" name="zvezdica-'.$ArtikalIdRel.'" value="'.$irp.'"/>';
                }
                $irp=1;
        $relatedPro .= '</div>';*/

                $relatedPro .= '<div class="product-price">';
        if ($ArtikalStanje > '0' and $pravaMpRel > '0') {
                    $relatedPro .= '<ins><span class="amount">' . $cenaPrikazRel . '</span></ins>';
        } else {
                    $relatedPro .= '<ins><span class="amount">' . $cenaPrikazRel = $jsonlang[117][$jezikId] . '</span></ins>';
        }
                //$relatedPro .= '<del><span class="amount">$400,99</span></del>';
                $relatedPro .= '</div>';

            $relatedPro .= '</div>';
        $relatedPro .= '</div>';

    endforeach;

    echo $relatedPro;

        ?>



</div><!-- /.related-products -->

<?php } ?>
<!-- ============================================== RELATED PRODUCTS : END ============================================== -->
