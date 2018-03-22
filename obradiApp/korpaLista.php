<?php


$pod2 = "SELECT
                            TA.IdTempArtAuto,TA.KolTempArt, TA.IdArtTempArt,A.ArtikalId, A.ArtikalLink, A.MinimalnaKolArt,A.ArtikalStanje, A.ArtikalMPCena,
                            A.ArtikalVPCena,ANN.OpisArtikla,A.KategorijaArtikalId, PLP.PorezVrednost,
                            V.PdvOznakaValuta,V.ImeZemljeValuta,UN.IdUnit,TUN.TipUnit,TUN.TipUnitCelo,K.KomitentMesto,
                            K.KomitentUPdv,K.KomitentIme,K.KomitentPrezime,K.KomitentiValuta,K.KomitentKolona,
                            KA.KategorijaArtikalaLink, KAN.NazivKategorije,
                            CAST((SELECT IF(1 > 0, MA.MarzaVP - ((MA.MarzaVP - 1) / 100 * ".POPUSTAPP."), MA.MarzaVP)) AS DECIMAL (5 , 3 )) AS MarzaVPApp,
                            CAST((SELECT IF(1 > 0, MA.MarzaMarza - ((MA.MarzaMarza - 1) / 100 * ".POPUSTAPP."), MA.MarzaMarza)) AS DECIMAL (5 , 3 )) AS MarzaMarzaApp,
                            GETKURS(KomitentiValuta, 'din') AS getkursorg,
                            (SELECT IF(K.KomitentRabat > 0, K.KomitentRabat, 0) / 100 * A.ArtikalVPCena) AS vpRabat,
                            (SELECT IF(K.KomitentRabat > 0, K.KomitentRabat, 0) / 100 * A.ArtikalMPCena) AS mpRabat,
                            (SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS ImeSlikeArtikliSlike

							FROM tempart TA
							JOIN artikli A
								ON A.ArtikalId = TA.IdArtTempArt
							JOIN artikalnazivnew ANN
								ON ANN.ArtikalId = A.ArtikalId AND  ANN.IdLanguage = $jezikId


                            JOIN kategorijeartikala KA
                              ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
                            JOIN kategorijeartikalanaslov KAN
                              ON KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId

							JOIN pdvkategzemlja PKZ
								ON PKZ.IdKategPdvKatZem = KA.KategorijaArtikalaId
							JOIN pdvlistaporeza PLP
								ON PLP.IdPdvListaPoreza = PKZ.PdvKategZemlja
							JOIN komitenti K
								ON K.KomitentId = A.ArtikalKomitent
							JOIN valuta V
								ON V.ValutaId = K.KomitentiValuta
							JOIN marza MA
								ON MA.MarzaId = A.ArtikalMarzaId
                            JOIN
                                unit UN ON UN.IdUnit = KA.TipKatUnit
							JOIN tipunitnew TUN
      							ON TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jezikId
							WHERE TA.KomiTempArt = $userId  AND (IdZemljePdvKatZem=K.KomitentiZemlja)";


$pod1 = "SELECT *,
            CAST((CASE
                    WHEN KomitentUPdv = 1 THEN getkursorg * (ArtikalMPCena - mpRabat) * MarzaMarzaApp * (PorezVrednost / 100 + 1)
                    ELSE getkursorg * (ArtikalMPCena - mpRabat) * MarzaMarzaApp
                END)
                AS DECIMAL (12 , 2 )) AS pravaMpNeRabatApp,
            CAST((CASE
                    WHEN KomitentUPdv = 1 THEN getkursorg * (ArtikalVPCena - vpRabat) * MarzaVPApp * (PorezVrednost / 100 + 1)
                    ELSE getkursorg * (ArtikalVPCena - vpRabat) * MarzaVPApp
                END)
                AS DECIMAL (12 , 2 )) AS pravaVpNeRabatApp


FROM (

  $pod2

) AS T1";


$upitArtArrayHead = "
SELECT
  *,
    IF(0 > 0,CAST(pravaMpNeRabatApp * (100 - 0) / 100 AS DECIMAL (12 , 2 )),pravaMpNeRabatApp) AS pravaMp,
    IF(0 > 0,CAST(pravaVpNeRabatApp * (100 - 0) / 100 AS DECIMAL (12 , 2 )),pravaVpNeRabatApp) AS pravaVp
  FROM ( $pod1 )
  AS T2;
";

$keyArtAr = $db->rawQuery($upitArtArrayHead);



$i = 0;
$dp = '';
$f = array();
if ($keyArtAr) {

        $m['tag'] = 'korpaLista';
        $m['success'] = true;
        $m['error'] = 0;
        $m['error_msg'] = "Nema Errora";

            foreach($keyArtAr AS $k=>$keyArt) {

                include('listaArtikala.php');

            }

        $m['artikli'] = $f;
        $m['ukupnaCena'] = $ukupnaKorpa;
        $m['ukupnaCenaFormat'] = $common->formatCenaSamoBroj($ukupnaKorpa, $valutasession);;
        $m['ukupnaKolicina'] = floatval($ukupnaKolArt);
        $m['cenaPrikazExt'] = $cenaPrikazExt;

        $upikPr = "SELECT GetKurs (1, '$valutasession') * " . TROSKOVIPREVOZA . " as cenaPrevoz";
        $kPrevoz = $db->rawQueryOne($upikPr);
        $cprev = $kPrevoz['cenaPrevoz'];


        $cenaPrevoz = $common->formatCenaSamoBroj($cprev, $valutasession);
        $m['prevoz'] = floatval($cprev);
        $m['prevozFormat'] = $cenaPrevoz;

} else {

    $m['tag'] = 'korpaLista';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema artikala u Korpi";

}

echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);


?>

