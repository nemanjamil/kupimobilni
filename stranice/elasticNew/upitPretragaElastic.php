<?php

$elastic = new elastic($conn);

use Elasticsearch\ClientBuilder;
require DCROOT.'/vendor/autoload.php';
$client = ClientBuilder::create()->build();


$indexEl = ELASTICINDEX; // INDEX
$typeEl = ELASTICGRUPE; // type

if ($od != 0) {
    $od = $od - 1;
}

if (!$limitpostrani) {
    echo 'Ne postoji Limit Po Strani';
    die;
}

$params = array();
$params['index'] = $indexEl;
$params['type'] = $typeEl;
$params['size'] = $limitpostrani; //$kolikoDaUzme+$brojOdvoj;
$params['from'] = $od; //$page; //$page;

switch ($gled) {
    case 0:
        $upitSortNaziv = 'ArtikalNazivSort';
        $upitSortOrder = 'asc';
        break;
    case 1:
        $upitSortNaziv = 'ArtikalNazivSort';
        $upitSortOrder = 'asc';
        break;
    case 2:
        $upitSortNaziv = 'ArtikalNazivSort';
        $upitSortOrder = 'desc';
        break;
    case 3:
        $upitSortNaziv = 'ArtikalVPCena';
        $upitSortOrder = 'asc';
        break;
    case 4:
        $upitSortNaziv = 'ArtikalVPCena';
        $upitSortOrder = 'desc';
        break;
    case 5:
        $upitSortNaziv = 'ArtikalId';
        $upitSortOrder = 'desc';
        break;
    case 6:
        $upitSortNaziv = 'ArtikalBrpregleda';
        $upitSortOrder = 'desc';
        break;
}


/*
 * ovo koristimo da kada pretrazimo po kljucnoj reci da dobijemo sve kategorije i brednove i da to drzimo do kraja sa leve strane
 * */
require('inicijelneKategES.php');

/*
 * KOD 5.1 FILTERED JE REPLACED
 * https://www.elastic.co/guide/en/elasticsearch/reference/5.1/query-dsl-filtered-query.html
 *
 * */

$params['body']['sort'] = [
    //['ArtikalNaziv' => ['order' => 'desc']],
    ['' . $upitSortNaziv . '' => ['order' => '' . $upitSortOrder . '']],  // mora polje da bude non-indexed
    // http://stackoverflow.com/questions/33382734/fields-not-getting-sorted-in-alphabetical-order-in-elasticsearch
];

// https://www.elastic.co/guide/en/elasticsearch/reference/2.3/query-dsl-bool-query.html
$nultaVar = 0;
// STANJE
$params['body']['query']['bool']['filter']['and'][$nultaVar]['range']['ArtikalStanje']['from'] = 1;


if ($VpKorisnik) {
    $minCenaParams = $minCenaSesParam;
    $maxCenaParams = $maxCenaSesParam;
    $kojaCenaParams = 'ArtikalVPCena';
} else {
    $minCenaParams = $minCenaSesParam/$dnevniKurs;
    $maxCenaParams = $maxCenaSesParam/$dnevniKurs;
    $kojaCenaParams = 'ArtikalMPCena';
}
if ($minCenaSesParam && $maxCenaSesParam) {
$params['body']['query']['bool']['filter']['and'][$nultaVar]['range'][$kojaCenaParams]['gte'] = $minCenaParams;
$params['body']['query']['bool']['filter']['and'][$nultaVar]['range'][$kojaCenaParams]['lte'] = $maxCenaParams;
}


// KATEGORIJE
if ($_SESSION['elasticSes']['kategorije']) {
    $nultaVar++;
    foreach ($_SESSION['elasticSes']['kategorije'] AS $k => $v) {
        $params['body']['query']['bool']['filter']['and'][$nultaVar]['and'][0]['or'][]['term']['KategorijaArtikalId'] = $v;
    }

}

