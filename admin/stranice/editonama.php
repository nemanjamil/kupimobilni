<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 31. 08. 2015.
 * Time: 10:15
 */

$db->where("idRekOnam", $id);
$tag = $db->getOne("rekonama");
$idRekOnam = $tag['idRekOnam'];
$OpisRekONama = $tag['OpisRekONama'];
$KomitRekOnama = $tag['KomitRekOnama'];

//var_dump($tag);

?>
<!--=== Page Content ===-->
<div class="row">

    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Izmeni komentar o nama</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editonama">


                    <input type="hidden" name="id" id="id" value="<?php echo $idRekOnam ?>">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Komitent </label>

                        <div class="col-md-9">

                            <select id="komitentId" name="KomitentId"
                                    class="select2 required full-width-fix" disabled="disabled">
                                <?php
                                $data = $db->get('komitenti', null, 'KomitentId,KomitentNaziv');
                                foreach ($data as $sds => $s) {
                                    $selkom = ($KomitRekOnama == $s['KomitentId']) ? 'selected' : '';
                                    echo '<option value="' . $s['KomitentId'] . '"  ' . $selkom . '>' . $s['KomitentNaziv'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Komentar</label>

                        <div class="col-md-9">
                            <textarea rows="3" name="string" id="string"
                                      class="form-control"><?php echo $OpisRekONama; ?></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni komentar" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
