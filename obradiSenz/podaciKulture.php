<?php
//$postdata = file_get_contents("php://input");
// ostavio sam POST a skinuo GET
$postdata = $_GET;


$a = array();

$cols = Array ("*");
$users = $db->get ("kulture", null, $cols);
if ($db->count > 0) {
    foreach ($users as $user) {

        $IdKulture = $user['IdKulture'];
        $ImeKulture = $user['ImeKulture'];
        $scientific = $user['scientific'];
        $opisKultura = base64_encode($user['opisKultura']);
        $kulturaVoda = (int) $user['kulturaVoda'];
        $kulturaSun = (int) $user['kulturaSun'];
        $kulturaTemp = (int) $user['kulturaTemp'];
        $kulturaMoisture = (int) $user['kulturaMoisture'];

        $SlikaKulture = $user['SlikaKulture'];
        $ext = pathinfo($SlikaKulture, PATHINFO_EXTENSION);
        $fileName = pathinfo($SlikaKulture, PATHINFO_FILENAME);
        $lokrel = $common->locationslikaOstalo('assets/images/kulture',$IdKulture);

        // 80 x 80
        $lok = DCROOT . $lokrel . '/' . $SlikaKulture;
        if (file_exists($lok)) {
            $lok = DPROOT.$lokrel.'/'.$SlikaKulture;
        } else {
            $lok = '';
        }


        // _mala
        $mala_slika = $fileName . '_mala.' . $ext;
        $lok_mala = DCROOT . $lokrel . '/' . $mala_slika;
        if (file_exists($lok_mala)) {
            $lok_mala = DPROOT.$lokrel.'/'.$mala_slika;
        } else {
            $lok_mala = '';
        }

        // _srednja
        $srednja_slika = $fileName . '_srednja.' . $ext;
        $lok_srednja = DCROOT . $lokrel . '/' . $srednja_slika;
        if (file_exists($lok_srednja)) {
            $lok_srednja = DPROOT.$lokrel.'/'.$srednja_slika;
        } else {
            $lok_srednja = '';
        }



        $o['IdKulture'] = $IdKulture;
        $o['ImeKulture'] = $ImeKulture;
        $o['SlikaKulture'] = $lok;
        $o['SlikaKulture_mala'] = $lok_mala;
        $o['SlikaKulture_srednja'] = $lok_srednja;
        $o['scientific'] = $scientific;
        $o['opisKultura'] = $opisKultura;
        $o['kulturaVoda'] = $kulturaVoda;
        $o['kulturaSun'] = $kulturaSun;
        $o['kulturaTemp'] = $kulturaTemp;
        $o['kulturaMoisture'] = $kulturaMoisture;

        array_push($a,$o);
    }
}
$m['kulture'] = $a;


echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>
