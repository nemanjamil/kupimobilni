<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 18:08
 */

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
    $Opi = $common->clearvariable($_POST[$Opi]);

    $an[$AreArr] = trim($Are);
    $op[$OpisArr] = trim($Opi);

endforeach;


$UrlVesti = $common->friendly_convert($_POST['VestiNaslovsrblat']);
$MestoVesti = $common->clearvariable($_POST['MestoVesti']);
$IdKategVesti = $common->clearvariable($_POST['IdKategVesti']);


if (isset($UrlVesti)) {

    $data = Array(
        'UrlVesti' => $UrlVesti,
        'MestoVesti' => $MestoVesti,
        'IdKategVesti' => $IdKategVesti,
        'SajtVesti' => '1',
        'IdKomitentVesti' => $br
    );

    $db->startTransaction();

    $idubacenog = $db->insert('vesti', $data);

    if ($idubacenog) {

        $error_msg = 'Insert : ' . $db->count . ' red';

        //  Ubacujemo Naslove
        $dataId['IdVestiNaslov'] = $idubacenog;
        $an = array_merge($an, $dataId);
        $idNaslovTekst = $db->insert('vestinaslov', $an);


        //  Ubacujemo Tekstove
        $dataIdTekst['IdVestiOpis'] = $idubacenog;
        $op = array_merge($op, $dataIdTekst);
        $idTekstOpis = $db->insert('vestiopis', $op);


        // ako je sve u redu onda ubacujemo sliku
        $slika = $_FILES;
        $imeslike = $UrlVesti;
        $idba = $idubacenog;
        $table = 'vesti';
        $kolona = 'SlikaVesti';
        $location = '/assets/images/vesti';
        $nazivInputPolja = 'slikeMultipleVest';
        $idkolone = 'IdVesti';
        $w = '870';
        $h = '363';
        $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
        $orgSlika = '0'; // da li zelimo da snimimo i originalnu sliku

        $ubacisliku->ubacislikuVesti($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);

        // ako je sve  ok onda imamo sva tri id-a, i tek onda odradi commit
        if ($idubacenog && $idNaslovTekst && $idTekstOpis) {
            $db->commit();
        } else {
            $db->rollback();
        }
        header("Location:admin/vesti");

    } else {
        $error_msg["error"] = 'Greska pri dodavanju vesti';
    }

}

?>