<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 8.8.15.
 * Time: 08.24
 */
require 'proveriAjaxDeny.php';

if (isset($_POST['mesCh'])) {
    $mesCh = filter_input(INPUT_POST, 'mesCh', FILTER_SANITIZE_NUMBER_INT);
} else {
    $mesCh = '';
}
if (isset($_POST['mesPar'])) {
    $mesPar = filter_input(INPUT_POST, 'mesPar', FILTER_SANITIZE_NUMBER_INT);
} else {
    $mesPar = '';
}
if (isset($_POST['parentTid'])) {
    $parentTid = filter_input(INPUT_POST, 'parentTid', FILTER_SANITIZE_STRING);
} else {
    $parentTid = '';
}
if (isset($_POST['parentTidkoji'])) {
    $parentTidkoji = filter_input(INPUT_POST, 'parentTidkoji', FILTER_SANITIZE_STRING);
} else {
    $parentTidkoji = '';
}
if (isset($_POST['moveType'])) {
    $moveType = filter_input(INPUT_POST, 'moveType', FILTER_SANITIZE_STRING);
} else {
    $moveType = '';
}

if (isset($id) && isset($br)) {

    $db->setTrace(true);

    $mesCh1 = $mesCh - 1;
    $mesCh = ($mesCh1 >= 0) ? $mesCh1 : '0';

    // onda radi mesto
    if ($moveType=='inner') {

        $data = Array(
            'ParentKategorijaArtikalaId' => $id,
            'KategorijaArtikalaMesto' => $mesCh
        );
        $db->where('KategorijaArtikalaId', $br);
        if ($db->update('kategorijeartikala', $data)) {
            $error_msg["ok"] = $db->count . ' records were updated';
        } else {
            $error_msg["error"] = 'Nije uradje update';
        }

    } else {
        // ako nije null - root kategorija
        if ($parentTid) {
/*
            $data = Array('KategorijaArtikalaMesto' => $id);
            $db->where('KategorijaArtikalaId', $br);
            $db->update('kategorijeartikala', $data);*/

        } else {
            $rqu = "UPDATE kategorijeartikala SET ParentKategorijaArtikalaId = NULL WHERE KategorijaArtikalaId = '$br'";
            $db->rawQuery($rqu);
        }
    }

    // uzimamo id Od onoga gde se stavlja
    $cols = Array("KategorijaArtikalaMesto");
    $db->where('KategorijaArtikalaId', $id);
    $gdeJebioArr = $db->getOne("kategorijeartikala", null, $cols);
    $gdeJebio = $gdeJebioArr['KategorijaArtikalaMesto'];


    //  iznad kog Id-a se stavlje koji
    $data = Array('KategorijaArtikalaMesto' => $gdeJebio + 1);
    $db->where('KategorijaArtikalaId', $id);
    $db->update('kategorijeartikala', $data);


    $data = Array('KategorijaArtikalaMesto' => $gdeJebio - 1);
    $db->where('KategorijaArtikalaId', $br);
    $db->update('kategorijeartikala', $data);

    print_r($db->trace);

} else {
    $error_msg["error"] = 'Nema Id';
}

echo $m = json_encode($error_msg);

?>