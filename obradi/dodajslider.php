<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 14. 08. 2015.
 * Time: 14:52
 */

//var_dump($_POST);

$banernaziv = $common->clearvariable($_POST['banernaziv']);
$banerlink = $common->friendly_convert($banernaziv);
$banerurl = $common->clearvariable($_POST['banerlink']);
$baneropis = $common->clearvariable($_POST['baneropis']);
$baneraktivan = $common->clearvariable($_POST['baneraktivan']);
$banerlokacija = $common->clearvariable($_POST['banerlokacija']);
$br = $common->clearvariable($_POST['br']);
//$ ? banerslika ? = $common->clearvariable($_POST[banerslika]);


if (isset($banernaziv)) {
    $data = Array(
        'BanerNaziv' => $banernaziv,
        'BanerLink' => $banerlink,
        'BanerOpis' => $baneropis,
        'BanerAktivan' => $baneraktivan,
        'BanerLokacija' => $banerlokacija,
        'BanerUrl' => $banerurl,
        'BanerSajt' => '1'

    );
//$db->setTrace (true);

    $db->startTransaction();

    $idubacenog = $db->insert('baneri', $data);
    if ($idubacenog) {

        $error_msg = 'Insert : ' . $db->count . ' red';

        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $banerlink;
        $idba = $idubacenog;
        $table = 'baneri';
        $kolona = 'BanerSlika';
        $location = '/assets/images/banners';
        $nazivInputPolja = 'slikeMultiple';
        $idkolone = 'BanerId';
        $w = '270';
        $h = '337';
        $preview = '0'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
        $orgSlika = '0'; // da li zelimo da snimimo i originalnu sliku

        $ubacisliku->ubacislikuBanerNew($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


        $db->commit();
//var_dump($db->trace);

        header("Location:admin/glavni-slajder");

    } else {
        $error_msg["error"] = 'Greska pri izmeni taga';
    }

}


/*
$db->insert('baneri', $data);
$db->commit();
$error_msg["ok"] = 'Dodat novi baner';
} else {
$error_msg["error"] = 'Nema naziva';
}


echo $m = json_encode($error_msg);

header("Location:$url");*/
?>