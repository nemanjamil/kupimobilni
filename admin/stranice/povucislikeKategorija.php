<!--=== Wells ===-->
<div class="widget">
    <div class="widget-header">
        <h4><i class="icon-sitemap"></i> Slike za kategorije</h4>
    </div>
    <div class="widget-content">
        <div class="well">
            Skinute slike za kategorije
        </div>
    </div>

    <div>

        <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" action="">

            <div class="form-group">
                <label class="col-md-2 control-label">Limit OD</label>

                <div class="col-md-10">
                    <input type="number" name="id">
                </div>

            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Limit DO</label>

                <div class="col-md-10">
                    <input type="number" name="br">
                </div>

            </div>



            <div class="form-actions">
                <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
            </div>
        </form>
    </div>

    <div>

        <?php

        $kategorijeDodatna = new kategorijeDodatna($db);
        $ubacisliku = new ubacisliku($db);
        //$common = new common($db);
        require_once(DCROOT . '/thumblib/ThumbLib.inc.php'); // include class


        function checkRemoteFile($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            // don't download content
            curl_setopt($ch, CURLOPT_NOBODY, 1);
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if (curl_exec($ch) !== FALSE) {
                return true;
            } else {
                return false;
            }
        }
        echo $idp = (int) $_POST['id'];
        echo '<br/>';
        echo $brp = (int) $_POST['br'];
        echo '<br/>';
        if ($idp and $brp) {

        // todo obrati paznju na limit
        $limit = Array($idp, $brp);

        $cols = Array("KategorijaArtikalaId", "KAN.NazivKategorije", "KategorijaArtikalaLink", "KategorijaArtikalaSlika");
        $db->join("kategorijeartikalanaslov KAN", "KAN.IdKategorije = KategorijaArtikalaId AND KAN.IdLanguage = 5", "LEFT");
        $db->where("Kategorija_dodatna is not NULL");
        $users = $db->get("kategorijeartikala", $limit, $cols);

        $i = 1;
        if ($db->count > 0)
            foreach ($users as $user) {

                echo 'Redni broj : '.$i;
                echo '<br/>';
                $i++;

                $KategorijaArtikalaSlika = $user['KategorijaArtikalaSlika'];
                $KategorijaArtikalaId = $user['KategorijaArtikalaId'];
                $Katsrblat = $user['NazivKategorije'];
                $KategorijaArtikalaId = $user['KategorijaArtikalaId'];

                echo $fileName = strtok($KategorijaArtikalaSlika, '.');

                /*$ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);*/


                $linkSlika = 'http://dodatnaoprema.com/images/slikekat/' . $fileName . '.jpg';
                echo '<br/>';
                echo 'Link do slike na dodatnoj : ' . $linkSlika;
                echo '<br/>';
                echo '<b>Kategorije masine : ' . $Katsrblat . '<br/>ID:' . $KategorijaArtikalaId . '</b>';
                echo '<br/><br/>';

                // 1. Ubacujemo slike

                if ($kategorijeDodatna->checkRemoteFile($linkSlika)) {


                    $location = KATSLIKELOK;
                    $lok = $common->locationslikaOstalo($location, $KategorijaArtikalaId);
                    $lokslifol = DCROOT . $lok;



                    if (!is_dir($lokslifol)) {
                        mkdir($lokslifol, 0775, true);
                    }

                    $imgmala = $lokslifol . "/" . $fileName . '.' . EXTPRED;
                    $thumbmala = PhpThumbFactory::create($linkSlika);
                    $thumbmala->adaptiveResize(400, 400);
                    $thumbmala->save($imgmala, EXTPRED);

                    $imgmala = $lokslifol . "/" . $fileName . '_mala.' . EXTPRED;
                    $thumbmala = PhpThumbFactory::create($linkSlika);
                    $thumbmala->adaptiveResize(110, 80);
                    $thumbmala->save($imgmala, EXTPRED);


                    $imgsrednja = $lokslifol . "/" . $fileName . '_srednja.' . EXTPRED;
                    $thumbsrednja = PhpThumbFactory::create($linkSlika);
                    $thumbsrednja->adaptiveResize(340, 250);
                    $thumbsrednja->save($imgsrednja, EXTPRED);


                    // dodatno  172 x 170
                    $imgsrednja172 = $lokslifol . "/" . $fileName . '_172.' . EXTPRED;
                    $thumbsrednja172 = PhpThumbFactory::create($linkSlika);
                    $thumbsrednja172->adaptiveResize(172, 170);
                    $thumbsrednja172->save($imgsrednja172, EXTPRED);


                    // update u bazi
                    $data = Array(
                        'KategorijaArtikalaSlika' => $fileName . '.' . EXTPRED
                    );
                    $db->where('KategorijaArtikalaId', $KategorijaArtikalaId);
                    if ($db->update('kategorijeartikala', $data)) {
                        echo $db->count . 'Slika records were updated';
                    } else {
                        echo 'update failed: ' . $db->getLastError();
                        die;
                    }
                    sleep(1);

                } else {
                    echo 'Nema slika';
                    echo '<br/><br/>';

                }

                // 2. Izmena teksta
                /*
                 * sada Kada smo ubacili slike onda treba da prebacimo srb lat u srb cir naslova
                 * koristimo neku kovertor iz cil u lat
                 */


                $Katsrb = $kategorijeDodatna->vice_versa_cySR($Katsrblat, 'cy');

                foreach ($jezLan AS $k => $v) {


                    $IdLanguage = $v['IdLanguage'];
                    $ShortLanguage = $v['ShortLanguage'];

                    /*
                    * prvo konvertujemo $Katsrblat u cirilicu
                    * onda uradimo UPDATE
                    */
                    $katNaziv = ($IdLanguage == 1) ? $kategorijeDodatna->vice_versa_cySR($Katsrblat, 'cy') : $Katsrblat;


                    $data = Array(
                        'IdKategorije' => $KategorijaArtikalaId,
                        "IdLanguage" => $IdLanguage,
                        'NazivKategorije' => $katNaziv
                    );


                    $db->where('IdKategorije', $KategorijaArtikalaId);
                    $db->where('IdLanguage', $IdLanguage);
                    if ($db->update('kategorijeartikalanaslov', $data)) {
                        echo $db->count . ' records were updated on  kategorijeartikalanaslov : ' . $ShortLanguage;
                        echo '<br/>';

                    } else {
                        echo '<br/>';
                        echo 'update <strong style="color: red">failed</strong> : kategorijeartikalanaslov ' . $db->getLastError();
                        echo '<br/>';
                        // ako je zabo update
                        die;
                    }

                }


            }


        } else {
            echo 'Nema Id i br';
        }
        ?>

    </div>


</div>
<!-- /Wells -->