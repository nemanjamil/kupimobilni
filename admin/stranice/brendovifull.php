<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 16.10.15.
 * Time: 11:37
 */
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-7">
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
                      action="/akcija.php?action=dodajbrend">
                     <?php

                        $naziv = '';
                        foreach ($jezLan as $k => $v):
                            $ShortLanguage = $v['ShortLanguage'];
                            $IdLanguage = $v['IdLanguage'];

                            $naziv .= '<div class="form-group">';
                            $naziv .= '<label class="col-md-3 control-label bg-success"><strong>Brend ime ' . $ShortLanguage . ' </strong></label>';
                            $naziv .= '<div class="col-md-9">';
                            $naziv .= '<input type="text" id="BrendIme' . $ShortLanguage . '" name="BrendIme[' . $IdLanguage . ']" class="form-control" value="">';
                            $naziv .= '</div>';
                            $naziv .= '</div>';
                        endforeach;

                        echo $naziv;

                        ?>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend Aktivan</label>

                        <div class="col-md-9">
                            <select id="brendactive" name="brendactive"
                                    class="form-control  required" value="<?php echo $BrendActive; ?>">
                                <option value="0"<?php echo ($BrendActive == 0) ? 'selected' : ''; ?> >Neaktivan
                                </option>
                                <option value="1"<?php echo ($BrendActive == 1) ? 'selected' : ''; ?> >Aktivan
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend Naslovna</label>

                        <div class="col-md-9">
                            <select id="brendnaslovna" name="brendnaslovna"
                                    class="form-control  required" value="<?php echo $BrendNaslovna; ?>">
                                <option value="0"<?php echo ($BrendNaslovna == 0) ? 'selected' : ''; ?> >Ne
                                </option>
                                <option value="1"<?php echo ($BrendNaslovna == 1) ? 'selected' : ''; ?> >Da
                                </option>
                            </select>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Brend link </label>

                        <div class="col-md-9">
                            <input type="text" name="BrendSlika" id="BrendSlika" class="form-control" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Slika brenda - 270 x 197 px</label>

                        <div class="col-md-4">
                            <input type="file" name="BrendSlika"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">
                        </div>
                    </div>



                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-3 control-label bg-success"><strong>Opis brenda ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-9">';
                        $naziv .= '<textarea rows=7  name="brendoviopis['.$IdLanguage.']" class="form-control wysiwyg"></textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';

                    endforeach;

                    echo $naziv;

                    ?>
                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj brend" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include 'listabrendova.php' ?>
</div>

<!-- /Page Content -->
