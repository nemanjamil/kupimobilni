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

        <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" action="">

            <div class="form-group">
                <label class="col-md-2 control-label">Limit OD</label>

                <div class="col-md-10">
                    <select name="podaci" id="">
                        <option value="168|1291">Masine i Alati</option>
                        <option value="171|1989">Srafovi i srafovska roba</option>
                        <option value="170|1374">Potrosni-materijal-burgije-testere</option>
                        <option value="155|62">Auto oprema</option>
                        <option value="154|6">Baterije</option>
                        <option value="156|69">Dodatna Oprema</option>
                        <option value="157|523">Moda</option>
                        <option value="158|580">Sve za decu su</option>
                        <option value="159|779">Elektronika</option>
                        <option value="160|780">Racunari</option>
                        <option value="161|781">Mobilni</option>
                        <option value="162|782">Igracke</option>
                        <option value="163|783">Sve za KUCU</option>
                        <option value="167|1047">Kancelarijski pribor</option>
                        <option value="169|1362">Basta i oprema za Bastu</option>

                    </select>
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
            </div>
        </form>

        <?php


        $kategorijeDodatna = new kategorijeDodatna($db);

        echo "Masine i Alati su id : 168 kod nas u bazi dok ID dodatna oprema je 1291";
        echo '<br/>';
        echo "Srafovi i srafovska roba su id : 171 kod nas u bazi dok ID dodatna oprema je 1989";
        echo '<br/>';
        echo "potrosni-materijal-burgije-testere su id : 170 kod nas u bazi dok ID dodatna oprema je 1374";
        echo '<br/>';
        echo "Auto oprema su id : 155 kod nas u bazi dok ID dodatna oprema je 62";
        echo '<br/>';
        echo "baterije su id : 154 kod nas u bazi dok ID dodatna oprema je 6";
        echo '<br/>';
        echo "DodatnaOPREMA su id : 156 kod nas u bazi dok ID dodatna oprema je 69";
        echo '<br/>';
        echo "Moda su id : 157 kod nas u bazi dok ID dodatna oprema je 523";
        echo '<br/>';
        echo "Sve za decu su id : 158 kod nas u bazi dok ID dodatna oprema je 580";
        echo '<br/>';
        echo "elektronika su id : 159 kod nas u bazi dok ID dodatna oprema je 779";
        echo '<br/>';
        echo "Računari su id : 160 kod nas u bazi dok ID dodatna oprema je 780";
        echo '<br/>';
        echo "Mobilni su id : 161 kod nas u bazi dok ID dodatna oprema je 781";
        echo '<br/>';
        // dovde sam dosao zadnje sam pokrenuo Mobilni
        echo "Igračke su id : 162 kod nas u bazi dok ID dodatna oprema je 782";
        echo '<br/>';
        echo "Sve za kucu su id : 163 kod nas u bazi dok ID dodatna oprema je 783";
        echo '<br/>';
        echo "kancelarijski-pribor su id : 167 kod nas u bazi dok ID dodatna oprema je 1047";
        echo '<br/>';
        echo "Bašta i oprema za baštu su id : 169 kod nas u bazi dok ID dodatna oprema je 1362";
        echo '<br/>';

        echo '<br/>';

        var_dump($_POST);

        if ($_POST['podaci']) {
            $pieces = explode("|", $_POST['podaci']);
            $idAgro = (int) $pieces[0];
            $idDodatna = (int) $pieces[1];
            $kategorijeDodatna->updateKategDodatna($idAgro, $idDodatna, 0,$jezLan);
            echo '<br/>';
            echo 'KRAJ';

        } else {
            echo 'Nema posta';
            echo '<br/>';
        }






        ?>

    </div>


</div>
<!-- /Wells -->