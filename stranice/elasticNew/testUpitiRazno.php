<?php
// verzija 1
//$params['body']['query']['match']['ArtikalNaziv']['query'] = trim($_GET['q']);
//$params['body']['query']['match']['ArtikalNaziv']['operator'] = 'or'; // moze @and ako je uslov
//
//// verzija 3
//$params['body']['query']['match']['ArtikalNazivStandard']['query'] = trim($_GET['q']);
//$params['body']['query']['match']['ArtikalNazivStandard']['operator'] = 'or'; // moze @and ako je uslov


// verzija 2
//https://www.elastic.co/guide/en/elasticsearch/guide/current/fuzzy-match-query.html
/*$params['body']['query']['fuzzy']['ArtikalNazivStandard']['value'] = $term;
$params['body']['query']['fuzzy']['ArtikalNazivStandard']['boost'] = 1.0;
$params['body']['query']['fuzzy']['ArtikalNazivStandard']['fuzziness'] = 5;
$params['body']['query']['fuzzy']['ArtikalNazivStandard']['prefix_length'] = 0;
$params['body']['query']['fuzzy']['ArtikalNazivStandard']['max_expansions'] = 5;*/

// verizja 4
/*$params['body']['query']['bool']['must']['or'][0]['multi_match']['fields'] = array('ArtikalNazivStandard');
$params['body']['query']['bool']['must']['or'][0]['multi_match']['query'] = $term;
$params['body']['query']['bool']['must']['or'][0]['multi_match']['fuzziness'] = "AUTO";*/

// verizja 5
/*$params['body']['query']['bool']['should'][0]['match']['ArtikalNazivStandard']['query'] = $term;
$params['body']['query']['bool']['should'][0]['match']['ArtikalNazivStandard']['operator'] = 'or';
$params['body']['query']['bool']['should'][1]['match']['ArtikalSifra']['query'] = $term;*/

// verzija 6
//$params['body']['query']['bool']['should'][0]['multi_match']['fields'] = array('ArtikalNazivStandard');
//$params['body']['query']['bool']['should'][0]['multi_match']['query'] = $term;
//$params['body']['query']['bool']['should'][0]['multi_match']['fuzziness'] = "AUTO";
//$params['body']['query']['bool']['should'][0]['multi_match']['operator'] = "and";
//$params['body']['query']['bool']['should'][1]['match']['ArtikalSifra']['query'] = $term;

//verzija 7
//$params['body']['query']['bool']['must']['or'][0]['multi_match']['fields'] = array('ArtikalNazivStandard');
//$params['body']['query']['bool']['must']['or'][0]['multi_match']['query'] = $term;
//$params['body']['query']['bool']['must']['or'][0]['multi_match']['fuzziness'] = "AUTO";
//$params['body']['query']['bool']['must']['or'][0]['multi_match']['operator'] = "and";
