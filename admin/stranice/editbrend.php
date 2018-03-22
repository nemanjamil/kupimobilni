<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19.10.15.
 * Time: 10:37
 */


$cols = Array("BR.BrendId", "BR.BrendLink", "BR.BrendNaslovna", "BR.BrendActive", "BR.BrendShow", "BR.BrendSlika", "BI.BrendIme", "BO.BrendOpis","BR.BrendSajt","BR.BrendSajtMasine");
$db->join("brendoviime BI", "BI.BrendId = BR.BrendId", "LEFT");
$db->join("brendoviopis BO", "BO.BrendId = BR.BrendId", "LEFT");
$db->where("BR.BrendId = $id"); // BR.BrendSajt = 2 AND
$links = $db->get("brendovi BR", null, $cols);


if ($links) {
    foreach ($links as $link) {

        $BrendId = $link['BrendId'];
        $BrendIme = $link['BrendIme'];
        $BrendActive = $link['BrendActive'];
        $BrendoviOpis = $link['brendoviopis' . $jezik];
        $BrendSlika = $link['BrendSlika'];
        $BrendNaslovna = $link['BrendNaslovna'];
        $BrendShow = $link['BrendShow'];
        $BrendLink = $link['BrendLink'];
        $BrendSajt = $link['BrendSajt'];
        $BrendSajtMasine = $link['BrendSajtMasine'];
    }
} else {
    echo 'Nema brenda opisa';
}

?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Brendovi</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=editbrend">

                    <input type="hidden" name="id" id="id" value="<?php echo $BrendId ?>">

                    <!--Ocena verifikacije-->

                    <?php


                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("BrendIme");
                        $db->where('BrendId', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $BreNazivNewUpit = $db->getOne("brendoviime", null, $cols);
                        $OpisArtikla = $BreNazivNewUpit['BrendIme'];


                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-3 control-label bg-success"><strong>Brend ime ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-9">';
                        $naziv .= '<input type="text" id="BrendIme' . $ShortLanguage . '" name="BrendIme[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend link </label>

                        <div class="col-md-9">
                            <input type="text" required="required" required name="BrendLinkLink" id="BrendLinkLink"
                                   class="form-control" value="<?php echo $BrendLink; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend Aktivan</label>

                        <div class="col-md-9">
                            <select id="brendactive" name="BrendActive"
                                    class="form-control  required" value="<?php echo $BrendActive; ?>">
                                <option value="0"<?php echo ($BrendActive == 0) ? 'selected' : ''; ?> >Neaktivan
                                </option>
                                <option value="1"<?php echo ($BrendActive == 1) ? 'selected' : ''; ?> >Aktivan
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend Show</label>

                        <div class="col-md-9">
                            <select id="BrendShow" name="BrendShow"
                                    class="form-control  required" value="<?php echo $BrendShow; ?>">
                                <option value="0"<?php echo ($BrendShow == 0) ? 'selected' : ''; ?> >NE
                                </option>
                                <option value="1"<?php echo ($BrendShow == 1) ? 'selected' : ''; ?> >DA
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend Naslovna</label>

                        <div class="col-md-9">
                            <select id="BrendNaslovna" name="BrendNaslovna"
                                    class="form-control  required" value="<?php echo $BrendNaslovna; ?>">
                                <option value="0"<?php echo ($BrendNaslovna == 0) ? 'selected' : ''; ?> >Ne
                                </option>
                                <option value="1"<?php echo ($BrendNaslovna == 1) ? 'selected' : ''; ?> >Da
                                </option>
                            </select>
                        </div>

                    </div>

<!--
                   <div class="form-group">
                        <label class="col-md-3 control-label">Brend Vidljiv na Agro</label>
                        <div class="col-md-9">
                            <select id="brendactive" name="BrendSajt"
                                    class="form-control  required" value="<?php /*echo $BrendSajt; */?>">
                                <option value="0" <?php /*echo ($BrendSajt == 0) ? 'selected' : ''; */?> >Neaktivan</option>
                                <option value="1" <?php /*echo ($BrendSajt == 1) ? 'selected' : ''; */?> >Aktivan
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend Vidljiv na Masine Alati</label>

                        <div class="col-md-9">
                            <select id="brendactive" name="BrendSajtMasine"
                                    class="form-control  required" value="<?php /*echo $BrendSajtMasine; */?>">
                                <option value="0"<?php /*echo ($BrendSajtMasine == 0) ? 'selected' : ''; */?> >Neaktivan
                                </option>
                                <option value="1"<?php /*echo ($BrendSajtMasine == 1) ? 'selected' : ''; */?> >Aktivan
                                </option>
                            </select>
                        </div>
                    </div>
-->

                    <div class="form-group">
                        <label class="col-md-3 control-label">Slika brenda - min 270 x 197</label>

                        <div class="col-md-4">
                            <input type="file" name="BrendSlika"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">


                            <?php

                            $slaa = $common->locationslikaOstalo(BRENDSLIKELOK, $BrendId);

                            $ext = pathinfo($BrendSlika, PATHINFO_EXTENSION);
                            $fileName = pathinfo($BrendSlika, PATHINFO_FILENAME);

                            //$mala_slika = $fileName . '_mala.' . $ext;
                            $mala_slika = $fileName . '.' . $ext;

                            //$lok = DCROOT . $slaa . '/' . $mala_slika;
                            $lok = DCROOT.'/'.BRENDSLIKELOK.'/'.$mala_slika;


                            if (file_exists($lok)) {
                                //echo '<img src="' . $slaa . '/' . $mala_slika . '" alt="Slika - Brend">';
                                echo '<img src="/' . BRENDSLIKELOK.'/'.$mala_slika . '" alt="Slika - Brend">';
                            }

                            ?>
                        </div>

                    </div>

                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("BrendOpis");
                        $db->where('BrendId', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("brendoviopis", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['BrendOpis'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-3 control-label bg-success"><strong>Opis Kategorije New ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-9">';
                        $naziv .= '<textarea rows="7" placeholder="Brendovi Opis" id="BrendOpis' . $ShortLanguage . '" name="BrendOpis[' . $IdLanguage . ']" class="form-control wysiwyg">' . $OpisArtikla . '</textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Izmeni brend" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

<!-- /Page Content -->