// BRENDOVI
if ($_SESSION['elasticSes']['brendovi']) {
    $nultaVar++;
    foreach ($_SESSION['elasticSes']['brendovi'] AS $k => $v) {
        $params['body']['query']['bool']['filter']['and'][$nultaVar]['and'][0]['or'][]['term']['ArtikalBrendId'] = $v;
    }
}

// MODELI
// http://stackoverflow.com/questions/28764996/elasticsearch-match-combination-in-array
// KADA JE AND
//$params['body']['query']['bool']['filter']['nested']['path'] = 'Modeli';
//$params['body']['query']['bool']['filter']['nested']['filter']['bool']['must']['match']['Modeli.ModelId'] = 2482;
//$params['body']['query']['bool']['filter']['nested']['filter']['bool']['must']['match']['Modeli.ModelId'] = 2483;

// KADA JE OR
if ($_SESSION['elasticSes']['modeli']) {
    $nultaVar++;
    $params['body']['query']['bool']['filter']['and'][$nultaVar]['nested']['path'] = 'Modeli';
    foreach ($_SESSION['elasticSes']['modeli'] AS $k => $v) {
        $params['body']['query']['bool']['filter']['and'][$nultaVar]['nested']['filter']['bool']['must']['or'][]['match']['Modeli.ModelId'] = $v;
    }
}



/*$nultaVar++;
$params['body']['query']['bool']['filter']['and'][2]['and'][0]['nested']['path'] = 'SpecValue';
$params['body']['query']['bool']['filter']['and'][2]['and'][0]['nested']['filter']['bool']['must'][0][0]['match']['SpecValue.IdGrupeSpecKategorija'] = 13; // materijal
$params['body']['query']['bool']['filter']['and'][2]['and'][0]['nested']['filter']['bool']['must'][1][0]['or'][]['match']['SpecValue.IdSpecVrednosti'] = 74; // silikon
$params['body']['query']['bool']['filter']['and'][2]['and'][0]['nested']['filter']['bool']['must'][1][0]['or'][]['match']['SpecValue.IdSpecVrednosti'] = 72; // koza


$params['body']['query']['bool']['filter']['and'][2]['and'][1]['nested']['path'] = 'SpecValue';
$params['body']['query']['bool']['filter']['and'][2]['and'][1]['nested']['filter']['bool']['must'][0][0]['match']['SpecValue.IdGrupeSpecKategorija'] = 1; // boja
$params['body']['query']['bool']['filter']['and'][2]['and'][1]['nested']['filter']['bool']['must'][1][0]['or'][]['match']['SpecValue.IdSpecVrednosti'] = 3; // crvena*/

// SPECIFIKACIJA
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

// KLJUCNE RECI
//if ($_SESSION['elasticSes']['tagoviEs']) {
//    foreach ($_SESSION['elasticSes']['tagoviEs'] AS $k => $v) {
//        $params['body']['query']['bool']['filter']['and'][1]['and'][$iBrenda]['and'][]['term']['ArtikalNazivStandard'] = $v;
//    }
//}





// UPIT
//$params['body']['query']['filtered']['query']['match']['ArtikalNaziv']['query'] = $term;
//$params['body']['query']['filtered']['query']['match']['ArtikalNaziv']['operator'] = 'and';
$params['body']['query']['bool']['must']['or'][0]['match']['ArtikalNaziv']['query'] = $term;
$params['body']['query']['bool']['must']['or'][0]['match']['ArtikalNaziv']['operator'] = 'and';
//$params['body']['query']['bool']['must']['or'][0]['match']['ArtikalNazivStandard']['fuzziness'] = 'AUTO';*/

//https://www.elastic.co/guide/en/elasticsearch/guide/current/fuzzy-match-query.html
/*$params['body']['query']['bool']['must']['or'][0]['fuzzy']['ArtikalNazivStandard']['value'] = $term;
$params['body']['query']['bool']['must']['or'][0]['fuzzy']['ArtikalNazivStandard']['boost'] = 1.0;
$params['body']['query']['bool']['must']['or'][0]['fuzzy']['ArtikalNazivStandard']['fuzziness'] = 5;
$params['body']['query']['bool']['must']['or'][0]['fuzzy']['ArtikalNazivStandard']['prefix_length'] = 0;
$params['body']['query']['bool']['must']['or'][0]['fuzzy']['ArtikalNazivStandard']['max_expansions'] = 5;*/


