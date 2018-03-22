<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-tag"></i> Dodaj Podatke za Kulturu</h4>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajTipSenzoraZaKuturu">

                    <input type="hidden" value="<?php echo $id; ?>" name="id">


                    <div class="form-group">
                        <label class="col-md-2 control-label">Senzor</label>

                        <div class="col-md-10">

                            <select id="IdSenzorKulPodLok" name="IdSenzorKulPodLok"
                                    class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get("senzortip" );
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['IdSenzorTip'] . '">' . $s['senzorTipIme']  . "\n";
                                }
                                ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Idealno od </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="OdPodaciIdeal" id="OdPodaciIdeal"
                                   class="form-control required"
                                   required="required">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Idealno do </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="DoPodaciIdeal" id="DoPodaciIdeal"
                                   class="form-control required"
                                   required="required">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuto od </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="OdZutoIdeal" id="OdZutoIdeal"
                                   class="form-control required"
                                   required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Zuto do </label>

                        <div class="col-md-10">

                            <input type="number" step="0.1" min="0"  name="DoZutoIdeal" id="DoZutoIdeal"
                                   class="form-control required"
                                   required="required">

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Dodaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>