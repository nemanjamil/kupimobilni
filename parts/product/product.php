<?php
function displayProduct($productName,$is_new,$is_sale,$is_hot,$productImageURL, $oldPrice = 400.99 ,$price = 369.99, $score = 4){
?>

	<div class="product">		
		<div class="product-image">
			<a href="<?php echo $productImageURL;?>" data-lightbox="image-1">
				<div class="image">
					<img src="assets/images/blank.gif" data-echo="<?php echo $productImageURL;?>" class="img-responsive" alt="">
				</div><!-- /.image -->

				<?php if ($is_new): ?>
					<div class="tag">
					<div class="tag-text new"><?php echo $jsonlang[87][$jezikId]; ?></div></div><?php endif; ?>
				<?php if ($is_sale): ?>
					<div class="tag">
					<div class="tag-text sale"><?php echo $jsonlang[109][$jezikId]; ?></div></div><?php endif; ?>
				<?php if ($is_hot): ?>
					<div class="tag">
					<div class="tag-text hot"><?php echo $jsonlang[115][$jezikId]; ?></div></div><?php endif; ?>
				<div class="hover-effect"><i class="fa fa-search"></i></div>
			</a>
		</div><!-- /.product-image -->
			
		
		<div class="product-info">
			<h3 class="name"><a href="index.php?page=detail"><?php echo $productName;?></a></h3>
			
			<div class="star-rating" title="Rated 4.50 out of 5">
				<span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
			</div><!-- /.star-rating -->

			<div class="product-price">	
				<ins>
					<span class="amount">$ <?php echo $price;?></span>
				</ins>
				<?php if($oldPrice):?>
				    <del><span class="amount">$ <?php echo $oldPrice;?></span></del> 
				<?php endif;?>
			</div><!-- /.product-price -->
			
		</div><!-- /.book-details -->


		<div class="cart animate-effect">
			<div class="action">
				<ul class="list-unstyled">
					<li class="add-cart-button">
						<a class="btn btn-primary" href="index.php?page-detail"><?php echo $jsonlang[76][$jezikId]; ?></a>
					</li>

	                <li>
						<a class="btn btn-primary whislist" href="#" title="<?php echo $jsonlang[15][$jezikId]; ?>">
							 <i class="icon fa fa-heart"></i>
						</a>
					</li>

					<li>
						<a class="btn btn-primary compare" href="#" title="<?php echo $jsonlang[74][$jezikId]; ?>">
						    <i class="fa fa-exchange"></i>
						</a>
					</li>
				</ul>
			</div><!-- /.action -->
		</div><!-- /.cart -->
	</div><!-- /.product -->
      
<?php	
}

?>