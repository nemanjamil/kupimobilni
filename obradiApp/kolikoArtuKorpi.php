<?php

$upitBrArtKorpa = "CALL KolikoUkorpi($userId);";
$upitBrArtKorpaUpit = $db->rawQuery($upitBrArtKorpa);


if ($upitBrArtKorpaUpit) {
    $KorpaKolTempArt = $upitBrArtKorpaUpit[0]['brojArtuKorpi'];
    $m['ukupnaKolicina'] = (int) ($KorpaKolTempArt);
} else {
    $m['ukupnaKolicina'] = (int) 0;
}

?>

