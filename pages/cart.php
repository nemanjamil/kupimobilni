<!-- ========================================= CONTENT ========================================= -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#"><?php echo $jsonlang[27][$jezikId]; ?></a></li>
				<li class='active'><?php echo $jsonlang[22][$jezikId]; ?></li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container shopping-cart">
		<?php require RB_ROOT.'/parts/section/shopping-cart-summary/shopping-cart.php' ?>
		<div class="row wow fadeInUp">
			<?php require RB_ROOT.'/parts/section/shopping-cart-summary/estimate-ship-tax.php' ?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<!-- ========================================= CONTENT : END========================================= -->