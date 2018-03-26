<?php
function kojijehost($tipHosta){

    if ($tipHosta == 1) {
        $hostTip = '/data/kupimobilni'; // server Linux
    } elseif ($tipHosta == 3) {
        $hostTip = 'C:/wamp64/www/kupimobilni'; // Nemanja Windows
    } elseif ($tipHosta == 4) {
        $hostTip = 'G:/projects/kupimobilni'; // Nikola
    } else {
        $hostTip = '/var/www/kupimobilni'; // Nemanja Linux
    }
    return $hostTip;
}
$mcProd = getenv('KUPIMOBILNI');
$documentroot = kojijehost($mcProd);


include ($documentroot."/vezafullCron.php");
$common = new common($db);
$kategorije = new kategorije($db);
$jezikId = 1;



define('ELASTICINDEX', "kupimobilni");
define('ELASTICGRUPE', "artikli");
$lokacijaFolder = '/stranice/elasticNew';
$lokacijaFolderAdmin = ROOTLOC . '/admin/stranice/elasticAdmin';
$timeUbac = @date('[d/M/Y:H:i:s]');

require $documentroot . '/obradi/snimiTxt.php';
$log->lfile($documentroot.'/logovi/elasticSearch.txt');

$log->lwrite('');
$log->lwrite('KupiMobilni ENV : ' . $serverVarijabla);


//require 'elastic/vendor/autoload.php';
// $client = Elasticsearch\ClientBuilder::create()->build();


use Elasticsearch\ClientBuilder;
require $documentroot . '/vendor/autoload.php';
$client = ClientBuilder::create()->build();

$limit = 100;

require $lokacijaFolderAdmin . "/listaElastic.php";

$indexEl = ELASTICINDEX;
$typeEl = ELASTICGRUPE;
$params['index'] = $indexEl;
$params['type'] = $typeEl;



if ($upitArtKat) {
    foreach ($upitArtKat as $product => $keyArt):

        $ArtikalId = (int)$keyArt['ArtikalId'];
        $KategorijaArtiklaId = (int) $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $ArtikalLink = $keyArt['ArtikalLink'];
        $linkslike = $keyArt['linkslike'];
        $KategorijaArtiklaNaziv = $keyArt['NazivKategorije'];
        $KategorijaArtikalaLink = $keyArt['KategorijaArtikalaLink'];
        $ArtikalBrendId = (int)$keyArt['ArtikalBrendId'];
        $BrendIme = $keyArt['BrendIme'];
        $BrendLink = $keyArt['BrendLink'];
        $ArtikalSifra = $keyArt['ArtikalSifra'];
        $ArtikalStanje = (int)$keyArt['ArtikalStanje'];
        $ArtikalNaAkciji = (int)$keyArt['ArtikalNaAkciji'];
        $ArtikalBrpregleda = (int)$keyArt['ArtikalBrpregleda'];
        $ArtikalVPCena = (float)$keyArt['ArtikalVPCena'];
        $ArtikalMPCena = (float)$keyArt['ArtikalMPCena'];
        $ArtikalBarKod = $keyArt['ArtikalBarKod'];

        $lokacijaslika = $common->locationslika($ArtikalId);

        $slika = $lokacijaslika . '/' . $linkslike;
        $dalipostoji = $common->daLiPostojiSlika($slika);

        $slikaGlavna = DPROOT . $dalipostoji;

        $urlArtiklaLink = $common->linkoDoArt($ArtikalId);

        $specArtikal = array(); // resetujemo spec
        $specKateg = $kategorije->specPoKategoriji($KategorijaArtiklaId, $jezikId);

        if ($specKateg) {
            $specArtikal = $kategorije->specPoArtiklu($specKateg, $ArtikalId, $jezikId);
            if (empty($specArtikal)) {
                $specArtikal = array();
            }
        } else {
            $specArtikal = array();
        }


        $params = array();
        $params['body'] = array(
            'ArtikalNaziv' => $ArtikalNaziv,
            'ArtikalNazivStandard' => $ArtikalNaziv,
            'ArtikalNazivSort' => $ArtikalNaziv,
            'ArtikalLink' => $ArtikalLink,
            'KategorijaArtikalId' => $KategorijaArtiklaId,
            'KategorijaArtikalaNaziv' => $KategorijaArtiklaNaziv,
            'KategorijaArtikalaLink' => $KategorijaArtikalaLink,
            'ArtikalSifra' => $ArtikalSifra,
            'ArtikalStanje' => $ArtikalStanje,
            'ArtikalNaAkciji' => $ArtikalNaAkciji,
            'ArtikalBrendId' => $ArtikalBrendId,
            'BrendIme' => $BrendIme,
            'ArtikalVPCena' => $ArtikalVPCena,
            'ArtikalMPCena' => $ArtikalMPCena,
            'BrendLink' => $BrendLink,
            'ArtikalBrpregleda' => $ArtikalBrpregleda,
            'ArtikalBarKod' => $ArtikalBarKod,
            'ArtikalId' => $ArtikalId,
            //'Modeli' => $modeliFull,
            //'SpecGrupe' => $specKateg,
            'SpecValue' => $specArtikal
            //'SpecGrupeValue' => $specArtikal
        );

        $params['index'] = $indexEl;
        $params['type'] = $typeEl;
        $params['id'] = $ArtikalId;

        $result = $client->index($params);

        $prikPodaci .= PHP_EOL . $ArtikalId . ' - ' . $ArtikalNaziv . ' - ' . $timeUbac . ' - ' . $infoUpdate . PHP_EOL;
        require $documentroot . '/stranice/elasticNew/uradiUpdateES.php';


    endforeach;
} else {
    $prikPodaciError = 'Nema Podataka Treba poslati MAIL - Time : ' . $timeUbac . '  ' . PHP_EOL;
    $log->lwrite($prikPodaciError);
}

$log->lwrite($prikPodaci);

$log->lclose();
?>




