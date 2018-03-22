<div class="rowXXX border">

    <?php
    require "opisTabeleProiz.php";
    ?>

    <?php
    //$co = Array("SG.IdSpecGrupe","SG.ImeSpecGrupe");
    //$db->setTrace(true);
    $co = Array("SG.IdSpecGrupe","SGN.NazivSpecGrupe");
    $db->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SAP.IdSpecArtikalGrupaPove");
    $db->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
    $db->where("SAP.IdSpecArtikalPov", $id);
    $specGrupe = $db->get("specartikalpov SAP", null, $co);

    /*print_r($db->trace);
    var_dump($specGrupe);*/
    if ($specGrupe) { ?>

        <div class="col-xs-12 col-sm-6 col-md-6">
            <h5><?php echo $jsonlang[266][$jezikId]; ?></h5>
            <table class="table "><!--table-striped-->

                <tbody>
                <?php
                $sd = '';
                foreach ($specGrupe as $k => $v):
                    $IdSpecGrupe = $v['IdSpecGrupe'];
                    $ImeSpecGrupe = $v['NazivSpecGrupe'];

                    // $co = Array("SV.IdSpecVrednosti","SV.IdSpecVrednostiIme");
                    $co = Array("SV.imeSpecGrupe","SV.IdSpecVrednosti","SVN.SpecVredNaziv");
                    $db->join("specvrednosti SV", "SV.IdSpecVrednosti = SAP.IdSpecArtikalPovIme");
                    $db->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
                    $db->where("SAP.IdSpecArtikalPov", $id);
                    $db->where("SAP.IdSpecArtikalGrupaPove", $IdSpecGrupe);
                    $specGrupeVre = $db->getOne("specartikalpov SAP", null, $co);

                    $sd .= '<tr>';
                    $sd .= '<td>' . $ImeSpecGrupe . '</td>';
                    $sd .= '<td>=></td>';
                    $sd .= '<td>' . $specGrupeVre['SpecVredNaziv'] . '</td>';
                    $sd .= '</tr>';

                endforeach;

                echo $sd;

                ?>

                </tbody>
            </table>
        </div>

    <?php } ?>


</div>

<?php

// ovo smo ovde ubacili jer nam treba podataka o prodavcu

$cols = Array("K.KomitentNaziv, K.KomitentIme, K.KomitentPrezime, K.KomitentUserName, K.KomitentId,K.KomitentiSlika", "KON.OpisKomitent", "LS.ImeLokSamo", "Z.ImeZemlja");
$db->where("K.KomitentId", $KomitentIdArtikal);
$db->join("komitentiopisnew KON", "KON.KomitentId = K.KomitentId AND KON.IdLanguage = $jezikId", "LEFT");
$db->join("lokalnasu LS", "LS.IdLokSamo = K.VerifikovanLS", "LEFT");
$db->join("zemlja Z", "Z.IdZemlja = LS.ZemljaLokSamo", "LEFT");
$komitent = $db->getOne("komitenti K", $cols);


$KomitentNazivKomKom = $komitent['KomitentNaziv'];
$KomitentImeKom = $komitent['KomitentIme'];
$KomitentPrezimeKom = $komitent['KomitentPrezime'];
$ImeLokSamoKom = $komitent['ImeLokSamo'];
$ImeZemljaKom = $komitent['ImeZemlja'];
$komitentOpisKom = $komitent['OpisKomitent'];
$KomitentiSlikaKom = $komitent['KomitentiSlika'];
$KomitentiUserNameKom = $komitent['KomitentUserName'];
$KomitentIdKom = $komitent['KomitentId'];


$lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $KomitentIdKom);

$ext = pathinfo($KomitentiSlikaKom, PATHINFO_EXTENSION);
$fileName = pathinfo($KomitentiSlikaKom, PATHINFO_FILENAME);

$mala_slika = $fileName . '_srednja.' . $ext;

$lok = DCROOT . $lokrel . '/' . $mala_slika;
if (file_exists($lok)) {
    $slikaKomitent = '<img  class="img-responsive" src="' . $lokrel . '/' . $mala_slika . '" alt="">';
}
$komArra .= '<p>' . $jsonlang[114][$jezikId] . '</p>';
$komArra .= '<h4>' . $KomitentNazivKom . '</h4>';
$komArra .= '<div>' . $KomitentImeKom . ' ' . $KomitentPrezimeKom . '</div>';
$komArra .= '<p>' . $ImeLokSamoKom . '</p>';
$komArra .= '<p>' . $ImeZemljaKom . '</p>';
$komArra .= '<p>' . $komitentOpisKom . '</p>';
?>


<?php
if ($OcenaVeriKomi) {
?><p>
       <h5><?php echo $jsonlang[261][$jezikId]; ?>
           <b>
               <a target="_blank" href="/<?php echo $KomitentiUserNameKom; ?>"><?php echo $jsonlang[262][$jezikId]; ?></a>.
           </b>
       </h5>
   </p>
<?php
}
?>

<!-- OVDE JE BIO OPIS ARTIKLA-->
<!--<div class="imatackeUl justify col-xs-12 col-sm-12 col-md-12 no-padding" id="opisDescArt"><span itemprop="description"><?php /*echo $OpisArtikliTekstovi; */?></span></div>-->


<div class="col-xs-12 col-sm-6 col-md-6"><br>

    <!-- <ul class="pull-right">
                <li><?php /*echo $jsonlang[21][$jezikId]; */ ?> : <a
                        href="/<?php /*echo $KategorijaArtikalaLink; */ ?>"><?php /*echo $KategorijaArtikalaNaziv; */ ?></a>
                </li>
            </ul>-->

    <?php

    $sdZdravlje = '';

    $co = Array("KZN.IdKategZdravlje","KZN.NazivKategZdravlje", "KZ.KategorijaArtikalaLinkZdravlje");
    $db->join("povezkatzdravlje PKZ", "PKZ.IdZdravljeArtikli = A.ArtikalId");
    $db->join("kategorijezdravlje KZ", "KZ.KategorijaArtikalaIdZdravlje = PKZ.IdOdKategZdravlje");
    $db->join("kategorijezdrnaslov KZN", "KZN.IdKategZdravlje = KZ.KategorijaArtikalaIdZdravlje AND KZN.IdLanguage = $jezikId");
    $db->where("A.ArtikalId", $id);
    $specGrupe = $db->get("artikli  A", null, $co);

    if ($specGrupe) {

        $sdZdravlje .= '<h5 class="text-left">' . $jsonlang[267][$jezikId] . ' - <strong>' . $jsonlang[268][$jezikId] . '</strong></h5>
            <table class="table text-left">

                <tbody>';


        foreach ($specGrupe as $k => $v):
            $KategorijaArtikalaLinkZdravljeSpecArt = $v['KategorijaArtikalaLinkZdravlje'];
            $TekstZdravljeSpecArt = $v['NazivKategZdravlje'];


            $sdZdravlje .= '<tr>';
            $sdZdravlje .= '<td><a href="/z/' . $KategorijaArtikalaLinkZdravljeSpecArt . '">' . $TekstZdravljeSpecArt . '</a></td>';
            $sdZdravlje .= '</tr>';

        endforeach;


        $sdZdravlje .= '</tbody></table>';
        echo $sdZdravlje;

    }


    ?>


</div>
