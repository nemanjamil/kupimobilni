<?php
$string="5ECF7F0747A7";
$id = 3;

$cols = Array ("LS.SenzorSifra","LS.IdListaSenzora","K.KomitentNaziv","K.KomitentIme","K.KomitentPrezime","K.KomitentId");
$db->join("komitenti K","K.KomitentId = LS.PripadaKomitentu");
$db->where("LS.SenzorSifra",$string);
$db->where("LS.PripadaKomitentu",$id);
$users = $db->get("listasenzora LS", null, $cols);


if ($db->count > 0) {


    foreach ($users as $user) {

        $SenzorSifra = $user['SenzorSifra'];
        $IdListaSenzora = $user['IdListaSenzora'];
        $KomitentNaziv = $user['KomitentNaziv'];
        $KomitentIme = $user['KomitentIme'];
        $KomitentPrezime = $user['KomitentPrezime'];
        $KomitentId = $user['KomitentId'];
        /*$LokacijaIme = $user['LokacijaIme'];
        $LokacijaId = $user['LokacijaId'];*/

        $o['SenzorSifra'] = $SenzorSifra;
        $o['IdListaSenzora'] = $IdListaSenzora;
        $o['KomitentNaziv'] = $KomitentNaziv;
        $o['KomitentIme'] = $KomitentIme;
        $o['KomitentPrezime'] = $KomitentPrezime;
        $o['KomitentId'] = $KomitentId;
        /* $o['LokacijaIme'] = $LokacijaIme;
         $o['LokacijaId'] = $LokacijaId;*/


    }
} else {
    echo "Nema podataka";
    die;
}

?>
<style>
    .tabeleJson {
        width: 600px; height: 700px; margin: 0 auto;
    }
</style>
<div class="row">
    <!--=== Validation Example 1 ===-->
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Tabele Android => <?php echo $KomitentIme; ?></h4>
            </div>
            <div class="widget-content clearfix">
                <div id="vlaznostVazduhaTabela" class="col-md-12 tabeleJson"></div>
                <div id="tempTabela" class="col-md-12 tabeleJson"></div>
                <div id="svetlostTabela" class="col-md-12 tabeleJson"></div>
                <div id="vlaznostZemljeTabela" class="col-md-12 tabeleJson"></div>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>



</div>



