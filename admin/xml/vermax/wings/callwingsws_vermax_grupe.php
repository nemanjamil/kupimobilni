<?php
session_start(); // mora session
set_time_limit(0);
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
$log->lwrite('OK VERMAX GRUPE -> tip HOST '.$documentroot.'; ROOTLOC : '.ROOTLOC);


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
// MAKPR,MAKTE,MAKMAŠINE,BAHCO
/*$xmlRequest = "<command name='local.cache.artikal_2' output='xml'>" .
                "<dStart>0</dStart>" .
                "<dLength>5000</dLength>" .
				"<dVrste>MAKPR,MAKTE,MAKMAŠINE</dVrste>" .
  				"<dAtrRet>true</dAtrRet>" .
                "</command>";*/
$xmlRequest = '<command name="lager.vrsta.svi" output="xml"/>';

 
$result = callService($xmlRequest);
 
$dom = new DOMDocument();
$dom->loadXML($result);

// kada necemo da odstampamo nego samo da snimimo
/*header("content-type: text/xml; charset=utf-8");
echo $strxml = $dom->saveXML();*/


$dom->encoding = 'UTF-8';
$dom->save($documentroot.'/admin/xml/vermax/xmlovi/vermax_grupe.xml');

$log->lwrite('CALLWINGS GRUPE KRAJ');
?>