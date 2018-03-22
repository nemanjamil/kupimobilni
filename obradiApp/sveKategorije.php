<?php
$kate = explode(",", KATEGORIJESAJT);


$cols = Array("KA.KategorijaArtikalaId", "KA.ParentKategorijaArtikalaId", "KA.KategorijaArtikalaActive", "KA.KategorijaArtikalaMesto",
    "KAN.NazivKategorije", "KA.KategorijeVidljivZaMP", "KA.KategorijaArtikalaSlika",
    "KA.KategorijaArtikalaLink", "KA.KategorijaArtikalaActiveMasine",
    "CAST(  (SELECT daLiImaPodkatUser(KA.KategorijaArtikalaId,1,3) ) AS SIGNED )AS daLiImaPodKat,
			     CAST(  (SELECT daLiKatImaArtikala(KA.KategorijaArtikalaId) ) AS SIGNED )AS kolikoImaArt");
$db->join("kategorijeartikalanaslov KAN","KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId");
$db->where('KA.KategorijaArtikalaId', $kate, 'IN');
$users = $db->get("kategorijeartikala KA", null, $cols);


if ($users) {

    $m['tag'] = 'povuciPodatkeKateroje';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";
    $per = array();
    $miki = array();

    foreach ($users as $user) {

        $KategorijaArtikalaId = $user['KategorijaArtikalaId'];
        $ParentKategorijaArtikalaId = $user['ParentKategorijaArtikalaId'];
        $KatIme = $user['NazivKategorije'];
        $KategorijeVidljivZaMP = $user['KategorijeVidljivZaMP'];
        $KategorijaArtikalaSlika = $user['KategorijaArtikalaSlika'];
        $KategorijaArtikalaLink = $user['KategorijaArtikalaLink'];
        $KategorijaArtikalaActiveMasine = $user['KategorijaArtikalaActiveMasine'];
        $daLiImaPodKat = $user['daLiImaPodKat'];
        $KategorijaArtikalaMesto = $user['KategorijaArtikalaMesto'];
        $kolikoImaArt = $user['kolikoImaArt'];

        $lokrel = $common->locationslikaOstalo(KATSLIKELOK,$KategorijaArtikalaId);

        $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
        $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

        $mala_slika = $fileName . '_172.' . $ext;
        $lok = DCROOT.$lokrel.'/'.$mala_slika;
        if (is_file($lok)) {
            $slikaKategBaner = DPROOT.'/'.$lokrel.'/'.$mala_slika;
            //$slikaKategBaner = '/assets/images/banners/2.jpg';
        } else {
            $slikaKategBaner = DPROOT.'/assets/images/banners/2.jpg';
        }

        $o['KategorijaArtikalaId'] = $KategorijaArtikalaId;
        $o['ParentKategorijaArtikalaId'] = $ParentKategorijaArtikalaId;
        $o['KatIme'] = $KatIme;
        $o['KategorijeVidljivZaMP'] = $KategorijeVidljivZaMP;
        $o['KategorijaArtikalaSlika'] = $slikaKategBaner;
        $o['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;
        $o['KategorijaArtikalaActiveMasine'] = $KategorijaArtikalaActiveMasine;
        $o['daLiImaPodKat'] = $daLiImaPodKat;
        $o['KategorijaArtikalaMesto'] = $KategorijaArtikalaMesto;
        $o['kolikoImaArt'] = $kolikoImaArt;

        $o['child'] = $klasaApp->recursiveKategMasine($KategorijaArtikalaId, $miki, 1,$jezikId);

        array_push($per, $o);

    }
    $m['kategorije'] = $per;

} else {

    $m['tag'] = 'povuciPodatkeKateroje';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema podataka za dati ID, nema senzora za datog komitenta";

}


echo json_encode($m, JSON_UNESCAPED_UNICODE);
die;


?>

