<?php require (DCROOT.'/stranice/kolicina.php');
?>
<!-- ============================================== DIGITAL BY CATEGORY ============================================== -->
<!--<div class="col-md-3XXX">-->
	<div class="fashion-category">
		<h3 class="section-title"><?php echo $jsonlang[376][$jezikId]; ?></h3>
		<div class="by-category">
			<ul>
				<li><a href="/superponuda"><?php echo $jsonlang[86][$jezikId]; ?> <span class="item-count"><?php echo $SuperPonuda;?></span></a></li>
				<li><a href="/novi"><?php echo $jsonlang[87][$jezikId]; ?> <span class="item-count"><?php echo $Najprodavaniji;?></span></a></li>
				<li><a href="/najprodavaniji"><?php echo $jsonlang[89][$jezikId]; ?> <span class="item-count"><?php echo $Novi;?></span></a></li>
				<!--<li><a href="#">Rasprodaja <span class="item-count">(41)</span></a></li>-->
			</ul>
		</div>
	</div>
<!--</div>--><!-- /.col -->
<!-- ============================================== DIGITAL BY CATEGORY : END ============================================== -->