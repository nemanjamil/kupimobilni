<?php
session_start(); // mora session
set_time_limit(0); // setovano da ne prekida skriptu
function kojijehost($tipHosta){

	if ($tipHosta==1) {
		$hostTip = '/data/masinealati';
	} else {
		$hostTip = '/var/www/masine';
	}
	return $hostTip;
}
$mcProd = getenv('MASINEENV');
$documentroot = kojijehost($mcProd);
$documentrootAdmin = $documentroot.'/admin';
define('ROOTLOC', $documentroot);

require($documentrootAdmin.'/xml/centralniXml/setovanjeXml.php');

require $documentroot."/stranice/elasticTest/logTxtElastic.php";
$log->lwrite('OK VERMAX MAKITA OSTALO XML -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);



/*$data = Array ('BrojDokle' => 0);
$db->where ('IdCronXml', 10);
if ($db->update ('cronzaxml', $data)) {
	//echo $db->count . ' records were updated';
} else {
	echo 'update failed: ' . $db->getLastError();
	die;
}*/

//wingswsusername : ee4534a2c20e24e2ae2745790200e73d 
//wingswspassword : c0eb19c590e17aea3f38eca3f244ffbf


function callService($command) {
	// Kredencijali za pristup
	$wingsWSusername = 'ee4534a2c20e24e2ae2745790200e73d';
	$wingsWSpassword = 'c0eb19c590e17aea3f38eca3f244ffbf';
	$aqlUsername = 'mobilni';
	$aqlPassword = 'centar';
	
	$xmlAuthorize =	"<header>" .
		"<wingsWSusername>{$wingsWSusername}</wingsWSusername>" .
		"<wingsWSpassword>{$wingsWSpassword}</wingsWSpassword>" .
		"<aqlUsername>{$aqlUsername}</aqlUsername>" .
		"<aqlPassword>{$aqlPassword}</aqlPassword>" .
		"</header>";

	try {
		$soap = new SoapClient("http://ws.wings.rs/service.php?WSDL");
		$soap->__setCookie("wingsws", session_id());

		$soap->__soapCall("processRequest", array($xmlAuthorize));
		$wsAnswer = $soap->__soapCall("processRequest", array($command));

		return $wsAnswer;
		
	} catch (Exception $ex) {
	}
}
//http://ws.wings.rs/api/#lager_lista_sa_prikazom_kolicina_u_bojama
// MAKPR,MAKTE,MAKMAŠINE,MAKDE
// MAKPR(2680),MAKTE(43),MAKMAŠINE(698),MAKDE(5534)
// BAHCO,APARAT,REMS,RIDGID,RUKO
$xmlRequest = "<command name='local.cache.artikal_2' output='xml'>" .
                "<dStart>0</dStart>" .
                "<dLength>5000</dLength>" .
				"<dVrste>BAHCO,APARAT,REMS,RIDGID,RUKO</dVrste>" .
  				"<dAtrRet>true</dAtrRet>" .
                "</command>";

$result = callService($xmlRequest);
 
$dom = new DOMDocument();
$dom->loadXML($result);

// kada necemo da odstampamo nego samo da snimimo
/*header("content-type: text/xml; charset=utf-8");
$strxml = $dom->saveXML();
*/



$dom->encoding = 'UTF-8';
$dom->save($documentroot.'/admin/xml/vermax/xmlovi/vermax_ostali.xml');

$log->lwrite('CALLWINGS VERMAX MAKITA OSTALO KRAJ');
?>