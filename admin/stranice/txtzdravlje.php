<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 06.10.15.
 * Time: 16:37
 */

$podaci = $db->getOne("osnpodaci");
$IdOsnPodaci = $podaci['IdOsnPodaci'];
$zdravljeNaslov = $podaci['zdravljeNaslov'];
$zdravljeOpis = $podaci['zdravljeOpis'];
$zdravljeTbNaslov1 = $podaci['zdravljeTbNaslov1'];
$zdravljeTbOpis1 = $podaci['zdravljeTbOpis1'];
$zdravljeTbNaslov2 = $podaci['zdravljeTbNaslov2'];
$zdravljeTbOpis2 = $podaci['zdravljeTbOpis2'];

?>
<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Zdravlje - tekst</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">
                <h3 class="icon-cog"> Izaberi jezik za izmenu:</h3>
                <hr>

                <?php
                $naziv = '';
                //var_dump($jezLan);

                foreach ($jezLan as $k => $v):
                    $ShortLanguage = $v['ShortLanguage'];

                    $naziv .= '<div class="form-group clearfix ">';
                    $naziv .= '<label class="col-md-3 control-label">Zdravlje ' . $ShortLanguage . ' </label>';
                    $naziv .= '<div class="col-md-9">';
                    $naziv .= '<a class="icon-cog" href="/admin/str/edittxtzdravlje/' . $k . '"> Izmeni na <strong>' . $ShortLanguage . '</strong> jeziku</a>';
                    $naziv .= '</div>';
                    $naziv .= '</div>';
                endforeach;

                echo $naziv;
                ?>
                <hr>

                <h2 style="text-align: center">Pregled tekstova sa stranice zdravlje</h2>

                <div class="clearfix"></div>

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=edittekstzdravlje">

                    <input type="hidden" name="id" id="id" value="<?php echo $IdOsnPodaci; ?>">

                    <hr>
                    <h4>Veliki Text strana zdravlje:</h4>

                    <!--Naslov na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Naslov glavni zdravlje stranica </label>

                        <div class="col-md-10">
                            <input type="text" name="zdravljeNaslov" class="form-control"
                                   value="<?php echo $zdravljeNaslov; ?>">
                        </div>
                    </div>

                    <!--Opis na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Opis glavni zdravlje stranica</label>

                        <div class="col-md-10">
                            <textarea rows="5" name="zdravljeOpis"
                                      class="form-control mceEditor required"><?php echo $zdravljeOpis; ?></textarea>

                        </div>
                    </div>

                    <hr>
                    <h4>Text box strana zdravlje:</h4>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box levo zdravlje</label>

                        <div class="col-md-10">
                            <input type="text" name="zdravljeTbNaslov1" class="form-control"
                                   value="<?php echo $zdravljeTbNaslov1; ?>">
                        </div>
                    </div>

                    <!--Opis na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box levo Opis </label>
                        <div class="col-md-10">

                            <textarea rows="5" name="zdravljeTbOpis1"
                                      class="form-control  required"><?php echo $zdravljeTbOpis1; ?></textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box desno zdravlje </label>

                        <div class="col-md-10">
                            <input type="text" name="$zdravljeTbNaslov2" class="form-control"
                                   value="<?php echo $zdravljeTbNaslov2; ?>">
                        </div>
                    </div>

                    <!--Opis na pocetnoj-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Text box desno Opis</label>

                        <div class="col-md-10">

                            <textarea rows="5" name="$zdravljeTbOpis2"
                                      class="form-control  required"><?php echo $zdravljeTbOpis2; ?></textarea>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->