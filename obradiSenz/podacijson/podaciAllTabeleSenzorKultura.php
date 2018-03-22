<?php
$params = Array($IdSenzorTip,$br,$string);
$upitpoTipu = "SELECT * FROM (
SELECT
    SV.idSenzorIncr,
    SV.vredSenzor,
    SV.vremeSenzor,
    TN.OpisNotifikacije,
    PN.tipSenzora,
    PN.idKulture,
    PN.vecaManjaNoti,
    PN.tipNotifikacije,
    OSN.IdSenNotNotifikacija,
    OSN.OpisSenNot
       FROM
    $senzorTipTabela SV
        JOIN podacinotifikacija PN  ON PN.idPodatka = SV.idSenzorIncr  AND PN.tipSenzora = ?  AND  PN.idKulture = ?
         JOIN tipnotifikacije TN  ON TN.IdTipNotifikacijeIncr = PN.tipNotifikacije
         JOIN opissenzornotifikacija OSN    ON OSN.IdSenNotNotifikacija = TN.IdTipNotifikacijeIncr AND PN.tipSenzora = OSN.IdSenNotSenzor AND PN.vecaManjaNoti = OSN.IdSenNotVecaManja
  WHERE
    SV.idSenzorSifra= ?
      ORDER BY SV.idSenzorIncr DESC
LIMIT $limitodUp, $limitdoUp) T
ORDER BY  vremeSenzor ASC";

$usersSenzorPodaci = $db->rawQuery($upitpoTipu, $params);

$f = 0;
if ($db->count > 0) {

    foreach ($usersSenzorPodaci as $p) {

        $vredSenzor = (float) $p['vredSenzor'];

        $vremeSenzorVlaznosti = $p['vremeSenzor'];
        $vremeSenzorVlaznostiReal = strtotime($vremeSenzorVlaznosti)*1000;

        $rows['vremeSenzor']= $vremeSenzorVlaznostiReal;
        $rows['vrednostSenzor']= $vredSenzor;
        array_push($u['podacizaSenzorTime'],$rows);


        $m['vremeSenzor'] = $vremeSenzorVlaznosti;
        $m['idSenzorIncr'] = $p['idSenzorIncr'];
        $m['vrednostSenzor'] = $vredSenzor;
        $m['OpisNotifikacije'] = $p['OpisNotifikacije'];
        $m['IdSenNotNotifikacija'] = $p['IdSenNotNotifikacija'];
        $m['vecaManjaNoti'] = (int) $p['vecaManjaNoti'];
        $m['OpisSenNot'] = $p['OpisSenNot'];
        array_push($u['podacizaSenzor'],$m);
    }

} else {
    $u['podacizaSenzor'] = [];
    $u['podacizaSenzorTime'] = [];
}
?>
