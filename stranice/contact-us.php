<!-- ========================================= CONTENT ========================================= -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#"><?php echo $jsonlang[27][$jezikId] ?></a></li>
				<li class='active'><?php echo $jsonlang[58][$jezikId] ?></li>
			</ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content contact-us">
	<!--<div class="container wow fadeInUp">
		<div class="row ">
			<div class="title">

            <h1><?php /*echo $jsonlang[164][$jezikId] */?></h1>

            <div class="tag-line"><?php /*echo $jsonlang[166][$jezikId] */?></div>

			</div>
		</div>
	</div>-->


	<div class="container">
		<div class="row contact-us">

			<div class="col-md-6 details wow fadeInUp" data-wow-delay="0.2s">
				<h3><?php echo $jsonlang[165][$jezikId] ?></h3>

				<p class="tag-line"><?php echo $jsonOsn[$jezikId]["OpisOsnPodaci"] ?></p>

				<div><i class="fa fa-building"></i><?php echo $jsonlang[291][$jezikId] . ' ' . $jsonOsn[$jezikId]["ImeFirmeOsnPodaci"] ?></div>
				<div><i class="fa fa-map-marker"></i><?php echo $jsonlang[155][$jezikId] . ': ' .  $jsonOsn[$jezikId]["UlicaiBrOsnPodaci"] . ', ' . $jsonOsn[$jezikId]["PosBrOsnPodaci"] . ' ' . $jsonOsn[$jezikId]["GradOsnPodaci"] ?></div>
				<div><i class="fa fa-phone"></i><?php echo $jsonlang[1][$jezikId] . ': ' .  $jsonOsn[$jezikId]["TelefonOsnPodaci"] . ', ' . $jsonOsn[$jezikId]["MobTelOsnPodaci"] ?></div>
				<div><i class="fa fa-envelope"></i><?php echo $jsonlang[31][$jezikId] . ': ' .  $jsonOsn[$jezikId]["EmailOsnPodaci"] ?></div>
				<div><i class="fa fa-certificate"></i><?php echo $jsonlang[292][$jezikId] . ' ' . $jsonOsn[$jezikId]["PibOsnPodaci"] ?>   </div>
                <div><i class="fa fa-gavel"></i><?php echo $jsonlang[293][$jezikId] . ' ' . $jsonOsn[$jezikId]["MatBrOsnPodaci"] ?></div>
                <div><i class="fa fa-university"></i><?php echo $jsonlang[294][$jezikId] . ' ' . $jsonOsn[$jezikId]["ZiroRacunOsnPodaci"] . ', ' . $jsonOsn[$jezikId]["BankaOsnPodaci"]; ?> </div>
				<div><i class="fa fa-file-text"></i>
                    <a href="http://direktnoizbaste.rs/f/podacifirma/Pib.pdf"><?php echo $jsonlang[292][$jezikId] ?></a>,
                    <a href="http://direktnoizbaste.rs/f/podacifirma/Binder2.pdf"><?php echo $jsonlang[297][$jezikId] ?></a>,
                    <a href="http://direktnoizbaste.rs/f/podacifirma/Podaci_od_firme0001.pdf"><?php echo $jsonlang[296][$jezikId] ?></a>
                </div>
			</div><!-- /.details -->

			<div class="col-md-6 send-mail wow fadeInUp" data-wow-delay="0.4s">
				<h3><?php echo $jsonlang[167][$jezikId] ?></h3>
				<div class="row">
					<!--<div class="col-md-6">
						<form class="register-form" role="form">

						</form>
					</div>-->

					<div class="col-md-12">
						<form class="register-form" role="form" method="post" action="akcija.php?action=posaljiPitanjeKomentar">

							<div class="form-group">
								<input type="email" name="email" class="form-control text-input" id="exampleInputName"
									   placeholder="<?php echo $jsonlang[168][$jezikId] ?>">
							</div>

							<div class="form-group">
								<textarea name="komentar" class="form-control" id="exampleInputComments"
										  placeholder="<?php echo $jsonlang[169][$jezikId] ?>"></textarea>
						  </div>

							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="6LdTzEkUAAAAAEreCXfL0G6ZMdqw9BdQ-2b7wfKH"></div>
                                <!--<div class="g-recaptcha" data-sitekey="6LeTYBcTAAAAAKMZUwVza2pFopZsbQRk99E5LoIT"></div>-->
							</div>

							<button type="submit"
									class="btn-upper btn btn-primary checkout-page-button"><?php echo $jsonlang[170][$jezikId] ?></button>
						</form>
					</div><!-- /.col -->

					<div class="col-md-12 outer-bottom-small">

					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container -->

    <?php require RB_ROOT.'/parts/navigation/contact-map.php' ?>
</div><!-- /.body-content -->
<!-- ========================================= CONTENT : END========================================= -->