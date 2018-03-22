<!-- ========================================= CONTENT ========================================= -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a></li>
				<!--<li class='active'>Blog</li>-->
			</ul>
		</div>
	</div>
</div>


<div class="body-content">
	<div class="container">
		<div class="row blog">

            <?php

            if ($mozeDaVidi) { ?>

                <div class="col-md-3 sidebar">
                    <?php require RB_ROOT.'/stranice/profil/profilKateg.php' ?>
                </div>

                <div class="col-md-9">
                    <?php require RB_ROOT.'/stranice/profil/'.$strProf.'.php' ?>
                </div>

            <?php } else { ?>


                <div class="col-md-3 sidebar">
                    -
                </div>

                <div class="col-md-9 minvisina">
                    <?php echo $jsonlang[227][$jezikId]; ?>
                </div>


            <?php }     ?>



		</div>
	</div>
</div>
