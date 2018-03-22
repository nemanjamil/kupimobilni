<?php
/**
 * Created by PhpStorm.
 * User: ITCluster Serbia
 * Date: 27.4.2016.
 * Time: 13:54
 */


//glavni translate

$db->where("IdTranslate = '$id' ");
$data = $db->get("translate ", null, "IdTranslate, srblat");

foreach ($data as $link) {

    $IdTranslate1 = $link['IdTranslate'];
    $srblat = $link['srblat'];
}


?>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Vrednost za translate  <i>[<?php echo $srblat; ?>]</i></h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <div class="widget-content">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal row-border"
                          id="validate-2" action="/akcija.php?action=dodajvrednosttranslate">

                        <!--Naziv-->
                        <?php
                        $naziv = '';
                        foreach ($jezLan as $k => $v):
                            $ShortLanguage = $v['ShortLanguage'];
                            $IdLanguage = $v['IdLanguage'];


                            $cols = Array("IdTranslate, NazivTranslate, IdLanguage");
                            $db->where('IdTranslate', $id);
                            $db->where('IdLanguage', $IdLanguage);
                            $artNazivNewUpit = $db->getOne("translatenaziv", null, $cols);

                            $OpisArtikla = $artNazivNewUpit['NazivTranslate'];
                            $IdLanguage1 = $artNazivNewUpit['IdLanguage'];
                            $IdTranslate = $artNazivNewUpit['IdTranslate'];

                            $naziv .= '<div class="form-group">';
                            $naziv .= '<label class="col-md-3 control-label bg-success"><strong>Novi Translate:  ' . $ShortLanguage . ' </strong></label>';
                            $naziv .= '<div class="col-md-9">';
                            $naziv .= '<input type="hidden" id="IdJezik' . $ShortLanguage . '" name="IdJezik[' . $IdLanguage . ']" class="form-control" value="' . $IdLanguage . '">';
                            $naziv .= '<input type="hidden" id="Idtranslate' . $ShortLanguage . '" name="IdTranslate[' . $IdLanguage . ']" class="form-control" value="' . $IdTranslate1 . '">';
                            $naziv .= '<input type="text" id="OpisTranslateVrd' . $ShortLanguage . '" name="OpisTranslateVrd[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
                            $naziv .= '</div>';
                            $naziv .= '</div>';
                        endforeach;

                        echo $naziv;

                        ?>
                        <!-- <div class="form-group">
                                <label class="col-md-3 control-label">Opis Jezika </label>

                                <div class="col-md-9">
                                    <input type="hidden" name="IdTranslateVrd" id="IdTranslateVrd"
                                           class="form-control" required="required"
                                           value="<?php /* echo $IdTranslateVrdSrb; */ ?>">

                                    <input type="hidden" name="IdJezik" id="IdJezik"
                                           class="form-control" required="required"
                                           value="<?php /*echo $IdLanguage; */ ?>">


                                    <input type="text" name="OpisTranslateVrd" id="OpisTranslateVrd"
                                           class="form-control" required="required"
                                           value="<?php /*echo $OpisTranslateVrdSrb; */ ?>">


                                </div>
                            </div>-->
                        <input type="hidden" id="Idtranslate" name="IdTranslate" class="form-control" value="<?php echo $IdTranslate1?>">
                        <div class="form-actions">
                            <input type="submit" value="Dodaj" class="btn btn-primary pull-right">
                        </div>
                    </form>


                </div>
            </div>
        </div>


    </div>
</div>



