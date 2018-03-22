<?php

if (isset($id) && isset($string)) {



    $katAkt = ($_POST['KategorijaArtikalaActive']=='on') ? '1' : '0';
    $katAktYouMayAlso = ($_POST['KategYouMayAlso']=='on') ? '1' : '0';
    $katRabAkt = ($_POST['KategorijeRabartAktivan']=='on') ? '1' : '0';
    $katVidAkt = ($_POST['KategorijeVidljivZaMP']=='on') ? '1' : '0';
    $KategorijaArtikalaLink = $common->friendly_convert($_POST['KategorijaArtikalaLink']);

    $data = Array (

        'KategorijaArtikalaLink' => trim($KategorijaArtikalaLink),

        'KategorijaArtikalaActive' => $katAkt,
        'KategYouMayAlso' => $katAktYouMayAlso,
        'KategorijaArtikalaMesto' => $_POST['KategorijaArtikalaMesto'],
        'MinimalnaKol' => $_POST['MinimalnaKol'],
        'TipKatUnit' => $_POST['TipKatUnit'],

        'KategorijaArtikalaKratak' => trim($_POST['KategorijaArtikalaKratak']),
        'KategorijeRabat' => $_POST['KategorijeRabat'],
        'KategorijeRabartAktivan' => $katRabAkt,
        'KategorijeVidljivZaMP' => $katVidAkt


    );

   // $data = array_merge($data,$dodajNaslov);




    $db->where ('KategorijaArtikalaId', $id);


        try {

//$db->setTrace (true);
            $db->startTransaction();

            if ($db->update ('kategorijeartikala', $data)) {
                $error_msg = 'Update : '.$db->count.' red';


                // I
                // Ubacujemo NAZIVE U NOVU BAZU
                // prvo ih brisemo sve
                require_once('forEachKategNazivNew.php');
                require_once('ubaciNaziveKategNewEditArt.php');


                // II
                // Ubacujemo TEKSTOVE U NOVU BAZU
                // prvo ih brisemo sve
                require_once('forEachKategTekstNew.php');
                require_once('ubaciTekstKategNewEditArt.php');


                // ubacivanje poreza
                // prvo brisemo sve poreze za tu kateg
                $db->where('IdKategPdvKatZem', $id);
                $db->delete('pdvkategzemlja');


                foreach($_POST['porez'] AS $key => $val) {
                    $data = Array (
                        "IdKategPdvKatZem" => $id,
                        "IdZemljePdvKatZem" => $key,
                        "PdvKategZemlja" => $val);
                    $idPdvPod = $db->insert ('pdvkategzemlja', $data);
                }


                // ako je sve u redu onda ubacujemo sliku
                $slika = $_FILES;
                $imeslike = $KategorijaArtikalaLink;
                $idba = $id;
                $table = 'kategorijeartikala';
                $kolona = 'KategorijaArtikalaSlika';
                $location = KATSLIKELOK;
                $nazivInputPolja = 'slikeMultiple';
                $idkolone = 'KategorijaArtikalaId';
                $w = '400';
                $h = '400';
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


 header("Location: ".URLVRATI."");


?>