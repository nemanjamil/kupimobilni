<!-- ============================================== BY CATEGORY ============================================== -->
<?php
//echo $katZdravljeID;
//$upitKateg = "CALL listaKategorijaPoIdNew($KategorijaArtikalaIdOS,1,$tipUsera,$jezikId,'','');";
//$kategLista = $db->rawQuery($upitKateg);
?>
<div class="fashion-category">
	<h3 class="section-title"><?php echo $KategorijaArtikalaNaziv; ?></h3>
	<div class="by-category">
		<ul>
		<?php

		if ($kategListaZdravljeDaliIma) {
			foreach($kategListaZdravljeDaliIma as $k => $v){

				$KaNazKatId = $v['KategorijaArtikalaIdZdravlje'];
				$kaNazivNazKatSideBar = $v['TekstZdravlje'.$jezik];
				$KatLinKatSideBar = $v['KategorijaArtikalaLinkZdravlje'];
				$daLiImaPodKat = ($v['daLiImaPodKat']) ? '+' : '';

				//$kv .= '<li><a class="active" href="/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
				$kv .= '<li><a href="/z/'.$KatLinKatSideBar.'">'.$kaNazivNazKatSideBar.' <span class="item-count">'.$daLiImaPodKat.'</span></a></li>';
			}
			echo $kv;
		}

		$kv = '';
		?>



		</ul>
	</div>
</div><!-- /.fashion-category -->
<!-- ============================================== BY CATEGORY : END ============================================== -->