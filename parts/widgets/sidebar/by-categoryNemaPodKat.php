<!-- ============================================== BY CATEGORY ============================================== -->
<?php
if ($ParentKategorijaArtikalaId) {
    // ovde ide KategID ali nama treba parent kategorija pa uzimamo parentId i on da u samo m upitu uzimamo njogov parent
    $upitKateg = "CALL listaKategorijaPoIdNew($ParentKategorijaArtikalaId,1,$tipUsera,$jezikId,NULL,NULL);";
    $kategLista = $db->rawQuery($upitKateg);
    /*if ($ParentKategorijaArtikalaId) {
    $upitKategParent = "CALL nadKategorija($ParentKategorijaArtikalaId,$jezikId);";
    $kategParenLinkUpit = $db->rawQuery($upitKategParent);
    $kategParenLink = $kategParenLinkUpit[0]['KategorijaArtikalaLink'];
    } else {
        $kategParenLink = '';
    }*/

    ?>
    <div class="fashion-category ">
        <h3 class="section-title section-titleNoMrg">< <a href="/<?php echo $kategParentLink; ?>"><?php echo $NazivKategorijeParentLink; ?></a></h3>
        <div class="by-category categoryDodatak ">
            <ul class="bg-info">
                <li><a href="/<?php echo $KategorijaArtikalaLink; ?>"><?php echo $KategorijaArtikalaNaziv; ?></a></li>
            </ul>
            <ul class="hidden-xs">
                <?php

                if ($kategLista) {
                    foreach ($kategLista as $k => $v) {

                        $KaNazKatId = $v['KategorijaArtikalaId'];
                        $kaNazivNazKatSideBar = $v['NazivKategorije'];
                        $KatLinKatSideBar = $v['KategorijaArtikalaLink'];
                        $kolikoImaArt = $v['kolikoImaArt'];
                        $daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : '';
                        $actKatli = ($KaNazKatId==$KategorijaArtikalaIdOS) ? 'class="active"' : '';

                        $brojArtuKateg = ($kolikoImaArt>0) ? '['.$kolikoImaArt.']' : 0;

                        $errKatArt = ($daLiImaPodKat && $brojArtuKateg) ? '1' : '';

                        //$kv .= '<li><a  href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
                        $kv .= '<li><a '.$actKatli.' href="/' . $KatLinKatSideBar . '">' . $kaNazivNazKatSideBar . '
                        <span class="item-count">' . $daLiImaPodKat . ' '.$brojArtuKateg.' <span class="errorSpan">'.$errKatArt.'</span> </span></a></li>';
                    }
                    echo $kv;
                }

                $kv = '';
                ?>



            </ul>
        </div>
    </div>
<?php } ?>
<!-- /.fashion-category -->
<!-- ============================================== BY CATEGORY : END ============================================== -->
