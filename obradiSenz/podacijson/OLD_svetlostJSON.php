<?php

/*$limit = Array (0, 10);
$cols = Array ("SS.VredSenzorSvetlost","SS.vremeSenzorSvetlost","TN.OpisNotifikacije","OSN.IdSenNotNotifikacija","OSN.OpisSenNot");
$db->join("podacinotifikacija PN","PN.idPodatka = SS.idSenSvetlostiInc");
$db->join("tipnotifikacije TN","TN.IdTipNotifikacijeIncr = PN.tipNotifikacije");
$db->join("opissenzornotifikacija OSN","OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr");
$db->where("SS.IdSenzorSvetlost",$string);
$db->where("PN.tipSenzora",$IdSenzorTip);
$db->where("OSN.IdSenNotSenzor",$IdSenzorTip);
$db->where("PN.vecaManjaNoti = OSN.IdSenNotVecaManja");
$db->orderBy("SS.vremeSenzorSvetlost","DESC");
$usersSenzorPodaciSvetlost = $db->get ("senzorsvetlosti SS ", $limit, $cols);*/





$params = Array($string);
$usersSenzorPodaciSvetlost = $db->rawQuery("SELECT
*
FROM
(SELECT
    SS.VredSenzorSvetlost,
    SS.vremeSenzorSvetlost,
    TN.OpisNotifikacije,
    OSN.IdSenNotNotifikacija,
    OSN.OpisSenNot
  FROM
    senzorsvetlosti SS
    JOIN podacinotifikacija PN
      ON PN.idPodatka = SS.idSenSvetlostiInc AND PN.tipSenzora = $IdSenzorTip
    JOIN tipnotifikacije TN
      ON TN.IdTipNotifikacijeIncr = PN.tipNotifikacije
    JOIN opissenzornotifikacija OSN
      ON OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr
  WHERE SS.IdSenzorSvetlost = ?

AND OSN.IdSenNotSenzor = $IdSenzorTip
AND PN.vecaManjaNoti = OSN.IdSenNotVecaManja
  ORDER BY SS.vremeSenzorSvetlost DESC
  LIMIT $limitodUp, $limitdoUp)  T
ORDER BY vremeSenzorSvetlost  ASC", $params);



$f = 0;
if ($db->count > 0) {

    foreach ($usersSenzorPodaciSvetlost as $p) {

        $VredSenzorSvetlost = (float) $p['VredSenzorSvetlost'];
        $vremeSenzorSvetlost = $p['vremeSenzorSvetlost'];
        $vremeSenzorSvetlost = strtotime($vremeSenzorSvetlost)*1000;
        $rows[$f]=array($vremeSenzorSvetlost,$VredSenzorSvetlost);
        $f++;


        $m['vremeSenzor'] = $p['vremeSenzorSvetlost'];
        $m['vrednostSenzor'] = $p['VredSenzorSvetlost'];
        $m['OpisNotifikacije'] = $p['OpisNotifikacije'];
        $m['IdSenNotNotifikacija'] = $p['IdSenNotNotifikacija'];
        $m['OpisSenNot'] = $p['OpisSenNot'];
        array_push($u['podacizaSenzor'],$m);

    }
    array_push($u['podacizaSenzorTime'],$rows);
}

?>
