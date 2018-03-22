<?php

function kojijehost($tipHosta){

    if ($tipHosta==1) {
        $sta['loc'] = '/data/masinealati';
        $sta['sajt'] = 'http://masinealati.rs';
    } else {
        $sta['loc'] = '/var/www/masine';
        $sta['sajt'] = 'http://masine';
    }
    return $sta;
}
$mcProd = getenv('MASINEENV');
$documentrootSta = kojijehost($mcProd);
$documentroot = $documentrootSta['loc'];
$hostTipSajt = $documentrootSta['sajt'];
$documentrootAdmin = $documentroot.'/admin';
define('ROOTLOC', $documentroot);

require $documentroot.'/vezafull.php';

?>
<!--=== Wells ===-->
<div class="widget">
    <div class="widget-header">
        <h4><i class="icon-sitemap"></i> XML Proizvodi</h4>
    </div>
    <div class="widget-content">
        <div class="well">
            Kreiran XML za proizvode
        </div>

        <?php
        $host = $hostTipSajt;
        $datum_clanka = date("Y-m-d");

        $pieces = explode(",", SVEKATEGORIJEMASINE);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        $limit  = array(20000,20000);
        $db->join("kategorijeartikala KA", "A.KategorijaArtikalId=KA.KategorijaArtikalaId", "LEFT");
        $db->join("brendovi B", "A.ArtikalBrendId=B.BrendId", "LEFT");
        $db->join("brendoviime BI", "BI.BrendId=B.BrendId AND IdLanguage = 5", "LEFT");
        $db->join("artiklislike ASL", "A.ArtikalId=ASL.IdArtikliSlikePov", "LEFT");
        $db->join("artikalnazivnew ANN", "ANN.ArtikalId=A.ArtikalId AND ANN.IdLanguage = 5");
        $sql = $db->get("artikli A", $limit, "A.ArtikalId, A.ArtikalLink,ANN.OpisArtikla, KA.KategorijaArtikalaLink,KA.KategorijaArtikalaId, BI.BrendIme, ASL.ImeSlikeArtikliSlike");


        foreach ($sql as $r => $lists) {

            $KategorijaArtikalaId = $lists['KategorijaArtikalaId'];

            if (!in_array($KategorijaArtikalaId, $pieces)) {
                continue;
            }

            $url_artikla = $lists['ArtikalLink'];
            $kat_link = $lists['KategorijaArtikalaLink'];
            $idart = $lists['ArtikalId'];
            $link2 = $host . '/' . $url_artikla . '/' . $idart;
            $linkslike = $lists['ImeSlikeArtikliSlike'];
            $model = $lists['BrendIme'];
            $ArtNazsrblat = $lists['OpisArtikla'];
            $folderslika = substr($idart, 0, 2);

            $slika = $documentroot . '/p/' . $folderslika . '/' . $idart . '/' . $linkslike;
            $lski = '/p/' . $folderslika . '/' . $idart . '/' . $linkslike;

//echo '<br />';

            $xml .= '<url>' . PHP_EOL;
            $xml .= '<loc>' . $link2 . '</loc>' . PHP_EOL;
            $xml .= '<lastmod>' . $datum_clanka . '</lastmod>' . PHP_EOL;
            $xml .= '<priority>0.8</priority>' . PHP_EOL;
            $xml .= '<changefreq>weekly</changefreq>' . PHP_EOL;


            if (is_file($slika)) {
                $xml .= '<image:image>' . PHP_EOL;
                $xml .= '<image:loc>' . $host . $lski . '</image:loc>' . PHP_EOL;
//$xml .= '<image:title>'.$model.'</image:title>'.PHP_EOL;
                $xml .= '<image:caption><![CDATA['.$ArtNazsrblat.']]></image:caption>'.PHP_EOL;
                $xml .= '</image:image>' . PHP_EOL;
            }

            $xml .= '</url>' . PHP_EOL;

            $i++;
            usleep(1000);
//    if ($i == 5) break;
        }

        $xml .= '</urlset>';


        $filename = $documentroot."/cron/crongotovo/xmlartikli2.xml";
        $file = fopen($filename, "w+");
        fwrite($file, $xml);
        fclose($file);

        //echo 'ok';

        ?>
    </div>
    <!-- /Wells -->
