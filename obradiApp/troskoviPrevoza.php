<?php

$m['tag'] = 'troskoviPrevoza';
$m['success'] = true;
$m['error'] = 0;
$m['error_msg'] = "Nema Errora";


$upikPr = "SELECT GetKurs (1, '$valutasession') * " . TROSKOVIPREVOZA . " as cenaPrevoz";
$kPrevoz = $db->rawQueryOne($upikPr);
$cprev = $kPrevoz['cenaPrevoz'];

$f['troskoviPrevozaBroj'] = $common->formatCenaSamoBroj($cprev, $valutasession);
$f['troskoviPrevozaExt'] = $common->formatCenaExt($cprev, $valutasession);

$m['kurs'] = $f;

echo json_encode($m, JSON_UNESCAPED_UNICODE);

?>