//$params['body']['query']['bool']['must']['or'][1]['match']['ArtikalNazivStandard']['query'] = $term;
//var_dump($params);

if ($term) {
    $result = $client->search($params);
}

if ($result) {
    $tookEsFull = $result['took'];
    $hitsV = $result['hits'];
    $total_count = $hitsV['total'];
    $hits = $hitsV['hits'];

    if ($total_count) {

        if ($total_count<$kolikoArtikalaMaxEs) {
            $m['tag'] = 'SearchES';
            $m['success'] = true;
            $m['error'] = 0;
            $m['error_msg'] = "Nema Errora";
            $m['total_count'] = $total_count; // $kolikoDaUzme; //;
            $m['incomplete_results'] = false;

            foreach ($hits AS $k => $keyArt):

                $id = (int)$keyArt['_id'];
                $ArtikalNaziv = $keyArt['_source']['ArtikalNaziv'];
                $ArtikalLink = $keyArt['_source']['ArtikalLink'];
                $KategorijaArtikalaNaziv = $keyArt['_source']['KategorijaArtikalaNaziv'];
                $KategorijaArtikalId = (int)$keyArt['_source']['KategorijaArtikalId'];
                $ArtikalBrendId = (int)$keyArt['_source']['ArtikalBrendId'];
                $ArtikalStanje = (int)$keyArt['_source']['ArtikalStanje'];
                $BrendIme = $keyArt['_source']['BrendIme'];

                $n['ArtikalNaziv'] = $ArtikalNaziv;
                $n['id'] = $id; // mora da bude ID
                $n['KategorijaArtikalaNaziv'] = $KategorijaArtikalaNaziv;
                $n['KategorijaArtikalId'] = $KategorijaArtikalId;
                $n['ArtikalBrendId'] = $ArtikalBrendId;
                $n['BrendIme'] = $BrendIme;
                $n['ArtikalLink'] = $ArtikalLink;
                $n['ArtikalStanje'] = $ArtikalStanje;

                $f[] = $n;
                $samoId[] = $id;

                /*$brendUpit['idBrend'] = $ArtikalBrendId;
                $brendUpit['brendIme'] = $BrendIme;
                $bre[] = $brendUpit;

                $kategUpit['KategorijaArtikalId'] = $KategorijaArtikalId;
                $kategUpit['KategorijaArtikalaNaziv'] = $KategorijaArtikalaNaziv;
                $kateg[] = $kategUpit;*/

            endforeach;

            $m['items'] = $f;
            $m['samoId'] = $samoId;
            /*$m['brendovi'] = $elastic->unique_multidim_array($bre, 'idBrend');
            $m['kategorije'] = $elastic->unique_multidim_array($kateg, 'KategorijaArtikalId');*/
        } else {
            $m['tag'] = 'SearchES';
            $m['success'] = false;
            $m['error'] = 0;
            $m['error_msg'] = "Ima podataka preko ".$kolikoArtikalaMaxEs;
            $m['incomplete_results'] = false;
            $m['total_count'] = $total_count;
            $m['items'] = $kolikoArtikalaMaxEs;
        }

    } else {

        $m['tag'] = 'SearchES';
        $m['success'] = false;
        $m['error'] = 0;
        $m['error_msg'] = "Nema podataka";
        $m['incomplete_results'] = false;
        $m['total_count'] = $total_count;
        $m['items'] = 0;

    }


} else {

    $m['tag'] = 'SearchES';
    $m['success'] = false;
    $m['error'] = 0;
    $m['error_msg'] = "Nesto nije u redu sa ES";
    $m['total_count'] = 0;

}
//var_dump($m);
//echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);
?>