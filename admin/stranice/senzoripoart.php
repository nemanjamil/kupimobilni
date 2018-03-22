<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 23.11.2015.
 * Time: 22.54
 */

//    var_dump($_POST);
//echo 'bbb'.$_POST[ArtikalId].'aaa';
    $ArtikalIdaa = $common->clearvariable($_POST[ArtikalId]);

?>
<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Podaci po artiklu</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Artikal</label>

                        <div class="col-md-9">

                            <select id="ArtikalId" name="ArtikalId"
                                    class="select2 required full-width-fix">
                                <option value=""></option>

                                <?php
                                $db->join("kategorijeartikala KA", "KA.KategorijaArtikalaId = A.KategorijaArtikalId");
                                $db->where("KA.Kategorija_dodatna IS NULL");
                                $data = $db->get('artikli A');

                                foreach ($data as $sds => $s) {
                                    $ArtikalId = $s['ArtikalId'];
                                    $ArtikalNaziv = $s['ArtikalNaziv'];
                                    $selektovano = ($ArtikalIdaa == $ArtikalId) ? 'selected' : ''

                                    ?>
                                    <option value="<?php echo $ArtikalId; ?>" <?php echo $selektovano ?>><?php echo $ArtikalNaziv; ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

    <!--=== Page Content ===-->

    <div class="col-md-12 col-xs-6">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-list-alt"></i> Lista podataka po kulturi i senzoru</h4>

                <div class="toolbar">
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

                        <!--<th>Naziv Kulture</th>-->
                        <th>Artikal</th>
                        <th>Proizvodjac</th>
                        <th>Kultura</th>
                        <th>Lokacija</th>
                        <th>Senzor</th>
                        <th>Tip Senz</th>
                        <th>Od</th>
                        <th>Do</th>
                        <th>Zuto Od</th>
                        <th>Zuto Do</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

//                    $db->setTrace(true);

                    $db->join("senzorkullokpodaci SK", "SK.IdKulLokPodaci = PK.IdSenzorKulPodLok", "LEFT");
                    $db->join("kulturalokacija KL", "KL.IdKulturaLokacija = SK.IdKultureKulLok ", "LEFT");
                    $db->join("senzortip ST", "ST.IdSenzorTip = SK.IdTipKulTipLok", "LEFT");
                    $db->join("kulture KU", "KU.IdKulture = KL.PovKulture", "LEFT");
                    $db->join("lokalnasu LSU", "LSU.IdLokSamo = KL.PovLokSamouprava", "LEFT");
                    $db->join("listasenzora LSZ", "LSZ.PripadaKulLok = KL.IdKulturaLokacija", "LEFT");
                    $db->join("senzorizaartikal SZART", "SZART.SenzorSifraSenzora = LSZ.IdListaSenzora", "LEFT");
                    $db->join("artikli A", "A.ArtikalId = SZART.SenzorZaArtikal ", "LEFT");
                    $db->join("komitenti KOMI", "KOMI.KomitentId = LSZ.PripadaKomitentu", "LEFT");
                    $db->where("A.ArtikalId", $ArtikalIdaa);
                    $db->orderBy("SZART.SenzorSifraSenzora");
                    $data = $db->get("podacikultiplok PK", null, " A.ArtikalId, KL.NazivKulturaLokacija,  A.ArtikalNaziv,
                        KU.ImeKulture, LSU.ImeLokSamo, LSZ.SenzorSifra, ST.senzorTipIme, PK.OdPodaciIdeal,
                        PK.DoPodaciIdeal, PK.OdZutoIdeal, PK.DoZutoIdeal, KOMI.KomitentIme, KOMI.KomitentPrezime");

//print_r($db->trace);
                    $i = 1;

                    foreach ($data as $sds => $link) {

                        $NazivKulturaLokacija = $link[NazivKulturaLokacija];
                        $ArtikalNaziv = $link[ArtikalNaziv];
                        $ImeKulture = $link[ImeKulture];
                        $ImeLokSamo = $link[ImeLokSamo];
                        $SenzorSifra = $link[SenzorSifra];
                        $senzorTipIme = $link[senzorTipIme];
                        $OdPodaciIdeal = $link[OdPodaciIdeal];
                        $DoPodaciIdeal = $link[DoPodaciIdeal];
                        $OdZutoIdeal = $link[OdZutoIdeal];
                        $DoZutoIdeal = $link[DoZutoIdeal];
                        $KomitentIme = $link[KomitentIme];
                        $KomitentPrezime = $link[KomitentPrezime];


                        $tab .=

                            //ovde ide dugme da te vodi na senzor
                            '<tr>


                     <!--$NazivKulturaLokacija-->
                    <td>' . $ArtikalNaziv . '</td>
                    <td>' . $KomitentIme. ' ' . $KomitentPrezime . '</td>
                    <td>' . $ImeKulture . '</td>
                    <td>' . $ImeLokSamo . '</td>
                    <td>' . $SenzorSifra . '</td>
                    <td>' . $senzorTipIme . '</td>
                    <td>' . $OdPodaciIdeal . '</td>
                    <td>' . $DoPodaciIdeal . '</td>
                    <td>' . $OdZutoIdeal . '</td>
                    <td>' . $DoZutoIdeal . '</td>
                </tr>';
                    }
                    echo $tab; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
