<?php
$lokdosert = '/data/kupimobilni/admin/xml/kimtec/';

$linkdoxml = 'https://b2b.kimtec.rs/slike/01001071_big.jpg';
$lfile = $lokdosert.'p/test.jpg';
$fp = fopen($lfile, "w");

if(file_exists($lokdosert."certs/ca.pem") && file_exists($lokdosert."certs/client.pem") && file_exists($lokdosert."certs/key.pem"))
{


    $ch =curl_init();
    curl_setopt($ch, CURLOPT_URL,$linkdoxml);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_CAINFO, $lokdosert."certs/ca.pem");
    curl_setopt($ch, CURLOPT_SSLCERT, $lokdosert."certs/client.pem");
    curl_setopt($ch, CURLOPT_SSLKEY, $lokdosert."certs/key.pem");
    curl_setopt($ch, CURLOPT_SSLKEYPASSWD, "miki"); // pin vezan za B2B certifikat
    curl_setopt($ch, CURLOPT_FILE, $fp);
    $return = curl_exec ($ch);
    //echo $return;
    //echo curl_error($ch);
    curl_close ($ch);

}
else
{
    if (!file_exists($lokdosert."certs/ca.pem")) { echo ("Datoteka certs/ca.pem ne postoji<br>"); }
    if(!file_exists($lokdosert."certs/client.pem")) { echo ("Datoteka certs/client.pem ne postoji<br>"); }
    if (!file_exists($lokdosert."certs/key.pem")) {echo ("Datoteka certs/key.pem ne postoji<br>"); }
}
?>