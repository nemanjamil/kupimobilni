<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 1.8.15.
 * Time: 11.54
 */

$db->join("tagovikategorija  B", "A.KategorijaArtikalaId = B.IdTagoviKategorija", "");
$db->join("tagovi  C", "B.IdOdTagova = C.TagoviId", "");
$db->where("A.KategorijaArtikalaId ", $id);
$products = $db->get("kategorijeartikala  A", null, "C.TagoviId, C.TagoviIme,CONCAT('osnovni') AS osnovni");


/*foreach ($products as $key => $value){
    $ar[value] = $value[TagoviId];
    $ar[text] = $value[TagoviIme];
    $ar[continent] = $value['osnovni'];
}
$df = $common->array_2_csv_sa_dodatkomnavodnika($products);

var_dump($df);*/

$zaOsnovno = json_encode($products, JSON_HEX_APOS | JSON_HEX_QUOT);


$db->join("pdvkategzemlja P", "P.IdKategPdvKatZem = K.KategorijaArtikalaId", "LEFT");
$db->where("K.KategorijaArtikalaId", $id);
$kat = $db->getOne("kategorijeartikala K", null, "K.*, P.IdZemljePdvKatZem, P.PdvKategZemlja");

$KategorijaArtikalaId = $kat['KategorijaArtikalaId'];
$ParentKategorijaArtikalaId = $kat['ParentKategorijaArtikalaId'];
$KategorijaArtikalaOpis = $kat['KategorijaArtikalaOpis'];
$KategorijaArtikalaLink = $kat['KategorijaArtikalaLink'];

$KategorijaArtikalaActive = $kat['KategorijaArtikalaActive'];
$katAkt = ($KategorijaArtikalaActive) ? 'checked' : '';

$KategYouMayAlso = $kat['KategYouMayAlso'];
$katAktYouMay = ($KategYouMayAlso) ? 'checked' : '';

$KategorijaArtikalaMesto = $kat['KategorijaArtikalaMesto'];
$TipKatUnit = $kat['TipKatUnit'];
$MinimalnaKol = $kat['MinimalnaKol'];

$KategorijaArtikalaKratak = $kat['KategorijaArtikalaKratak'];
$KategorijaArtikalaSlika = $kat['KategorijaArtikalaSlika'];
$KategorijeRabat = $kat['KategorijeRabat'];

$KategorijeRabartAktivan = $kat['KategorijeRabartAktivan'];
$katRabAkt = ($KategorijeRabartAktivan) ? 'checked' : '';

$KategorijeVidljivZaMP = $kat['KategorijeVidljivZaMP'];
$katVidAkt = ($KategorijeVidljivZaMP) ? 'checked' : '';

$KategorijeVidljivZaMP;
$KategorijePDV = $kat['KategorijePDV'];


//dodato 26.01.2016.
$Katsrblat = $kat['Katsrblat'];
$Katsrb = $kat['Katsrb'];
$PdvKategZemlja = $kat['PdvKategZemlja'];

$OpisKatTekstsrblat = $kat['OpisKatTekstsrblat'];
$OpisKatTekstsrb = $kat['OpisKatTekstsrb'];


