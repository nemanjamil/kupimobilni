<?php

if (!$id) {

    $m['tag'] = 'listaKategorijaPoBrendu';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Id Brenda";
    echo json_encode($m, JSON_UNESCAPED_UNICODE);
    die;
}


if ($id) {

    $cols = Array("DISTINCT A.KategorijaArtikalId, KA.KategorijaArtikalaLink, KA.KategorijaArtikalaSlika ,KN.NazivKategorije ");
    $db->join("kategorijeartikala KA", "KA.KategorijaArtikalaId = A.KategorijaArtikalId");
    $db->join("kategorijeartikalanaslov KN", "KN.IdKategorije = KA.KategorijaArtikalaId AND KN.IdLanguage = $jezikId", "LEFT");
    $db->where("ArtikalBrendId", $id);
    $db->orderBy("KategorijaArtikalaLink", "ASC");
    $users = $db->get("artikli A", null, $cols);

    if ($db->count > 0) {

        $m['tag'] = 'listaKategorijaPoBrendu';
        $m['success'] = true;
        $m['error'] = 0;
        $m['error_msg'] = "OK";

        foreach ($users as $user) {

            $KategorijaArtikalId = $user['KategorijaArtikalId'];
            $KategorijaArtikalaLink = $user['KategorijaArtikalaLink'];
            $KategorijaArtikalaSlika = $user['KategorijaArtikalaSlika'];
            $NazivKategorije = $common->strLower($user['NazivKategorije']);


            $lokrel = $common->locationslikaOstalo(KATSLIKELOK, $KategorijaArtikalId);

            $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
            $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

            $mala_slika = $fileName . '_172.' . $ext;

            $slaa = $common->locationslikaOstalo(KATSLIKELOK, $KategorijaArtikalId);

            $lok = $lok = DCROOT . $lokrel . '/' . $mala_slika;
            if (is_file($lok)) {
                $slikaKategBaner = DPROOT.$slaa . '/' . $mala_slika;
            } else {
                $slikaKategBaner = '/assets/images/banners/2.jpg';
            }


            $spcK['KategorijaArtikalId'] = $KategorijaArtikalId;
            $spcK['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;
            $spcK['NazivKategorije'] = $NazivKategorije;
            $spcK['SlikaKategBaner'] = $slikaKategBaner;

            $f[] = $spcK;

        }

        $m['listaKategorija'] = $f;

    } else {

        $m['tag'] = 'listaKategorijaPoBrendu';
        $m['success'] = false;
        $m['error'] = 2;
        $m['error_msg'] = "Nema Liste Kategorija";
        echo json_encode($m, JSON_UNESCAPED_UNICODE);
        die;

    }

}


echo json_encode($m, JSON_UNESCAPED_UNICODE);

?>

