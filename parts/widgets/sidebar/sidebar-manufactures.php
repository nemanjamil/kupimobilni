<!-- ============================================== SIDEBAR MANUFACTURES ============================================== -->
<?php
$upitKateg = "CALL listaKategorijaPoIdNew($KategorijaArtikalaIdOS,1,$tipUsera,$jezikId,'','');";
$kategLista = $db->rawQuery($upitKateg);
?>
<div class="manufacture">
	<!--<h4 class="sidebar-sub-title">manufacture</h4>-->
	<ul>
        <?php

        if ($kategLista) {
            foreach($kategLista as $k => $v){

                $KaNazKatId = $v['KategorijaArtikalaId'];
                $kaNazivNazKatSideBar = $v['Kat'.$jezik];
                $KatLinKatSideBar = $v['KategorijaArtikalaLink'];
                $daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : '';

                $kv .= '<li><a class="active" href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
            }
            echo $kv;
        }

        $kv = '';
        ?>


	</ul>
</div><!-- /.manufacture -->
<!-- ============================================== SIDEBAR MANUFACTURES : END ============================================== -->
