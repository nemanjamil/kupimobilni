<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 10.42
 */

$m = array();

$cols = Array("TagoviId", "TagoviIme", "TagoviGrupa","TagoviIme,CONCAT('bazacron') AS bazacron");
//$db->where("tagovi.TagoviIme LIKE '%$string%'");
$user = $db->get("tagovi",  Array (10, 10), $cols);



$i = 0;
foreach ($user as $key => $value) {

    $m[$i]['value'] .= $value['TagoviId'];
    $m[$i]['text'] .= $value['TagoviIme'];
    $m[$i]['continent'] .= $value['bazacron'];

    $i++;

}
$cities = json_encode($m, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |JSON_HEX_APOS |JSON_HEX_QUOT);

/*JSON_UNESCAPED_UNICODE da bi dobili utf-8
http://se2.php.net/manual/en/json.constants.php*/
//$post_data = json_encode($e, JSON_UNESCAPED_UNICODE);


$fp = fopen(DCROOT.'/cron/crongotovo/cities.json', 'w+');
fwrite($fp, $cities);
fclose($fp);

