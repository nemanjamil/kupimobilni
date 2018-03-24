<?php
define('ROOTLOC', '/var/www/masine');
$lokacijaFolder = '/stranice/elasticTest';
$lokacijaFolderAdmin = ROOTLOC . '/admin/stranice/elasticAdmin';
$timeUbac = @date('[d/M/Y:H:i:s]');
require ROOTLOC . '/vezafull.php';
require "logTxtElastic.php";

echo 'Nismo jos setovali';
die;

//require 'elastic/vendor/autoload.php';
// $client = Elasticsearch\ClientBuilder::create()->build();
use Elasticsearch\ClientBuilder;

require ROOTLOC . '/elastic/vendor/autoload.php';
$client = ClientBuilder::create()->build();


$limit = 100;
require $lokacijaFolderAdmin . "/listaElastic.php";

$indexEl = ELASTICINDEX;
$typeEl = ELASTICGRUPE;
$params['index'] = $indexEl;
$params['type'] = $typeEl;


$params = ['body' => []];

for ($i = 1; $i <= 500; $i++) {
    $params['body'][] = [
        'index' => [
            '_index' => 'my_index',
            '_type' => 'my_type',
            '_id' => $i
        ]
    ];

    $params['body'][] = [
        'my_field' => 'my_value',
        'second_field' => 'some more values'
    ];

    // Every 1000 documents stop and send the bulk request
    if ($i % 100 == 0) {
        $responses = $client->bulk($params);

        // erase the old bulk request
        $params = ['body' => []];

        // unset the bulk response when you are done to save memory
        unset($responses);
    }
}

// Send the last batch if it exists
if (!empty($params['body'])) {
    $responses = $client->bulk($params);
}

die;


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

        $prikPodaci .= $ArtikalId . ' - ' . $ArtikalNaziv . ' - ' . $timeUbac.' - '.$infoUpdate.PHP_EOL.PHP_EOL;

        var_dump($params);
        require "uradiUpdateES.php";

    endforeach;

    $log->lwrite($prikPodaci);



} else {

    $prikPodaci = 'Nema Podataka Treba poslati MAIL - Time : ' . $timeUbac . '  ' . PHP_EOL;
    $log->lwrite($prikPodaci);

}

$log->lclose();
?>




