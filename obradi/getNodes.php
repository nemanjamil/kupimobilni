<?php
$idagro = $_POST['id'];

/*
 * ove varijable smo setovali u  /var/www/masine/admin/assets/js/ztreekateg.js
 * Linija 19
 * otherParam: {"kategUcitavanje": '170,168,171'},
 */
$kategUcitavanje = $_POST['kategUcitavanje'];


$cols = Array("KategorijaArtikalaId", "ParentKategorijaArtikalaId","KategorijeVidljivZaMP", "KN.NazivKategorije","KategorijaArtikalaMesto",ACTIVEKATEG,"KategorijaArtikalaLink");
$db->join("kategorijeartikalanaslov KN","KN.IdKategorije = kategorijeartikala.KategorijaArtikalaId AND KN.IdLanguage = $jezikId");
if ($idagro) {
    $db->where('ParentKategorijaArtikalaId', $idagro);
} else {
    if ($kategUcitavanje) {
        $db->where('KategorijaArtikalaId IN ('.$kategUcitavanje.')');
        //$db->where('KategorijaArtikalaId', 168);
    } else {
        $db->where("ParentKategorijaArtikalaId IS NULL");
    }
}
$db->orderBy ("KategorijaArtikalaMesto","asc");
$user = $db->get("kategorijeartikala", null, $cols);



$i = 0;
foreach ($user as $key => $value) {
    $KategorijaArtikalaId = $value['KategorijaArtikalaId'];
    $KategorijaArtikalaActive = $value[ACTIVEKATEG];

    $KategorijeVidljivZaMP = $value['KategorijeVidljivZaMP'];
    $vidljivaKat = ($KategorijeVidljivZaMP) ? '' : 'NIJE VIDLJIVA';


    $ParentKategorijaArtikalaId = $value['ParentKategorijaArtikalaId'];
    $ParentKategorijaArtikalaId = ($ParentKategorijaArtikalaId) ? $ParentKategorijaArtikalaId : 'NULL';


    $m[$i]['name'] .= $value['NazivKategorije'].' '.$vidljivaKat;
	//$m[$i]['name'] .= $value['KategorijaArtikalaLink'];
    $m[$i]['open'] .= 'true';
    $m[$i]['mestolok'] .= ($value['KategorijaArtikalaMesto']) ? $value['KategorijaArtikalaMesto'] : '0';
    $m[$i]['checked'] .=  ($KategorijaArtikalaActive)? "true" : '';
    $m[$i]['chkDisabled'] .=  ($KategorijeVidljivZaMP)? '' : 'true';

    // Da li taj ID ima podkategorije, Za to koristimo storedProdecuru
	// ovde smo stavli 5 da bi prikazao sve kategorije
	$upit = "daLiImaPodkat($KategorijaArtikalaId,0,5)";
    $db->where($upit);
    if ($db->has('kategorijeartikala')) {
        $m[$i]['isParent'] .= 'true';
        //$m[$i]['nocheck'] .= 'true';
        $m[$i]['parentId'] .= $ParentKategorijaArtikalaId;

		$m[$i]['url'] .= 'kat/'.$KategorijaArtikalaId;
		$m[$i]['target'] .= '_blank';
		// click:"alert('I can not jump...');"

    } else {
		$m[$i]['url'] .= 'kat/'.$KategorijaArtikalaId;
        $m[$i]['isParent'] .= 'false';
        $m[$i]['parentId'] .= $ParentKategorijaArtikalaId;
    }

    $m[$i]['id'] .= $KategorijaArtikalaId;
    $i++;
}
echo json_encode($m, JSON_UNESCAPED_SLASHES);

?>
