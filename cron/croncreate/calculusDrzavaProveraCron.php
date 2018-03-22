<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 8.1.2018.
 * Time: 14:40
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
