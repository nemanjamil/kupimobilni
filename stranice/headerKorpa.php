<?php

/*if ($tipUsera>=REGISTROVANVP) {
	//* (V.PdvZemljValuta/100 + 1)  AS pravaCena
	// ( (SELECT   GetKurs (KomitentiValuta, $valutasession))  ) * A.ArtikalVPCena * MA.MarzaVP AS pravaCena
	// ( (SELECT  GetKurs (KomitentiValuta, $valutasession)) ) * A.ArtikalMPCena * MA.MarzaMarza AS pravaCena
	$dodaArtUpitHead = "(CASE WHEN KomitentUPdv = 1 THEN ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
                                    (ArtikalVPCena - vpjac)
                                      * MarzaVP * (PorezVrednost/100 + 1)
                                     ELSE ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
                                     (ArtikalVPCena -  vpjac)  * MarzaVP END) AS pravaCena";

} else {

	$dodaArtUpitHead = "(CASE WHEN KomitentUPdv = 1 THEN
                                    ((SELECT GetKurs (KomitentiValuta, $valutasession))) *

                                    (ArtikalMPCena - mpjac) *
                                    MarzaMarza * (PorezVrednost/100 + 1)
                                    ELSE ((SELECT GetKurs (KomitentiValuta, $valutasession))) *
                                    (ArtikalMPCena - mpjac)
                                    * MarzaMarza END) AS pravaCena";
}*/


require(DCROOT.'/stranice/upitZaKorpu.php');

$ArtikliKupljeniHead = $db->rawQuery($upitArtArrayHead);

if ($ArtikliKupljeniHead) {

	foreach($ArtikliKupljeniHead as $k => $v):

        $ArtikalStanjeKorpa = $v['ArtikalStanje'];
        $ArtikalMPCena = $v['ArtikalMPCena'];
        $pravaMpHeader = $v['pravaMp'];
        $pravaVpHeader = $v['pravaVp'];
        $dani = $v['dani'];


        $nakasdKorpa = $common->stanjeOpisSveId($ArtikalStanjeKorpa, $ArtikalMPCena, $sesValuta,
            $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId],
            $pravaVpHeader, $pravaMpHeader, $tipUsera, $dani);
        //require(DCROOT.'/stranice/cenaPrikazVarijable.php');

        $cenaPrikazBrojKorpa = $nakasdKorpa['cenaPrikazBroj'];



        $KolTempArt = $v['KolTempArt'];
		$pravaVpKorpaHeader = $cenaPrikazBrojKorpa;
        $IdArtTempArt = $v['IdArtTempArt'];
		$artNazivKorpa = $v['OpisArtikla'];
		$artLinkKorpa = $v['ArtikalLink'];

		$ukupnaKolArt += $KolTempArt;
		$cenaPoArtKol = $pravaVpKorpaHeader*$KolTempArt;
		//$cenaPoArtKolArray[$IdArtTempArt] = $cenaPoArtKol;
		$ukupnaKorpa += $cenaPoArtKol;

	endforeach;
}
$ukupnaKolArt = ($ukupnaKolArt) ? $ukupnaKolArt : 0;
if ($ukupnaKorpa) {
	$ukupnaKorpa = $common->formatCenaExt($ukupnaKorpa,$valutasession);
} else {
	//echo $cenaPoArtKol;
}
?>