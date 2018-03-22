<?php
$vredonstSenzor = 'vredSenzorMoisture';
$vremeSenzor = 'vremeSenzorMoisture';



/*$limit = Array (0, 10);
$cols = Array ("SM.vredSenzorMoisture","SM.vremeSenzorMoisture","TN.OpisNotifikacije","OSN.IdSenNotNotifikacija","OSN.OpisSenNot");
$db->join("podacinotifikacija PN","PN.idPodatka = SM.idSenMoisture");
$db->join("tipnotifikacije TN","TN.IdTipNotifikacijeIncr = PN.tipNotifikacije");
$db->join("opissenzornotifikacija OSN","OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr");
$db->where("SM.IdSenzorMoisture",$string);
$db->where("PN.tipSenzora",$IdSenzorTip);
$db->where("OSN.IdSenNotSenzor",$IdSenzorTip);
$db->where("PN.vecaManjaNoti = OSN.IdSenNotVecaManja");
$db->orderBy("SM.vremeSenzorMoisture","DESC");
$usersSenzorPodaciSvetlost = $db->get ("senzormoisture SM", $limit, $cols);*/

$params = Array($string);
$usersSenzorPodaci = $db->rawQuery("SELECT
*
FROM
(SELECT
    SM.vredSenzorMoisture,
    SM.vremeSenzorMoisture,
    TN.OpisNotifikacije,
    OSN.IdSenNotNotifikacija,
    OSN.OpisSenNot
  FROM
    senzormoisture SM
    JOIN podacinotifikacija PN
      ON PN.idPodatka = SM.idSenMoisture AND PN.tipSenzora = $IdSenzorTip
    JOIN tipnotifikacije TN
      ON TN.IdTipNotifikacijeIncr = PN.tipNotifikacije
    JOIN opissenzornotifikacija OSN
      ON OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr
  WHERE SM.IdSenzorMoisture = ?
AND OSN.IdSenNotSenzor = $IdSenzorTip
AND PN.vecaManjaNoti = OSN.IdSenNotVecaManja
  ORDER BY SM.vremeSenzorMoisture DESC
  LIMIT $limitodUp, $limitdoUp) T
ORDER BY vremeSenzorMoisture ASC", $params);



$f = 0;
if ($db->count > 0) {

    foreach ($usersSenzorPodaci as $p) {

        $vredSenzorMoisture = (float) $p['vredSenzorMoisture'];
        $vremeSenzorMoisture = $p['vremeSenzorMoisture'];
        $vremeSenzorMoisture = strtotime($vremeSenzorMoisture)*1000;
        $rows[$f]=array($vremeSenzorMoisture,$vredSenzorMoisture);
        $f++;

        $m['vremeSenzor'] = $p['vremeSenzorMoisture'];
        $m['vrednostSenzor'] = $p['vredSenzorMoisture'];
        $m['OpisNotifikacije'] = $p['OpisNotifikacije'];
        $m['IdSenNotNotifikacija'] = $p['IdSenNotNotifikacija'];
        $m['OpisSenNot'] = $p['OpisSenNot'];
        array_push($u['podacizaSenzor'],$m);

    }

    array_push($u['podacizaSenzorTime'],$rows);
}

?>
