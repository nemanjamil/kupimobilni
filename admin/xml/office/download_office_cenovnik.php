<?php
set_time_limit(0); 
$documentroot = '/home3/dodopr/public_html';
include ($documentroot."/vezafull.php");




$likacijadoslikedir = $documentroot."/xml/office";
$fp = fopen($likacijadoslikedir.'/mobilni_svet.xml', "w");
$linkdoxml = 'http://www.officecom.rs/Distribucija/xml/mobilni_svet.aspx';


		$ch =curl_init();
		curl_setopt($ch,CURLOPT_URL,$linkdoxml);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		
		curl_setopt($ch, CURLOPT_FILE, $fp);
		$return = curl_exec ($ch);
		//echo $return;
		echo curl_error($ch);
		curl_close ($ch);
		


/* 
$documentroot = '/home/dodopr/public_html';
$xml = file_get_contents("https://services.it4profit.com/product/sr/710/PriceAvail.xml?USERNAME=nommaster&PASSWORD=Nommaster1"); 
file_put_contents($documentroot.'/xml/asbis/PriceAvail.xml', $xml); // now your xml file is saved.
 */
$db->query("UPDATE cronzaxml SET BrojDokle='0' WHERE IdCronXml = '8'");  // bilo je BrojDokleCena

?>