?>
<div class="row">
    <!--=== KATEGORIJE ===-->
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">

                <h4><i class="icon-edit"></i> Edit Kategorije</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <?php $imekategUpit = $adminfunkc->getKatodID($id); ?>

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1"
                      action="/akcija.php?action=editujKategZasebno">

                    <input type="hidden" id="jsonTag" value="<?php echo $zaOsnovno; ?>">
                    <input type="hidden" name="id" id="idodKateg" value="<?php echo $KategorijaArtikalaId; ?>">

                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("NazivKategorije");
                        $db->where('IdKategorije', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("kategorijeartikalanaslov", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['NazivKategorije'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Naziv Opis ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="NazivKategorije[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorija Link <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="KategorijaArtikalaLink"
                                   value="<?php echo $KategorijaArtikalaLink; ?>" class="form-control required ">
                            <!-- izbacili smo url u klasi-->
                        </div>
                    </div>

                    <!--
                    <div class="form-group">
                        <label class="col-md-2 control-label">PDV <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="KategorijePDV" value="<?php /*echo $KategorijePDV; */ ?>"
                                   class="form-control  digits" maxlength="2" placeholder="Npr. Srbija=20, ">
                        </div>
                    </div>
-->

                    <div class="form-group">
                        <label class="col-md-2 control-label">Aktivna Kategorija <span class="required">*</span></label>

                        <div class="col-md-10">
                            <label class="checkbox">
                                <div class="checker"><span>
                                        <input name="KategorijaArtikalaActive" <?php echo $katAkt; ?> class="uniform"
                                               type="checkbox">
                                    </span></div>
                                - </label>
                            <label for="KategorijaArtikalaActive" class="has-error help-block" generated="true"
                                   style="display:none;"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Aktivna Kategorija You May Also Like -> Preporucene
                            Kategorije<span class="required">*</span></label>

                        <div class="col-md-10">
                            <label class="checkbox">
                                <div class="checker"><span>
                                        <input name="KategYouMayAlso" <?php echo $katAktYouMay; ?> class="uniform"
                                               type="checkbox">
                                    </span></div>
                            </label>
                             <span class="help-block">Ovo je da se kategorija vidi kao preporucena. Trebalo bi napraviti stored proceduru koja izbacuje kategorije u kojoj su artikli najvise gledani</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Mesto <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="number" name="KategorijaArtikalaMesto"
                                   value="<?php echo $KategorijaArtikalaMesto; ?>" class="form-control digits">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label class="col-md-2 control-label">Minimalna kolicina <span
                                    class="required">*</span></label>

                            <div class="col-md-10">
                                <input type="text" name="MinimalnaKol" id="MinimalnaKol"
                                       class="form-control digits required" maxlength="3"
                                       value="<?php echo $MinimalnaKol; ?>" placeholder="od 1 do 50 kg">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Jedinica mere <span class="required">*</span></label>

                        <div class="col-md-10">

                            <select class="form-control required" name="TipKatUnit"
                                    value="<?php echo $TipKatUnit ?> " id="TipKatUnit">
                                <option value=""></option>

                                <?php
                                $data = $db->get('unit');
                                foreach ($data as $sds => $s) {
                                    $IdUnit = $s[IdUnit];
                                    $TipUnit = $s[TipUnit];
                                    $selektovano = ($TipKatUnit == $IdUnit) ? 'selected' : '';

                                    ?>
                                    <option
                                        value="<?php echo $IdUnit; ?>" <?php echo $selektovano ?>><?php echo $TipUnit; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Rabat <span class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="number" name="KategorijeRabat" value="<?php echo $KategorijeRabat; ?>"
                                   class="form-control digits">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Rabat Aktivan <span class="required">*</span></label>

                        <div class="col-md-10">
                            <label class="checkbox">
                                <div class="checker">
                                    <input name="KategorijeRabartAktivan" <?php echo $katRabAkt; ?> class="uniform"
                                           type="checkbox">
                                </div>

                            </label>

                            <span class="help-block">Ne radi!!!. Ako dajemo dodatni rabat na samoj kategoriji. Pitanje, da li ako se ovaj rabat
                            aktivira da li se rabati svih korisnika neutralisu pa se samo ovaj rabat racuna</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorija vidljiv za MP <span
                                class="required">*</span></label>

                        <div class="col-md-10">
                            <label class="checkbox">
                                <div class="checker"><span>
                                        <input name="KategorijeVidljivZaMP" <?php echo $katVidAkt; ?> class="uniform"
                                               type="checkbox">
                                    </span></div>
                                - </label>
                            <label for="KategorijeVidljivZaMP" class="has-error help-block" generated="true"
                                   style="display:none;"></label>
                        </div>
                    </div>

                    <!--
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kratak opis kategorije <span
                                class="required">*</span></label>

                        <div class="col-md-10">
                            <input type="text" name="KategorijaArtikalaKratak"
                                   value="<?php /*echo $KategorijaArtikalaKratak; */ ?> " class="form-control required">
                        </div>
                    </div>
-->

                    <!--Multi slike-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorija Slika</label>

                        <div class="col-md-4">
                            <input type="file" name="slikeMultiple"
                                   class="with-preview accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                        <div class="col-md-5">

                            <?php

                            $lokrel = $common->locationslikaOstalo(KATSLIKELOK, $KategorijaArtikalaId);

                            $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                            $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

                            //$mala_slika = $fileName . '_172.' . $ext;
                            $mala_slika = $fileName . '.' . $ext;

                            //$lok = $lok = DCROOT . $lokrel . '/' . $mala_slika;
                            $lok =   $lok = DCROOT.'/'.KATSLIKELOK.'/'.$mala_slika;

                            if (file_exists($lok)) {
                                echo '<img src="/' .  KATSLIKELOK . '/' . $mala_slika . '" alt="">';
                            }

                            ?>

                        </div>
                    </div>


                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("TekstKategorije");
                        $db->where('IdKategorije', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("kategorijeartikalatekst", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['TekstKategorije'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Veliki Opis ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<textarea rows=35  name="OpisArtikliTekstovi[' . $IdLanguage . ']" class="form-control mceEditor">' . $OpisArtikla . '</textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';

                    endforeach;

                    echo $naziv;

                    ?>



                    <?php

                    $naziv = '';
                    $data = $db->get('zemlja');

                    foreach ($data as $sds => $s):
                        $ImeZemlja = $s['ImeZemlja'];
                        $IdZemlja = $s['IdZemlja'];

                        if ($IdZemlja == 2 || $IdZemlja == 3 || $IdZemlja == 4) {
                            continue;
                        }


                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Porez za ' . $ImeZemlja . '</label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<select class="form-control required" name="porez[' . $IdZemlja . ']">';
                        $data = $db->get('pdvlistaporeza');
                        foreach ($data as $sds => $s) {
                            $IdPdvListaPoreza = $s['IdPdvListaPoreza'];
                            $PorezVrednost = $s['PorezVrednost'];
                            // provera koji je porez
                            $db->where("IdKategPdvKatZem", $KategorijaArtikalaId);
                            $db->where("IdZemljePdvKatZem", $IdZemlja);
                            $user = $db->getOne("pdvkategzemlja");
                            $idPorez = $user['PdvKategZemlja'];
                            $selektovano = ($idPorez == $IdPdvListaPoreza) ? 'selected' : '';
                            $naziv .= '<option value="' . $IdPdvListaPoreza . '" ' . $selektovano . '>' . $PorezVrednost . '</option>';
                        }
                        $naziv .= '</select>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;
                    echo $naziv;

                    ?>


                    <div class="form-actions">
                        <input type="submit" value="Validate Me" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>

    <!--=== SPECIFIKACIJA KATEGORIJE ===-->
    <div class="col-md-12">
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
                        <th class="checkbox-column">
                            <input type="checkbox" class="uniform">
                        </th>
                        <th>First Name</th>
                        <th>Last Name</th>

                        <th>Status</th>
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

                    /*$db->join("speckategorija sk", "kat.KategorijaArtikalaId = sk.IdSpecKategorija");
                    $db->join("specifikacijagrupe sg", "sk.IdGrupeSpecKategorija = sg.IdSpecGrupe");
                    $db->groupBy("sg.IdSpecGrupe");
                    $specKateg = $db->get("kategorijeartikala kat", null, "sg.IdSpecGrupe, sg.ImeSpecGrupe ");*/

                    $cols = Array("SG.IdSpecGrupe", "SG.OtvZarvSpecGrupe", "SGN.NazivSpecGrupe");
                    $db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
                    //$db->join("specvrednosti SV", "SG.IdSpecGrupe = SV.IdSpecVrednostiGrupe");
                    $db->groupBy("SG.IdSpecGrupe");
                    $specKateg = $db->get("specifikacijagrupe SG", null, $cols);


                    if ($specKateg) {
                        foreach ($specKateg as $kat => $val) {
                            $IdSpecGrupe = $val['IdSpecGrupe'];
                            $ImeSpecGrupe = $val['NazivSpecGrupe'];

                            if (is_array($arrsta)) {
                                $cekiKat = (in_array($IdSpecGrupe, $arrsta)) ? 'checked' : '';
                            }

                            /* $db->join("specvrednosti sv", "sg.IdSpecGrupe = sv.IdSpecVrednostiGrupe");
                             $db->where("sg.IdSpecGrupe", $IdSpecGrupe);
                             $products = $db->get("specifikacijagrupe sg", null, "sv.IdSpecVrednosti, sv.IdSpecVrednostiIme");*/


                            $cols = Array("SV.IdSpecVrednosti", "SVN.SpecVredNaziv");
                            $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
                            $db->where("SV.IdSpecVrednostiGrupe", $IdSpecGrupe);
                            $db->orderBy('SpecVredNaziv', "ASC");
                            $products = $db->get("specvrednosti SV", null, $cols);


                            ?>
                            <tr>
                                <td class="checkbox-column">
                                    <input type="checkbox" class="uniform">
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                            <i class="icol-cog"></i> <?php echo $ImeSpecGrupe; ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if ($products) {
                                                foreach ($products as $kljuc => $vrednost) {
                                                    $IdSpecVrednosti = $vrednost['IdSpecVrednosti'];
                                                    $IdSpecVrednostiIme = $vrednost['SpecVredNaziv'];
                                                    ?>
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
                                <td><a href="/admin/str/dodajspecchild/<?php echo $IdSpecGrupe; ?>">Dodaj
                                        Specifikaciju za <?php echo $ImeSpecGrupe; ?> </a></td>

                                <td>
                                    <input type="checkbox" kojaGrupa="<?php echo $IdSpecGrupe; ?>"
                                           class="kategDodaj" <?php echo $cekiKat; ?> />
                                </td>
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