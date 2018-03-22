<?php
$vredonstSenzor = 'vredSenzorTemp';
$vremeSenzor = 'vremeSenzorTemp';
//$joinSenzor = '"senzortemp STMP", "STMP.idSenTempIncr = PN.idPodatka","LEFT"';


/*$limit = Array (0, 10);
$cols = Array ("ST.vredSenzorTemp","ST.vremeSenzorTemp","TN.OpisNotifikacije","OSN.IdSenNotNotifikacija","OSN.OpisSenNot");
$db->join("podacinotifikacija PN","PN.idPodatka = ST.idSenTempIncr");
$db->join("tipnotifikacije TN","TN.IdTipNotifikacijeIncr = PN.tipNotifikacije");
$db->join("opissenzornotifikacija OSN","OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr");
$db->where("ST.idSenzorTemp",$string);
$db->where("PN.tipSenzora",$IdSenzorTip);
$db->where("OSN.IdSenNotSenzor",$IdSenzorTip);
$db->where("PN.vecaManjaNoti = OSN.IdSenNotVecaManja");
$db->orderBy("ST.vremeSenzorTemp","DESC");
$usersSenzorPodaci = $db->get ("senzortemp ST", $limit, $cols);*/

$upitTemp = "SELECT
*
FROM
(SELECT
    ST.vredSenzorTemp,
    ST.vremeSenzorTemp,
    TN.OpisNotifikacije,
    OSN.IdSenNotNotifikacija,
    OSN.OpisSenNot
  FROM
    senzortemp ST
    JOIN podacinotifikacija PN
      ON PN.idPodatka = ST.idSenTempIncr AND PN.tipSenzora = $IdSenzorTip
    JOIN tipnotifikacije TN
      ON TN.IdTipNotifikacijeIncr = PN.tipNotifikacije
    JOIN opissenzornotifikacija OSN
      ON OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr
  WHERE ST.idSenzorTemp = ?
AND OSN.IdSenNotSenzor = $IdSenzorTip
AND PN.vecaManjaNoti = OSN.IdSenNotVecaManja
  ORDER BY ST.vremeSenzorTemp DESC
  LIMIT $limitodUp, $limitdoUp ) T
  ORDER BY vremeSenzorTemp ASC";
$params = Array($string);
$usersSenzorPodaci = $db->rawQuery($upitTemp, $params);



$f = 0;
if ($db->count > 0) {

    foreach ($usersSenzorPodaci as $p) {

        $vredSenzorTemp = (float) $p['vredSenzorTemp'];
        $vremeSenzorTemp =  $p['vremeSenzorTemp'];

        $vremeSenzorTemp = strtotime($vremeSenzorTemp)*1000;

        $rows[$f]=array($vremeSenzorTemp,$vredSenzorTemp);
        $f++;


        $m['vremeSenzor'] = $p['vremeSenzorTemp'];
        $m['vrednostSenzor'] = $vredSenzorTemp;
        $m['OpisNotifikacije'] = $p['OpisNotifikacije'];
        $m['IdSenNotNotifikacija'] = $p['IdSenNotNotifikacija'];
        $m['OpisSenNot'] = $p['OpisSenNot'];
        array_push($u['podacizaSenzor'],$m);

    }
    array_push($u['podacizaSenzorTime'],$rows);
}

?>
