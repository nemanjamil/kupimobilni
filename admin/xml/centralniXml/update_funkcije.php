<?php

// kod ovog file radimo sam ubacivanje artikala, ne radimo update stanja i cene
function microtime_float()
{
    list ($msec, $sec) = explode(' ', microtime());
    $microtime = (float)$msec + (float)$sec;
    return $microtime;
}

$start = microtime_float();

function urlpro($model)
{
    $i = 0;
    $smanji = strtolower($model);
    $text = explode(' ', $smanji);
    foreach ($text as $a) {
        $staizb = array(' ', '"', '/', '?', '(', ')', ',', '.', '_', '+', ':', '\'', '”');
        $k[] = str_replace($staizb, '', $a);
        if ($i++ > 3) break;

    }
    $comma_separated = implode("-", $k);
    return ($comma_separated);
}


$date = date("Y-m-d H:i:s");


/*$data = Array('NoviArtikal' => 0);
$db->where('IdCronXml', $kojijevendor);
if ($db->update('cronzaxml', $data)) {
    $db->count . ' records were updated';
} else {
    echo 'update failed - NoviArtikal : ' . $db->getLastError();
    die;
}*/


$db->where('IdValutaLevo', 1);
$db->where('IdValutaDesno', 4);
$results = $db->getOne('kurs');
$kurs = $results['OdnosValuta'];


?>