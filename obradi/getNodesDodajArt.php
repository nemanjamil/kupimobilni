<?php
$idagro = $_POST['id'];
$adminfunkc = new adminfunkc($db);
$m = $adminfunkc->listaKateg($idagro,0,$jezikId);
/*
echo $m = '[
        { id:1,isParent:true, pId:0, name:"can check 1", open:true},
        { id:11, isParent:true, pId:1, name:"can check 1-1", open:true},
        { id:111, isParent:false, pId:11, name:"can check 1-1-1"},
        { id:112, isParent:false, pId:11, name:"can check 1-1-2"},

    ]';*/



/*$cols = Array("KategorijaArtikalaId", "KategorijaArtikalaNaziv", "ParentKategorijaArtikalaId","KategorijaArtikalaMesto","KategorijaArtikalaActive","KategorijaArtikalaLink");

if ($idagro) {
    $db->where('ParentKategorijaArtikalaId', $idagro);
} else {
    $db->where("ParentKategorijaArtikalaId IS NULL");
}
$db->orderBy ("KategorijaArtikalaMesto","asc");
$user = $db->get("kategorijeartikala", null, $cols);


$i = 0;
foreach ($user as $key => $value) {
    $KategorijaArtikalaId = $value['KategorijaArtikalaId'];
    $KategorijaArtikalaActive = $value['KategorijaArtikalaActive'];

    $ParentKategorijaArtikalaId = $value['ParentKategorijaArtikalaId'];
    $ParentKategorijaArtikalaId = ($ParentKategorijaArtikalaId) ? $ParentKategorijaArtikalaId : 'NULL';


    //$m[$i]['name'] .= $value['KategorijaArtikalaNaziv'];
    $m[$i]['name'] .= $value['KategorijaArtikalaLink'];
    $m[$i]['open'] .= 'true';
    $m[$i]['mestolok'] .= ($value['KategorijaArtikalaMesto']) ? $value['KategorijaArtikalaMesto'] : '0';


    // Da li taj ID ima podkategorije, Za to koristimo storedProdecuru
	// ovde smo stavli 5 da bi prikazao sve kategorije
    $upit = "daLiImaPodkat($KategorijaArtikalaId,0,5)";
    $db->where($upit);
    if ($db->has('kategorijeartikala')) {
        $m[$i]['isParent'] .= 'true';
        $m[$i]['nocheck'] .= 'true';
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
}*/

echo json_encode($m, JSON_UNESCAPED_SLASHES);


?>
