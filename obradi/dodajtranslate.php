<?php
/**
 * Created by PhpStorm.
 * User: ITCluster Serbia
 * Date: 27.4.2016.
 * Time: 14:05
 */

if (empty($_POST)) {
    echo 'Nisu pronadjeni POST parametri!';
    die;
}


$NazivTranslate = $common->clearvariable($_POST[naziv]);


if ($NazivTranslate) {
    $data = Array(
        'srblat' => $NazivTranslate,
        'ParentTranslate' => '190',
        'TypeLanguage' => '1'

    );

 $lastId =  $db->insert('translate', $data);

} else {
    $error_msg["error"] = 'Greska pri dodavanju notifikacije';
}


header ( "Location:".'admin/str/dodajvrednosttranslate/'. $lastId ."");

?>