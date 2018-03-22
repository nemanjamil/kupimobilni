<?php
    /*<td>
    <img src="'.$linkdoSlike.'/two-column-01.jpg" width="280" alt="" />
    </td>

    <td class="full-width-image">
                                                    <img src="'.$linkdoSlike.'/header.jpg" width="600" alt="" />
                                                </td>

    */

$mailBody .= '<div class="column">
                            <table width="100%">
                                <tr>
                                    <td class="inner">
                                        <table class="contents">
                                            <tr>


                                            </tr>
                                            <tr>
                                                <td class="text">
                                                <p class="h1">'.$senzorTipIme.' IdSenzorTip : '.$IdSenzorTip.'</p>';


$OdPodaciIdeal = $value['OdPodaciIdeal'];
$DoPodaciIdeal = $value['DoPodaciIdeal'];
$OdZutoIdeal = $value['OdZutoIdeal'];
$DoZutoIdeal = $value['DoZutoIdeal'];

// bgcolor="#90ee90" bgcolor="#ffffe0" bgcolor="#f08080"
$mailBody .= '<table class="tftable" border="1">';
$mailBody .= '<tr>
                <td>< : '.$OdZutoIdeal.'</td>
                <td>Srednja : <br> do '.$OdZutoIdeal.'</td>
                <td>Optimim : <br> od '.$OdPodaciIdeal.'</td>
                <td>Optimim : <br>  do '.$DoPodaciIdeal.'</td>
                <td>Srednja : <br> od '.$DoPodaciIdeal.' do '.$DoZutoIdeal.'</td>
                <td>> : '.$DoZutoIdeal.'</td>
                </tr>';
$mailBody .= '</table>';


//$db->setTrace(true);

$cols = Array("PN.idNotInc","PN.idPodatka","PN.tipNotifikacije","PN.idPodatka","PN.poslatMail","PN.vremeNotifikacije",
    "ST.senzorTipIme","TN.OpisNotifikacije","STMP.vredSenzorTemp","SV.vredSenzorVlaznosti","A.ArtikalNaziv","OSN.OpisSenNot");

$db->join("senzortip ST", "ST.IdSenzorTip = PN.tipSenzora");
$db->join("listasenzora LS", "LS.SenzorSifra = PN.notSifraSenzora");
$db->join("komitenti K", "K.KomitentId = LS.PripadaKomitentu");
$db->join("tipnotifikacije TN", "TN.IdTipNotifikacijeIncr = PN.tipNotifikacije");
$db->join("senzorkullokpodaci SKLP", "SKLP.IdKultureKulLok = LS.PripadaKulLok");
//$db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKLP.IdKulLokPodaci");
$db->join("opissenzornotifikacija  OSN", "TN.IdTipNotifikacijeIncr = OSN.IdSenNotNotifikacija AND ST.IdSenzorTip = OSN.IdSenNotSenzor AND PN.vecaManjaNoti=OSN.IdSenNotVecaManja","LEFT");
$db->join("senzortemp STMP", "STMP.idSenTempIncr = PN.idPodatka","LEFT");
$db->join("senzorvlaznosti SV", "SV.idSenVlazVazIcnr = PN.idPodatka","LEFT");

$db->join("senzorizaartikal SZA", "SZA.SenzorSifraSenzora = LS.IdListaSenzora","LEFT");
$db->join("artikli A", "A.ArtikalId = SZA.SenzorZaArtikal","LEFT");

$db->where ("PN.vremeNotifikacije ", $vremeTest, '>=');
$db->where("PN.tipSenzora = SKLP.IdTipKulTipLok");
$db->where("PN.poslatMail", 0);
$db->where("PN.tipSenzora", $IdSenzorTip);
$db->where("K.KomitentId", $Kid);
$db->where("SKLP.IdKultureKulLok", $IdKulturaLokacija);
$db->where("PN.tipSenzora", $IdSenzorTip);
$db->where("PN.notSifraSenzora", $notSifraSenzora);

$db->orderBy ("ST.IdSenzorTip","asc");
$linkPodaciSenzor = $db->get("podacinotifikacija PN", null, $cols);


//print_r($db->trace);

//var_dump($db);



if ($linkPodaciSenzor) {


    $mailBody .= '<table class="tftable" border="1">
<tr>
<th>Opis</th>
<!--<th>Id</th>-->
<th>Trenutna Vrednost</th>
<th>Vreme</th>
</tr>';

    foreach ($linkPodaciSenzor AS $key => $value):

        $idNotInc = $value['idNotInc'];
        $tipNotifikacije = $value['tipNotifikacije'];
        $senzorTipIme = $value['senzorTipIme'];
        $OpisNotifikacije = $value['OpisNotifikacije'];
        $vredonstSenzortab = $value[$vredonstSenzor];
        $vremeNotifikacije = $value['vremeNotifikacije'];
        $OpisSenNot = $value['OpisSenNot'];




          switch ($tipNotifikacije) {
            case 1:
                $cssNotifikacija = "#90ee90";
                break;
            case 2:
                $cssNotifikacija = "#ffffe0";
                break;
            case 3:
                $cssNotifikacija = "#f08080";
                break;
        }



        //<td>'.$idNotInc.'</td>
        $mailBody .= '<tr>
        <td bgcolor="'.$cssNotifikacija.'">'.$OpisNotifikacije.'</td>

        <td>'.$vredonstSenzortab.'</td>
        <td>'.$vremeNotifikacije.'</td>

        </tr>';


    endforeach;

$mailBody .= '</table>';


    $mailBody .= '<table class="tftable" border="1">';
    $mailBody .= '<tr>
                    <td>
                    <p><strong>Šta treba uraditi</strong></p>
                    <p>'.$OpisSenNot.'</p>
                    </td>
                </tr>';



    $mailBody .= '</table>';
    $mailBody .= '<br/>';

}



                                    $mailBody .= '</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>';




?>