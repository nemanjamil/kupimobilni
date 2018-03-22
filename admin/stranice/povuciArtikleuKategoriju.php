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


        $kategorijeDodatna = new kategorijeDodatna($db);

        /*
         * uzimamo id od Dodatne opreme iz nase baze
         */

        $cols = Array("Kategorija_dodatna");
        $db->where("KategorijaArtikalaId", $id);
        $users = $db->getOne("kategorijeartikala", null, $cols);
        if ($db->count <= 0) die;

        $idDod = (int)$users['Kategorija_dodatna'];

        if (!$idDod) die;

        echo $idDod;
        /*
         * Na osnovu datog ID-a povlacimo iz baze vebsop podatke
         */
        // 646
        $limit = Array(0,2);
        $cols = Array ("*");
        $db->where ("V.kategorija_id", $idDod);
        $users = $db->get ("vebsop V", $limit, $cols);


        if ($db->count > 0)
            foreach ($users as $v) {

                $idArt = $v['id'];
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

                /*
                 * SADA radimo INSERT datih podataka u nasu bazu
                 */
                $db->setTrace(true);
                $data = Array (
                    'ArtikalNaziv' => $model,
                    'ArtikalIdDodatna' => $idArt,
                    'KategorijaArtikalId' => $id,
                    'ArtikalBrendId' => 29, // bosch
                    'ArtikalLink' => $url_artikla,
                    'CodeBosch' => $codebosch,
                    'CodeBoschLink' => $codeboschlink,
                    'ArtikalMarzaId'=> $marzaid,
                    'ArtikalKomitent' => 3 // to je komitent nemanja je VENDOR
                );

                $id = $db->insert ('artikli', $data);
                if ($id)
                    echo 'user was created. Id=' . $id;
                else
                    echo 'insert failed: ' . $db->getLastError();

                var_dump($db->trace);
                die;


            }


        ?>

    </div>


</div>
<!-- /Wells -->