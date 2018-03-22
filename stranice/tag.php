<!-- ========================================= CONTENT ========================================= -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a></li>
				<li class='active'>Tag</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs ">
	<div class="container">
		<div class="row outer-bottom-sm category-v3">
			<div class='col-md-12'>

				<!--<div class="filter-container wow fadeInUp">
					<?php /*require RB_ROOT.'/parts/section/category/filter-container.php' */?>
				</div>-->


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
					require RB_ROOT.'/parts/section/category/controls-product-item.php';

					?>
				</div>

				<!--<div class="controls-product-top outer-top-vs wow fadeInUp">
					<?php /*require RB_ROOT.'/parts/section/category/controls-product-item.php' */?>
				</div>-->

				<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-xs">
								<div class="row">

									<?php require RB_ROOT.'/parts/section/category/category-v3-grid.php'; ?>

								</div><!-- /.row -->
							</div><!-- /.category-product -->

						</div><!-- /.tab-pane -->


					</div><!-- /.tab-content -->
					<div class="clearfix controls-product-bottom">

						<?php
						require RB_ROOT.'/parts/section/category/controls-product-item.php';
						?>

					</div><!-- /.filters-container -->

				</div><!-- /.search-result-container -->

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<!-- ========================================= CONTENT : END========================================= -->