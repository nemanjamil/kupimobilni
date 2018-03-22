
<!-- ========================================= CONTENT ========================================= -->
<div class="body-content">
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/"><?php echo $jsonlang[28][$jezikId]; ?></a></li>
				<!--<li class='active'>Blog</li>-->
			</ul>
		</div>
	</div>
</div>

	<div class="container">
		<div class="row category-v1 outer-bottom-sm">
			<div class="col-md-3 col-sm-12 sidebar">

				<h3 class="section-title"><?php echo $jsonlang[194][$jezikId]; ?></h3>
            	<div class="sidebar-filter">


					<?php
					
						// ovo je kada imamo jednu glavnu kategoriju pa klikcemo na specifikacije
						require RB_ROOT.'/parts/navigation/sidemenuFull.php';
						//require RB_ROOT.'/parts/widgets/sidebar/sidebar-price-slider.php';


					?>

	            </div><!-- /.sidebar-filter -->


	            	
            </div><!-- /.sidebar -->

            
			<div class=" col-md-9 col-sm-12 outer-bottom-sm">

				<?php if(!$specPodaci) { ?>

				<div class="odvojKategBaner">

					<h3><?php echo $jsonlang[195][$jezikId]; ?></h3>

					<p><?php echo $jsonlang[196][$jezikId]; ?></p>

				</div>

					<?php } else { ?>
				<div class="controls-product-top outer-top-vs wow fadeInUp">
					<?php
					// ovde se nalazi paginacija
					//$db->where ('A.KategorijaArtikalId', $KategorijaArtikalaIdOS);
					$resultsPages = $db->getOne('artikli A','count(*) as totalpages_sve');

					$currentpage = ($currentpage) ? $currentpage : 1;

					$konPokKont = $kontrole['limitpostrani'];

					if (!$konPokKont) { $konPokKont = LIMITPOSTRANI;	}

					$totalpages_sve = $resultsPages['totalpages_sve'];

					$pag = '';
					require RB_ROOT.'/parts/section/category/pagination.php';


					require RB_ROOT.'/parts/section/category/controls-product-item.php' ?>
				</div><!-- /.controls-product-top -->

				<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-xs">
								<div class="row">

									<?php
									// ovde je lista artikala
									require RB_ROOT.'/parts/section/category/categoryListaCustom.php'; ?>
									
								</div><!-- /.row -->
							</div><!-- /.category-product -->
						
						</div><!-- /.tab-pane -->
							
						<div class="tab-pane outer-top-vs"  id="list-container">
							<div class="category-product ">

								<?php //  require RB_ROOT.'/parts/section/category/category-v1-list.php'; ?>

							</div><!-- /.category-product -->
						</div><!-- /.tab-pane #list-container -->
					</div><!-- /.tab-content -->
					
					<div class="clearfix controls-product-bottom wow fadeInUp">
						
						<?php  require RB_ROOT.'/parts/section/category/controls-product-item.php' ?>
						
					</div><!-- /.filters-container -->

				</div><!-- /.search-result-container -->

                <?php } ?>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div>

<!-- ========================================= CONTENT : END========================================= -->