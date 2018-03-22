<?php
header("Content-type: text/json");
date_default_timezone_set('UTC');

$cols = Array ("SZ.SenzorSifraSenzora, LS.SenzorSifra");
$db->join("senzorizaartikal SZ", "SZ.SenzorZaArtikal = A.ArtikalId");
$db->join("listasenzora LS", "LS.IdListaSenzora = SZ.SenzorSifraSenzora");
$db->where("A.ArtikalId", $id);
$products = $db->get("artikli A", null, $cols);

//$idSifraSenzor = $products[0]['SenzorSifraSenzora'];
$idSifraSenzor = $products[0]['SenzorSifra'];

//$db->setTrace(true);
$cols = Array ("vremeSenzorVlaznosti as vremeX");
$db->where('vremeSenzorVlaznosti', Array ('2015-11-20 16:00:26', '2015-11-20 16:25:23'), 'BETWEEN');
$db->where("idSenzorVlaznosti", $idSifraSenzor);
$users = $db->get ("senzorvlaznosti", 30, $cols);
//print_r($db->trace);

function dateToTimezone($timeZone = 'UTC', $dateTimeUTC = null, $dateFormat = 'Y-m-d H:i:s'){

    $dateTimeUTC = $dateTimeUTC ? $dateTimeUTC : date("Y-m-d H:i:s");
    $date = new DateTime($dateTimeUTC, new DateTimeZone('UTC'));
    $date->setTimeZone(new DateTimeZone($timeZone));

    return $date->format($dateFormat);
}


foreach($users as $k => $v){
    $vrx[] = strtotime($v[vremeX])*1000;
}

$jSon['xData'] = $vrx;

$vrx = '';

// KREIRAMO TEMP
$cols = Array ("vredSenzorTemp");
$db->where('vremeSenzorTemp', Array ('2015-11-20 16:01:26', '2015-11-20 16:25:23'), 'BETWEEN');
$db->where("idSenzorTemp", $idSifraSenzor);
$users = $db->get ("senzortemp", 30, $cols);

foreach($users as $k => $v){
    $temp[] = (float) $v[vredSenzorTemp];
}

$sd = array('name'=>'Temperatura','data'=>$temp,'unit'=>'c','type'=>'line','valueDecimals'=>1);
$jSon['datasets'][] = $sd;




// KREIRAMO SVETLOST
$cols = Array ("VredSenzorSvetlost");
$db->where('vremeSenzorSvetlost', Array ('2015-11-20 16:01:26', '2015-11-20 16:25:23'), 'BETWEEN');
$db->where("idSenzorSvetlost", $idSifraSenzor);
$lux = $db->get ("senzorsvetlosti", 30, $cols);

foreach($lux as $k => $v){
    $lumena[] = (float)$v[VredSenzorSvetlost];
}

$sd = array('name'=>'Svetlost','data'=>$lumena,'unit'=>'lux','type'=>'line','valueDecimals'=>1);
$jSon['datasets'][] = $sd;


// KREIRAMO Vlaznost
$cols = Array ("vredSenzorVlaznosti");
$db->where('vremeSenzorVlaznosti', Array ('2015-11-20 16:01:26', '2015-11-20 16:25:23'), 'BETWEEN');
$db->where("idSenzorVlaznosti", $idSifraSenzor);
$ph = $db->get ("senzorvlaznosti", 30, $cols);

foreach($ph as $k => $v){
    $phhhp[] = (float)$v[vredSenzorVlaznosti];
}

$sd = array('name'=>'Vlaznost','data'=>$phhhp,'unit'=>'vlaz','type'=>'line','valueDecimals'=>0);
$jSon['datasets'][] = $sd;

echo $m = json_encode($jSon,JSON_NUMERIC_CHECK  | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);


?>

