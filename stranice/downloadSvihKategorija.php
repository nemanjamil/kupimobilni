<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 12.10.2017.
 * Time: 12:50
 */

/*$calculus = new calculusServisi($db);

$urlServisa = URLCALCSERVICE . 'StrGrupaArtUsl';
$postParametri = [
    'IDGrupe' => ''
];

$curlInitStanje = $calculus->posaljiPodatkeCalc($urlServisa, $postParametri);*/


if ($curlInitStanje) {
    $dom = new DOMDocument();
    $dom->loadXML(DCROOT.'ABS PUTANJA xml/imefajla');
    $tables = $dom->getElementsByTagName('Table');

    if (!empty($tables)) {

        $brojLenght = $tables->length;
        if ($brojLenght > 0) {

            foreach ($tables as $row) {

                $IDGrupe = $row->getElementsByTagName("IDGrupe");
                $IDGrupe = $IDGrupe->item(0)->nodeValue;

                $IDNadgrupe = $row->getElementsByTagName("IDNadgrupe");
                $IDNadgrupe = $IDNadgrupe->item(0)->nodeValue;

                $Nivo = $row->getElementsByTagName("Nivo");
                $Nivo = (int)$Nivo->item(0)->nodeValue;

                if ($IDGrupe == $IDNadgrupe) {

                    echo '</br>';
                    echo '<i class="bojaljubsajta">Preskacem: IdGrupe: ' . $IDGrupe . ' =  IdNadGrupe: ' . $IDNadgrupe . '</i>';
                    echo '</br>';
                    echo '</br>';

                } else {

                    echo '</br>';
                    echo '<div>ID IZ BAZE '.$IDGrupe.'</div>';
                    echo '</br>';
                    echo '<div>ID IZ BAZE NADGRUPA '.$IDNadgrupe.'</div>';
                    echo '</br>';

                    $db->where('KategorijaArtiklaExtId', $IDGrupe);
                    $upit = $db->getOne('kategorijeartikala', null, 'KategorijaArtiklaExtId');
                    $KategorijaArtiklaExtIdUpit = $upit['KategorijaArtiklaExtId'];


                    if ($KategorijaArtiklaExtIdUpit) {

                        $update_query = Array(
                            'KategorijaArtiklaExtId' => $IDGrupe,
                            'ParentKategorijaArtiklaExtId' => $IDNadgrupe
                        );
                        $db->where('KategorijaArtiklaExtId', $KategorijaArtiklaExtIdUpit);

                        if ($db->update ('kategorijeartikala', $update_query)) {
                            echo $db->count . ' records were updated';
                            echo '</br>';
                        } else {
                            echo 'update failed: ' . $db->getLastError();
                            var_dump($db);
                        }


                        echo '<b class="bojacrvena">IdGrupe: ' . $IDGrupe . '</b>';
                        echo '</br>';
                        echo '<b class="bojacrvena">Kategora NAD GRUPE: ' . $IDNadgrupe . '</b>';
                        echo '</br>';

                    } else {

                        $insert_query = Array(
                            'KategorijaArtiklaExtId' => $IDGrupe,
                            'ParentKategorijaArtiklaExtId' => $IDNadgrupe,
                            'KategorijaArtikalaLink' => rand(0, 10000000)
                        );
                        $idUbacenogart = $db->insert('kategorijeartikala', $insert_query);

                        echo '<b class="bojacrvena">IdGrupe: ' . $IDGrupe . '</b>';
                        echo '</br>';
                        echo '<b class="bojacrvena">IdGrupe NAD GRUPE: ' . $IDNadgrupe . '</b>';
                        echo '</br>';
                        echo '<b class="bojacrvena">IdKategorije ubacen: ' . $idUbacenogart . '</b>';
                        echo '</br>';


                    }


                }

                usleep(10000);


            }

        } else {
            echo '$brojLenght nije > 0';
            die;
        }

    } else {
        echo 'empty($tables)';
        die;
    }

} else {
    echo 'nema curlinitstanje';
    die;
}