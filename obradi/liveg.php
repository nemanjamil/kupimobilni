<?php
//header("Content-type: text/json");

// SIFRA SENZORA
$cols = Array ("SZ.SenzorSifraSenzora, LS.SenzorSifra");
$db->join("senzorizaartikal SZ", "SZ.SenzorZaArtikal = A.ArtikalId");
$db->join("listasenzora LS", "LS.IdListaSenzora = SZ.SenzorSifraSenzora");
$db->where("A.ArtikalId", 2);
$products = $db->get("artikli A", null, $cols);

$idSifraSenzor = $products[0]['SenzorSifra'];
// kraj




// VREME - x osa
$cols = Array ("SV.vremeSenzorVlaznosti as vremeX, SV.vredSenzorVlaznosti");
$db->where('SV.vremeSenzorVlaznosti', Array ('2015-11-19 16:00:26', '2015-11-19 16:25:23'), 'BETWEEN');
$db->where("SV.idSenzorVlaznosti", $idSifraSenzor);
$time = $db->get ("senzorvlaznosti SV", 10, $cols);
//var_dump($db);
$array1 = array();
foreach($time as $k => $v) {
    $xty[] = strtotime($v[vremeX]) * 1000;
    $y[] = $v[vredSenzorVlaznosti];

    $array1=array($xty, $y);

}


// TEMPERATURA - y osa
$cols = Array ("vredSenzorTemp");
$db->where('vremeSenzorTemp', Array ('2015-11-19 16:01:26', '2015-11-19 16:25:23'), 'BETWEEN');
$db->where("idSenzorTemp", $idSifraSenzor);
$temperatura = $db->get ("senzortemp", 10, $cols);


foreach($temperatura as $k => $v){
    $temp[] = (float)$v[vredSenzorTemp];
}
$ytemp = array($temp);

// kraj


$ret = array($xty, $temp);

//print_r($ret);
//echo json_encode($ret);


function array_interlace() {
    $args = func_get_args();
    $total = count($args);

    //print_r($args);

    if($total < 2) {
        return FALSE;
    }

    $i = 0;
    $j = 0;
    $arr = array();

    foreach($args as $arg) {
        foreach($arg as $v) {
            $arr[$j] = $v;
            $j += $total;

        }

        $i++;
        $j = $i;
    }

    ksort($arr);
    return array_values($arr);
}

$result = array_map(null,$xty, $temp);

$resultEncoded = json_encode($result);
$resultEncoded = substr($resultEncoded,1);
$resultEncoded = substr($resultEncoded,0,strlen($resultEncoded)-1);


echo $resultEncoded;

/*

Dubes
// JSON header
header("Content-type: text/json");

// vreme puta 1000
$x = time() * 1000;
// random od 0 do 100
$y = rand(0, 100);

// PHP array kao JSON
$ret = array($x, $y);
echo json_encode($ret);
*/
// rezultat treba da bude u obliku [1449058622000,7]
?>