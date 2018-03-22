<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 3.11.2017.
 * Time: 9:45
 */

$db->where('ImeZemlja', $drzava);
$UpitDrzava = $db->getOne('zemlja', null, 'IdZemlja');
$IdZemlja = $UpitDrzava['IdZemlja'];
if($IdZemlja){
    $drzavaId = $IdZemlja;
}else{
    $insert_query_zemlja = Array(
        'ImeZemlja' => $drzava
    );
    $drzavaId = $db->insert('zemlja', $insert_query_zemlja);
}
