<?php

//$db->setTrace(true);

if (isset($id)) {

    $katAkt = ($_POST['KategorijaArtikalaActive']=='on') ? '1' : '0';

    $KategorijaArtikalaLink = $common->friendly_convert($_POST['KategorijaArtikalaLink']);


    $data = Array (
        'KategorijaArtikalaLinkZdravlje' => trim($KategorijaArtikalaLink),
        'KategorijaArtikalaActiveZdravlje' => $katAkt,
        'KategorijaArtikalaMestoZdravlje' => $_POST['KategorijaArtikalaMesto'],
        'KategorijaArtikalaKratakZdravlje' => trim($_POST['KategorijaArtikalaKratak'])
    );

    //$data = array_merge($data,$dodajNaslov);



    $db->where ('KategorijaArtikalaIdZdravlje', $id);


        try {

            if ($db->update ('kategorijezdravlje', $data)) {
                $error_msg = 'Update : '.$db->count.' red';


                $idubacenog = $id;

                require_once('foreachNaziv.php');


                $idnaziv = 'IdKategZdravlje';
                $tabelaNaziv = 'kategorijezdravljenew';
                $kolonaIdLanguage = 'IdLanguage';
                $kolonaNaziv = 'NazivKategZdravlje';

                require_once('ubaciNaziv.php');


                require_once('foreachVelikiOpis.php');


                $idVelikiOpis = 'IdKategZdravlje';
                $tabelaVelikiOpis = 'kategorijezdravljetekst';
                $kolonaIdLanguage = 'IdLanguage';
                $kolonaVelikiOpis = 'TekstKategZdr';

                require_once('ubaciVelikiOpis.php');


                // ako je sve u redu onda ubacujemo sliku
                $slika = $_FILES;
                $imeslike = $KategorijaArtikalaLink;
                $idba = $id;
                $table = 'kategorijezdravlje';
                $kolona = 'KategorijaArtikalaSlikaZdravlje';
                $location = KATSLIKELZDRAVLJE;
                $nazivInputPolja = 'slikeMultiple';
                $idkolone = 'KategorijaArtikalaIdZdravlje';
                $w = '370';
                $h = '170';
                $preview = '1'; //ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
                $orgSlika = ''; // da li zelimo da snimimo i originalnu sliku

                // ovo cu kasnije napraviti
                $ubacisliku->ubacislikuKB($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone, $w, $h, $preview, $orgSlika);



            } else {
                $error_msg = 'Nesto ne valja : '.$db->getLastError();
            }

            $db->commit();
            //var_dump($db->trace);

        } catch (Exception $e) {
            $db->rollback();
            $error_msg = 'Uradjen roolBack : '.$db-> $e->getMessage();
        }


} else {
    $error_msg = 'Nema Id';
}
//var_dump($db->trace);
//die;

header("Location: ".URLVRATI."");


?>