<?php
define('EXTPRED', 'png');

include ($documentroot."/vezafullCron.php");
require_once ($documentroot.'/thumblib/ThumbLib.inc.php');
include($documentrootAdmin . '/xml/centralniXml/update_funkcije.php');
include($documentroot.'/stranice/parse/simple_html_dom.php');


$kategorijeDodatna = new kategorijeDodatna($db);

$jezLan = $db->get('languagejezik', null, "IdLanguage,ShortLanguage");

//$date = date("Y-m-d H:i:s", strtotime("+7 hours")); //oblik za mysql datetime
//$ip = getenv('REMOTE_ADDR');

?>









