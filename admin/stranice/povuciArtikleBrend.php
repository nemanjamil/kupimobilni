<!--=== Wells ===-->
<div class="widget">
    <div class="widget-header">
        <h4><i class="icon-sitemap"></i> XML Kategorije</h4>
    </div>
    <div class="widget-content">
        <div class="well">
            Kreiran XML za Kategorije

        </div>
    </div>


    <div>

        <?php

        require_once(DCROOT.'/thumblib/ThumbLib.inc.php');
        $kategorijeDodatna = new kategorijeDodatna($db);

        // DodatnaOprema Link
        $linkDodatnaSajt = 'http://dodatnaoprema.com';

        /*
         * Definisemo id brenda koji ubacujemo
         * Kod nas u bazi je Brend bosch = 29
         */
        $brendAgro = 29;

        /*
         * Definisemo brend od dodatne opreme
         * U bazi vebsop brend BOSCH je 456
         */
        $brendDodatna = 456;

        /*
         * vendor dodatne oprema BOSCH je 45
         */
        $vendorDodatna = 45;

        /*
         * Vendor kod Agro Komitenti je NEMANJA = 3
         */
        $vendorAgro = 3;

        // ovo je kategorija koju smo uzeli kao testnu
        $kategorijaDodatna = '1506';

        // ovo je ta ista kategorija u AGRO
        $cols = Array("KategorijaArtikalaId");
        $db->where("Kategorija_dodatna", $kategorijaDodatna);
        $users = $db->getOne("kategorijeartikala", null, $cols);
        if ($db->count <= 0) die;

        $kategorijaAgro = (int)$users['KategorijaArtikalaId'];

        if (!$kategorijaAgro) {
            echo 'Nema kategorije u koje ubacujemo artikle';
            die;
        }

        die;



       // Sada pravimo upit u vebsop po brendu i jednu kategoriju @646 $kategorijaAgro
        $cols = Array("*");
        $db->where("V.kategorija_id", $kategorijaDodatna);
        $db->where("V.vendor", $vendorDodatna);
        $users = $db->get("vebsop V", null, $cols);

        if (!$users) {
            error_log("Nema artikala u vebsop bazi - linija 64 PovuciArtikleBrend!", 0);
            die;
        }

        $i=1;
        if ($db->count > 0) {
            foreach ($users as $v) {

                $idArtDodatna = $v['id'];
                $kategorija_id = $v['kategorija_id'];
                $brend = $v['brend'];
                $model = $v['model'];
                $cena = $v['cena'];
                $cenaeuro = $v['cenaeuro'];
                $opis = $v['opis'];
                $kratopis = $v['kratopis'];
                $url_artikla = $v['url_artikla'];
                $vendor = $v['vendor'];
                $codebosch = $v['codebosch'];
                $codeboschlink = $v['codeboschlink'];
                $marzaid = $v['marzaid'];


                // Provera da li je UNIQUE Artikal Link
                // require('uniqueArtikalLink.php'); // nece da radi sa CONTINUE
                $cols = Array ("ArtikalId");
                $db->where ("ArtikalLink", $url_artikla);
                if($db->has("artikli", NULL, $cols)) {
                    /*echo $error = 'Ima duplikat ArtikalLink na ID od vebsop -> '.$idArtDodatna;
                    echo '<br/>';
                    error_log($error,0);*/
                    continue;
                }


                $db->startTransaction();

                /*
                 * SADA radimo INSERT datih podataka u nasu bazu
                 */
                $db->setTrace(true);
                $data = Array (
                    'ArtikalNaziv' => $model,
                    'ArtikalIdDodatna' => $idArtDodatna,
                    'KategorijaArtikalId' => $kategorijaAgro,  // ovo dobijamo od upita sa linije 52
                    'ArtikalBrendId' => $brendAgro, // bosch
                    'ArtikalLink' => $url_artikla,
                    'CodeBosch' => $codebosch,
                    'CodeBoschLink' => $codeboschlink,
                    'ArtikalMarzaId'=> $marzaid,
                    'ArtikalKomitent' => $vendorAgro, // to je komitent nemanja je VENDOR
                    'TipKatUnitArt' => 8,  // kom
                    'ArtikalMPCena' => $cena,
                    'ArtikalVPCena' => $cena

                );

                $idArt = $db->insert ('artikli', $data);
                if (!$idArt) echo 'insert failed -> ARTIKLI: ' . $db->getLastError();

                require('dodatna/ubaciArtNazivArtOpis.php');

                /*
                 * SADA UBACUJEMO SLIKE ARTIKLA
                 */
                if ($idNaziv) {
                require('dodatna/ubaciSlikeAriklaDodatna.php');
                }

                //var_dump($db->trace);

                if ($i==1) die;
                $i++;




            }
        } else {
            echo 'Nema artikala';
        }


        ?>

    </div>


</div>
<!-- /Wells -->