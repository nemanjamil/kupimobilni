<?php


$upitArtArray = "SELECT
  KA.KategorijaArtikalaId,
  KAN.NazivKategorije,
  KA.KategorijaArtikalaLink,
  SUM(A.ArtikalBrPregleda)  AS brojpregleda
FROM
  artikli A
  JOIN kategorijeartikala KA ON KA.KategorijaArtikalaId = A.KategorijaArtikalId
  JOIN kategorijeartikalanaslov KAN ON KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = 5
  WHERE KA.KategorijaArtikalaId != 164
  GROUP BY A.KategorijaArtikalId
ORDER BY brojpregleda DESC
LIMIT $limit";

$keyArtAr = $db->rawQuery($upitArtArray);

$i = 0;
$dp = '';
if ($keyArtAr) {

        $m['tag'] = 'kategYouMayAlso';
        $m['success'] = true;
        $m['error'] = 0;
        $m['error_msg'] = "Nema Errora";

            foreach($keyArtAr AS $k=>$v) {
                $KategorijaArtikalaId  = $v['KategorijaArtikalaId'];
                $NazivKategorije  = $v['NazivKategorije'];
                $KategorijaArtikalaLink  = $v['KategorijaArtikalaLink'];
                $brojpregleda  = $v['brojpregleda'];

                $f['KategorijaArtikalaId'] = $KategorijaArtikalaId;
                $f['NazivKategorije'] = $NazivKategorije;
                $f['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;
                $f['brojpregleda'] = $brojpregleda;

                $r[] = $f;

            }

        $m['kategorije'] = $r;

} else {

    $m['tag'] = 'kategYouMayAlso';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema Kategorija";

}

echo $json = json_encode($m, JSON_UNESCAPED_UNICODE);


?>

