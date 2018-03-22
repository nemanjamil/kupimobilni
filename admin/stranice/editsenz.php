<?php

$db->where("IdListaSenzora", $id);
$data = $db->get("listasenzora");


foreach ($data as $link) {

    $IdListaSenzora = $link['IdListaSenzora'];
    $SenzorSifra = $link['SenzorSifra'];
    $PripadaKulLok = $link['PripadaKulLok'];
    $KomitentIdOdSenz = $link['KomitentId'];

}
?>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i>Izmeni senzor</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editsenz">

                    <!-- <div class="form-group">
                        <label class="col-md-3 control-label">Kultura</label>

                        <div class="col-md-9">

                            <select id="PripadaKulLok" name="PripadaKulLok"
                                    class="select2 required full-width-fix">

                                <?php
                    /*                                $data = $db->get('kulturalokacija');
                                                    foreach ($data as $sds => $s) {
                                                        $IdKulturaLokacija = $s['IdKulturaLokacija'];
                                                        $NazivKulturaLokacija = $s['NazivKulturaLokacija'];
                                                        $selektovano = ($PripadaKulLok == $IdKulturaLokacija) ? 'selected' : ''

                                                        */ ?>
                                    <option
                                        value="<?php /*echo $IdKulturaLokacija; */ ?>"
                                        <?php /*echo $selektovano */ ?>><?php /*echo $NazivKulturaLokacija; */ ?></option>
                                <?php /*} */ ?>
                            </select>

                        </div>
                    </div>-->

                    <div class="form-group">
                        <label class="col-md-3 control-label">Komitent</label>

                        <div class="col-md-9">

                            <select id="PripadaKomitentu" name="PripadaKomitentu"
                                    class="select2 required full-width-fix">

                                <?php
                                $data = $db->get('komitenti');
                                foreach ($data as $sds => $s) {
                                    $KomitentId = $s['KomitentId'];
                                    $KomitentIme = $s['KomitentIme'];
                                    $KomitentPrezime = $s['KomitentPrezime'];
                                    $selektovano = ($KomitentIdOdSenz == $KomitentId) ? 'selected' : ''

                                    ?>
                                    <option
                                        value="<?php echo $KomitentId; ?>"
                                        <?php echo $selektovano ?>><?php echo $KomitentIme . ' ' . $KomitentPrezime; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Sifra Senzora</label>

                        <div class="col-md-9">
                            <input type="hidden" value="<?php echo $IdListaSenzora; ?>" id="IdListaSenzora"
                                   name="IdListaSenzora">

                            <input type="text" name="SenzorSifra" id="SenzorSifra"
                                   class="form-control required"
                                   required="required" value="<?php echo $SenzorSifra; ?>">

                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="Izmeni senzor" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

    <div class="col-md-6 col-xs-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i>Dodaj Kulturu za Dati Senzor</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=dodajKulturuNaSenzor">
                    <input type="hidden" name="IdListaSenzora" value="<?php echo $IdListaSenzora; ?>">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Kultura</label>

                        <div class="col-md-9">

                            <select id="PripadaKulLok" name="PripadaKulLok"
                                    class="select2 required full-width-fix">

                                <option value=""></option>
                                <?php
                                $data = $db->get('kulture');
                                foreach ($data as $sds => $s) {

                                    $IdKulture = $s['IdKulture'];
                                    $ImeKulture = $s['ImeKulture'];
                                    ?>
                                    <option value="<?php echo $IdKulture; ?>">  <?php echo $ImeKulture; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Izmeni senzor" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i>Koje Kulture Pripadaju senzoru <?php echo $SenzorSifra; ?> </h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <table
                    class="table table-striped table-bordered table-hover ">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Senzor</th>
                        <th>Proizvodjac</th>
                        <th>Kultura</th>
                        <th>IdKulture</th>
                        <th>Notifikacija</th>
                        <th>Izaberi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php


                    $db->join("kulture K", "K.IdKulture = KS.IdKulture");
                    $db->join("listasenzora LS", "LS.IdListaSenzora  = KS.IdListaSenzora");
                    $db->join("komitenti KO", "KO.KomitentId = LS.KomitentId");
                    $db->where("KS.IdListaSenzora", $id);
                    $data = $db->get("kulturasenzor KS", null, "IdKulturaSenzor,SenzorSifra,KomitentIme,KomitentPrezime,ImeKulture,K.IdKulture");

                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $IdKulturaSenzor = $link['IdKulturaSenzor'];
                        $SenzorSifra = $link['SenzorSifra'];
                        $NazivKulturaLokacija = $link['ImeKulture'];
                        $IdKulture = $link['IdKulture'];
                        $KomitentIme = $link['KomitentIme'];
                        $KomitentPrezime = $link['KomitentPrezime'];
                        $tab .=
                            '<tr>

                    <td>' . $IdKulturaSenzor . '</td>
                    <td>' . $SenzorSifra . '</td>
                    <td>' . $KomitentIme . ' ' . $KomitentPrezime . '</td>
                    <td>' . $NazivKulturaLokacija . '</td>
                    <td>' . $IdKulture . '</td>
                     <td><a href="/admin/str/notifikacije/' . $IdKulturaSenzor . '"> <i class="icon-edit"> </i> Lista notifikacija</a></td>

                    <td class="align-center">
                        <div class="btn-group">

					     <a data-original-title="Delete" onclick="return confirmSubmit()" href="/akcija.php?action=obrisiKulturuZaSenzor&id=' . $IdKulturaSenzor . '" class="btn btn-xs bs-tooltip" title=""><i class="icon-trash"></i></a>

                        </div>
                    </td>
                </tr>';

                        /*<li><a href="/admin/str/editsenz/' . $IdKulturaSenzor . '"> <i class="icon-edit"> </i> Izmeni</a></li>*/
                    }
                    echo $tab; ?>

                    </tbody>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

</div>