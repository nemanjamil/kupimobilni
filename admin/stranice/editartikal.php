<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 5:04 PM

 */


//require_once('ubaciNaziveArtNew.php');

//var_dump($jezikId);



$cols = Array("A.*", "M.MarzaMarza", "K.KomitentiValuta","KAN.NazivKategorije");

$db->join("kategorijeartikala KA", "KA.KategorijaArtikalaId = A.KategorijaArtikalId");
$db->join("kategorijeartikalanaslov KAN", "KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId");

$db->join("brendovi B", "B.BrendId = A.ArtikalBrendId");
$db->join("marza M", "M.MarzaId = A.ArtikalMarzaId");
$db->join("komitenti K", "K.KomitentId = A.ArtikalKomitent");

$db->join("unit UN", "UN.IdUnit = A.TipKatUnitArt", "LEFT");
$db->join("tipunitnew TUN", "TUN.IdTipUnit = UN.IdUnit AND TUN.IdLanguage = $jezikId", "LEFT");


$db->where("A.ArtikalId", $id);
$links = $db->get("artikli A", null, $cols);

foreach ($links as $link) {


    $ArtikalId = $link['ArtikalId'];
    $ArtikalNaziv = $link['ArtikalNaziv'];
    $ArtikalKategorija = $link['KategorijaArtikalId'];
    $ArtikalBrendId = $link['ArtikalBrendId'];
    $ArtikalVPCena = $link['ArtikalVPCena'];
    $ArtikalMPCena = $link['ArtikalMPCena'];
    $ArtikalKratakOpis = $link['ArtikalKratakOpis'];
    $ArtikalBarkod = $link['ArtikalBarKod'];
    $ArtikalSifra = $link['ArtikalSifra'];
    $ArtikalNaAkciji = $link['ArtikalNaAkciji'];
    $ArtikalMarza = $link['ArtikalMarzaId'];
    $ArtikalURL = $link['ArtikalLink'];
    $ArtikalKomitent = $link['ArtikalKomitent'];
    $KategorijaArtikalaNaziv = $link['NazivKategorije'];
    $KomitentiValuta = $link['KomitentiValuta'];
    $ArtikalStanje = $link['ArtikalStanje'];
    $OpisArtikliTekstovi = $link['OpisArtikliTekstovi'];
    $ArtikalAktivan = $link['ArtikalAktivan'];
    $MinimalnaKolArt = $link['MinimalnaKolArt'];
    $TipKatUnitArt = $link['TipKatUnitArt'];
    $ArtikalDostupnoOd = $link['ArtikalDostupnoOd'];
    $artAkt = ($ArtikalAktivan) ? 'checked' : '';

    //naknadno dodato
    $ArtNazsrb = $link['ArtNazsrblat'];
    $ArtikalKratakOpissrblat = $link['ArtikalKratakOpissrblat'];
    $OpisArtikliTekstovisrblat = $link['OpisArtikliTekstovisrblat'];

    $ArtikalReklamaTekst = $link['ArtikalReklamaTekst'];



// tagovi
    $cols = Array("T.TagoviIme");
    $db->join("tagovi T", "T.TagoviId = TA.IdOdTagovaArt");
    $db->where("TA.IdTagoviArtikli", $id);
    $tagoviArtupit = $db->get('tagoviartikli TA', null, $cols);
    if ($tagoviArtupit) {
        $tagoviArt = $common->array_2_csv_sa_dodatkomnavodnika($tagoviArtupit);
    }

    // CODE
    $codebosch = $link['CodeBosch'];
    $codeboschlink = $link['CodeBoschLink'];

    $codelumen = $link['codelumen'];
    $codelumenlink = $link['codelumenlink'];

    $codevermax = $link['codevermax'];
    $codevermaxlink = $link['codevermaxlink'];


    $codeagro = $link['codeagro'];


    $cols = Array("ArtikalIdPoklon");
    $db->where("ArtikalIdGlavni", $id);
    $linksPoklon = $db->get("poklonartikli", null, $cols);
    $comma_separatedPoklon = [];
    if ($linksPoklon) {
        foreach ($linksPoklon AS $kp => $vp) {
            $comma_separatedPoklon[] = $vp['ArtikalIdPoklon'];
        }
        $comma_separatedPoklon = implode(",", $comma_separatedPoklon);
    }


}

