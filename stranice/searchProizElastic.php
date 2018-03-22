<?php
if ($od != 0) {
    $od = $od - 1;
}

if (!$limitpostrani) {
    echo 'Ne postoji Limit Po Strani';
    die;
}

//require 'elastic/vendor/autoload.php';
// $client = Elasticsearch\ClientBuilder::create()->build();
use Elasticsearch\ClientBuilder;
require DCROOT.'/vendor/autoload.php';
$client = ClientBuilder::create()->build();

//$params = ['index' => ELASTICINDEX];
//$response = $client->indices()->getSettings($params);

$term = trim($_GET['q']);



$indexEl = ELASTICINDEX;
$typeEl = ELASTICGRUPE;
$params = array();
$params['index'] = $indexEl;
$params['type'] = $typeEl;
$params['size'] = $limitpostrani;
$params['from'] = $od;

switch ($gled) {
    case 0:
        $upitSortNaziv = 'ArtikalBrpregleda';
        $upitSortOrder = 'desc';
        break;
    case 1:
        $upitSortNaziv = 'ArtikalBrpregleda';
        $upitSortOrder = 'desc';
        break;
    case 2:
        $upitSortNaziv = 'ArtikalVPCena';
        $upitSortOrder = 'asc';
        break;
    case 3:
        $upitSortNaziv = 'ArtikalVPCena';
        $upitSortOrder = 'desc';
        break;
    case 4:
        $upitSortNaziv = 'ArtikalNazivSort';
        $upitSortOrder = 'asc';
        break;
    case 5:
        $upitSortNaziv = 'ArtikalNazivSort';
        $upitSortOrder = 'desc';
        break;
    case 6:
        $upitSortNaziv = 'ArtikalId';
        $upitSortOrder = 'desc';
        break;
    case 7: // default elastic
        $upitSortNaziv = '';
        $upitSortOrder = '';
        break;

}
/*
 * ovo koristimo da kada pretrazimo po kljucnoj reci da dobijemo sve kategorije i brednove i da to drzimo do kraja sa leve strane
 * */


$kojePoljezaPretragu = 'ArtikalNazivStandard';

require('elasticNew/inicijelneKategES.php');
if ($upitSortNaziv && $upitSortNaziv!='ArtikalBrpregleda') {
    $params['body']['sort'] = [
        ['' . $upitSortNaziv . '' => ['order' => '' . $upitSortOrder . '']]
    ];
}
$nultaVar = 0;
$params['body']['query']['bool']['filter']['and'][$nultaVar]['range']['ArtikalStanje']['from'] = 1;

$nultaVar++;
if ($VpKorisnik) {
    $minCenaParams = $minCenaSesParam;
    $maxCenaParams = $maxCenaSesParam;
    $kojaCenaParams = 'ArtikalVPCena';
} else {
    $minCenaParams = $minCenaSesParam;
    $maxCenaParams = $maxCenaSesParam;
    $kojaCenaParams = 'ArtikalMPCena';
}
if ($minCenaSesParam || $maxCenaSesParam) {
    $params['body']['query']['bool']['filter']['and'][$nultaVar]['range'][$kojaCenaParams]['gte'] = $minCenaParams;
    $params['body']['query']['bool']['filter']['and'][$nultaVar]['range'][$kojaCenaParams]['lte'] = $maxCenaParams;
}

// KATEGORIJE
if ($_SESSION['elasticSes']['kategorije']) {
    $nultaVar++;
    foreach ($_SESSION['elasticSes']['kategorije'] AS $k => $v) {
        $params['body']['query']['bool']['filter']['and'][$nultaVar]['or'][]['term']['KategorijaArtikalId'] = $v;
        //$params['body']['query']['bool']['filter']['and'][$nultaVar]['and'][0]['or'][]['term']['KategorijaArtikalId'] = $v;
    }

}

// BRENDOVI
if ($_SESSION['elasticSes']['brendovi']) {
    $nultaVar++;
    foreach ($_SESSION['elasticSes']['brendovi'] AS $k => $v) {
        $params['body']['query']['bool']['filter']['and'][$nultaVar]['or'][]['term']['ArtikalBrendId'] = $v;
        //$params['body']['query']['bool']['filter']['and'][$nultaVar]['and'][0]['or'][]['term']['ArtikalBrendId'] = $v;
    }
}



$elasticSes = $_SESSION['elasticSes']['specVrednosti'];
if (!empty($elasticSes)) {
    $nultaVar++;
    $elasticBrojAr = 0;
    foreach ($elasticSes AS $ks => $vs):
        if (!empty($vs[0])) {
            $params['body']['query']['bool']['filter']['and'][$nultaVar]['and'][$elasticBrojAr]['nested']['path'] = 'SpecValue';
            $params['body']['query']['bool']['filter']['and'][$nultaVar]['and'][$elasticBrojAr]['nested']['filter']['bool']['must'][0][0]['match']['SpecValue.IdGrupeSpecKategorija'] = $ks; // materijal

            foreach ($vs AS $kspecUp => $vspecUp):
                $params['body']['query']['bool']['filter']['and'][$nultaVar]['and'][$elasticBrojAr]['nested']['filter']['bool']['must'][1][0]['or'][]['match']['SpecValue.IdSpecVrednosti'] = $vspecUp; // koza
            endforeach;

            $elasticBrojAr++;
        }



    endforeach;

}



