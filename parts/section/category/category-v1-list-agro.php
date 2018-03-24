<?php

$delay = 0;


$products = '';
//$db->setTrace(true);


$upitArtKat = $db->rawQuery($upitArtArray1);
//print_r($db->trace);
//  ROUND((A.ArtikalBrOcena/A.ArtikalBrKlikova),0) AS ocenaut,

if ($upitArtKat) {
    foreach ($upitArtKat as $product => $keyArt):

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $OpisKratakOpis = $keyArt['OpisKratakOpis'];
        $OpisArtTekst = $keyArt['OpisArtTekst'];
        $OpisArtTekst = $common->limit_text_obican($OpisArtTekst,200);
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
        $pozovite = $jsonlang[117][$jezikId];
        $ImaNaStanju = $jsonlang[116][$jezikId];

        $lokFolder = $common->locationslika($ArtikalId);
        $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

        $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
        $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);

        $mala_slika = $lokFolder . '/' . $fileName . '_mala.' . $ext;
        $srednja_slika = $lokFolder . '/' . $fileName . '_srednja.' . $ext;
        $velika_slika = $lokFolder . '/' . $ImeSlikeArtikliSlike;

        $srednja_slika = $common->nemaSlike($srednja_slika);


        $nakasd = $common->stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $sesValuta, $jsonlang[229][$jezikId], $jsonlang[117][$jezikId], $jsonlang[116][$jezikId], $pravaVp, $pravaMp, $tipUsera, $dani);
        $cenaSamoBrojFormat = $nakasd['cenaSamoBrojFormat'];
        $cenaPrikazExt = $nakasd['cenaPrikazExt'];

        $products[$i]['ArtikalId'] = $ArtikalId;
        $products[$i]['ArtikalNaziv'] = $ArtikalNaziv;
        $products[$i]['OpisKratakOpis'] = $OpisKratakOpis;
        $products[$i]['OpisArtTekst'] = $OpisArtTekst;
        $products[$i]['velika_slika'] = $velika_slika;
        $products[$i]['srednja_slika'] = $srednja_slika;
        $products[$i]['urlArtiklaLink'] = $urlArtiklaLink;
        $products[$i]['cenaSamoBrojFormat'] = $cenaSamoBrojFormat;
        $products[$i]['cenaPrikazExt'] = $cenaPrikazExt;
        $products[$i]['ImeSlikeArtikliSlike'] = $ImeSlikeArtikliSlike;
        $products[$i]['opisTekstArt'] = $opisTekstArt;
        $products[$i]['ocenaut'] = $ocenaut;
        $products[$i]['Jedinica'] = $jsonlang[263][$jezikId];
        $products[$i]['Najmanje'] = $jsonlang[106][$jezikId];//umesto najmanje stavljeno stanje proizvoda translate 106
        $products[$i]['opisDetaljnije'] = $jsonlang[76][$jezikId];
        $products[$i]['compare'] = $jsonlang[74][$jezikId];
        $products[$i]['pravaMp'] = $pravaMp;
        $products[$i]['pozovite'] = $pozovite;
        $products[$i]['BrendIme'] = $BrendIme;
        $products[$i]['brendPrevod'] = $jsonlang[348][$jezikId];
        $products[$i]['ArtikalStanje'] = $ArtikalStanje;
        $products[$i]['ImaNaStanju'] = $ImaNaStanju;
        $products[$i]['ArtikalKratakOpis'] = $ArtikalKratakOpis;
        $products[$i]['jezikId'] = $jezikId;
        $products[$i]['ArtikalNaAkciji'] = $ArtikalNaAkciji;


        $i++;
    endforeach;
}


if ($products) {
foreach ($products as $proizvod):
    ?>
    <!--Ako nam treba sporo ucitavanje proizvoda-->
    <!--<div class="category-product-inner wow fadeInUp" data-wow-delay="<?php /*echo (float)($delay/5);*/
    ?>s">-->
    <div class="category-product-inner" itemscope itemtype="http://schema.org/Product">

        <div class="product-item-list-v1">


            <?php

            echo $common->displayListProduct(
                $proizvod['ArtikalId'],
                $proizvod['ArtikalNaziv'],
                $proizvod['OpisKratakOpis'],
                $proizvod['OpisArtTekst'],
                $proizvod['ArtikalNaAkciji'],
                $proizvod['velika_slika'],
                $proizvod['srednja_slika'],
                $proizvod['urlArtiklaLink'],
                $proizvod['cenaSamoBrojFormat'],
                $proizvod['cenaPrikazExt'],
                $proizvod['ImeSlikeArtikliSlike'],
                $proizvod['opisTekstArt'],
                $proizvod['ocenaut'],
                $proizvod['Jedinica'],
                $proizvod['Najmanje'],
                $proizvod['opisDetaljnije'],
                $proizvod['compare'],
                $proizvod['pravaMp'],
                $proizvod['pozovite'],
                $proizvod['BrendIme'],
                $proizvod['brendPrevod'],
                $proizvod['ArtikalStanje'],
                $proizvod['ImaNaStanju'],
                $proizvod['jezikId']
            );
            ?>


        </div>
        <!-- /.product-item-list-v1 -->
    </div><!-- /.category-product-inner -->
    <?php $delay++; ?>
<?php endforeach;
}else{echo "Nema proizvoda";}
?>
<!-- ========================================== CATEGORY-V1-LIST : END ========================================= -->
	


