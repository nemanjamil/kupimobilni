<?php

if ($KomitentTipUsera<2) {
    $userUpit = "AND (SELECT   vidljivMp (A.KategorijaArtikalId)) = 1";
} else {
    $userUpit = '';
}

?>