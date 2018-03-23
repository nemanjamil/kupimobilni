<?php

function kojijehost($tipHosta){

    if ($tipHosta==1) {
        $sta['loc'] = '/data/kupimobilni';
        $sta['sajt'] = 'http://masinealati.rs';
    } else {
        $sta['loc'] = '/var/www/masine';
        $sta['sajt'] = 'http://masine';
    }
    return $sta;
}
$mcProd = getenv('KUPIMOBILNI');
$documentrootSta = kojijehost($mcProd);
$documentroot = $documentrootSta['loc'];
$hostTipSajt = $documentrootSta['sajt'];
$documentrootAdmin = $documentroot.'/admin';
define('ROOTLOC', $documentroot);

require $documentroot.'/vezafull.php';

?>
<div class="widget">
    <div class="widget-header">
        <h4><i class="icon-sitemap"></i> XML Kategorije</h4>
    </div>
    <div class="widget-content">
        <div class="well">
            Kreiran XML za Kategorije
        </div>
    </div>

    <?php

    $host = $hostTipSajt; //'http://dire.rs/';
    $datum_clanka = date("Y-m-d");

    $pieces = explode(",", SVEKATEGORIJEMASINE);

    $xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;


    $xml .= '<url>' . PHP_EOL;
    $xml .= '<loc>' . $host . '</loc>' . PHP_EOL;
    $xml .= '<lastmod>' . $datum_clanka . '</lastmod>' . PHP_EOL;
    $xml .= '<priority>1</priority>' . PHP_EOL;
    $xml .= '<changefreq>weekly</changefreq>' . PHP_EOL;
    $xml .= '</url>' . PHP_EOL;

    // odavde pocinju kategorije
    $cols = Array("KAN.NazivKategorije", "K.KategorijaArtikalaLink", "K.KategorijaArtikalaId");
    $db->join("kategorijeartikalanaslov KAN", "KAN.IdKategorije=K.KategorijaArtikalaId", "LEFT");
    $db->where("KAN.IdLanguage = 5");
    $users = $db->get("kategorijeartikala K", null, $cols);


    if ($users > 0)
        foreach ($users as $r => $lists) {

            $kat_name = $lists['NazivKategorije'];
            $kat_link = $lists['KategorijaArtikalaLink'];
            $idart = $lists['KategorijaArtikalaId'];

           /* if (!in_array($idart, $pieces)) {
                continue;
            }*/

            $link2 = $host . '/' . $kat_link;

            $xml .= '<url>' . PHP_EOL;
            $xml .= '<loc>' . $link2 . '</loc>' . PHP_EOL;
            $xml .= '<lastmod>' . $datum_clanka . '</lastmod>' . PHP_EOL;
            $xml .= '<priority>0.9</priority>' . PHP_EOL;
            $xml .= '<changefreq>weekly</changefreq>' . PHP_EOL;
            $xml .= '</url>' . PHP_EOL;
        }
    $i = 1;

    $xml .= '</urlset>';


    $filename = $documentroot."/cron/crongotovo/db_sitemap_kateg.xml";
    $file = fopen($filename, "w+");
    fwrite($file, $xml);
    fclose($file);
    ?>
</div>
<!-- /Wells -->