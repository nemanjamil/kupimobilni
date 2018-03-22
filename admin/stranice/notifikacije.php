<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 08. 2015.
 * Time: 16:47
 */


$cols = Array("ANN.OpisArtikla", "SZA.SenzorZaArtikal", "LS.SenzorSifra", "K.KomitentEmail", "K.KomitentId");
$db->join("senzorizaartikal SZA", "SZA.SenzorSifraSenzora = LS.IdListaSenzora");
$db->join("artikli A", "A.ArtikalId = SZA.SenzorZaArtikal");
$db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId");
$db->join("komitenti K", "K.KomitentId = A.ArtikalKomitent");

$db->where("LS.IdListaSenzora", $id);
$products = $db->get("listasenzora LS", null, $cols);



$idArtikla = $products[0]['SenzorZaArtikal'];
$ArtikalNaziv = $products[0]['OpisArtikla'];
$SenzorSifra = $products[0]['SenzorSifra'];
$KomitentEmail = $products[0]['KomitentEmail'];
$KomitentId = $products[0]['KomitentId'];

if (!$SenzorSifra) {
    echo 'Nema sifre';
}
$ArtikalNaziv =  ($ArtikalNaziv) ? $ArtikalNaziv : '';
?>
<div class="row">


    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Šifra senzora : <?php echo $SenzorSifra; ?> -
                   Artikal Naziv : <a href="<?php echo DPROOTADMIN . '/str/editartikal/' . $idArtikla; ?> "> <?php echo $ArtikalNaziv; ?></a>
                    - Komitent :
                    <a target="_blank" href="<?php echo DPROOTADMIN . '/str/editkomitenta/' . $KomitentId; ?> "> <?php echo $KomitentEmail; ?></a>

                </h4>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <?php
    $limitNotifikacija = 5;

    $vlaznovId = 1;
    $temperaId = 2;
    $svetostId = 3;
    $moistureId = 4;

    require_once('vlaznostVazduha.php');
    require_once('temperatura.php');

    ?>


</div>

