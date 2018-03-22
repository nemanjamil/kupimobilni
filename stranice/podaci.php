<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 13.8.15.
 * Time: 17.58
 */


//$dataKateg = array("KategorijaArtikalaId", "ParentKategorijaArtikalaId", "KategorijaArtikalaNaziv", "KategorijaArtikalaLink", "KategorijaArtikalaKratak");
$db->where("KomitentId", $_SESSION['user']['KomitentId']);
$db->where("KomitentActive", 1);
$daljestr = $db->getOne("komitenti");

if ($daljestr) {

$KomitentId = $daljestr['KomitentId'];
$KomitentSifra = $daljestr['KomitentSifra'];
$KomitentNaziv = $daljestr['KomitentNaziv'];
$KomitentIme = $daljestr['KomitentIme'];
$KomitentPrezime = $daljestr['KomitentPrezime'];
$KomitentAdresa = $daljestr['KomitentAdresa'];
$KomitentPosBroj = $daljestr['KomitentPosBroj'];
$KomitentMesto = $daljestr['KomitentMesto'];
$KomitentTelefon = $daljestr['KomitentTelefon'];
$KomitentMobTel = $daljestr['KomitentMobTel'];
$KomitentEmail = $daljestr['KomitentEmail'];
$KomitentUserName = $daljestr['KomitentUserName'];
//$KomitentPassword = $daljestr['KomitentPassword'];
//$KomitentSalt = $daljestr['KomitentSalt'];
$KomitentActive = $daljestr['KomitentActive'];

$KomitentTipUsera = $daljestr['KomitentTipUsera'];
$KomitentRabat = $daljestr['KomitentRabat'];

// rabat kupi
$KomiRabatKupi = $daljestr['KomiRabatKupi'];
$KomiRabatKupi = ($KomiRabatKupi) ? $KomiRabatKupi : 0;

$KomitentFirma = $daljestr['KomitentFirma'];
$KomitentPib = $daljestr['KomitentPib'];
$KomitentFirmaAdresa = $daljestr['KomitentFirmaAdresa'];
$KomitentiValuta = $daljestr['KomitentiValuta'];

$InstaliranAppAnd = $daljestr['InstaliranAppAnd'];


    if (!$KomitentUserName) {

        $komUserNameFri = $common->friendly_convert($KomitentEmail);

        $data = Array (
            'KomitentUserName' => $komUserNameFri
        );
        $db->where ('KomitentId', $KomitentId);
        $db->update ('komitenti', $data);

    }


} else {
    echo 'Nije Nasao komitenta';
    die;
}


?>