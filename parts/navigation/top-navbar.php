<!-- ============================================== TOP NAVBAR ============================================== -->
<div class="top-nav">
	<ul class="list-unstyled list-inline">

		<?php
		if($KomitentTipUsera>=10) {
			echo '<li class=""><a href="/admin/" target="_blank" </a>KupiMobilni admin</li>';
		}
		?>
		<!--<li id="fbStatus"></li>-->

		<?php
		if($KomitentEmail) {
			echo '<li><a href="/p/'.$KomitentUserName.'">'.$jsonlang[14][$jezikId].' '.$KomitentNaziv.'</a></li>';
		} else {
            // ovo nam je potrebno za FB registraciju /var/www/masine/assets/js/fb.js linija 30
			echo '<li id="nazivKomitentaHead"></li>';
		}
		?>
        <!--<li class="hidden-xs"><a href="/wish"><?php /*echo $jsonlang[15][$jezikId]; */?></a></li>-->
		<li class="hidden-xs hidden-sm hidden-lg"><a href="/cart"><?php echo $jsonlang[16][$jezikId]; ?></a></li>
		<!--<li class=""><a href="/checkout"><?php /*echo $jsonlang[17][$jezikId]; */?></a></li>-->
		<?php
		if ($KomitentEmail) {

            if ($_SESSION['user']['logovankako']) {
                $logovanPreko = $_SESSION['user']['logovankako'];
            } else {
                $logovanPreko = 'MA';
            }
			echo '<li class=""><a href="/izlogujse" class="izlogujse"><strong>' . $jsonlang[29][$jezikId] . '</strong></a><span hidden>-> 	Logovan preko : '. $logovanPreko .'</span></li>';
		} else {
			echo '<li class=""><a class="log-in" href="/login">'.$jsonlang[18][$jezikId].'</a></li>';
		}
		?>

	</ul>
</div><!-- /.top-nav -->
<!-- ============================================== TOP NAVBAR : END ============================================== -->