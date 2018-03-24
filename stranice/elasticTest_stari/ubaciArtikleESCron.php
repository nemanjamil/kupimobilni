<?php
//define('ROOTLOC', '/var/www/masine');
define('ROOTLOC', '/data/kupimobilni');
$lokacijaFolder = '/stranice/elasticTest';
$lokacijaFolderAdmin = ROOTLOC . '/admin/stranice/elasticAdmin';
$timeUbac = @date('[d/M/Y:H:i:s]');
require ROOTLOC . '/vezafull.php';
require "logTxtElastic.php";

$log->lwrite('');

//require 'elastic/vendor/autoload.php';
// $client = Elasticsearch\ClientBuilder::create()->build();
use Elasticsearch\ClientBuilder;

require ROOTLOC . '/elastic/vendor/autoload.php';
$client = ClientBuilder::create()->build();


$limit = 500;
require $lokacijaFolderAdmin . "/listaElastic.php";

$indexEl = ELASTICINDEX;
$typeEl = ELASTICGRUPE;
$params['index'] = $indexEl;
$params['type'] = $typeEl;

if ($upitArtKat) {
    foreach ($upitArtKat as $product => $keyArt):

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];

        $ArtikalBrendId = $keyArt['ArtikalBrendId'];
        $BrendIme = $keyArt['BrendIme'];
        $BrendLink = $keyArt['BrendLink'];

        $OpisKratakOpis = $keyArt['OpisKratakOpis'];
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
        $ArtikalNaAkciji = $keyArt['ArtikalNaAkciji'];
        $ArtikalStanje = $keyArt['ArtikalStanje'];
        $ocenaut = $keyArt['ocenaut'];
        $ImeSlikeArtikliSlike = $keyArt['ImeSlikeArtikliSlike'];
        $ArtikalBrPregleda = $keyArt['ArtikalBrPregleda'];


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
        $cenaPrikazBroj = $nakasd['cenaPrikazBroj'];
        $mozedasekupi = $nakasd['mozedasekupi'];


        $params = array();
        $params['body'] = array(
            'ArtikalNaziv' => $ArtikalNaziv,
            'ArtikalLink' => $ArtikalLink,
            'KategorijaArtikalId' => $KategorijaArtikalId,
            'KategorijaArtikalaNaziv' => $KategorijaArtikalaNaziv,
            'KategorijaArtikalaLink' => $KategorijaArtikalaLink,
            'mozedasekupi' => $mozedasekupi,
            'ArtikalBrPregleda' => $ArtikalBrPregleda,
            //'cenaPrikazBroj' => $cenaPrikazBroj,
            //'cenaPrikazExt' => $cenaPrikazExt,
            'ArtikalStanje' => $ArtikalStanje,
            'ArtikalNaAkciji' => $ArtikalNaAkciji,
            'ArtikalBrendId' => $ArtikalBrendId,
            'BrendLink' => $BrendLink
            /*'spec' => array(
                'pp' => rand(1, 100),
                'power' => rand(1, 100)
            )*/
        );

        $params['index'] = $indexEl;
        $params['type'] = $typeEl;
        $params['id'] = $ArtikalId;

        $result = $client->index($params);

        $prikPodaci = PHP_EOL.$ArtikalId . ' - ' . $ArtikalNaziv . ' - ' . $timeUbac.' - '.$infoUpdate.PHP_EOL;

        //var_dump($params);
        require "uradiUpdateES.php";

    endforeach;

    $log->lwrite($prikPodaci);



} else {

    $prikPodaci = 'Nema Podataka Treba poslati MAIL - Time : ' . $timeUbac . '  ' . PHP_EOL;
    $log->lwrite($prikPodaci);

}

$log->lclose();
?>