?>
<!--=== Page Content ===-->

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Izmeni Artikal: <?php echo $ArtikalNaziv; ?></h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=editartikal">


                    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
                    <input type="hidden" name="idkategorijeDodajArtikal" id="idkategorijeDodajArtikal" value="<?php echo $ArtikalKategorija; ?>">


                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("OpisArtikla");
                        $db->where('ArtikalId', $id);
                        $db->where('IdLanguage', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("artikalnazivnew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['OpisArtikla'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Ime artikla New TEST ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="artNazivNew[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
                        $naziv .= '</div>';
                        $naziv .= '</div>';
                    endforeach;

                    echo $naziv;

                    ?>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitenti</label>

                        <div class="col-md-10">
                            <select id="komitentId" name="KomitentId"
                                    class="select2 required full-width-fix">
                                <?php
                                $data = $db->get('komitenti', null, 'KomitentId,KomitentIme,KomitentPrezime,KomitentKolona');
                                foreach ($data as $sds => $s) {
                                    $selkom = ($ArtikalKomitent == $s['KomitentId']) ? 'selected' : '';
                                    echo '<option value="' . $s['KomitentId'] . '|' . $s['KomitentKolona'] . '"  ' . $selkom . '>' . $s['KomitentIme'] . ' ' . $s['KomitentPrezime'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <!--Kategorija artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kategorije MENI</label>

                        <div class="col-md-5">
                            <div><strong>Pripada kategoriji :</strong>
                                <span class="red">
                                    <b>
                                        <a target="_blank"
                                           href="<?php echo DPROOTADMIN . '/kat/' . $ArtikalKategorija; ?>">
                                            <?php echo $KategorijaArtikalaNaziv; ?>
                                        </a>
                                    </b>
                                </span>
                            </div>
                            <div><a id="expandAllBtn" href="#" onclick="return false;">Expand All Nodes</a></div>
                        </div>
                        <div class="col-md-5">
                            <div class="zTreeDemoBackground left">
                                <ul id="treeDemoEditArtikal" class="ztree"></ul>
                            </div>
                        </div>
                    </div>


                    <!--Kategorija artikla ZDRAVLJE-->
                    <!--                    <div class="form-group">
                                            <label class="col-md-2 control-label">Kategorije ZDRAVLJE</label>

                                            <div class="col-md-3">-->
                    <!--<div><strong>Pripada kategoriji za Zdravlje : </strong> <span
                                    class="red"><?php /*echo $KategorijaArtikalaNaziv; */ ?> </span></div>
                            <div><a id="expandAllBtn" href="#" onclick="return false;">Expand All Nodes</a></div>-->
                    <!--</div>
                    <div class="col-md-7">
                        <div class="zTreeDemoBackground left">
                            <ul id="treeHeadZdravljeArtEdit" class="ztree"></ul>
                        </div>
                    </div>
                </div>-->

                    <!--Specifikacije artikala-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Specifikacije Artikala</label>

                        <div class="col-md-10" id="spefikacijeArtikala">
                            <ul class="list-unstyled">
                                <?php
                                //$db->setTrace(true);
                                //var_dump($db->trace);
                                $cols = Array("SG.IdSpecGrupe", "SGN.NazivSpecGrupe");
                                $db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SK.IdGrupeSpecKategorija");
                                $db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
                                $db->where("SK.IdSpecKategorija", $ArtikalKategorija);
                                $groups = $db->get("speckategorija SK", null, $cols);

                                $e = '';
                                foreach ($groups as $key => $value) {
                                    $ImeSpecGrupe = $value['NazivSpecGrupe'];
                                    $IdSpecGrupe = $value['IdSpecGrupe'];


                                    $upitRaw = "SELECT
                                SV.IdSpecVrednosti,
                                SVN.SpecVredNaziv,
                                    IF(
                                    IdSpecArtikalPovIme = SV.IdSpecVrednosti,
                                    'selected',
                                    ''
                                    ) AS selektovano
                                FROM
                                specvrednosti SV
                                    JOIN specvrednaziv SVN ON SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId
                                    LEFT JOIN
                                    (SELECT
                                    SP.IdSpecArtikalPovIme
                                    FROM
                                    specartikalpov SP
                                    WHERE SP.IdSpecArtikalGrupaPove = $IdSpecGrupe
                                    AND SP.IdSpecArtikalPov = $id) mm
                                    ON mm.IdSpecArtikalPovIme = SV.IdSpecVrednosti
                                WHERE IdSpecVrednostiGrupe = $IdSpecGrupe";

                                    $specUpit = $db->rawQuery($upitRaw);
                                    $e .= '<li>';
                                    $e .= '<div><strong>' . $ImeSpecGrupe . '</strong></div>';
                                    $e .= '<div class="specOdvoj">';
                                    $e .= '<select id="group_' . $IdSpecGrupe . '" class="form-control" name="spec[]">';
                                    $e .= '<option value=""></option>';
                                    foreach ($specUpit as $k => $v) {
                                        $IdSpecVrednosti = $v['IdSpecVrednosti'];
                                        $IdSpecVrednostiIme = $v['SpecVredNaziv'];
                                        $selektovano = $v['selektovano'];
                                        $sel = ($selektovano) ? 'selected="selected"' : '';
                                        $e .= '<option value="' . $IdSpecVrednosti . '" ' . $sel . '>' . $IdSpecVrednostiIme . '</option>';
                                    }
                                    $e .= '</select>';
                                    $e .= '</div>';
                                    $e .= '</li>';
                                }
                                echo $e;
                                ?>
                            </ul>
                        </div>
                    </div>


                    <!--Brend artikla-->
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Brend</label>

                        <div class="col-md-10">
                            <select id="brendartikla" name="brendartikla"
                                    class="select2 full-width-fix" value="<?php echo $ArtikalBrend ?>">
                                <option value=""></option>
                                <?php
                                $cols = Array("B.BrendId", "BI.BrendIme", "B.BrendSajt");
                                $db->join("brendoviime BI", "BI.BrendId = B.BrendId");
                                $db->where("BI.IdLanguage = 5");
                                $data = $db->get('brendovi B', null, $cols);
                                foreach ($data as $key => $value) {
                                    $BrendId = $value['BrendId'];
                                    $BrendIme = $value['BrendIme'];
                                    $selektovano = ($ArtikalBrendId == $BrendId) ? 'selected' : '';
                                    echo '<option value="' . $BrendId . '" ' . $selektovano . '>' . $BrendIme . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--Dostupnst-->
                    <div class="form-group required">
                        <label class="col-md-2 control-label ">Dostupnost:</label>
                        <div class="col-md-10">
                            <input id="hide" type="radio" name="ArtikalAktivan"
                                   value="0" <?php echo ($ArtikalAktivan == 0) ? 'checked' : ''; ?>><label> &nbsp;Nije
                                aktivan artikal</label>
                            <br>
                            <input id="hide1" type="radio" name="ArtikalAktivan"
                                   value="1" <?php echo ($ArtikalAktivan == 1) ? 'checked' : ''; ?>><label> &nbsp;Odmah
                                dostupno</label>
                            <br>
                            <input id="show" type="radio" name="ArtikalAktivan"
                                   value="2" <?php echo ($ArtikalAktivan == 2) ? 'checked' : ''; ?>><label>
                                &nbsp;Uskoro</label>
                            <br>
                        </div>
                    </div>
                    <!--Dostupno od-->
                    <div class="form-group" id="uskoro">

                        <label class="col-md-2 control-label">Dostupno od:</label>

                        <div class="col-md-4">
                            <input type="text" id="datepicker" name="ArtikalDostupnoOd" class="form-control datepicker"
                                   value="<?php echo $ArtikalDostupnoOd ?>">

                        </div>
                    </div>
                    <!--Cene artikla -->
                    <div class="form-group" id="cena" class="strip">
                        <label class="col-md-2 control-label">Cena VP</label>

                        <div class="col-md-4">
                            <input name="cenavpartikla" class="form-control" step="0.1" min="0" type="number"
                                   value="<?php echo $ArtikalVPCena ?>">
                        </div>

                        <label class="col-md-2 control-label">Cena MP</label>

                        <div class="col-md-4">
                            <input name="cenampartikla" class="form-control" step="0.1" min="0" type="number"
                                   value="<?php echo $ArtikalMPCena ?>">
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

                            <input type="number" name="ArtikalStanje" value="<?php echo $ArtikalStanje; ?>" min="0"
                                   class="form-control digits required">

                            <span class="help-block">Koliko ima artikala na stanju ili ce biti raspolozivo</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label class="col-md-2 control-label">Minimalna kolicina</label>

                            <div class="col-md-10">
                                <input type="text" name="MinimalnaKolArt" id="MinimalnaKolArt"
                                       class="form-control digits required" maxlength="3"
                                       value="<?php echo $MinimalnaKolArt; ?>" placeholder="od 1 do 50 kg">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Jedinica mere </label>

                        <div class="col-md-10">

                            <select class="form-control required" name="TipKatUnitArt"
                                    value="<?php echo $TipKatUnitArt ?> " id="TipKatUnitArt">
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
                            <input type="text" name="barkodartikla" class="form-control digits" min="5"
                                   value="<?php echo $ArtikalBarkod ?>">
                        </div>
                    </div>
                    <!--Sifra artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Sifra artikla</label>

                        <div class="col-md-10">
                            <input type="text" name="sifraartikla" class="form-control digits"
                                   value="<?php echo $ArtikalSifra ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Artikal na akciji</label>

                        <div class="col-md-10">
                            <select id="ArtikalNaAkciji" name="ArtikalNaAkciji"
                                    class="form-control full-width-fix">

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


                    <!--<div class="form-group">
                        <label class="col-md-2 control-label">Artikal Reklama tekst</label>
                        <div class="col-md-10">
                            <input type="text" name="ArtikalReklamaTekst" class="form-control" value="<?php /*echo $ArtikalReklamaTekst */ ?>">
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label class="col-md-2 control-label">Dodaj po zarezima ID artikle</label>

                        <div class="col-md-10">
                            <input type="text" name="poklonArikliIdjevi" class="form-control"
                                   value="<?php echo $comma_separatedPoklon ?>">
                        </div>
                    </div>


                    <!--Marza artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Marza</label>

                        <div class="col-md-10">
                            <select id="marzaartikla" name="marzaartikla"
                                    class="form-control required full-width-fix" value="<?php echo $ArtikalMarza ?>">
                                <option value=""></option>
                                <?php
                                $data = $db->get(' marza');
                                foreach ($data as $key => $value) {
                                    $MarzaId = $value['MarzaId'];
                                    $MarzaMarza = $value['MarzaMarza'];
                                    $selektovano = ($ArtikalMarza == $MarzaId) ? 'selected="selected"' : '';
                                    //
                                    echo '<option value="' . $MarzaId . '" ' . $selektovano . ' >' . $MarzaMarza . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <!--URL artikla-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">URL</label>

                        <div class="col-md-10">
                            <input type="text" name="urlartikla" id="urlartikla" class="form-control required"
                                   value="<?php echo $ArtikalURL ?>">
                        </div>
                    </div>

                    <!--Artikal Aktivan -->
                    <!--<div class="form-group">
                        <label class="col-md-2 control-label">Artikal aktivan </label>
                        <div class="col-md-10">
                            <label class="checkbox"><input <?php /*echo $artAkt */ ?> type="checkbox" name="ArtikalAktivan"
                                                                                 class="uniform"> Da li ce se uopste
                                videti na sajtu iako ima artikala na stanju</label>
                        </div>
                    </div>-->
                    <!--Multi slike-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Multi slike</label>

                        <div class="col-md-3">
                            <input type="file" multiple="multiple" name="slikeMultiple[]"
                                   class="multi with-preview accept-gif|jpg|png fileIgnorisi"/>
                        </div>

                        <!-- /Simple Table -->
                        <?php include 'artikalsliketabela.php' ?>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tagovi</label>

                        <div class="col-md-10">
                            <input type="text" id="tagime" name="tagime" class="form-control"
                                   value="<?php echo $tagoviArt; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="input18">MODELI</label>
                        <div class="col-md-10">
                            <select id="input18" class="select2-select-00 col-md-12 full-width-fix" multiple size="5">
                                <?php
                                $cols = Array("modeli_artikli.ModelId", "modeli.ModelNaziv");
                                $db->join("modeli", "modeli.ModelId = modeli_artikli.ModelId");
                                $db->where("modeli_artikli.ArtikalId", $id);
                                $upitModeliOdg = $db->get('modeli_artikli', null, $cols);
                                if ($upitModeliOdg) {
                                    foreach ($upitModeliOdg as $key => $value) {
                                        $ModelId = $value['Modeld'];
                                        $ModelNaziv = $value['ModelNaziv'];
                                        echo '<option value="' . $ModelId . '" selected="selected">' . $ModelNaziv . '</option>';;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <!--Kratak opis artikla-->
                    <?php
                    /*
                                        $naziv = '';
                                        foreach ($jezLan as $k => $v):
                                            $ShortLanguage = $v['ShortLanguage'];
                                            $naziv .= '<div class="form-group">';
                                            $naziv .= '<label class="col-md-2 control-label">Kratak opis <b>' . $ShortLanguage . ' </b> (iznad cene)</label>';
                                            $naziv .= '<div class="col-md-10">';
                                            $naziv .= '<input type="text" id="ArtikalKratakOpis' . $ShortLanguage . '" name="ArtikalKratakOpis' . $ShortLanguage . '" class="form-control" value="' . $link['ArtikalKratakOpis' . $ShortLanguage] . '">';
                                            $naziv .= '</div>';
                                            $naziv .= '</div>';
                                        endforeach;
                                        echo $naziv;
                    */
                    /*Kratak opis artikla*/
                    /*
                                        $nazivOp = '';
                                        foreach ($jezLan as $k => $v):
                                            $ShortLanguage = $v['ShortLanguage'];
                                            $nazivOp .= '<div class="form-group">';
                                            $nazivOp .= '<label class="col-md-2 control-label">Veliki Opis ' . $ShortLanguage . '</label>';
                                            $nazivOp .= '<div class="col-md-10">';
                                            $nazivOp .= '<textarea rows="5" name="OpisArtikliTekstovi' . $ShortLanguage . '" class="form-control mceEditor">' . $link['OpisArtikliTekstovi' . $ShortLanguage] . '</textarea>';
                                            $nazivOp .= '</div>';
                                            $nazivOp .= '</div>';
                                        endforeach;
                                        echo $nazivOp;
                    */
                    ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kratak opis <b>SrbLat</b> (iznad cene)</label>
                        <div class="col-md-10">
                            <input type="text" id="ArtikalKratakOpissrblat" name="ArtikalKratakOpissrblat"
                                   class="form-control" value="<?php echo $ArtikalKratakOpissrblat ?>">
                        </div>
                    </div>

                    <?php

                    $naziv = '';
                    foreach ($jezLan as $k => $v):
                        $ShortLanguage = $v['ShortLanguage'];
                        $IdLanguage = $v['IdLanguage'];

                        $cols = Array("OpisKratakOpis");
                        $db->where('IdArtiklaAkon', $id);
                        $db->where('IdLanguageAkon', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("artiklikratakopisnew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['OpisKratakOpis'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Kratak Opis ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<input type="text" id="ArtNaz' . $ShortLanguage . '" name="artNazivKratak[' . $IdLanguage . ']" class="form-control" value="' . $OpisArtikla . '">';
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

                        $cols = Array("OpisArtTekst");
                        $db->where('ArtikalId', $id);
                        $db->where('LanguageId', $IdLanguage);
                        $artNazivNewUpit = $db->getOne("artiklitekstovinew", null, $cols);
                        $OpisArtikla = $artNazivNewUpit['OpisArtTekst'];

                        $naziv .= '<div class="form-group">';
                        $naziv .= '<label class="col-md-2 control-label bg-success"><strong>Veliki Opis ' . $ShortLanguage . ' </strong></label>';
                        $naziv .= '<div class="col-md-10">';
                        $naziv .= '<textarea style="width: 100%; height: 100px;" name="OpisArtikliTekstovi[' . $IdLanguage . ']" id="myArea2">' . $OpisArtikla . '</textarea>';
                        $naziv .= '</div>';
                        $naziv .= '</div>';

                    endforeach;

                    echo $naziv;


                    ?>


                    <!--BOSCH-->
                    <!--<div class="form-group">
                        <label class="col-md-2 control-label">Code Bosch </label>
                        <div class="col-md-10">
                            <input type="text" name="codebosch" id="codebosch" class="form-control" value="<?php /*echo $codebosch */ ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Code Bosch Link</label>
                        <div class="col-md-10">
                            <input type="text" name="codeboschlink" id="codeboschlink" class="form-control" value="<?php echo $codeboschlink ?>">
                        </div>
                    </div>-->

                    <!--MI LUMEN-->
                    <!--<div class="form-group">
                        <label class="col-md-2 control-label">Code WolfCraft </label>
                        <div class="col-md-10">
                            <input type="text" name="codelumen" id="codelumen" class="form-control" value="<?php /*echo $codelumen */ ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Code WolfCraft Link</label>
                        <div class="col-md-10">
                            <input type="text" name="codelumenlink" id="codelumenlink" class="form-control" value="<?php /*echo $codelumenlink */ ?>">
                        </div>
                    </div>-->


                    <!--<div class="form-group">
                        <label class="col-md-2 control-label">Code Agro </label>
                        <div class="col-md-10">
                            <input type="text" name="codeagro" id="codeagro" class="form-control" value="<?php /*echo $codeagro; */ ?>">
                        </div>
                    </div>-->

                    <!--codevermax-->
                    <!--<div class="form-group">
                        <label class="col-md-2 control-label">Code Vermax </label>
                        <div class="col-md-10">
                            <input type="text" name="codevermax" id="codevermax" class="form-control" value="<?php /*echo $codevermax */ ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Code Vermax Link</label>
                        <div class="col-md-10">
                            <input type="text" name="codevermaxlink" id="codevermaxlink" class="form-control" value="<?php /*echo $codevermaxlink */ ?>">
                        </div>
                    </div>-->

                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Izmeni artikal" class="btn btn-primary pull-right">
                        <a href="/akcija.php?action=obrisiartikal&id=<?php echo $ArtikalId; ?>"
                           class="btn btn-danger pull-left"> Obrisi artikal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
/*
 * Ubaci podatke BOSCH
 */
//require('ubaciBosch.php');


/*
 * Ubaci podatke BOSCH
 */
//require('ubaciWolfCraft.php');


/*
 * Ubaci podatke BOSCH
 */
//require('ubaciVermax.php');

?>

