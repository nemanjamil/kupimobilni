<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 6.10.2017.
 * Time: 15:02
 * Expl: Servis za update parent kategorija u bazi
 */


/*Prvo pozivamo sve kategorije iz baze*/


//$kateg = $db->get('kategorijeartikala', null, 'KategorijaArtikalaId', 'KategorijaArtiklaExtId', 'ParentKategorijaArtiklaExtId');
$array = Array('KategorijaArtikalaId', 'KategorijaArtiklaExtId', 'ParentKategorijaArtiklaExtId');
$kateg = $db->get('kategorijeartikala', null, $array);

echo 'Select * from kategorijeartikala';
echo '</br>';
echo '</br>';


if ($kateg) {

    foreach ($kateg as $k => $v) {
        $KategorijaArtikalaId = $v['KategorijaArtikalaId'];
        $KategorijaArtiklaExtId = $v['KategorijaArtiklaExtId'];
        $ParentKategorijaArtiklaExtId = $v['ParentKategorijaArtiklaExtId'];

        echo 'Selektovana kategorija - KategorijaArtikalaId: ' . $KategorijaArtikalaId;
        echo '</br>';

        $db->startTransaction();

        /*Za svaki ParentKategorijaArtiklaExtId izvuci KategorijaArtikalaId*/


        $db->where('KategorijaArtiklaExtId', $ParentKategorijaArtiklaExtId);
        $upit2 = $db->getOne('kategorijeartikala', 'KategorijaArtikalaId');
        $KategorijaArtikalaIdUpit2 = $upit2['KategorijaArtikalaId'];

        echo'<hr>';
        echo '<b class="bojacrvena"> SELECT KA.KategorijaArtikalaId  FROM kategorijeartikala KA WHERE KA.KategorijaArtiklaExtId = ' . $ParentKategorijaArtiklaExtId.'</b>';
        echo '</br>';
        echo 'Selektovana kategorija 2 iz ParentExtId - KategorijaArtikalaId: ' . $KategorijaArtikalaIdUpit2;
        echo '</br>';

        /*Updateuj sve kojima je ParentKategorijaArtiklaExtId gore navedena*/

        $update_query = Array(
            'ParentKategorijaArtikalaId' => $KategorijaArtikalaIdUpit2
        );

        $db->where('ParentKategorijaArtiklaExtId', $ParentKategorijaArtiklaExtId);
        $db->update('kategorijeartikala', $update_query);

        echo 'UPDATE kategorijeartikala SET ParentKategorijaArtikalaId = '.$KategorijaArtikalaIdUpit2.' WHERE ParentKategorijaArtiklaExtId = '.$ParentKategorijaArtiklaExtId;
        echo '</br>';
        echo 'Updateovano';
        echo '</br>';

        $db->commit();



        echo '<b class="bojaplavasajt" >Updateovana kategorija - KategorijaArtikalaId: ' . $KategorijaArtikalaIdUpit2.'</b>';
        echo '</br>';
        echo '</br>';



    }

} else {
    echo 'Nema kateg';
}