<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 30. 08. 2015.
 * Time: 23:22
 */
/*var_dump($_POST);
die;*/

foreach ($jezLan as $k => $v):
    $ShortLanguage = $v['ShortLanguage'];
    $Are = 'VestiNaslov' . $ShortLanguage;
    $Opi = 'VestiOpis' . $ShortLanguage;

    $AreArr = 'VestiNaslov' . $ShortLanguage;
    $OpisArr = 'VestiOpis' . $ShortLanguage;

    if (isset($_POST[$Are])) {
        $Are = filter_input(INPUT_POST, $Are, FILTER_SANITIZE_STRING);
    } else {
        $Are = '';
    }
    $Opi = $common->clearvariableTekst($_POST[$Opi]);



    $an[$AreArr] = trim($Are);
    $op[$OpisArr] = trim($Opi);

endforeach;


$UrlVesti = $common->friendly_convert($_POST['VestiNaslovsrblat']);
if (isset($_POST['MestoVesti'])) {
    $MestoVesti = filter_input(INPUT_POST, 'MestoVesti', FILTER_SANITIZE_NUMBER_INT);
} else {
    $MestoVesti = '';
}
$IdKategVesti = $common->clearvariable($_POST['IdKategVesti']);

$updatevesti = Array(
    'UrlVesti' => $UrlVesti,
    'MestoVesti' => $MestoVesti,
    'IdKategVesti' => $IdKategVesti,
    'IdKomitentVesti' => $br

);



if ($id) {


    $db->startTransaction();

    $db->where("IdVesti", $id);
    $db->update('vesti', $updatevesti);
    $error_msg = 'Insert : ' . $db->count . ' red';


    //  Update Naslove
    $db->where('IdVestiNaslov', $id);
    $db->update('vestinaslov', $an);


    //  Update Tekstove
    $db->where('IdVestiOpis', $id);
    $db->update('vestiopis', $op);




    // ako je sve u redu onda ubacujemo sliku
    $slika = $_FILES;
    $imeslike = $UrlVesti;
    $idba = $id;
    $table = 'vesti';
    $kolona = 'SlikaVesti';
    $location = 'assets/images/vesti';
    $nazivInputPolja = 'slikeMultipleVest';
    $idkolone = 'IdVesti';
    $w = '870';
    $h = '363';
    $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
    $orgSlika = '0'; // da li zelimo da snimimo i originalnu sliku


    $ubacisliku->ubacislikuVesti($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);


    $db->commit();
//var_dump($db);
    //die;
    header("Location:admin/vesti");

} else {
    $error_msg["error"] = 'Greska pri izmeni vesti';
}
echo $m = json_encode($error_msg);
?>