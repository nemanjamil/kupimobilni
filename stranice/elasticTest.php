<?
use Elasticsearch\ClientBuilder;
require DCROOT.'/vendor/autoload.php';
$client = ClientBuilder::create()->build();

$indexEl = ELASTICINDEX; // INDEX
$typeEl = ELASTICGRUPE; // type

$indexParams['index']  = $indexEl;
$daliPostoji = $client->indices()->exists($indexParams);
if ($logged) {
    if ($tipUsera>=15 && ($KomitentId==2 || $KomitentId==3)) {
        if ($daliPostoji) {
            require "elasticNew/deleteIndex.php";
        }
        require "elasticNew/createIndexSajtTest.php";

    } else {
        echo 'Nemate pravo da restartujete ES';
        var_dump($KomitentId);
        var_dump($KomitentExtId);

    }
} else {
    echo 'Niste logovani. Nemate pravo da restartujete ES';
}

?>