/*$params['body']['query']['bool']['must']['match'][$kojePoljezaPretragu]['query'] = $term;
$params['body']['query']['bool']['must']['match'][$kojePoljezaPretragu]['operator'] = 'or'; // moze da bude and*/

//$params['body']['query']['bool']['should'][0]['bool']['must']['match']['ArtikalNazivStandard']['query'] = $term;
//$params['body']['query']['bool']['should'][0]['bool']['must']['match']['ArtikalNazivStandard']['operator'] = 'or';
//$params['body']['query']['bool']['should'][1]['bool']['must']['match']['ArtikalSifra']['query'] = $term;

/*$params['body']['query']['bool']['should'][0]['multi_match']['fields'] = array($kojePoljezaPretragu);
$params['body']['query']['bool']['should'][0]['multi_match']['query'] = $term;
$params['body']['query']['bool']['should'][0]['multi_match']['fuzziness'] = "AUTO";
$params['body']['query']['bool']['should'][0]['multi_match']['operator'] = "and";
$params['body']['query']['bool']['should'][1]['must']['match']['ArtikalSifra']['query'] = $term;*/

/*$params['body']['query']['bool']['should'][0]['multi_match']['fields'] = array($kojePoljezaPretragu);
$params['body']['query']['bool']['should'][0]['multi_match']['query'] = $term;
$params['body']['query']['bool']['should'][0]['multi_match']['fuzziness'] = "AUTO";
$params['body']['query']['bool']['should'][0]['multi_match']['operator'] = "and";
$params['body']['query']['bool']['should'][0]['multi_match']['boost'] = 2;

$params['body']['query']['bool']['should'][1]['match']['ArtikalSifra']['query'] = $term;
$params['body']['query']['bool']['should'][1]['match']['ArtikalSifra']['boost'] = 3;*/

/*$params['body']['query']['bool']['should'][2]['match'][$kojePoljezaPretragu]['query'] = $term;
$params['body']['query']['bool']['should'][2]['match'][$kojePoljezaPretragu]['operator'] = 'or';
$params['body']['query']['bool']['should'][2]['match'][$kojePoljezaPretragu]['boost'] = 1;*/


$params['body']['query']['bool']['should'][0]['match'][$kojePoljezaPretragu]['query'] = $term;
$params['body']['query']['bool']['should'][0]['match'][$kojePoljezaPretragu]['operator'] = 'and';
$params['body']['query']['bool']['should'][0]['match'][$kojePoljezaPretragu]['boost'] = 1;

$params['body']['query']['bool']['should'][1]['match'][$kojePoljezaPretragu]['query'] = $term;
$params['body']['query']['bool']['should'][1]['match'][$kojePoljezaPretragu]['operator'] = 'or';
$params['body']['query']['bool']['should'][1]['match'][$kojePoljezaPretragu]['boost'] = 3;


//require('elasticNew/testUpitiRazno.php');

//var_dump($params);


$result = $client->search($params);


if ($result) {

    $hitsV = $result['hits'];
    $total_count = $hitsV['total'];

    $hits = $hitsV['hits'];

    if ($total_count) {

        $m['tag'] = 'SearchES';
        $m['success'] = true;
        $m['error'] = 0;
        $m['error_msg'] = "Nema Errora";
        $m['total_count'] = $total_count; // $kolikoDaUzme; //;
        $m['incomplete_results'] = false;


        foreach ($hits AS $k => $keyArt):

            $id = $keyArt['_id'];
            $ArtikalNaziv = $keyArt['_source']['ArtikalNaziv'];
            $ArtikalLink = $keyArt['_source']['ArtikalLink'];
            $KategorijaArtikalaNaziv = $keyArt['_source']['KategorijaArtikalaNaziv'];


            $n['ArtikalNaziv'] = $ArtikalNaziv;
            $n['id'] = $id; // mora da bude ID
            $n['KategorijaArtikalaNaziv'] = $KategorijaArtikalaNaziv;
            $n['ArtikalLink'] = $ArtikalLink;

            $f[] = $n;

        endforeach;

        $m['items'] = $f;

    } else {

        $m['tag'] = 'SearchES';
        $m['success'] = false;
        $m['error'] = 0;
        $m['error_msg'] = "Nema podataka";
        $m['incomplete_results'] = false;
        $m['total_count'] = $total_count;
        $m['items'] = array();

    }


} else {

    $m['tag'] = 'SearchES';
    $m['success'] = false;
    $m['error'] = 0;
    $m['error_msg'] = "Nesto nije u redu sa ES";
    $m['total_count'] = 0;

}

//echo $m = json_encode($m, JSON_UNESCAPED_UNICODE);

$itemsEs = $m['items'];
$vredPrikaz = '';
if ($itemsEs) {


    foreach ($itemsEs as $productID => $qty) {
        $ArtId = $qty['id'];

        $listaArtikala[] = (int) $ArtId;
    }


    // pravimo upit u bazu
    $arraCsv = $common->array_2_csv_sa_dodatkomnavodnika($listaArtikala);

    require('elasticUpitSearch/upitSearchEl.php');


    require('elasticUpitSearch/listaVarijabliSearch.php');

    echo $vredPrikaz;


}

?>
