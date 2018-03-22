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
        $parent_id = '785';
        $linkdo3g = "http://dodatnaoprema.com/koment.php?akcija=jsondodatnaviseartjson&br=$parent_id";

        $json = file_get_contents($linkdo3g);
        if (!$json) die;
        $obj = json_decode($json);


        if ($obj) {
            foreach ($obj as $mydata => $m) {
                $id = $m->{'id'};

                echo '<br />Ime kategorije : ';
                echo $kat_name = $m->{'kat_name'};
                $kat_link = $m->{'kat_link'};
                $kat_opis = $m->{'kat_opis'};
                $slikica = $m->{'slikica'};
                $activ = $m->{'activ'};
                $keywords = $m->{'keywords'};


                // sada proveram da li ima u AGRO u bazi taj id
                echo '<br />Upit da li ima kod nas u bazi : ';
                $db->where("Kategorija_dodatna", $id);
                $katGl = $db->getOne("kategorijeartikala");
                if ($katGl) {

                    echo '<br />Radi se UPDATE : <br />';

                    $KategorijaArtikalaId = $katGl['KategorijaArtikalaId'];


                    /*
                     * Prvo se radi update Kategorije
                     * */
                   // $db->setTrace(true);
                    $data = Array(
                        'KategorijaArtikalaLink' => $kat_link,
                        "KategorijaArtikalaSlika" => $slikica
                    );
                    $db->where('Kategorija_dodatna', $id);
                    if ($db->update('kategorijeartikala', $data)) {

                        echo $db->count . ' records were updated on kategorijeartikala '.$ShortLanguage;
                        echo '<br/>';

                    } else {
                        echo '<br/>';
                        echo 'update <strong style="color: red">failed</strong> on  kategorijeartikala: ' . $db->getLastError();
                        echo '<br/>';
                        // ako je zabo update
                        die;
                    }
                   // print_r($db->trace);


                    /*
                    Onda se radi update naziva
                    */
                    foreach ($jezLan AS $k => $v) {


                        $IdLanguage = $v['IdLanguage'];
                        $ShortLanguage = $v['ShortLanguage'];
                        $katNaziv = ($IdLanguage == 1) ? $kategorijeDodatna->vice_versa_cySR($kat_name, 'cy') : $kat_name;


                        $data = Array(
                            'IdKategorije' => $KategorijaArtikalaId,
                            "IdLanguage" => $IdLanguage,
                            'NazivKategorije' => $katNaziv
                        );


                        $db->where('IdKategorije', $KategorijaArtikalaId);
                        $db->where('IdLanguage', $IdLanguage);
                        if ($db->update('kategorijeartikalanaslov', $data)) {
                            echo $db->count . ' records were updated on  kategorijeartikalanaslov : '.$ShortLanguage;
                            echo '<br/>';

                        } else {
                            echo '<br/>';
                            echo 'update <strong style="color: red">failed</strong> : kategorijeartikalanaslov ' . $db->getLastError();
                            echo '<br/>';
                            // ako je zabo update
                            die;
                        }


                    }


                    /*
                    Onda se radi update Opis
                    */
                    foreach ($jezLan AS $k => $v) {


                        $IdLanguage = $v['IdLanguage'];
                        $ShortLanguage = $v['ShortLanguage'];


                        $data = Array(
                            'IdKategorije' => $KategorijaArtikalaId,
                            "IdLanguage" => $IdLanguage,
                            'TekstKategorije' => $kat_opis
                        );


                        $db->where('IdKategorije', $KategorijaArtikalaId);
                        $db->where('IdLanguage', $IdLanguage);
                        if ($db->update('kategorijeartikalatekst', $data)) {
                            echo $db->count . ' records were updated on  kategorijeartikalatekst : '.$ShortLanguage;
                            echo '<br/>';

                        } else {
                            echo '<br/>';
                            echo 'update <strong style="color: red">failed</strong> : kategorijeartikalatekst ' . $db->getLastError();
                            echo '<br/>';
                            // ako je zabo update
                            die;
                        }


                    }


                } else {

                    echo '<br />Radi se INSERT : Nije odradjeno do kraja <strong style="color: red">FAIL INSTERT</strong><br />';


                   /* $data = Array("ParentKategorijaArtikalaId" => NULL,
                        "Kategorija_dodatna" => $id,
                        "Katsrblat" => $kat_name,
                        "Katsrb" => $kategorijeDodatna->vice_versa_cySR($kat_name, 'cy'),
                        "KategorijaArtikalaLink" => $kat_link,
                        "KategorijaArtikalaNaziv" => $kat_name,
                        "KategorijaArtikalaSlika" => $slikica,
                    );
                    $id = $db->insert('kategorijeartikala', $data);

                    if (!$id) {
                        $db->rollback();
                    } else {
                        $db->commit();
                    }*/


                }

                echo '<br /><br />';

            }
        }

        ?>

    </div>

</div>
<!-- /Wells -->