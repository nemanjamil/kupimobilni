<?php


if ($brendArtUpit){
    $spC = 'AND A.ArtikalBrendId = '.$brendArtUpit;
}

switch ($sortKontrole) {
    case 1:
        $spC .= ' ORDER by A.ArtikalBrPregleda DESC';
        break;
    case 2:
        $spC .= ' ORDER BY A.ArtikalMpCena ASC';
        break;
    case 3:
        $spC .= ' ORDER BY A.ArtikalMpCena DESC';
        break;
    case 4:
        $spC .= ' ORDER BY A.ArtikalNaziv ASC';
        break;
    case 5:
        $spC .= ' ORDER by A.ArtikalId DESC';
        break;

    default:
        $spC .= ' ORDER by A.ArtikalBrPregleda DESC';
}

$spC .= " LIMIT $od,$do";

?>


