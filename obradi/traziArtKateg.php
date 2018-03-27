<?php
if ($id && $string) {
    $m['stanje'] = true;
    $m['message'] = 'Sve je Ok';

    $qq = $string; // ovo smo stavli jer imamo istu skruptu na  /var/www/masine/stranice/searchProiz.php
    require(DCROOT.'/stranice/separatedComa.php');


$spC . " ORDER BY A.ArtikalBrPregleda DESC";
$spC . " LIMIT 0,20";
$upitArtArray = "
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
    ANN.OpisArtikla,
    AKO.OpisKratakOpis,
    KA.KategorijaArtikalaLink,
    KAN.NazivKategorije,
    BI.BrendIme,
    BR.BrendLink,
    K.KomitentiValuta,
    V.ValutaValuta,
    MA.MarzaMarza,
    K.KomitentUPdv,
    PLP.PorezVrednost,
    MarzaVP,
    CAST( (A.ArtikalBrOcena / A.ArtikalBrKlikova)	AS SIGNED ) AS ocenaut,
    DATEDIFF(A.ArtikalDostupnoOd, NOW()) as dani,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalVPCena) AS vpjac,
    (SELECT IF(K.KomitentRabat>0,K.KomitentRabat,0)/100*A.ArtikalMPCena) AS mpjac,
    (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS ImeSlikeArtikliSlike

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

WHERE A.KategorijaArtikalId = $id
  AND MATCH (ANN.OpisArtikla)  AGAINST ('$comma_separated' IN NATURAL LANGUAGE MODE)
  AND A.ArtikalAktivan >= 1
  AND (IdZemljePdvKatZem=K.KomitentiZemlja)
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$tipUsera)) = 1
  " . $spC . " ) AS T1)
  AS T2;
";


    $upit = $db->rawQuery($upitArtArray);


    if ($upit) {
        foreach ($upit as $k=> $keyArt){


                $ArtikalId = (int) $keyArt['ArtikalId'];
            $KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
                $ArtikalNaziv = (string) $keyArt['OpisArtikla'];
                $OpisKratakOpis = (string) $keyArt['OpisKratakOpis'];
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
                $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
                $ArtikalStanje = $keyArt['ArtikalStanje'];
                $ocenaut = $keyArt['ocenaut'];

            $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];

            $lokFolder = $common->locationslika($ArtikalId);

            $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

            $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
            $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

            $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
            $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
            $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

            $srednja_slika = $common->nemaSlikeBezCrte($srednja_slika);
            $mala_slika = $common->nemaSlikeBezCrte($mala_slika);
            $velika_slika = $common->nemaSlikeBezCrte($velika_slika);


            // $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCenaExt($pravaVp, $sesValuta) : $common->formatCenaExt($pravaMp, $sesValuta);
            if ($ArtikalStanje > 0) {
                $mozedase = '';
                $cenaPrikaz = ($tipUsera >= 3) ? $common->formatCenaSamoBroj($pravaVp, $sesValuta) : $common->formatCenaSamoBroj($pravaMp, $sesValuta);
                $cenaPrikazExt = ($tipUsera >= 3) ? $common->formatCenaExt($pravaVp, $sesValuta) : $common->formatCenaExt($pravaMp, $sesValuta);
            } else {
                $mozedase = 'disabled="disabled"';
            }


            $g['ArtikalNaziv'] = $ArtikalNaziv;
            $g['OpisKratakOpis'] = $OpisKratakOpis;
            $g['ArtikalLink'] = $ArtikalLink;
            $g['pravaMp'] = (float) $pravaMp;
            $g['pravaVp'] = (float) $pravaVp;
            $g['cenaPrikaz'] = $cenaPrikaz;
            $g['cenaPrikazExt'] = $cenaPrikazExt;
            $g['ArtikalNaAkciji'] = $ArtikalNaAkciji;
            $g['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;
            $g['NazivKategorije'] = $KategorijaArtikalaNaziv;
            $g['srednja_slika'] = $srednja_slika;
            $g['mala_slika'] = $mala_slika;
            $g['velika_slika'] = $velika_slika;
            $g['BrendIme'] = $BrendIme;
            $g['ocenaut'] = (int) $ocenaut;
            $g['ArtikalStanje'] = $ArtikalStanje;
            $g['link'] = $ArtikalLink.'/'.$ArtikalId;

            $art[] = $g;
        }
    }
    $m['artikli'] = $art;

} else {
    $m['stanje'] = false;
    $m['message'] = 'Nije nesto dobro od podataka';

}

echo json_encode($m);
?>