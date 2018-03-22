<?php


$cols = Array("DISTINCT ST.senzorTipIme","ST.IdSenzorTip","SKLP.NazivKulLokPod", "PKL.OdPodaciIdeal","PKL.DoPodaciIdeal","PKL.OdZutoIdeal","PKL.DoZutoIdeal");
$db->join("senzorkullokpodaci SKLP", "SKLP.IdKultureKulLok = LS.PripadaKulLok");
$db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKLP.IdKulLokPodaci");
$db->join("podacinotifikacija PN", "PN.notSifraSenzora = LS.SenzorSifra");
$db->join("senzortip ST", "ST.IdSenzorTip = PN.tipSenzora");

$db->where ("LS.SenzorSifra", $notSifraSenzora);
$db->where("PN.tipSenzora = SKLP.IdTipKulTipLok");
$linkPodaciOkviriVrednosti = $db->get("listasenzora LS", null, $cols);




/*$db->setTrace(true);
$cols = Array("ST.IdSenzorTip", "ST.senzorTipIme","PKL.OdPodaciIdeal", "PKL.DoPodaciIdeal", "PKL.OdZutoIdeal","PKL.DoZutoIdeal");
$db->join("senzortip ST", "ST.IdSenzorTip = PN.tipSenzora");
$db->join("listasenzora LS", "LS.SenzorSifra = PN.notSifraSenzora");
$db->join("senzorkullokpodaci SKLP", "SKLP.IdKultureKulLok = LS.PripadaKulLok");
$db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKLP.IdKulLokPodaci");

$db->where ("PN.vremeNotifikacije ", $vremeTest, '>=');
$db->where("PN.poslatMail", 0);
$db->where("PN.notSifraSenzora", $notSifraSenzora);
$db->where("PN.tipSenzora = SKLP.IdTipKulTipLok");
$db->groupBy('PN.tipSenzora');
$db->orderBy ("ST.IdSenzorTip","asc");
$link = $db->get("podacinotifikacija PN", null, $cols);
print_r($db->trace);*/





if ($linkPodaciOkviriVrednosti) {



foreach ($linkPodaciOkviriVrednosti AS $key => $value):

    $senzorTipIme = $value['senzorTipIme'];
    $IdSenzorTip = $value['IdSenzorTip'];

    switch ($IdSenzorTip) {
        case 1:
            $vredonstSenzor = 'vredSenzorVlaznosti';
            $vremeSenzor = 'vremeSenzorVlaznosti';
            //$joinSenzor = '"senzorvlaznosti SV", "SV.idSenVlazVazIcnr = PN.idPodatka","LEFT"';
            break;
        case 2:
            $vredonstSenzor = 'vredSenzorTemp';
            $vremeSenzor = 'vremeSenzorTemp';
            //$joinSenzor = '"senzortemp STMP", "STMP.idSenTempIncr = PN.idPodatka","LEFT"';
            break;
        case 3:
            $vredonstSenzor = 'VredSenzorSvetlost';
            $vremeSenzor = 'vremeSenzorSvetlost';
            break;
        case 4:
            $vredonstSenzor = 'vredSenzorMoisture';
            $vremeSenzor = 'vremeSenzorMoisture';
            break;
    }

// ovo smo preselili ovde a zatvara se ovaj deo na POCETKU mailBody3col.php
    $mailBody .= '<tr><td class="two-column">
                    <!--[if (gte mso 9)|(IE)]>
						<table width="100%">
						<tr>
						<td width="50%" valign="top">
						<![endif]-->';

        require('cssMailAndroid/opisiVrednosti.php');

        $mailBody .= '<!--[if (gte mso 9)|(IE)]>
						</td>
						</tr>
						</table>
						<![endif]-->
					</td>
				</tr>';



endforeach;

/*
require_once('cssMailAndroid/mailBody3col.php');
require_once('cssMailAndroid/mailBodyfut.php');*/

}



?>