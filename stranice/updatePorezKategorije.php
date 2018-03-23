<?php

$array = Array('KategorijaArtikalaId', 'KategorijaArtiklaExtId', 'ParentKategorijaArtiklaExtId');
$kateg = $db->get('kategorijeartikala', null, $array);


if ($kateg) {

    foreach ($kateg as $k => $v) {
        $KategorijaArtikalaId = $v['KategorijaArtikalaId'];
        $KategorijaArtiklaExtId = $v['KategorijaArtiklaExtId'];
        $ParentKategorijaArtiklaExtId = $v['ParentKategorijaArtiklaExtId'];

        echo 'Selektovana kategorija - KategorijaArtikalaId: ' . $KategorijaArtikalaId;
        echo '</br>';

        $db->rawQuery("INSERT IGNORE INTO pdvkategzemlja (`IdKategPdvKatZem`, `IdZemljePdvKatZem`, `PdvKategZemlja`)
            VALUES ($KategorijaArtikalaId, 1, 4)");
        /*$data = Array (
            "IdKategPdvKatZem" => $KategorijaArtikalaId,
            "IdZemljePdvKatZem" => 1,
            "PdvKategZemlja" => 4);
       if(!$db->insert ('pdvkategzemlja', $data)){
           echo 'Error PDV';
           var_dump($db);
           die;
       }*/


    }
}
