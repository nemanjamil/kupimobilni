<?php
use Elasticsearch\ClientBuilder;
require 'elastic/vendor/autoload.php';
$client = ClientBuilder::create()->build();

$indexEl = ELASTICINDEX;
$typeEl = ELASTICGRUPE;

$indexParams['index']  = $indexEl;
$daliPostoji = $client->indices()->exists($indexParams);


if ($tipUsera>=15 && $KomitentId==3) {
    if ($daliPostoji) {
        require "elasticTest_stari/deleteIndex.php";
    }
    require "elasticTest_stari/createIndexSajtTest.php";

}
//require "elasticTest/createIndex.php"; // ne koristimo
//require "elasticTest/modifikacijeIndex.php";


die;

/*echo 'INDEX PODATAK';
echo '<br/>';
$params = [
    'index' => $indexEl,
    'type' => $typeEl,
    'id' => '2532',
    'body' => [ 'ArtikalNaziv' => 'Glodalica za zid GNF 35 CA! kategorije']
];
$result = $client->index($params);
var_dump($result);*/



echo 'SEARCH';
echo '<br/>';
$params = array();
$params['index'] = $indexEl;
$params['type'] = $typeEl;
$params['client']['verbose'] = true;


// MATCH
// $params['body']['query']['match_phrase_prefix']['ArtikalNaziv']['query'] = 'glod gn';
// $params['body']['query']['match_phrase_prefix']['ArtikalNaziv']['max_expansions'] = 100;
$params['body']['query']['match']['ArtikalNaziv']['query'] = 'prizma sa drz';
$params['body']['query']['match']['ArtikalNaziv']['operator'] = 'and';

// MATCH 2
// $params['body']['query']['query_string']['default_field'] = 'ArtikalNaziv';
// $params['body']['query']['query_string']['query'] = '1250';

// MATCH 3
// $params['body']['query']['query_string']['fields'] = array('ArtikalNaziv','KategorijaArtikalaNaziv');
// $params['body']['query']['query_string']['query'] = 'glod';

// MATCH FUZZY
//$params['body']['query']['fuzzy']['ArtikalNaziv'] = 'glod 125';
// $params['body']['query']['match']['ArtikalNaziv']['operator'] = 'and';

// MATCH FILTER
// $params['body']['query']['filtered']['filter']['term']['ArtikalNaziv'] = 1250;
// $params['body']['query']['filtered']['query']['match_phrase_prefix']['ArtikalNaziv'] = 'glod';

/*
var_dump($params);*/

/*$filter = array();
$filter['term']['mozedasekupi'] = 1;

$query = array();
$query['match']['ArtikalNaziv'] = 'gnf';

$params['body']['query']['filtered'] = array(
    "filter" => $filter,
    "query"  => $query
);*/
$result = $client->search($params);
var_dump($result);


die;

require "elasticTest_stari/upitElastic.php";

if ($upitArtKat) {
    foreach ($upitArtKat as $product => $keyArt):

        $ArtikalId = $keyArt['ArtikalId'];
        $KategorijaArtikalId = $keyArt['KategorijaArtikalId'];
        $ArtikalNaziv = $keyArt['OpisArtikla'];
        $OpisKratakOpis = $keyArt['OpisKratakOpis'];
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
        $NaAkciji = $keyArt['ArtikalNaAkciji'];
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
            'KategorijaArtikalId' => $KategorijaArtikalId,
            'KategorijaArtikalaNaziv' => $KategorijaArtikalaNaziv,
            'cenaPrikazBroj' => $cenaPrikazBroj,
            'mozedasekupi' => $mozedasekupi,
            'cenaPrikazExt' => $cenaPrikazExt,
            'spec' => array(
                'pp' => rand(1, 100),
                'power' => rand(1, 100)
            )
        );


        $params['index'] = $indexEl;
        $params['type'] = $typeEl;
        $params['id'] = $ArtikalId;

        var_dump($params);
        $result = $client->index($params);

    endforeach;
}


die;


echo 'INDEX';
echo '<br/>';
$params = array();
$params['body'] = array(
    'name' => 'Pera_' . rand(1, 600),
    'age' => rand(1, 100),
    'badges' => rand(120, 250)
);
$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
$params['id'] = '444';
$result = $client->index($params);
var_dump($result);

echo 'GET';
echo '<br/>';

$params = array();
$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
$params['id'] = '444';
$result = $client->get($params);
var_dump($result);

echo 'SEARCH';
echo '<br/>';
$params = array();
$params['index'] = 'pokemon';
$params['type'] = 'pokemon_trainer';
// $params['body']['query']['bool']['must']['terms']['age'] = array(0, 100); mora da bude
$params['body']['query']['filtered']['filter']['range']['age']['gte'] = 5;
$params['body']['query']['filtered']['filter']['range']['age']['lte'] = 70;
$result = $client->search($params);
print_r($result);

die;

/*$params = [
    'index' => 'pokemon',
    'type' => 'pokemon_trainer',
    'id' => '2532',
    'body' => [ 'testField' => 'abc']
];
$result = $client->index($params);
var_dump($result);*/


$params = [
    'index' => 'pokemon',
    'type' => 'pokemon_trainer',
    'id' => '444'
];
$response = $client->get($params);
var_dump($response);
die;


$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ]
        ]
    ]
];

$results = $client->search($params);

var_dump($results);
echo $milliseconds = $results['took'];
echo '<br/>';
echo $maxScore = $results['hits']['max_score'];
echo '<br/>';
$score = $results['hits']['hits'][0]['_score'];
$doc = $results['hits']['hits'][0]['_source'];