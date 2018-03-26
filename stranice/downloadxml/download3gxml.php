<?php
set_time_limit(0);
function kojijehost($tipHosta){

    if ($tipHosta == 1) {
        $hostTip = '/data/kupimobilni'; // server Linux
    } elseif ($tipHosta == 3) {
        $hostTip = 'C:/wamp64/www/kupimobilni'; // Nemanja Windows
    } elseif ($tipHosta == 4) {
        $hostTip = 'G:/projects/kupimobilni'; // Nikola
    } else {
        $hostTip = '/var/www/kupimobilni'; // Nemanja Linux
    }
    return $hostTip;
}
$mcProd = getenv('KUPIMOBILNI');

$documentroot = kojijehost($mcProd);

// 1. zakucavamo server execution time na 0 tj. da ne stane dok se sve ne izvrsi i da prikaze sve error - e.
//ini_get('display_errors');
ini_set('max_execution_time', 0);

$likacijadoslikedir = $documentroot."/xml/3g/";
$linkdoxml = 'http://bg.company3g.com/xml/3gMobilSistemSajt.zip';

function flushmoj($naziv) {
    /*echo $naziv;
    echo '</br>';
    flush();
    ob_flush();*/
}
function dovucizipfile($linkdoxml,$likacijadoslikedir){
    $fp = fopen($likacijadoslikedir.'/3gMobilSistem.zip', "w");
    $ch = curl_init();
    //curl_setopt($ch, CURLOPT_HEADER, 1);
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL,$linkdoxml);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    $return = curl_exec ($ch);

    if(curl_errno($ch)){
        echo 'error:' . curl_error($ch);
    }
    curl_close ($ch);

}


flushmoj('Pocinjemo sa dovlacenjem fajla');
dovucizipfile($linkdoxml,$likacijadoslikedir);

flushmoj('Dovukli smo file');
sleep(4);

$ZIP_ERROR = [
    ZipArchive::ER_EXISTS => 'File already exists.',
    ZipArchive::ER_INCONS => 'Zip archive inconsistent.',
    ZipArchive::ER_INVAL => 'Invalid argument.',
    ZipArchive::ER_MEMORY => 'Malloc failure.',
    ZipArchive::ER_NOENT => 'No such file.',
    ZipArchive::ER_NOZIP => 'Not a zip archive.',
    ZipArchive::ER_OPEN => "Can't open file.",
    ZipArchive::ER_READ => 'Read error.',
    ZipArchive::ER_SEEK => 'Seek error.',
];

$zip = new ZipArchive();
$result_code = $zip->open($likacijadoslikedir.'/3gMobilSistem.zip');

if( $result_code !== true ){
    $msg = isset($ZIP_ERROR[$result_code])? $ZIP_ERROR[$result_code] : 'Unknown error.';
    //var_dump($msg);
} else {
    if ($result_code === TRUE) {
        flushmoj('Pocinje Extract');
        $zip->extractTo($likacijadoslikedir);
        $zip->close();
        flushmoj('Zavrsio se Extract');
    } else {
        echo 'failed, code:' . $res;
    }
}



// $db->query("UPDATE cronzaxml SET BrojDokle='0' WHERE IdCronXml = '8'");  // bilo je BrojDokleCena

?>