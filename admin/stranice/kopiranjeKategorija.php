<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Razno Test Nemanja</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <!-- <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit OD</label>

                        <div class="col-md-10">
                            <input type="text" name="id" class="form-control digits" max="5"
                                   value="<?php /*echo $id */ ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit DO</label>

                        <div class="col-md-10">
                            <input type="text" name="br" class="form-control digits" max="5"
                                   value="<?php /*echo $br */ ?>">
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>-->

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Nemanja Test</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">


                <?php
                //$db->setTrace (true);

                $limit = Array(0, 100000);
                $cols = Array("VS.opiskategorije" , "VS.id","VS.kat_link");
                //$db->join("artikli A", "A.ArtikalIdDodatna = v.id", "LEFT");
                //$db->where("v.vendor", $vendorDodatna);
                //$db->where("v.codeboschlink LIKE '%bosch-professional%'");
                $data = $db->get("kategorije VS", $limit, $cols);


                $i = 1;
                if ($dataXXX){
                foreach ($data as $sds => $link) {
                    usleep(10000);

                    echo '<div style="background-color: #dedede;border: 1px solid rosybrown; margin: 20px;padding: 20px">';
                    $opiskategorije = $link['opiskategorije'];
                    echo '<br/>';
                    echo "Id kategorije u dodatna oprema ";
                    echo '<br/>';
                    echo $id = $link['id'];
                    echo '<br/>';
                    echo 'Kat link ';
                    echo '<br/>';
                    echo $kat_link = $link['kat_link'];
                    echo '<br/>';
                    // Dobijamo ID od Agro Kategorije




                    $cols = Array("KategorijaArtikalaId","KategorijaArtikalaLink");
                    $db->where("Kategorija_dodatna", $id);
                    $data = $db->getOne("kategorijeartikala", NUll, $cols);
                    $KategorijaArtikalaId = $data['KategorijaArtikalaId'];
                    $KategorijaArtikalaLink = $data['KategorijaArtikalaLink'];
                    if ($KategorijaArtikalaId) {

                        echo 'Postoji Kategorija U Agro Bazi ' . $KategorijaArtikalaId;
                        echo '<br/>';
                        echo 'Kat link na AGRO bazi ' . $KategorijaArtikalaLink;
                        echo '<br/>';


                        $db->where('IdKategorije', $KategorijaArtikalaId);
                        if($db->delete('kategorijeartikalatekst')) {
                            echo 'successfully deleted';
                        } else {
                            echo 'Nije obrisano';
                        }


                        foreach ($jezLan as $k=>$v) {
                            $IdLanguage = $v['IdLanguage'];
                            $ShortLanguage = $v['ShortLanguage'];

                            $insert_query = Array('IdKategorije' => $KategorijaArtikalaId, 'IdLanguage' => $IdLanguage, 'TekstKategorije' => $opiskategorije);
                            $db->setQueryOption(Array('IGNORE'));
                            $idArtNewInsert = $db->insert('kategorijeartikalatekst', $insert_query);
                        }



                    } else {
                        echo 'Ne Postoji Kategorija U Agro Bazi '.$KategorijaArtikalaId;
                        echo '<br/>';
                    }

                    echo '</div>';
                    $i++;
                }
                echo $r;
                } else {
                    echo 'Nema podataka';
                }
                ?>

            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->