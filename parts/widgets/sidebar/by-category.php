<!-- ============================================== BY CATEGORY ============================================== -->
<?php

$upitKateg = "CALL listaKategorijaPoIdNew($KategorijaArtikalaIdOS,1,$tipUsera,$jezikId,NULL,NULL);";
$kategLista = $db->rawQuery($upitKateg);
/*if ($ParentKategorijaArtikalaId) {
$upitKategParent = "CALL nadKategorija($ParentKategorijaArtikalaId,$jezikId);";
$kategParenLinkUpit = $db->rawQuery($upitKategParent);
$kategParenLink = $kategParenLinkUpit[0]['KategorijaArtikalaLink'];
} else {
    $kategParenLink = '';
}*/
if ($ParentKategorijaArtikalaId) {
    $upitKategParent = "CALL nadKategorija($ParentKategorijaArtikalaId,$jezikId);";
    $kategParenLinkUpit = $db->rawQuery($upitKategParent);
    $kategParentLink = $kategParenLinkUpit[0]['KategorijaArtikalaLink'];
    $NazivKategorijeParentLink = $kategParenLinkUpit[0]['NazivKategorije'];
} else {
    $kategParentLink = '';
}

?>
<div class="fashion-category">
    <?php if ($ParentKategorijaArtikalaId) { ?>
        <h3 class="section-title">< <a
                href="/<?php echo $kategParentLink; ?>"><?php echo $NazivKategorijeParentLink; ?></a></h3>
    <?php } else { ?>
        <h3 class="section-title">< <a
                href="/<?php echo $kategParentLink; ?>"><?php echo $jsonlang[27][$jezikId]; ?></a> ></h3>
    <?php } ?>
    <div class="by-category">
        <ul>
            <?php

            if ($kategLista) {
                foreach ($kategLista as $k => $v) {

                    $KaNazKatId = $v['KategorijaArtikalaId'];
                    $kaNazivNazKatSideBar = $v['NazivKategorije'];
                    $KatLinKatSideBar = $v['KategorijaArtikalaLink'];
                    $kolikoImaArt = $v['kolikoImaArt'];
                    $daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : $kolikoImaArt;

                    //$kv .= '<li><a class="active" href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
                    $kv .= '<li><a href="/' . $KatLinKatSideBar . '">' . $kaNazivNazKatSideBar . ' <span class="item-count">[' . $daLiImaPodKat . ']</span></a></li>';
                }
                echo $kv;
            }

            $kv = '';
            ?>


        </ul>
    </div>
</div><!-- /.fashion-category -->
<!-- ============================================== BY CATEGORY : END ============================================== -->