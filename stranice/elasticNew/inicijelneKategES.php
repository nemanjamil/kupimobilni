<?php
// https://qbox.io/blog/elasticsearch-aggregations
// https://www.elastic.co/guide/en/elasticsearch/guide/master/_filtering_queries.html
// MULTI MATCH  https://www.elastic.co/guide/en/elasticsearch/reference/2.3/query-dsl-multi-match-query.html
// FUZZY https://www.elastic.co/guide/en/elasticsearch/reference/2.3/query-dsl-fuzzy-query.html
// BOOL https://www.elastic.co/guide/en/elasticsearch/reference/2.3/query-dsl-bool-query.html

/*
 * I
 *
 * */
/*$totalCountTag = 0;
$paramsSve = array();
$paramsSve['index'] = $indexEl;
$paramsSve['type'] = $typeEl;
$paramsSve['size'] = 0; // ovo smo stavili da ne bi prikazivali artikle

$paramsSve['body']['query']['bool']['must']['match']['ArtikalNazivStandard']['query'] = $term;
$paramsSve['body']['query']['bool']['must']['match']['ArtikalNazivStandard']['operator'] = 'or';

$paramsSve['body']['aggs']['tagoviAggs']['terms']['field'] = 'ArtikalNazivStandard';
$paramsSve['body']['aggs']['tagoviAggs']['terms']['size'] = 50;

$resultInic = $client->search($paramsSve);

if ($resultInic) {

    $hitsV = $resultInic['hits'];
    $total_count = $hitsV['total'];
    $hits = $hitsV['hits'];


    if ($total_count) {

        $aggregationsTagovi = $resultInic['aggregations']['tagoviAggs']['buckets'];

    } else {
        //echo 'Nema TotalCount za Tagove Reci u inicijelneKateg';
        //echo '<br/>';
        $totalCountTag = 1;
    }
} else {
    //echo 'Nema Tagove Reci po datoj kljucnoj reci - inicijelneKateg';
    //echo '<br/>';
    $totalCountTag = 2;
}*/


/*
 * II
 * */
$paramsSve = array();
$paramsSve['index'] = $indexEl;
$paramsSve['type'] = $typeEl;
$paramsSve['size'] = 0; // ovo smo stavili da ne bi prikazivali artikle

/*$iBrenda = 0;
if ($_SESSION['elasticSes']['kategorije']) {
    foreach ($_SESSION['elasticSes']['kategorije'] AS $k => $v) {
        $paramsSve['body']['query']['bool']['filter']['and'][0]['and'][$iBrenda]['or'][]['term']['KategorijaArtikalId'] = $v;
    }
    $iBrenda = 1;
}
if ($_SESSION['elasticSes']['brendovi']) {
    foreach ($_SESSION['elasticSes']['brendovi'] AS $k => $v) {
        $paramsSve['body']['query']['bool']['filter']['and'][0]['and'][$iBrenda]['or'][]['term']['ArtikalBrendId'] = $v;
    }
    $iBrenda++;
}*/
$paramsSve['body']['query']['bool']['must'][0]['range']['ArtikalStanje']['from'] = 1;
$paramsSve['body']['query']['bool']['must'][1]['match'][$kojePoljezaPretragu]['query'] = $term;
$paramsSve['body']['query']['bool']['must'][1]['match'][$kojePoljezaPretragu]['operator'] = 'or';

$paramsSve['body']['aggs']['kategorijeAggs']['terms']['field'] = 'KategorijaArtikalId';
$paramsSve['body']['aggs']['kategorijeAggs']['terms']['size'] = 100;

$paramsSve['body']['aggs']['brendoviAggs']['terms']['field'] = 'ArtikalBrendId';
$paramsSve['body']['aggs']['brendoviAggs']['terms']['size'] = 100;

$paramsSve['body']['aggs']['maxCenaVp']['max']['field'] = 'ArtikalVPCena';
$paramsSve['body']['aggs']['minCenaVp']['min']['field'] = 'ArtikalVPCena';

$paramsSve['body']['aggs']['maxCenaMp']['max']['field'] = 'ArtikalMPCena';
$paramsSve['body']['aggs']['minCenaMp']['min']['field'] = 'ArtikalMPCena';

