<?php
if ($brArray) {
$ulBrend = '<ul>';
foreach ($brArray as $valueKat) {

    $upitBrendKoliko = "SELECT COUNT(*) AS kolikoKomada,b.brand_name FROM vebsop vs
                    JOIN brand b ON b.id = vs.brend
                    WHERE vs.vendor = $vendorDodatna AND vs.brend = $valueKat";
    $dataKoliko = $db->rawQuery($upitBrendKoliko);


    $ulBrend .= '<li>' . $dataKoliko[0]['brand_name'] . ' =>  ' . $dataKoliko[0]['kolikoKomada'] . '</li>';


}
echo $ulBrend .= '</ul>';
}
?>