<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */
/*
$KategorijaArtikalaI = 11185; //Mobilni

$podaIn = $db->rawQueryOne("SELECT svePodkat($KategorijaArtikalaI) as svePodk");

$pod = $podaIn['svePodk'];

$a = explode(",",$pod);
$IdSpeckategorije = 30;


foreach($a as $k => $v){

echo $v;
echo '</br>';
$db->rawQueryOne("INSERT INTO speckategorija (IdSpecKategorija, IdGrupeSpeckategorija) VALUES ('$v', '$IdSpeckategorije')");

}


die;
*/







?>
<div class="col-md-12">

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="widget box">
                <div class="widget-header">

                    <h4><i class="icon-th-large"></i> Dodaj specifikaciju grupe</h4>

                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content">

                    <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                          action="/akcija.php?action=dodajGrupuSpec">


                        <div class="form-group">
                            <label class="col-md-2 control-label">Ime GENERALNO</label>

                            <div class="col-md-10">
                                <input type="text" id="naziv" name="naziv" class="form-control required"
                                       placeholder="Naziv - interni">
                            </div>
                        </div>


                        <?php
                        $naziv = '';
                        foreach ($jezLan as $k => $v):
                            $ShortLanguage = $v['ShortLanguage'];
                            $IdLanguage = $v['IdLanguage'];

                            $naziv .= '<div class="form-group">';
                            $naziv .= '<label class="col-md-2 control-label">Ime  ' . $ShortLanguage . ' </label>';
                            $naziv .= '<div class="col-md-10">';
                            $naziv .= '<input type="text" id="grupe' . $ShortLanguage . '" name="grupe[' . $IdLanguage . ']"  class="form-control required">';
                            $naziv .= '</div>';
                            $naziv .= '</div>';
                        endforeach;

                        echo $naziv;
                        ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Kratak opis</label>

                            <div class="col-md-10">
                            <textarea rows="3" id="string" name="string" class="form-control"
                                      placeholder="Opis na srpskom jeziku"></textarea>

                            </div>
                        </div>


                        <div class="form-actions">
                            <input type="submit" value="Dodaj grupu" class="btn btn-primary pull-right">
                        </div>
                    </form>

                </div>
            </div>
            <!-- /Validation Example 1 -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Specifikacije kategorija <!--(<code>no-padding</code>)--></h4>

                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content no-padding">
                    <table class="table table-striped table-bordered table-hover table-checkable datatable">
                        <thead>
                        <tr>
                            <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
                            <th>Ime kategorije</th>
                            <th>Dodaj Specifikaciju</th>
                            <th>Edit Kategorije</th>
                            <th>Obrisi</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $db->where('IdSpecKategorija', $id);
                        $gdePrip = $db->get('speckategorija', null, 'IdGrupeSpecKategorija');
                        if ($gdePrip) {
                            foreach ($gdePrip as $kat => $val) {
                                $arrsta[] = $val['IdGrupeSpecKategorija'];

                            }
                        }


                        $db->join("specvrednosti SV", "SG.IdSpecGrupe = SV.IdSpecVrednostiGrupe", "LEFT"); // ovde smo dodali LEFT, da bi prikazao i one grupe koje nemaju nijednu Vrednost
                        $db->join('specgrupenaz SGN', "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId  ");
                        $db->groupBy("SG.IdSpecGrupe");
                        $specKateg = $db->get("specifikacijagrupe SG", null, "SG.IdSpecGrupe, SGN.NazivSpecGrupe");


                        if ($specKateg) {
                            foreach ($specKateg as $kat => $val) {
                                $IdSpecGrupe = $val['IdSpecGrupe'];
                                $ImeSpecGrupe = $val['NazivSpecGrupe'];

                                if (is_array($arrsta)) {
                                    $cekiKat = (in_array($IdSpecGrupe, $arrsta)) ? 'checked' : '';
                                }

                                $db->join("specvrednosti SV", "SG.IdSpecGrupe = SV.IdSpecVrednostiGrupe");
                                $db->join('specvrednaziv SVN', "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
                                $db->where("SG.IdSpecGrupe", $IdSpecGrupe);
                                $products = $db->get("specifikacijagrupe SG", null, "SV.IdSpecVrednosti, SVN.SpecVredNaziv");


                                ?>
                                <tr>
                                    <td class="checkbox-column">
                                        <input type="checkbox" class="uniform">
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                                <i class="icol-cog"></i> <?php echo $ImeSpecGrupe; ?> <span
                                                    class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if ($products) {
                                                    foreach ($products as $kljuc => $vrednost) {
                                                        $IdSpecVrednosti = $vrednost['IdSpecVrednosti'];
                                                        $IdSpecVrednostiIme = $vrednost['SpecVredNaziv'];
                                                        ?>
                                                        <!--UKOLIKO BUDE POTREBNO, dodati akciju, da se ode na edit osobine-->
                                                        <li><a href="#"><i
                                                                    class="icol-color-swatch-1"></i> <?php echo $IdSpecVrednostiIme; ?>
                                                            </a></li>
                                                        <!--<li><a href="#"><i class="icol-font"></i> Font Size</a></li>
                                                        <li><a href="#"><i class="icol-html"></i> HTML Version</a></li>-->
                                                    <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><a href="/admin/str/dodajspecchild/<?php echo $IdSpecGrupe; ?>">Dodaj Specifikaciju
                                            za <?php echo $ImeSpecGrupe; ?> </a></td>
                                    <td><a href="/admin/str/editgrupuspec/<?php echo $IdSpecGrupe; ?>">Edituj
                                            kategoriju <?php echo $ImeSpecGrupe; ?> </a></td>


                                    <td class="align-center"><span class="btn-group">
                            <a data-original-title="Obrisi"
                               href="/akcija.php?action=obrisispeckategorije&id=<?php echo $IdSpecGrupe; ?>"
                               class="btn btn-md bs-tooltip " title=""><i class=" icon-trash"></i></a>
                            </span></td>

                                </tr>
                                <?php
                            }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>