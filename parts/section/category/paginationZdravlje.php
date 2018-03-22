<!-- ========================================== PAGINATION ========================================= -->
<?php
if ($totalpages_sve) {
	$range = 3;
	$totalpages_sve;
	$totalpages = ceil($totalpages_sve / $konPokKont);

    if (!$KategorijaArtikalaLinkZdravlje) {
		$KategorijaArtikalaLinkZdravlje = $KategorijaArtikalaLinkZdravlje;
    }

    $pag .= '<nav>
	<ul class="pagination">';

        if ($currentpage > 0) {
            //echo '<li><a href="">&laquo;</a></li>';
            $pag .= '<li>
			<a href="/z/' . $KategorijaArtikalaLinkZdravlje .'" class="prev" aria-label="Previous">
				<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
			</a>
		</li>';
        }

       for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
			if (($x > 0) && ($x <= $totalpages)) {

				if ($x == $currentpage) {
                    $pag .= '<li class="active" ><a href="#">' . $x . '</a></li>';
				} else {
                    $pag .= '<li><a href="/z/'.$KategorijaArtikalaLinkZdravlje.'/p/'. $x .'">' . $x . '</a></li>';
				}

			}
		}


        if ($currentpage != $totalpages) {
            $pag .= '<li>
			<a href="/z/'.$KategorijaArtikalaLinkZdravlje . '/p/' . $totalpages.'" class="next" aria-label="Next">
				<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
			</a>
		</li>';
        }


    $pag .= '</ul></nav>';

}
?>
