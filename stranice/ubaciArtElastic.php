<?php
use Elasticsearch\ClientBuilder;
require DCROOT.'/vendor/autoload.php';
$client = ClientBuilder::create()->build();

$indexEl = ELASTICINDEX; // INDEX
$typeEl = ELASTICGRUPE; // type
$jezikId = 5;


/*$wpw =  "SELECT TOP 2000
        A.*,
		AN.ArtikalNaziv,
		KN.KategorijaArtikalaNaziv,
        SP.LinkSlike,
        au.BrendIme AS BrendIme ,
        au.BrendLink AS BrendLink
FROM    artikli A
        JOIN ArtikliNaziv AN ON AN.ArtikalId = A.ArtikalId AND AN.IdLanguage = 1
		LEFT OUTER JOIN SlikeProiz SP ON  A.ArtikalId = SP.ArtikalId AND SP.mainpic = 1
		JOIN dbo.kategorijeartikala K ON K.KategorijaArtiklaId = A.KategorijaArtiklaId
		JOIN dbo.KategorijaArtikalaNaziv KN ON KN.KategorijaArtiklaId = K.KategorijaArtiklaId AND KN.IdLanguage = 1
        JOIN brendovi au ON A.ArtikalBrendId = au.id
WHERE   A.ProsaoES = 0
         -- AND A.ArtikalStanje > 0
        -- AND A.ArtikalId = 20226
        -- AN.ArtikalNaziv like '%S7562%'
ORDER BY ArtikalId DESC;";*/
// Kucni punjac wireless
// artikli.ArtikalNaziv like '%iphone%'
// artikli.ArtikalId = 1040397
// artikli.ProsaoES = 0
//$upitArtKat = $conn->upitRaw($wpw);

$limit = array(0, 2000);
$colone = array("A.*", "AN.OpisArtikla", "KN.NazivKategorije", "(SELECT ImeSlikeArtikliSlike FROM  artiklislike WHERE IdArtikliSlikePov = A.ArtikalId AND MainArtikliSlike = 1 LIMIT 1 )   AS linkslike", "B.BrendIme", "BB.BrendLink");
$db->join("artikalnazivnew AN", "AN.ArtikalId = A.ArtikalId AND AN.IdLanguage = $jezikId");
$db->join("kategorijeartikalanaslov KN", "KN.IdKategorije = A.KategorijaArtikalId AND KN.IdLanguage = $jezikId");
$db->join("brendoviime B", "B.BrendId = A.ArtikalBrendId AND B.IdLanguage = $jezikId");
$db->join("brendovi BB", "BB.BrendId = A.ArtikalBrendId ");
$db->where("A.elSearch = 0");
$db->orderBy("A.ArtikalId", "ASC");
$upitArtKat = $db->get("artikli A", $limit, $colone);

?>

<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Elastic Ubaci</a></li>
        <li><a href="#">Lista</a></li>
    </ul>

    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="page-login">

                <div class="account-border">
                    <div class="row">
                        <div class="col-sm-12 new-customer">

                            <?
                            if ($upitArtKat) {
                                foreach ($upitArtKat as $product => $keyArt):

                                    $ArtikalId = (int)$keyArt['ArtikalId'];
                                    $KategorijaArtiklaId = (int)$keyArt['KategorijaArtikalId'];
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

                                    //var_dump($params);

                                    // die;

                                    //TODO nikola nemanja Po zavrsetku, skinuti koment i omoguciti update artikala
                                    $update_query = Array(
                                        'elSearch' => 1

                                    );
                                    $db->where('ArtikalId', $ArtikalId);
                                    $db->update('artikli', $update_query);


                                    echo $ArtikalNaziv;
                                    echo '<br/>';
                                    echo $ArtikalId;
                                    echo '<br/>';
                                    echo '<br/>';
                                    var_dump($params);


                                endforeach;
                            } else {
                                echo 'Nema vise';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--<script type="text/JavaScript" src="/js/secure/sha512.js"></script>
<script type="text/JavaScript" src="/js/secure/forms.js"></script>-->
<!-- //Main Container -->