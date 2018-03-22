<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 10.11.16.
 * Time: 11.55
 */

$queryspec = '/NewDataSet/Table[ProductCode="' . $ProductCode . '"]';
$entriesspec = $docspecxpath->query($queryspec);

$codeokr = '0';
if ($entriesspec) {


    foreach ($entriesspec as $row) {


        $SpecificationItemName = $row->getElementsByTagName("SpecificationItemName");
        $SpecificationItemName = $SpecificationItemName->item(0)->nodeValue;

        $SpecificationItemValues = $row->getElementsByTagName("SpecificationItemValues");
        $SpecificationItemValues = $SpecificationItemValues->item(0)->nodeValue;


        if (!$codeokr) {

            $m = '<table width="100%" border="1">';
            $m .= '<tr>';
                    $f = '<td>' . $SpecificationItemName . '</td>';
                    $f .= '<td>' . $SpecificationItemValues . '</td>';
            $r = '</tr>';
            $r .= '</table>';

        } else {
            $w .= '<tr>';
            $w .= '<td>' . $SpecificationItemName . '</td>';
            $w .= '<td>' . $SpecificationItemValues . '</td>';
            $w .= '</tr>';

        }

        $codeokr++;
    }
} else {
    $pokazi .= '<li>Nema podataka Tabela KImtek</li>';
}


$jedspec = $m . $f . $w . $r;
unset($m);
unset($f);
unset($r);
unset($w);
unset($codeokr);





?>