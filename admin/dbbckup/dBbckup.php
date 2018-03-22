<?php

function kojijehost($tipHosta){

    if ($tipHosta==1) {
        $hostTip = '/data/masinealati';
    } else {
        $hostTip = '/var/www/masine';
    }
    return $hostTip;
}
$mcProd = getenv('MASINEENV');

$lokacija = $mcProd.'/dbbckup';
$backupFile = 'dbbackup-' . date("d-m-Y-H-i-s") . '.gz';

$command = "mysqldump -h localhost -u agrouserbaza -pagrouserbaza011 --routines agro |gzip > ".$lokacija."/".$backupFile;
system($command);

// -r treba proveriti za sta sluzi

?>