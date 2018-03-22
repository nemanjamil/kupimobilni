<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 03.8.15.
 * Time: 16:37
 */
?>


<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Dodaj Artikal</h4>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajartikal">

                    <input type="hidden" name="idkategorijeDodajArtikal" id="idkategorijeDodajArtikal">

                    <!--Ime artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ime artikla za bazu </label>

                        <div class="col-md-10">
                            <input type="text" name="imeartikla" id="imeartikla" class="form-control required"
                                   required="required">
                        </div>
                    </div>
                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Ime artikla ' . $ShortLanguage . ' </label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="ArtNaz' . $ShortLanguage . '" class="form-control required" value="' . $link['ArtNaz' . $ShortLanguage] . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>

                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        if ($IdLanguage == 2 || $IdLanguage == 3 || $IdLanguage == 4) {
                            continue;
                        }

                        $cols = Array("OpisArtikla");
                        $db->where('ArtikalId', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("artikalnazivnew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['OpisArtikla'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Ime artikla New ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="artNazivNew[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>


                    <!--koji je uSer-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitenti</label>

                        <div class="col-md-10">

                            <select id="komitentId" name="KomitentId"
                                    class="select2 required full-width-fix">
                                <?php

                                $data = $db->get('komitenti');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['KomitentId'] . '|' . $s['KomitentKolona'] . '">' . $s['KomitentIme'] . ' ' . $s['KomitentPrezime'] .  ' - ' . $s['KomitentNaziv'] . '</option>' . "\n";
                                }

                                ?>
                            </select>

                        </div>
                    </div>

                    <!--Sifra artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Sifra artikla</label>

                        <div class="col-md-10">
                            <input type="text" name="sifraartikla" class="form-control digits">
                        </div>
                    </div>


                    <!--Kategorija artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorije MENI</label>

                        <div class="col-md-3">
                            <div><a id="expandAllBtnDodaj" href="#" onclick="return false;">Expand All Nodes</a></div>
                        </div>

                        <div class="col-md-7">

                            <div class="zTreeDemoBackground left">
                                <ul id="treeDemoDodajArtikal" class="ztree"></ul>
                            </div>

                        </div>
                    </div>

                    <!--Kategorija artikla Lista-->
                   <!-- <div class="form-group">
                        <label class="col-md-2 control-label">Kategorije Artikala Lista</label>


                        <div class="col-md-10">
                            <select id="KategorijeArtikalaId" name="KategorijeArtikalaId"
                                    class="select2 full-width-fix">
                                <option value=""></option>
                                <?php
/*                                $svekatmasine = SVEKATEGORIJEMASINE;
                                $cols1 = Array("KN.NazivKategorije", "K.KategorijaArtikalaId");
                                $db->join("kategorijeartikalanaslov KN", "KN.IdKategorije = K.KategorijaArtikalaId");
                                $db->where("KN.IdLanguage = 5 AND K.KategorijaArtikalaId IN ($svekatmasine) ORDER BY KN.NazivKategorije ASC");
                                $data1 = $db->get('kategorijeartikala K', null, $cols1);

                                foreach ($data1 as $sds => $s) {
                                    $KategorijaArtikalaId = $s['KategorijaArtikalaId'];
                                    $NazivKategorije = $s['NazivKategorije'];
                                    $selektovano = ($TipKatUnitArt == $KategorijaArtikalaId) ? 'selected' : '';

                                    */?>
                                    <option
                                        value="<?php /*echo $KategorijaArtikalaId; */?>" <?php /*echo $selektovano */?>><?php /*echo $NazivKategorije; */?></option>
                                <?php /*} */?>

                            </select>
                        </div>
                    </div>-->


                    <!--Brend artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Brend</label>

                        <div class="col-md-10">
                            <select id="brendartikla" name="brendartikla"
                                    class="select2 full-width-fix">
                                <option value=""></option>
                                <?php
                                $cols = Array("B.BrendId", "BI.BrendIme", "B.BrendSajt");
                                $db->join("brendoviime BI", "BI.BrendId = B.BrendId");
                                $db->where("BI.IdLanguage = 5 AND B.BrendSajt = 1");
                                $data = $db->get('brendovi B', null, $cols);
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['BrendId'] . '" selected="selected">' . $s['BrendIme'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--Dostupnst-->
                    <div class="form-group required">
                        <label class="col-md-2 control-label ">Dostupnost:</label>

                        <div class="col-md-10">
                            <input type="radio" id="hide" checked name="ArtikalAktivan" value="0"
                                ><label> &nbsp;Nije aktivan artikal</label>
                            <br>
                            <input type="radio" id="hide1" name="ArtikalAktivan" value="1"
                                ><label> &nbsp;Odmah dostupno</label>
                            <br>
                            <input type="radio" id="show" name="ArtikalAktivan" value="2"
                                ><label> &nbsp;Uskoro</label>
                            <br>
                        </div>
                    </div>

                    <!--Dostupno od-->
                    <div class="form-group" id="uskoro" class="strip">

                        <label class="col-md-2 control-label">Dostupno od:</label>

                        <div class="col-md-4">
                            <input type="text" id="datepicker" name="ArtikalDostupnoOd" class="form-control datepicker"
                                   placeholder="31/12/2020">

                        </div>
                    </div>
                    <!--Svuda je bilo col-md-2, ali s obzirom da vise nemamo Valutu, promenjeno je na col-md-4-->

                    <!--Cene artikla-->
                    <div class="form-group" id="cena" class="strip">
                        <label class="col-md-2 control-label">Cena VP</label>

                        <div class="col-md-4">
                            <input name="cenavpartikla" class="form-control" step="0.1" min="0" type="number">
                        </div>

                        <label class="col-md-2 control-label">Cena MP</label>

                        <div class="col-md-4">
                            <input name="cenampartikla" class="form-control" step="0.1" min="0" type="number">
                        </div>

                        <!--<label class="col-md-2 control-label">Valuta</label>-->

                        <!-- <div class="col-md-2">
                            <select id="valutaartikla" name="valutaartikla" class="form-control required">
                                <?php
                        /*                                $data = $db->get('valuta');
                                                        foreach ($data as $sds => $s) {
                                                            echo '<option value="' . $s[ValutaId] . '" selected="selected">' . $s[ValutaNaziv] . '</option>' . "\n";
                                                        }
                                                        */ ?>
                            </select>
                        </div>-->
                    </div>

                    <!--Artikal Stanje -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Artikal stanje </label>

                        <div class="col-md-10">

                            <input type="number" name="ArtikalStanje" value="0" min="0"
                                   class="form-control digits required">

                            <span class="help-block">Koliko ima artikala na stanju ili ce biti raspolozivo</span>
                        </div>
                    </div>

                    <!--Minimalna kolicina-->
                    <div class="form-group">
                        <div>
                            <label class="col-md-2 control-label">Minimalna kolicina <span
                                    class="required"></span></label>

                            <div class="col-md-10">
                                <input type="text" name="MinimalnaKolArt" id="MinimalnaKolArt"
                                       class="form-control digits required" maxlength="3" placeholder="od 1 do 50 kg">
                            </div>
                        </div>
                    </div>

                    <!--Jedinica mere-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Jedinica mere <span class="required"></span></label>

                        <div class="col-md-10">

                            <select class="form-control required" name="TipKatUnitArt" id="TipKatUnitArt">
                                <option value=""></option>

                                <?php
                                $data = $db->get('unit');
                                foreach ($data as $sds => $s) {
                                    $IdUnit = $s['IdUnit'];
                                    $TipUnit = $s['TipUnit'];
                                    $selektovano = ($TipKatUnitArt == $IdUnit) ? 'selected' : '';

                                    ?>
                                    <option
                                        value="<?php echo $IdUnit; ?>" <?php echo $selektovano ?>><?php echo $TipUnit; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!--Barkod artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Barkod</label>

                        <div class="col-md-10">
                            <input type="text" name="barkodartikla" class="form-control digits" min="5">
                        </div>
                    </div>

                    <!--Artikal na akciji-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Artikal na akciji</label>

                        <div class="col-md-10">
                            <select id="ArtikalNaAkciji" name="ArtikalNaAkciji"
                                    class="form-control required full-width-fix">

                                <option value="0" <?php echo ($ArtikalNaAkciji == 0) ? 'selected' : ''; ?> > Ne</option>
                                <option value="1" <?php echo ($ArtikalNaAkciji == 1) ? 'selected' : ''; ?> > Akcija AGRO sajt</option>
                                <option value="2" <?php echo ($ArtikalNaAkciji == 2) ? 'selected' : ''; ?> > Najprodavaniji AGRO sajt </option>
                                <option value="3" <?php echo ($ArtikalNaAkciji == 3) ? 'selected' : ''; ?> > Rasprodaja AGRO sajt </option>
                                <option value="6" <?php echo ($ArtikalNaAkciji == 6) ? 'selected' : ''; ?> > Super ponuda MASINE sajt </option>
                                <option value="7" <?php echo ($ArtikalNaAkciji == 7) ? 'selected' : ''; ?> > Novi Proizvodi MASINE sajt </option>
                                <option value="8" <?php echo ($ArtikalNaAkciji == 8) ? 'selected' : ''; ?> >Najprodavaniji MASINE sajt </option>

                            </select>
                        </div>
                    </div>

                    <!--Marza artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Marza</label>

                        <div class="col-md-10">
                            <select id="marzaartikla" name="marzaartikla"
                                    class="form-control full-width-fix">
                                <?php
                                $data = $db->get('marza');
                                foreach ($data as $sds => $s) {
                                    // selected="selected"
                                    echo '<option value="' . $s['MarzaId'] . '" >' . $s['MarzaMarza'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--URL artikla-->
                    <!--<div class="form-group">
                        <label class="col-md-2 control-label">URL</label>

                        <div class="col-md-10">
                            <input type="text" name="urlartikla" id="urlartikla" class="form-control required" value="">
                        </div>

                    </div>-->

                    <!--Tagovi-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tagovi</label>

                        <div class="col-md-10">
                            <input type="text" id="tagime" name="tagime" class="form-control required" value="">
                        </div>

                    </div>

                    <!--Multi slike-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Multi slike</label>

                        <div class="col-md-10">
                            <!-- MultiFile http://www.jqueryrain.com/?XCHylIho -->
                            <!-- maxsize-1024 - ukupno fajlove ne sme da predje 1Mb-->
                            <input type="file" multiple="multiple" name="slikeMultiple[]" maxlength="10"
                                   class="multi with-preview max-3 accept-gif|jpg|png fileIgnorisi"/>

                        </div>
                    </div>

                    <!--Kratak opis artikla za tabelu artikli-->
                    <!--     <div class="form-group">
                             <label class="col-md-2 control-label ">Kratak opis  <strong>SRB</strong> tabela Artikli</label>

                             <div class="col-md-10">

                                 <input type="text" id="ArtikalKratakOpis" name="ArtikalKratakOpis" class="form-control ">
                             </div>
                         </div>
     -->

                    <?php
                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label">Kratak opis <b>' . $ShortLanguage . ' </b> (iznad cene)</label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtikalKratakOpis' . $ShortLanguage . '" name="ArtikalKratakOpis' . $ShortLanguage . '" class="form-control required" value="' . $link['ArtikalKratakOpis' . $ShortLanguage] . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;
                    ?>

                    <?php
                    $nazivOp = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];

                        $nazivOp .= '<div class="form-group">';
                        $nazivOp .= '<label class="col-md-2 control-label">Veliki Opis <b>' . $ShortLanguage . '</b> (opis artikla)</label>';
                        $nazivOp .= '<div class="col-md-10">';
                        $nazivOp .= '<textarea rows="5" name="OpisArtikliTekstovi' . $ShortLanguage . '" class="form-control required mceEditor">' . $link['OpisArtikliTekstovi' . $ShortLanguage] . '</textarea>';
                        $nazivOp .= '</div>';
                        $nazivOp .= '</div>';

                    endforeach;

                    echo $nazivOp;
                    ?>


                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj artikal" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- /Page Content -->
