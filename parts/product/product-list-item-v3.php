<!-- ============================================== PRODUCT LIST ITEM-V3 ============================================== -->
<?php function displayListProduct($productName,$is_new,$is_sale,$is_hot,$productImageURL, $oldPrice = 400.99 ,$price = 369.99, $score = 4){
?>
	
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-12">
			<div class="product-image">
				<a href="<?php echo $productImageURL;?>" data-lightbox="image-1">
					<div class="image">
						<img src="assets/images/blank.gif" data-echo="<?php echo $productImageURL;?>" class="img-responsive" alt="">
					</div><!-- /.image -->			

		            <?php if($is_sale):?><div class="tag"><div class="tag-text sale">sale</div></div><?php endif;?>
		            <?php if($is_new):?><div class="tag"><div class="tag-text new">new</div></div><?php endif;?>
		            <?php if($is_hot):?><div class="tag"><div class="tag-text hot">hot</div></div><?php endif;?>
		            <div class="hover-effect"><i class="fa fa-search"></i></div>
	            </a>
			</div><!-- /.product-image -->
		</div>
		
		<div class="col-md-9 col-sm-7 col-xs-12">
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

				<div class="product-short-desc">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labo re
						et dolore magna aliqua. Ut enim ad minim venia. Lorem ipsum dolor sit amet,
						conse ctetur adi piscing elit send do eiusmod later.</p>
				</div><!-- .product-short-desc -->
				
			</div><!-- /.product-info -->

			<div class="cart">
				<div class="action">
					<ul class="list-unstyled list-inline">
						<li class="btn-group add-cart-button">
							
							<a class="btn btn-primary" href="index.php?page-detail">
						    Add to cart</a>
						</li>

		                <li class="control-btn">
							<a class="btn btn-primary add-to-cart" href="#" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="control-btn">
							<a class="btn btn-primary add-to-cart" href="#" title="Compare">
							    <i class="fa fa-exchange"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
		</div>
	</div><!-- /.row -->
      
<?php	
}

?>
<!-- ============================================== PRODUCT LIST ITEM-V3 : END ============================================== -->