<!-- ========================================= CONTENT ========================================= -->

<div class="body-content outer-top-xs">


	<div class="container">
		<div class="row category-v1 outer-bottom-sm">
			<div class="col-md-3 col-sm-12 sidebar">
            	<div class="sidebar-filter">
					<?php
						// ovo je kada imamo jednu glavnu kategoriju pa klikcemo na specifikacije
						//require RB_ROOT.'/parts/navigation/sidemenu.php';
						//require RB_ROOT.'/parts/widgets/sidebar/sidebar-price-slider.php';
						// require RB_ROOT.'/parts/widgets/sidebar/sidebar-manufactures.php';
					?>

	            </div><!-- /.sidebar-filter -->

	            	<?php // require RB_ROOT.'/parts/widgets/sidebar/product-tags.php'
	            	require RB_ROOT.'/parts/widgets/sidebar/sidebar-comparision.php';
	            	/*require RB_ROOT.'/parts/widgets/sidebar/sidebar-advertisement.php';*/
				    require RB_ROOT. '/parts/widgets/sidebar/product-hot-deals.php';
					?>
	            	
            </div><!-- /.sidebar -->

            
			<div class=" col-md-9 col-sm-12 outer-bottom-sm">

				<h1 class="section-title"><?php echo $KategorijaArtikalaNaziv; ?></h1>

				<?php  require RB_ROOT.'/parts/section/category/category-page-slider.php' ?>

				<div class="controls-product-top outer-top-vs wow fadeInUp">
					<?php


					// ovde se nalazi paginacija

					$db->join("povezkatzdravlje PZ", "PZ.IdZdravljeArtikli = A.ArtikalId");
					$db->where (' PZ.IdOdKategZdravlje', $katZdravljeID);
					$resultsPages = $db->getOne('artikli A','COUNT(DISTINCT A.ArtikalId) AS totalpages_sve');

					$currentpage = ($currentpage) ? $currentpage : 1;

					$konPokKont = $kontrole['limitpostrani'];

					if (!$konPokKont) { $konPokKont = LIMITPOSTRANI;	}

					$totalpages_sve = $resultsPages['totalpages_sve'];

					$pag = '';
					require RB_ROOT.'/parts/section/category/paginationZdravlje.php';


					require RB_ROOT.'/parts/section/category/controls-product-item.php' ?>
				</div><!-- /.controls-product-top -->

				<div class="search-result-container odvojKategBaner">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-xs">
								<div class="row">

									<?php
									// ovde je lista artikala
									require RB_ROOT.'/parts/section/category/categoryZdravljeListaArt.php'; ?>
									
								</div><!-- /.row -->
							</div><!-- /.category-product -->
						
						</div><!-- /.tab-pane -->
							
						<div class="tab-pane outer-top-vs"  id="list-container">
							<div class="category-product ">

								<?php  require RB_ROOT.'/parts/section/category/category-v1-list.php'; ?>

							</div><!-- /.category-product -->
						</div><!-- /.tab-pane #list-container -->
					</div><!-- /.tab-content -->
					
					<div class="clearfix controls-product-bottom wow fadeInUp">

						<?php  require RB_ROOT.'/parts/section/category/controls-product-item.php' ?>
						
					</div><!-- /.filters-container -->

				</div><!-- /.search-result-container -->

                <div>
                    <?php echo $KategZdravljeOpis; ?>
                </div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container -->

	</div>

<!-- ========================================= CONTENT : END========================================= -->