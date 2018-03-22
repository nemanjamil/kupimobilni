<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19.10.15.
 * Time: 01:37
 */

$BrendSlika = $common->clearvariable($_POST[BrendSlika]);
$BrendImeSlike = $common->friendly_convert($BrendSlika);


if (isset($_POST['brendactive'])) {
    $BrendActive = filter_input(INPUT_POST, 'brendactive', FILTER_SANITIZE_NUMBER_INT);
} else {
    $BrendActive = '1';
}
if (isset($_POST['brendnaslovna'])) {
    $BrendShow = filter_input(INPUT_POST, 'brendnaslovna', FILTER_SANITIZE_NUMBER_INT);
} else {
    $BrendShow = '0';
}
if (isset($_POST['brendsajt'])) {
    $BrendSajt = filter_input(INPUT_POST, 'brendsajt', FILTER_SANITIZE_NUMBER_INT);
} else {
    $BrendSajt = '1';
}


foreach ($_POST['BrendIme'] as $val => $k) {
    $arti[$val] = filter_var($k, FILTER_SANITIZE_STRING);
}
foreach ($_POST['brendoviopis'] as $valN => $kN) {
    $artiN[$valN] = filter_var($kN, FILTER_SANITIZE_STRING);
}


if (isset($BrendSlika)) {
    $data = Array(
        'BrendSajt' => $BrendSajt,
        'BrendShow' => $BrendShow,
        'BrendLink' => $BrendImeSlike,
        'BrendActive' => $BrendActive
    );


    //$db->startTransaction();

    $idubacenog = $db->insert('brendovi', $data);


    $db->where('BrendId', $idubacenog);
    if($db->delete('brendoviime')) {
        $obr = true;
    } else {
        $obr = false;
    }
if($idubacenog){

    if ($arti) {
        foreach ($arti as $key => $val) {
            $insert_query = Array('BrendId' => $idubacenog, 'IdLanguage' => $key, 'BrendIme' => $val);
            $db->setQueryOption(Array('IGNORE'));
            $idInsert = $db->insert('brendoviime', $insert_query);

            if(!$idInsert){

                echo 'Nije Ubaceno ime u bazu';
                die;
            }
        }
    }
}else{
    echo 'Nema Id od ubacenog Brenda';
    die;

}


    $db->where('BrendId', $idubacenog);
    if($db->delete('brendoviopis')) {
        $obr = true;
    } else {
        $obr = false;
    }


    if ($artiN) {
        foreach ($artiN as $key => $val) {
            $insert_query = Array('BrendId' => $idubacenog, 'IdLanguage' => $key, 'BrendOpis' => $val);
            $db->setQueryOption(Array('IGNORE'));
            $idInsert = $db->insert('brendoviopis', $insert_query);
        }
    }


    if ($idubacenog) {

        $error_msg = 'Insert : ' . $db->count . ' red';

        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $BrendImeSlike;
        $idba = $idubacenog;
        $table = 'brendovi';
        $kolona = 'BrendSlika';
        $location = '/assets/images/brands';
        $nazivInputPolja = 'BrendSlika';
        $idkolone = 'BrendId';
        $w = '1920';
        $h = '940';
        $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
        $orgSlika = '0'; // da li zelimo da snimimo i originalnu sliku

        $ubacisliku->ubacislikuBrend($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


        //ovde ubacujemo detaljan opis (veliki) za artikal


      //  $db->commit();
        header("Location:admin/brendovifull");

    } else {
        $error_msg["error"] = 'Greska pri izmeni brenda';
        header("Location:admin/brendovifull");
    }

}
var_dump($error_msg);
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