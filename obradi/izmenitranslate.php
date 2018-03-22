<?php
/**
 * Created by PhpStorm.
 * User: ITCluster Serbia
 * Date: 27.4.2016.
 * Time: 14:06
 */

if(isset($_POST['id'])) {  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING); } else { $id = ''; }
if(isset($_POST['br'])) {  $br = filter_input(INPUT_POST, 'br', FILTER_SANITIZE_STRING); } else { $br = ''; }


if (isset($id, $br)) {
    $update_query = Array(
        'srblat' => $br

    );
        $db->where('IdTranslate', $id);
        $db->update('translate', $update_query);


    header("Location: " . URLVRATI . "");

}
else { header("Location: /izvestaj?err=Niste uneli sve podatke."); }


