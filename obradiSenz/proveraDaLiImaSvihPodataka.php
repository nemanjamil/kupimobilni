<?php

if (!$temperature) {
    $o['tag'] = 'idSenzorVazduha';
    $o['success'] = false;
    $o['error'] = 3;
    $o['error_msg'] =  "Ne postoji Temeperatura";
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$temperature;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    $log->lwrite($opisSenzora.' => Ne postoji Podataka  Temeperatura '.$temperature);
    die;
}

if (!$temperature) {
    $o['tag'] = 'idSenzorVazduha';
    $o['success'] = false;
    $o['error'] = 4;
    $o['error_msg'] =  "Ne postoji humidity";
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$humidity;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    $log->lwrite($opisSenzora.' => Ne postoji Podataka  humidity '.$humidity);
    die;
}

if (!$temperature) {
    $o['tag'] = 'idSenzorVazduha';
    $o['success'] = false;
    $o['error'] = 5;
    $o['error_msg'] =  "Ne postoji luminosity";
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$luminosity;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    $log->lwrite($opisSenzora.' => Ne postoji Podataka  luminosity '.$luminosity);
    die;
}

if (!$temperature) {
    $o['tag'] = 'idSenzorVazduha';
    $o['success'] = false;
    $o['error'] = 6;
    $o['error_msg'] =  "Ne postoji moisture";
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$moisture;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    $log->lwrite($opisSenzora.' => Ne postoji Podataka  moisture '.$moisture);
    die;
}
if (!$temperature) {
    $o['tag'] = 'idSenzorVazduha';
    $o['success'] = false;
    $o['error'] = 7;
    $o['error_msg'] =  "Ne postoji idSifra";
    $o['error_podaci'] =  "Id -> ".$idSifra." ; Vrednost ".$idSifra;
    $o['error_msg_opis'] =  $db->getLastError();
    echo json_encode($o,JSON_UNESCAPED_UNICODE);
    $log->lwrite($opisSenzora.' => Ne postoji Podataka  idSifra '.$idSifra);
    die;
}