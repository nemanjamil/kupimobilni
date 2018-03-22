<?php
/**
 * Created by PhpStorm.
 * User: Nikola Markovic
 * Date: 3.11.2017.
 * Time: 15:36
 */


$db->where('IdNarudzbine', $id);
$Narudzbina = $db->getOne('narudzbine', null);

$IdNarudzbine = $Narudzbina['IdNarudzbine'];
$ImeNarudz = $Narudzbina['ImeNarudz'];
$PrezimeNarudz = $Narudzbina['PrezimeNarudz'];
$AdresaNarudz = $Narudzbina['AdresaNarudz'];
$MestoNarudz = $Narudzbina['MestoNarudz'];
$PostBrojNarudz = $Narudzbina['PostBrojNarudz'];
$EmailNarudz = $Narudzbina['EmailNarudz'];
$MobNarudz = $Narudzbina['MobNarudz'];
$NapomenaNarudz = $Narudzbina['NapomenaNarudz'];
$VremeNarudz = $Narudzbina['VremeNarudz'];
$DatumZaSinhronizaciju = date("Y-m-d", strtotime($VremeNarudz));
$NapomenaNarudz = $Narudzbina['NapomenaNarudz'];
$SinhronizovanoNarudz = $Narudzbina['SinhronizovanoNarudz'];

if ($SinhronizovanoNarudz == 0) {


    $db->where('KomitentEmail', $EmailNarudz);
    $komitenti = $db->getOne('komitenti', null);
    $KomitentId = $komitenti['KomitentId'];
    $KomitentExtId = $komitenti['KomitentExtId'];
    $KomitentSifra = $komitenti['KomitentSifra'];



    include DCROOT . 'calculusConfig.php';

    require 'calculusservisi/ubaciZaglavljeDokumenta.php';

    //Dobijamo ID kako bi ubacili sad artikle
    //$ID

    require 'artikliZaUbacivanjeCalculus.php';

    require 'calculusservisi/ubaciStavkeDokumenta.php';

    if($ID){

        $update_query = Array(
            'SinhronizovanoNarudz' => 1
        );
        $db->where('IdNarudzbine', $id);
        $db->update('narudzbine', $update_query);


    echo '<br>
          <h3>Uspesno sinhronizovano</h3>
          <br>
          <a href="' . URLVRATI . '"> <button class="btn btn-primary"> Vrati se nazad</button ></a>';
}
//header("Location: " . URLVRATI . "?e=Uspesno sinhronizovan");
} else {

    header("Location: " . URLVRATI . "?e=Vec je sinhronizovan ");

}




