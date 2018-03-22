<?php
$itemsEs = $m['items'];

if (!empty($itemsEs)) {

    if ($total_count < $kolikoArtikalaMaxEs) {
        if ($total_count > $kolikoArtikalaSugest) {
            /*$yr = '<div style="padding: 20px;border: 1px solid #dcdcdc;background-color: #dcdcdc">';
            $yr .= '<p>Imate preko ' . $kolikoArtikalaSugest . ' artikala u odgovoru na ključnu reč "' . $term . '"</p>';
            $yr .= '<p>Probajte sa detaljnijim rečima kako bi ste suzili izbor</p>';
            $yr .= '</div>';*/
        }
        if ($m['samoId']) {
            $samoIdRCsv = array_reverse($m['samoId']);
            $samoIdR = $m['samoId'];


            $upitArt = "SET NOCOUNT ON DECLARE @IdValues TABLE (Id INT, [Order] INT IDENTITY(1, 1)) ";

            foreach ($samoIdR AS $val) {
                $upitArt .= " INSERT INTO @IdValues VALUES ($val)";
            }


            $upitArt .= "SELECT  artikli.* ,
            AN.ArtikalNaziv,
            kategorijeartikala.KategorijaArtiklaNaziv ,
            kategorijeartikala.KategorijaArtikalaLink ,
            KategorijeKomitentiRabati.Rabat AS rabatKomitentKateg,
            SlikeProiz.linkslike ,
            brendovi.BrendIme ,
            brendovi.BrendLink
        FROM    artikli
            LEFT JOIN ArtikliNaziv AN ON AN.ArtikalId = artikli.ArtikalId AND AN.IdLanguage = $jezikId
            JOIN @IdValues ON [@IdValues].Id = artikli.ArtikalId
            JOIN kategorijeartikala ON kategorijeartikala.KategorijaArtiklaId = artikli.KategorijaArtiklaId
            LEFT JOIN SlikeProiz ON SlikeProiz.ArtikalId = artikli.ArtikalId AND SlikeProiz.mainpic = 1
            LEFT JOIN brendovi ON brendovi.id = artikli.ArtikalBrendId
            LEFT JOIN KategorijeKomitentiRabati ON KategorijeKomitentiRabati.KategorijaArtiklaId = kategorijeartikala.KategorijaArtiklaId
            AND KategorijeKomitentiRabati.KomitentId = $dbKomitentId
        WHERE
            artikli.ArtikalAktivan = 1
            AND artikli.ArtikalStanje > 0
            AND artikli.ArtikalVidljivZaMp = 1
            $artikalVidljivMP
        ORDER BY
        [@IdValues].[Order]";
            // --AND dbo.IsAvailableForMP(artikli.KategorijaArtiklaId) = 1


            $getProducts = $conn->prepare($upitArt);
            $getProducts->execute();
            $queryResult = $getProducts->fetchAll(PDO::FETCH_ASSOC);
            $brojRedova = (int)$getProducts->rowCount();


            if ($brojRedova > 0) {
                $artIdLista = 0;
                foreach ($queryResult AS $k => $qty):

                    $kolicina = $qty['kolicina'];
                    $ArtikalId = $qty['ArtikalId'];
                    $folderslika = substr($ArtikalId, 0, 2);
                    $KategorijaArtiklaId = $qty['KategorijaArtiklaId'];
                    $ArtikalStanje = $qty['ArtikalStanje'];
                    $crticeStanje = $common->generisiCrtice($ArtikalStanje);
                    $ArtikalSifra = $qty['ArtikalSifra'];

                    $ArtikalRabatAktivan = $qty['ArtikalRabatAktivan'];
                    $ArtikalRabatAktivan = $prikazart->RabatKomitentKategFloat($ArtikalRabatAktivan);

                    $rabatKomitentKateg = $qty['rabatKomitentKateg'];
                    $rabatKomitentKateg = $prikazart->RabatKomitentKategFloat($rabatKomitentKateg);


                    $ArtikalNaziv = $qty['ArtikalNaziv'];
                    $ArtikalLink = $qty['ArtikalLink'] . '/' . $ArtikalId;
                    $ArtikalOpis = $qty['ArtikalOpis'];
                    $ArtikalKratakOpis = $qty['ArtikalKratakOpis'];

                    $KategorijaArtiklaNaziv = $qty['KategorijaArtiklaNaziv'];
                    $KategorijaArtikalaLink = $qty['KategorijaArtikalaLink'];

                    $linkslike = $qty['linkslike'];
                    $lokacijaslika = $common->locationslika($ArtikalId);
                    $slika = $lokacijaslika . '/' . $linkslike;
                    $dalipostojiSlika = $common->daLiPostojiSlika($slika);
                    //$l = '/klase/timthumb.php?src=' . $dalipostoji . '&w=353&h=353';


                    $ArtikalBrendId = $qty['ArtikalBrendId'];
                    $BrendIme = $qty['BrendIme'];
                    $BrendLink = $qty['BrendLink'];
                    $pdvStopa = $qty['ArtikalPDV'];

                    $kurs = $dnevniKurs; // ovo dobijamo iz INDEX.php

                    $specKateg = '';
                    $specKateg = $prikazart->specPoKategoriji($KategorijaArtiklaId, $jezikId);
                    if ($specKateg) {
                        $specArtikal = $prikazart->specPoArtiklu($specKateg, $ArtikalId, $jezikId);
                    } else {
                        $specArtikal = '';
                    }
                    $specArtPrikaz = '';
                    if (!empty($specArtikal)) {
                        foreach ($specArtikal AS $key => $valSpec) {
                            $specArtPrikaz .= '<li>' . $valSpec['imeGrupe'] . ' : ' . $valSpec['vrednostNaArtiklu'] . '</li>';
                        }
                    }

                    $specArtPrikaz .= '<li>Brend : ' . $BrendIme . '</li>';;
                    $specArtPrikaz .= '<li><a class="font10" href="/' . $KategorijaArtikalaLink . '">Kat : ' . $KategorijaArtiklaNaziv . '</a></li>';

                    $dodatniPDVkategorije = $qty['dodatniPDVkategorije'];
                    $ArtikalVPCena = $qty['ArtikalVPCena'];
                    $ArtikalVPCena = round($ArtikalVPCena, 2);

                    $ArtikalMPCena = $qty['ArtikalMPCena'];
                    $ArtikalNaAkciji = $qty['ArtikalNaAkciji'];

                    /* echo '$ArtikalVPCena : '.$ArtikalVPCena.'<br/>';
                     echo '$ArtikalMPCena : '.$ArtikalMPCena.'<br/>';
                     echo '$ArtikalRabat : '.$ArtikalRabat.'<br/>';
                     echo '$pdvStopa : '.$pdvStopa.'<br/>';
                     echo '$kurs : '.$kurs.'<br/>';
                     echo '$ArtikalStanje : '.$ArtikalStanje.'<br/>';
                     echo '$KomitentExtId : '.$KomitentExtId.'<br/>';
                     echo '$dodatniPdvKategorije : '.$dodatniPdvKategorije.'<br/>';
                     echo '$vrstaplacanjaSes : '.$vrstaplacanjaSes.'<br/>';
                     echo '$logovan : '.$logovan.'<br/>';
                     echo '$valutasession : '.$valutasession.'<br/>';*/

                    /*var_dump('$ArtikalRabat : '.$ArtikalRabat);
                    var_dump('$KomitentRabat : '.$KomitentRabat);
                    var_dump('$rabatKomitentKateg : '.$rabatKomitentKateg);*/

                    $mojaCena = $prikazart->cenaVrsta(
                        $ArtikalVPCena, $ArtikalMPCena,
                        $ArtikalRabatAktivan, $KomitentRabat, $rabatKomitentKateg,
                        $pdvStopa, $kurs, $ArtikalStanje,
                        $KomitentExtId, $vrstaplacanjaSes, $logovan, $valutasession);


                    if ($mojaCena['tip'] == 0) {
                        $mojacenaFloatExt = $mojaCena['vrednost'];
                    } else {
                        $cenaExt = $prikazart->formatCenaExt($valutasession);
                        $mojacenaFloat = $prikazart->formatCenaSamoBroj($mojaCena['vrednost'], $valutasession);
                        $mojacenaFloatExt = $mojacenaFloat . ' ' . $cenaExt['prikaz'];
                    }


                    if (($artIdLista % 3) == 0) {
                        $yr .= '<div class="products-list row list">';
                    } else {
                        $yr .= '';
                    }


                    $yr .= '<div class="product-layout col-md-4 col-sm-6 col-xs-12 col-lg-12">';
                    $yr .= '<div class="product-item-container">';

                    // LEVI BLOK
                    $yr .= '<div class="left-block col-md-3 nopadding">';
                        $yr .= '<div class="product-image-container lazyXXX second_imgXX ">';
                            $yr .= '<a target="_blank" href="/' . $ArtikalLink . '">';
                                $yr .= '<img data-src="' . $dalipostojiSlika . '" src="' . $dalipostojiSlika . '"  alt="' . $ArtikalNaziv . '" class="img-responsive" />';
                            $yr .= '</a>';
                        $yr .= '</div>';

                        $yr .= '<span class="label label-new">New</span>';
                        //$yr .= '<a class="quickview iframe-link visible-lg" data-fancybox-type="iframe"  href="quickview.html">  Quickview</a>';
                    $yr .= '</div>';


                    // desni blok
                    $yr .= '<div class="right-block col-md-5">';
                        $yr .= '<div class="caption">';
                            $yr .= '<h4><a target="_blank" href="/' . $ArtikalLink . '">' . $ArtikalNaziv . '</a></h4>';
                            $yr .= '<div><ul class="liststylenista specListaArtikala nopaddingnomargin">' . $specArtPrikaz . '</ul></div>';

                           /* $yr .= '<div class="ratings">';
                                $yr .= '<div class="rating-box">';
                                    $yr .= '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
                                    $yr .= '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
                                    $yr .= '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
                                    $yr .= '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
                                    $yr .= '<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>';
                                $yr .= '</div>';
                            $yr .= '</div>';*/

                            $yr .= '<div class="price">';
                                $yr .= '<span class="price-new">' . $mojacenaFloatExt . '</span>';
                                //$yr .= '<span class="price-old">$172.00</span>';
                                //$yr .= '<span class="label label-percent">-40%</span>';
                            $yr .= '</div>';

                            /*$yr .= '<div class="description item-desc hidden">';
                                $yr .= '<p>Lorem ipsum dolor sit </p>';
                            $yr .= '</div>';*/

                        $yr .= '</div>';

                    $yr .= '</div>';

                    // Treci blok
                    $yr .= '<div class="right-block col-md-4">';
                        $yr .= '<div class="button-group">';
                        //$yr .= '<button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs">Add to Cart</span></button>';
                        //$yr .= '<button class="wishlist" type="button" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart"></i></button>';
                        //$yr .= '<button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>';
                            $yr .= '<form class="fromKupiArt" data-idArt="' . $ArtikalId . '" action="" enctype="multipart/form-data" method="post">';
                                $yr .= '<button class="addToCart pull-left marginright5" type="submit" data-toggle="tooltip">
                                                                                                            <i class="fa fa-shopping-cart"></i>
                                                                                                            <span class="hidden-xs">Dodaj u korpu</span>';
                                $yr .= '</button>';
                            $yr .= '<input class="brojKupiKolicina pull-left" name="idArt_' . $ArtikalId . '" value="1"  type="number"/>';
                            $yr .= '</form>';
                        $yr .= '</div>';

                    $yr .= '</div>';


                    $yr .= '</div>';
                    $yr .= '</div>';

                    if ($qty === end($queryResult)) {
                        $artIdLista = 2;
                    }
                    if (($artIdLista % 3) == 2) {
                        $yr .= '</div>';
                        $artIdLista = 0;
                    } else {
                        $yr .= '';
                        $artIdLista++;

                    }


                endforeach;

            } else {

                $yr = '<div style="margin: 50px">';
                $yr .= '<p>Nema na stanju datih artikala</p>';
                $yr .= '<p>Probajte sa drugim rečima ili uklonite filtere</p>';
                $yr .= '</div>';
            }


        } else {
            $yr = '<div style="margin: 50px">';
            $yr .= '<p>Nema Samo ID</p>';
            $yr .= '<p>Probajte sa filterima ili drugim rečima</p>';
            $yr .= '</div>';
        }
    } else {

        $yr = '<div style="margin: 50px">';
        $yr .= '<p>Imate preko ' . $kolikoArtikalaMaxEs . ' artikala u odgovoru na ključnu reč "' . $term . '"</p>';
        $yr .= '<p>Probajte sa filterima ili drugim rečima</p>';
        $yr .= '</div>';
    }

} else {

    if ($term) {
        if ($itemsEs == 0) {
            $yr = '<div style="margin: 50px">';
            $yr .= '<p>Nemate artikala u odgovoru na ključnu reč</p>';
            $yr .= '<p class="font18"><strong>' . $term . '</strong></p>';
            $yr .= '<p>Probajte sa drugim rečima</p>';
            $yr .= '</div>';
        } else {
            //$yr = 'Nema nista u pretrazi';
            $yr = '<div style="margin: 50px">';
            $yr .= '<p>Dobro dosli na pretragu</p>';
            $yr .= '<p>Ukucajte rec ili frazu</p>';
            $yr .= '</div>';
        }
    } else {
        $yr = '<div style="margin: 50px">';
        $yr .= '<p>Dobro dosli na pretragu</p>';
        $yr .= '<p>Ukucajte rec ili frazu</p>';
        $yr .= '</div>';
    }
}


?>
