<?php
/**
 * OVAJ JE PRAVI
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 20.8.15.
 * Time: 10.07
 */
?>
<div class="body-content">
	<div class="container shopping-cart">
		<?php if ($cenaPoArtKol) { ?>
			<?php require RB_ROOT.'/parts/section/shopping-cart-summary/shopping-cart.php' ?>
			<div class="row wow fadeInUp">
				<?php require RB_ROOT.'/parts/section/shopping-cart-summary/estimate-ship-tax.php' ?>
			</div><!-- /.row -->

		<?php } else { ?>

		<div class="row wow fadeInUp minvisina">
			<?php echo $jsonlang[173][$jezikId]; ?>
			</div>
		<?php } ?>

	</div><!-- /.container -->
</div><!-- /.body-content -->