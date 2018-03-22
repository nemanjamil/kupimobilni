<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 01. 2016.
 * Time: 9:32 AM
 */
//$limitlista = $common->clearvariable($_POST[limit]);
$limitlistaOd = $id;
$limitlistaDo = $br;

if (!$id) {
    $id = 0;
}

if (!$br) {
    $br = 5;
}

$brendAgro = ($_POST['brendartikla']) ? $_POST['brendartikla'] : '';
$vendorAgro = ($_POST['KomitentId']) ? $_POST['KomitentId'] : ''; // vermax

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Podaci po artiklu VEBSOP</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit OD</label>

                        <div class="col-md-10">
                            <input type="text" name="id" class="form-control digits" max="5"
                                   value="<?php echo $id ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit DO</label>

                        <div class="col-md-10">
                            <input type="text" name="br" class="form-control digits" max="5"
                                   value="<?php echo $br ?>">
                        </div>
                    </div>

                    <!--Brend artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Brend</label>

                        <div class="col-md-10">
                            <select id="brendartikla" name="brendartikla"
                                    class="form-control required" value="<?php echo $ArtikalBrend ?>">
                                <option value=""></option>
                                <?php
                                $cols = Array("B.BrendId", "BI.BrendIme", "B.BrendSajt");
                                $db->join("brendoviime BI", "BI.BrendId = B.BrendId");
                                $db->where("BI.IdLanguage = 5 AND B.BrendSajt = 1");
                                $data = $db->get('brendovi B', null, $cols);
                                foreach ($data as $key => $value) {
                                    $BrendId = $value['BrendId'];
                                    $BrendIme = $value['BrendIme'];
                                    $selektovano = ($brendAgro == $BrendId) ? 'selected' : '';
                                    echo '<option value="' . $BrendId . '" ' . $selektovano . '>' . $BrendIme . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitenti</label>

                        <div class="col-md-10">
                            <select id="komitentId" name="KomitentId"
                                    class="select2 required full-width-fix">
                                <?php
                                $data = $db->get('komitenti', null, 'KomitentId,KomitentIme,KomitentPrezime,KomitentKolona');
                                foreach ($data as $sds => $s) {
                                    $selkom = ($vendorAgro == $s['KomitentId']) ? 'selected' : '';
                                    echo '<option value="' . $s['KomitentId'] . '"  ' . $selkom . '>' . $s['KomitentIme'] . ' ' . $s['KomitentPrezime'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit"
                               onclick="this.value='Submitting ..';this.disabled='disabled'; this.form.submit();"
                               value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!--=== Page Content ===-->