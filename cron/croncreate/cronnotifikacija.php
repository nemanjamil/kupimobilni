<?php
$postdata = file_get_contents("php://input");

if (!empty($postdata)) {
    $tp = $postdata;
} else {
    $tp = 'prazno';
}
/*echo 'string : ';
echo $tp = 'temperature=100;humidity=200;luminosity=300;ID=Thing-B7E6';
echo '<br/>';*/

$woot = explode(';', $tp);
$i = 0;
foreach ($woot as $key => $value) {
    $s = explode('=', $value);
    //$pod[] = array($s[0]=>$s[1]);
    $pod[$s[0]] = $s[1];
    $i++;
}

// dobijamo podatke sto kupimo od senzora
$w = json_encode($pod);
$someObject = json_decode($w);
$idSifra = $someObject->ID;
$temperature = $someObject->temperature;
$humidity = $someObject->humidity;
$luminosity = $someObject->luminosity;
$moisture = $someObject->moisture;



// dobijemo podatke o korisniku datog senzora
$cols = Array("K.KomitentEmail");
$db->join("komitenti K", "K.KomitentId = LS.PripadaKomitentu");
$db->where("LS.SenzorSifra", $idSifra);
$link = $db->get("listasenzora LS", null, $cols);
$email = $link[0]['KomitentEmail'];
if (!$email) {
    $email = 'nemanjamil@gmail.com';
}

/*$cols = Array("K.ImeKulture","ST.senzorTipIme", "LSU.ImeLokSamo", "KL.NazivKulturaLokacija", "SKL.NazivKulLokPod", "PKL.*");
$db->join("kulturalokacija KL", "KL.IdKulturaLokacija = LS.PripadaKulLok");
$db->join("kulture K", "KL.PovKulture = K.IdKulture");
$db->join("lokalnasu LSU", "KL.PovLokSamouprava = LSU.IdLokSamo");
$db->join("senzorkullokpodaci SKL", "SKL.IdKultureKulLok = LS.PripadaKulLok");
$db->join("senzortip ST", "ST.IdSenzorTip = SKL.IdTipKulTipLok");
$db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKL.IdKulLokPodaci");
$db->where("LS.SenzorSifra", $idSifra);
$link = $db->get("listasenzora LS", null, $cols);*/



// UBACUJEMO TEMEPRATURU
$data = Array("idSenzorTemp" => $idSifra,
    "vredSenzorTemp" => $temperature
);
$id = $db->insert('senzortemp', $data);
// proveravamo podatke
$cols = Array("PKL.OdPodaciIdeal","PKL.DoPodaciIdeal", "PKL.OdZutoIdeal", "PKL.DoZutoIdeal");
$db->join("kulturalokacija KL", "KL.IdKulturaLokacija = LS.PripadaKulLok");
$db->join("senzorkullokpodaci SKL", "SKL.IdKultureKulLok = LS.PripadaKulLok");
$db->join("podacikultiplok PKL", "PKL.IdSenzorKulPodLok = SKL.IdKulLokPodaci");
$db->where("LS.SenzorSifra", $idSifra);
$db->where("PKL.IdSenzorKulPodLok", 2);
$link = $db->get("listasenzora LS", null, $cols);

$OdPodaciIdeal = $link[0]['OdPodaciIdeal'];
$DoPodaciIdeal = $link[0]['DoPodaciIdeal'];
$OdZutoIdeal = $link[0]['OdZutoIdeal'];
$DoZutoIdeal = $link[0]['DoZutoIdeal'];

if ($temperature >= $OdPodaciIdeal && $temperature <= $DoPodaciIdeal) {


    require RB_ROOT.'/PHPMailer-master/PHPMailerAutoload.php';

    $mail = new PHPMailer;
//$mail->SMTPDebug = 4;
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = GLAVNIMAIL;  // kpoybpurvlplpqlu rizuhphjjczomrvk itclusterserbia@gmail.com
    $mail->Password = PASSMAIL;
    $mail->From = GLAVNIMAIL;
    $mail->FromName = FROMNAME;
    $mail->isHTML(true);
    $mail->addAddress($email, 'Izmena Maila');     // Add a recipient
    //$mail->addReplyTo($email, $korpaime.' '.$korpaprezime);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('itclusterserbia@gmail.com');
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $naslovmaila = 'U okviru';
    $mail->Subject = $naslovmaila;
    $mail->Body = 'pera'; //$message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        die;
    } else {
        echo 'OK poslat mail';

    }

}



/////////////////////
/////////////////////




// UBACUJEMO VLAZNOST VAZDUHA
$data = Array("idSenzorVlaznosti" => $idSifra,
    "vredSenzorVlaznosti" => $humidity
);
$id = $db->insert('senzorvlaznosti', $data);


// UBACUJEMO SVETLOST
$data = Array("IdSenzorSvetlost" => $idSifra,
    "VredSenzorSvetlost" => $luminosity
);
$id = $db->insert('senzorsvetlosti', $data);


// UBACUJEMO MOISTURE
$data = Array("IdSenzorMoisture" => $idSifra,
    "vredSenzorMoisture" => $moisture
);
$id = $db->insert('senzormoisture', $data);



/*$db->startTransaction();
if (!$db->insert ('myTable', $insertData)) {
    $db->rollback();
} else {
    $db->commit();
}*/

?>
	