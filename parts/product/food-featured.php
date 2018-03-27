<!-- ============================================== FOOD FEATURED ============================================== -->
<?php
$products = array(
    /*array(
        'product_name' => 'Product name #01',
        'is_new' => true,
        'is_sale' => false,
        'is_hot' => false,
        'productImageURL' => 'assets/images/products/30.jpg'


    ),
    array(
        'product_name' => 'Product name #01',
        'is_new' => false,
        'is_sale' => false,
        'is_hot' => true,
        'productImageURL' => 'assets/images/products/30.jpg'


    )*/

);

$limitUpit = 18;
$brojAkcije = 8;
$upitArtArray = "CALL listaArtikalaRazno($limitUpit,$valutasession,$jezikId,$KomitentId,$brojAkcije);";
$keyArt = $db->rawQueryOne($upitArtArray);

$keyArtAr = $db->rawQuery($upitArtArray);
$i = 0;
foreach ($keyArtAr as $k => $keyArt):

    $ArtikalId = $keyArt['ArtikalId'];
    $KategorijaArtikalaIdOS = $keyArt['KategorijaArtikalId'];
    $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
    $ArtikalNaziv = $keyArt['OpisArtikla'];
    $ArtikalMPCena = $keyArt['ArtikalMPCena'];
    $ArtikalVPCena = $keyArt['ArtikalVPCena'];
    $KategorijaArtikalaNaziv = $keyArt['NazivKategorije'];
    $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
    $KomitentiValuta = $keyArt['KomitentiValuta'];
    $ValutaValuta = $keyArt['ValutaValuta'];
    $MarzaMarza = $keyArt['MarzaMarza'];
    $odnosKursArt = $keyArt['odnosKursArt'];
    $pravaMp = $keyArt['pravaMp'];
    $pravaVp = $keyArt['pravaVp'];
    $ArtikalLink = $keyArt['ArtikalLink'];
    $ArtikalKratakOpis = $keyArt['ArtikalKratakOpis'];
    $ArtikalStanje = $keyArt['ArtikalStanje'];
    $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];


    $urlArtiklaLink = '/' . $ArtikalLink . '/' . $ArtikalId;

    if ($ArtikalStanje > 0) {
        $mozedase = '';
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

    $products[$i]['ArtikalId'] = $ArtikalId;
    $products[$i]['ArtikalNaziv'] = $ArtikalNaziv;
    $products[$i]['NaAkciji'] = $ArtikalNaAkciji;
    $products[$i]['velika_slika'] = $velika_slika;
    $products[$i]['srednja_slika'] = $srednja_slika;
    $products[$i]['urlArtiklaLink'] = $urlArtiklaLink;
    $products[$i]['cenaPrikaz'] = $cenaPrikaz;
    $products[$i]['opisDetaljnije'] = $jsonlang[76][$jezikId];
    $products[$i]['ImeSlikeArtikliSlike'] = $ImeSlikeArtikliSlike;
    $products[$i]['wishlist'] = $jsonlang[84][$jezikId];
    $products[$i]['compare'] = $jsonlang[74][$jezikId];
    $products[$i]['pozovite'] = $jsonlang[117][$jezikId];
    $products[$i]['pravaMp'] = $pravaMp;

    $i++;

endforeach;

?>

<div class="title">
    <h3><?php echo $jsonlang[228][$jezikId]; ?></h3>
    <hr>
</div>

<div class="featured-product">
    <?php $delay = 0; ?>
    <?php foreach ($products as $product): ?>
        <div class="item category-product">
            <div class="products grid-v2 wow fadeInUp" data-wow-delay="<?php echo (float)($delay / 10); ?>s">
                <?php
                echo $common->displayProduct(
                    $product['ArtikalId'],
                    $product['ArtikalNaziv'],
                    $product['NaAkciji'],
                    $product['velika_slika'],
                    $product['srednja_slika'],
                    $product['urlArtiklaLink'],
                    $product['cenaPrikaz'],
                    $product['ImeSlikeArtikliSlike'],
                    $product['opisDetaljnije'],
                    $product['wishlist'],
                    $product['compare'],
                    $product['pozovite'],
                    $product['pravaMp']
                )
                ?>

            </div>
            <!-- /.products -->
        </div><!-- /.item -->
        <?php $delay++; ?>
    <?php endforeach; ?>
</div><!-- /.fashion-featured -->
<!-- ============================================== FOOD FEATURED : END ============================================== -->