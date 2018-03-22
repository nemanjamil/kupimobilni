<?php
require 'proveriAjaxDeny.php';

$kolikoDaUzme = 10;
$brojOdvoj = 2;
if(isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
    $page = ($page-1)*$kolikoDaUzme+$brojOdvoj;
} else {
    $page = 0;
}


//require 'elastic/vendor/autoload.php';
// $client = Elasticsearch\ClientBuilder::create()->build();
use Elasticsearch\ClientBuilder;

require 'elastic/vendor/autoload.php';
$client = ClientBuilder::create()->build();

$indexEl = ELASTICINDEX;
$typeEl = ELASTICGRUPE;
$params = array();
$params['index'] = $indexEl;
$params['type'] = $typeEl;
$params['size'] = $kolikoDaUzme+$brojOdvoj;
$params['from'] = $page; //$page;
$params['body']['query']['match']['ArtikalNaziv']['query'] = $_GET['q'];
$params['body']['query']['match']['ArtikalNaziv']['operator'] = 'and';
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

echo $m = json_encode($m, JSON_UNESCAPED_UNICODE);