//$paramsSve['body']['aggs']['Modeli']['nested']['path'] = 'Modeli';
//$paramsSve['body']['aggs']['Modeli']['aggs']['modeliAggs']['terms']['field'] = 'Modeli.ModelId';
//$paramsSve['body']['aggs']['Modeli']['aggs']['modeliAggs']['terms']['size'] = 100;
//$paramsSve['body']['aggs']['Modeli']['aggs']['modeliAggs']['terms']['order']['_term'] = 'asc';

$paramsSve['body']['aggs']['SpecValue']['nested']['path'] = 'SpecValue';
$paramsSve['body']['aggs']['SpecValue']['aggs']['specKategAggs']['terms']['field'] = 'SpecValue.IdGrupeSpecKategorija';
$paramsSve['body']['aggs']['SpecValue']['aggs']['specKategAggs']['terms']['size'] = 100;

$paramsSve['body']['aggs']['SpecValue']['aggs']['specVrednostAggs']['terms']['field'] = 'SpecValue.IdSpecVrednosti';
$paramsSve['body']['aggs']['SpecValue']['aggs']['specVrednostAggs']['terms']['size'] = 100;


$resultInic = $client->search($paramsSve);


if ($resultInic) {

    $hitsV = $resultInic['hits'];
    $total_count = $hitsV['total'];
    $hits = $hitsV['hits'];


    if ($total_count) {

        $aggregationsKateg = $resultInic['aggregations']['kategorijeAggs']['buckets'];
        $aggregationsBrendovi = $resultInic['aggregations']['brendoviAggs']['buckets'];
        //$aggregationsModeli = $resultInic['aggregations']['Modeli']['modeliAggs']['buckets'];
        $specKategAggs = $resultInic['aggregations']['SpecValue']['specKategAggs']['buckets'];
        $specVrednostAggs = $resultInic['aggregations']['SpecValue']['specVrednostAggs']['buckets'];

        $maxCenaVp = $resultInic['aggregations']['maxCenaVp']['value'];
        $minCenaVp = $resultInic['aggregations']['minCenaVp']['value'];
        $maxCenaMp = $resultInic['aggregations']['maxCenaMp']['value'];
        $minCenaMp = $resultInic['aggregations']['minCenaMp']['value'];


    } else {
        //echo 'Nema KATEG i BREND TotalCount u inicijelneKateg';
    }
} else {
    //echo 'Nema Kategorija ni Brendova po datoj kljucnoj reci - inicijelneKateg';
}


/*
 * III BACK UP
 * */
/*$paramsSve = array();
$paramsSve['index'] = $indexEl;
$paramsSve['type'] = $typeEl;
$paramsSve['size'] = 0; // ovo smo stavili da ne bi prikazivali artikle

$paramsSve['body']['query']['bool']['must']['match']['ArtikalNazivStandard']['query'] = $term;
$paramsSve['body']['query']['bool']['must']['match']['ArtikalNazivStandard']['operator'] = 'and';

$paramsSve['body']['aggs']['kategorijeAggs']['terms']['field'] = 'KategorijaArtikalId';
$paramsSve['body']['aggs']['kategorijeAggs']['terms']['size'] = 100;

$paramsSve['body']['aggs']['brendoviAggs']['terms']['field'] = 'ArtikalBrendId';
$paramsSve['body']['aggs']['brendoviAggs']['terms']['size'] = 100;

$paramsSve['body']['aggs']['tagoviAggs']['terms']['field'] = 'ArtikalNazivStandard';
//$paramsSve['body']['aggs']['tagoviAggs']['terms']['order']['ArtikalNaziv'] = 'desc';
$paramsSve['body']['aggs']['tagoviAggs']['terms']['size'] = 50;

$resultInic = $client->search($paramsSve);

if ($resultInic) {

    $hitsV = $resultInic['hits'];
    $total_count = $hitsV['total'];
    $hits = $hitsV['hits'];


    if ($total_count) {

        $aggregationsKateg = $resultInic['aggregations']['kategorijeAggs']['buckets'];
        $aggregationsBrendovi = $resultInic['aggregations']['brendoviAggs']['buckets'];
        $aggregationsTagovi = $resultInic['aggregations']['tagoviAggs']['buckets'];

    } else {
        echo 'Nema TotalCount u inicijelneKateg';
    }
} else {
    echo 'Nema Kategorija ni Brendova po datoj kljucnoj reci - inicijelneKateg';
}*/

?>