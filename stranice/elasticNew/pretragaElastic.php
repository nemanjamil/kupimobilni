<?php

$itemsEs = $m['items'];

// ako cemo da radimo upit po ID IN ('...')
//$keywords_imploded = implode("','",$keywords);

if ($itemsEs) {
    if ($total_count<$kolikoArtikalaMaxEs) {
    if ($total_count>$kolikoArtikalaSugest){
        $yr = '<div style="padding: 20px;border: 1px solid #dcdcdc;background-color: #dcdcdc">';
        $yr .= '<p>Imate preko '.$kolikoArtikalaSugest.' artikala u odgovoru na ključnu reč "'.$term.'"</p>';
        $yr .= '<p>Probajte sa detaljnijim rečima kako bi ste suzili izbor</p>';
        $yr .= '</div>';
    }
    $yr .= '<ul class="clearfix listart">';

    foreach ($itemsEs as $productID => $qty) {
        $dbKomitentId = $dbClasa->SetovanoNull($KomitentId);

        $productID = $qty['id'];
        /*SlikeProiz.ArtikalId = artikli.ArtikalId */
        //
        if ($productID) {
            $wpw = "
            SELECT
                artikli.*,
                kategorijeartikala.KategorijaArtiklaNaziv,
                kategorijeartikala.KategorijaArtikalaLink,
                dbo.GetKursProdajni() AS Kurs,
                dbo.GetRabatZaArtikal(artikli.ArtikalId, $dbKomitentId) AS Rabat,
                [dbo].[GetVrednostVendor]($productID) AS dodatniPDVkategorije,
                SlikeProiz.linkslike,
                brendovi.BrendIme,
                brendovi.BrendLink
            FROM
                artikli
                JOIN kategorijeartikala
                    ON kategorijeartikala.KategorijaArtiklaId = artikli.KategorijaArtiklaId
                LEFT JOIN SlikeProiz
                    ON SlikeProiz.id = artikli.ArtikalSlika
                LEFT JOIN brendovi
                    ON brendovi.id = artikli.ArtikalBrendId
            WHERE
                artikli.ArtikalId = $productID
                AND artikli.ArtikalStanje > 0
                AND artikli.ArtikalVidljivZaMp = 1
                AND dbo.IsAvailableForMP(artikli.KategorijaArtiklaId) = 1
            ORDER BY
                ArtikalId";

            $upi = $dbClasa->fetchassoc($wpw);

            if ($upi) {
                $kolicina = $qty['kolicina'];
                $ArtikalId = $upi['ArtikalId'];
                $folderslika = substr($ArtikalId, 0, 2);
                $KategorijaArtiklaId = $upi[KategorijaArtiklaId];
                $ArtikalStanje = $upi[ArtikalStanje];
                $crticeStanje = $dbClasa->generisiCrtice($ArtikalStanje);
                $ArtikalSifra = $upi[ArtikalSifra];

                $ArtikalNaziv = $upi[ArtikalNaziv];
                $ArtikalLink = $upi[ArtikalLink] . '/' . $ArtikalId;
                $ArtikalOpis = $upi[ArtikalOpis];
                $ArtikalKratakOpis = $upi[ArtikalKratakOpis];

                $KategorijaArtiklaNaziv = $upi[KategorijaArtiklaNaziv];
                $KategorijaArtikalaLink = $upi[KategorijaArtikalaLink];

                $linkslike = $upi[linkslike];
                $lokacijaslika = $dbClasa->locationslika($ArtikalId);
                $slika = $lokacijaslika . '/' . $linkslike;
                $dalipostoji = $dbClasa->daLiPostojiSlika($slika);
                $l = '/klase/timthumb.php?src=' . $dalipostoji . '&w=353&h=353';

                $ArtikalRabat = $upi[Rabat];

                $ArtikalBrendId = $upi[ArtikalBrendId];
                $BrendIme = $upi[BrendIme];
                $BrendLink = $upi[BrendLink];
                $pdvStopa = $upi[ArtikalPDV];

                $kurs = $upi[Kurs];

                $dodatniPDVkategorije = $upi[dodatniPDVkategorije];
                $ArtikalVPCena = $upi[ArtikalVPCena];
                $ArtikalVPCena = round($ArtikalVPCena, 2);

                $ArtikalMPCena = $upi['ArtikalMPCena'];
                $ArtikalNaAkciji = $upi['ArtikalNaAkciji'];


                if ($KomitentExtId && $dodatniPDVkategorije && (!isset($_SESSION['vrstaplacanja']) || $_SESSION['vrstaplacanja'] == '1' || $_SESSION['vrstaplacanja'] == '3')) {

                    if ($ArtikalNaAkciji == 1) {

                        $cenaBezPdv = $dbClasa->calculateCenaAsStringBezPDV(
                            $ArtikalVPCena,
                            $ArtikalMPCena,
                            0,
                            $kurs,
                            $ArtikalStanje,
                            $KomitentExtId
                        );

                        $cenaBezPdvFloat = $dbClasa->calculateCenaAsFloatBezPDV(
                            $ArtikalVPCena,
                            $ArtikalMPCena,
                            0,
                            $kurs,
                            $ArtikalStanje,
                            $KomitentExtId
                        );
                    } else {

                        $cenaBezPdv = $dbClasa->calculateCenaAsStringBezPDV(
                            $ArtikalVPCena,
                            $ArtikalMPCena,
                            $ArtikalRabat,
                            $kurs,
                            $ArtikalStanje,
                            $KomitentExtId
                        );

                        $cenaBezPdvFloat = $dbClasa->calculateCenaAsFloatBezPDV(
                            $ArtikalVPCena,
                            $ArtikalMPCena,
                            $ArtikalRabat,
                            $kurs,
                            $ArtikalStanje,
                            $KomitentExtId
                        );
                    }

                    $cenafull = $cenaBezPdv;
                    $cenaFullFloat = $cenaBezPdvFloat;
                }
                else if ($ArtikalNaAkciji == 1) {


                    $cenaBezPdv = $dbClasa->calculateCenaAsStringBezPDV(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        0,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId
                    );

                    $cenaBezPdvFloat = $dbClasa->calculateCenaAsFloatBezPDV(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        0,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId
                    );

                    $cenafull = $dbClasa->calculateCenaAsString(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        0,
                        $pdvStopa,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId);

                    $cenaFullFloat = $dbClasa->calculateCenaAsFloat(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        0,
                        $pdvStopa,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId);
                } else {

                    $cenaBezPdv = $dbClasa->calculateCenaAsStringBezPDV(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        $ArtikalRabat,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId
                    );

                    $cenaBezPdvFloat = $dbClasa->calculateCenaAsFloatBezPDV(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        $ArtikalRabat,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId
                    );

                    $cenafull = $dbClasa->calculateCenaAsString(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        $ArtikalRabat,
                        $pdvStopa,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId);

                    $cenaFullFloat = $dbClasa->calculateCenaAsFloat(
                        $ArtikalVPCena,
                        $ArtikalMPCena,
                        $ArtikalRabat,
                        $pdvStopa,
                        $kurs,
                        $ArtikalStanje,
                        $KomitentExtId);
                }


                $registrovanUser = (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) ? '1' : '0';


                $yr .= '<li class="listItem">';
                $yr .= '<div class="articleHBox">';
                $yr .= '<div class="slikaf">';
                $yr .= '<a href="/' . $ArtikalLink . '">';

                if ($ArtikalNaAkciji == 1) {
                    $yr .= '<span class="actionakcija"></span>';
                } else if ($ArtikalNov == 1) {
                    $yr .= '<span class="actionnovo"></span>';
                }

                $yr .= '<img align="middle" src="' . $l . '" alt="' . $ArtikalNaziv . '" />';
                $yr .= '</a>';
                $yr .= '</div>';
                $yr .= '<div class="articleName"><a href="/' . $ArtikalLink . '" class="boja3gfont">' . $ArtikalNaziv . '</a>';

                if ($ArtikalNaAkciji == 1) {
                    $yr .= '<br><label class="akcijaInfo">Akcijska cena ne podleže dodatnom rabatu</label>'; //</div>
                }


                $yr .= '<br><div class="clearfix stanjecrtpoz">
                <div class="floatleft stanjecrticetekst">Stanje :</div>
                <div class="floatleft stanjecrtice">' . $crticeStanje . '</div>
                </div>
                </div>
				';

                $yr .= '<div class="articleBuyBox">';

                if ($ArtikalNaAkciji == 1) {
                    $yr .= '<div class="divAkcija">';
                    $yr .= '<div class="cena staracena">' . $staraCena . '</div>';
                    $yr .= '<div class="mojacena">Akcijska cena: <span class="bojacrvena cenaIznos">' . $cenafull . '</span>';
                    $yr .= '</div>';
                } else {
                    if ($KomitentExtId) {
                        if ($_SESSION['tipusera'] >= 5) {
                            $yr .= '<div class="divAdmin">';
                        } else {
                            $yr .= '<div class="divVp">';
                        }
                    } else {
                        $yr .= '<div class="divMp">';
                    }

                    if ($KomitentExtId) {
                        $yr .= '<div class="cena">' . $staraCena . '</div>';
                        $yr .= '<div class="mojacena">Moja cena: <span class="bojacrvena cenaIznos">' . $cenafull . '</span></div>';
                    } else {
                        $yr .= '<div class="cena">' . $cenafull . '</div>';
                    }
                }

                $yr .= '<div class="cenadugme" style="align-content: center"><form id="ubaciukorpu' . $ArtikalId . '" name="' . $ArtikalId . '" action="" method="post" enctype="multipart/form-data" class="formaobc">';
                $yr .= '<input type="hidden" name="id" value="' . $ArtikalId . '" />';
                $yr .= '<input type="button" id="btnKupiProizDodajUKorpuLista" class="dodajUKorpu" ' . $mozedasekupi . ' />';
                $yr .= '</form></div>';

                $yr .= '</div>';

                $yr .= '</div>';
                $yr .= '</li>';
            }
        }
    }

    $yr .= '</ul>';
    $yr .= '<div class="crt"></div>';
    } else {

        $yr = '<div style="margin: 50px">';
        $yr .= '<p>Imate preko '.$kolikoArtikalaMaxEs.' artikala u odgovoru na ključnu reč "'.$term.'"</p>';
        $yr .= '<p>Probajte sa filterima ili drugim rečima</p>';
        $yr .= '</div>';
    }

} else {

        $yr = '<div style="margin: 50px">';
        $yr .= '<p>Nema rezulata</p>';
        $yr .= '<p>Probajte sa drugim filterima ili drugim rečima</p>';
        $yr .= '<p>ili resetujete filtere</p>';
        $yr .= '<p>';
        $yr .= '<a class="bojacrvenaprod" id="resetujFiltereEs"  href="#">';
            $yr .= 'Reset filtera';
            $yr .= '</a>';
        $yr .= '</p>';
        $yr .= '</div>';



}


?>
