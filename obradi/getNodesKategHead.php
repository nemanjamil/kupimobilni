<?php


$idagro = $_POST['id'];

$cols = Array("kateghead.IdKategHead", "ParentKategHead", "LinkKategHead","AktivanKategHead","MestoKategHead","KHN.NaslovKategHead");
$db->join("kategheadnaslov KHN","KHN.IdKategHead = kateghead.IdKategHead AND KHN.IdLanguage = $jezikId");

if ($idagro) {
    $db->where('ParentKategHead', $idagro);
} else {
    $db->where("ParentKategHead IS NULL");
}
$db->orderBy ("MestoKategHead","asc");
$user = $db->get("kateghead", null, $cols);

$i = 0;
foreach ($user as $key => $value) {
    $KategorijaArtikalaId = $value['IdKategHead'];
    $KategorijaArtikalaActive = $value['AktivanKategHead'];

    $ParentKategorijaArtikalaId = $value['ParentKategHead'];
    $ParentKategorijaArtikalaId = ($ParentKategorijaArtikalaId) ? $ParentKategorijaArtikalaId : 'NULL';


    $m[$i]['name'] .= $value['NaslovKategHead'];
    $m[$i]['open'] .= 'true';
    $m[$i]['mestolok'] .= ($value['MestoKategHead']) ? $value['MestoKategHead'] : '0';
    $m[$i]['checked'] .=  ($KategorijaArtikalaActive)? "true" : '';

    // Da li taj ID ima podkategorije, Za to koristimo funkciju
	// ovde smo stavli 5 da bi prikazao sve kategorije
    $upit = "daLiImaPodkaHead($KategorijaArtikalaId,0,5)";
    $db->where($upit);
    if ($db->has('kateghead')) {
        $m[$i]['isParent'] .= 'true';
        //$m[$i]['nocheck'] .= 'true';
        $m[$i]['parentId'] .= $ParentKategorijaArtikalaId;

		$m[$i]['url'] .= 'kategEditHead/'.$KategorijaArtikalaId;
		$m[$i]['target'] .= '_blank';
		// click:"alert('I can not jump...');"

    } else {
        $m[$i]['url'] .= 'kategEditHead/' . $KategorijaArtikalaId;
        $m[$i]['isParent'] .= 'false';
        $m[$i]['parentId'] .= $ParentKategorijaArtikalaId;
    }

    $m[$i]['id'] .= $KategorijaArtikalaId;
    $i++;
}
echo json_encode($m, JSON_UNESCAPED_SLASHES);

?>
