<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 5.1.2018.
 * Time: 10:52
 */

$array = Array('KategorijaArtikalaId', 'KategorijaArtiklaExtId', 'ParentKategorijaArtiklaExtId');
$kateg = $db->get('kategorijeartikala', null, $array);

$log->lwrite('Select * from kategorijeartikala');

if ($kateg) {

    foreach ($kateg as $k => $v) {
        $KategorijaArtikalaId = $v['KategorijaArtikalaId'];
        $KategorijaArtiklaExtId = $v['KategorijaArtiklaExtId'];
        $ParentKategorijaArtiklaExtId = $v['ParentKategorijaArtiklaExtId'];

        $log->lwrite('Selektovana kategorija - KategorijaArtikalaId: ' . $KategorijaArtikalaId);


        $db->startTransaction();

        $db->where('KategorijaArtiklaExtId', $ParentKategorijaArtiklaExtId);
        $upit2 = $db->getOne('kategorijeartikala', 'KategorijaArtikalaId');
        $KategorijaArtikalaIdUpit2 = $upit2['KategorijaArtikalaId'];

        $log->lwrite('Selektovana kategorija 2 iz ParentExtId - KategorijaArtikalaId: ' . $KategorijaArtikalaIdUpit2);

        $update_query = Array(
            'ParentKategorijaArtikalaId' => $KategorijaArtikalaIdUpit2
        );

        $db->where('ParentKategorijaArtiklaExtId', $ParentKategorijaArtiklaExtId);
        $db->update('kategorijeartikala', $update_query);


        $log->lwrite('UPDATE kategorijeartikala SET ParentKategorijaArtikalaId = ' . $KategorijaArtikalaIdUpit2 . ' WHERE ParentKategorijaArtiklaExtId = ' . $ParentKategorijaArtiklaExtId);

        $db->commit();

        $log->lwrite('Updateovana kategorija - KategorijaArtikalaId: ' . $KategorijaArtikalaIdUpit2);

    }

} else {
    $log->lwrite('Nema kateg');

}