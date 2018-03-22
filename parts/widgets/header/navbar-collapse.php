<!-- ============================================== NAVBAR COLLPASE ============================================== -->
<div class="navbar-collapse mc-horizontal-menu-collapse1" >
	<div class="nav-outer">
		<ul class="nav navbar-nav">
<!--pocetna-->
            <li class="no-down">
                <a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a>
            </li>

            <li class="dropdown yamm-fw">
				<!--data-hover="dropdown"-->
				<a href="#"  class="dropdown-toggle" data-toggle="dropdown"><?php echo $jsonlang[21][$jezikId]; ?>
					<span class="menu-label hot-menu hidden-xs">hot</span>
				</a>
				<ul class="dropdown-menu fadeInUp animatedfadeInUp animated">
					<li>
						<?php require RB_ROOT.'/parts/navigation/megamenu_bez_slike.php';?>
					</li>
				</ul>
			</li>

<!--Servis-->
            <li class="dropdown yamm">
				<a href="#" class="dropdown-toggle" data-hover="dropdown"
				   data-toggle="dropdown"><?php echo $jsonlang[324][$jezikId];?></a>
				<ul class="dropdown-menu pages fadeInUp animated">
					<li>
						<div class="yamm-content">
							<div class="row">
								<div class='col-xs-12 col-sm-12 col-md-12'>
									<h2 class="title"><a href="/servis-uredjaja"><?php echo $jsonlang[324][$jezikId]; ?></a></h2>
									<ul class='links'>
										<li><a href="/servis-bosch"><?php echo $jsonlang[325][$jezikId]; ?></a></li>
										<li><a href="/servis-makita"><?php echo $jsonlang[326][$jezikId]; ?></a></li>
										<li><a href="/servis-dremel"><?php echo $jsonlang[327][$jezikId]; ?></a></li>
									</ul>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</li>
<!--posao-->
            <li class="dropdown yamm">
                <a href="#" class="dropdown-toggle" data-hover="dropdown"
                   data-toggle="dropdown"><?php echo $jsonlang[328][$jezikId];?></a>
                <ul class="dropdown-menu pages fadeInUp animated">
					<li>
						<div class="yamm-content">
							<div class="row">
								<div class='col-xs-12 col-sm-12 col-md-12'>
									<h2 class="title"><a href="/posao"><?php echo $jsonlang[328][$jezikId];?></a></h2>
									<ul class='links'>
										<li><a href="/komercijalista"><?php echo $jsonlang[329][$jezikId];?></a></li>
										<li><a href="/administrator-sajta"><?php echo $jsonlang[330][$jezikId];?></a></li>
									</ul>
								</div>
							</div>
						</div>
					</li>
                </ul>
            </li>
<!--kupovina-->
			<li class="dropdown yamm">
				<a href="/kupovina-i-odlozeno-placanje" class="dropdown-toggle" data-hover="dropdown"
				   data-toggle="dropdown"><?php echo $jsonlang[331][$jezikId]; ?></a>
				<ul class="dropdown-menu pages fadeInUp animated">
					<li>
						<div class="yamm-content">
							<div class="row">
								<div class='col-xs-12 col-sm-12 col-md-12'>
									<h2 class="title"><a href="/kupovina-i-odlozeno-placanje"><?php echo $jsonlang[332][$jezikId]; ?></a></h2>
									<ul class='links'>
										<li><a href="/placanje-na-rate"><?php echo $jsonlang[333][$jezikId]; ?></a></li>
										<li><a href="/nacin-kupovine"><?php echo $jsonlang[334][$jezikId]; ?></a></li>
									</ul>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</li>
<!--o nama-->
			<li class="no-down">
				<a href="/o-nama-masine"><?php echo $jsonlang[95][$jezikId]; ?></a>
			</li>
<!--kontakt-->
			<li class="no-down">
				<a href="/contact-us"><?php echo $jsonlang[58][$jezikId]; ?></a>
			</li>

			<!--<li class="dropdown yamm">
				<a href="index.php?page=home" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">HOT1</a>
				<ul class="dropdown-menu fadeInUp animated">
					<li>
						<?php /*require RB_ROOT.'/parts/navigation/megamenu-fullwidth.php';*/?>
					</li>
				</ul>
			</li>-->



			<!--<li class="dropdown yamm-fw">
				<a href="#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">HOT3
					<span class="menu-label hot-menu hidden-xs">hot</span>
				</a>
				<ul class="dropdown-menu fadeInUp animatedfadeInUp animated">
					<li>
						<?php /* require RB_ROOT.'/parts/navigation/megamenu_bez_slike.php';*/?>
					</li>
				</ul>
			</li>-->

			<!--<li class="dropdown yamm-fw hidden-sm">
				<a href="#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">HOT4
					<span class="menu-label new-menu hidden-xs">new</span>
				</a>
				<ul class="dropdown-menu fadeInUp animated">
					<li>
						<?php /* require RB_ROOT.'/parts/navigation/megamenu_bez_slike.php';*/?>
						<?php /* require RB_ROOT.'/parts/navigation/megamenu.php';*/?>
					</li>
				</ul>
			</li>-->

			<!--	<li class="no-down hidden-md hidden-sm">
				<a href="/customSearchCat" ><?php /* echo $jsonlang[192][$jezikId]; */?></a>
			</li>-->

			<!--<li class="no-down">
				<a href="/category-v1">Nesto dodati</a>
			</li>

				<li class="no-down">
				<a href="/zdravlje"><?php /* echo $jsonlang[265][$jezikId];*/  ?></a>
			</li>
			-->

			<!--<li class="no-down yamm"> dropdown
				<a href="/market" ><?php /* echo $jsonlang[190][$jezikId]; */?></a>
			</li>-->

			<!--<li class="no-down yamm">
				<a href="/saveti" ><?php /*echo $jsonlang[191][$jezikId]; */?></a>



                <!--<a href="/povrce" class="dropdown-toggle" data-hover="dropdown"
                   data-toggle="dropdown"><?php /* echo $jsonlang[175][$jezikId]; */ ?></a>-->

			<!--<ul class="dropdown-menu pages fadeInUp animated">
                    <li>
                        <div class="yamm-content">
                            <div class="row">
                                        <?php /* require('povrce.php');*/ ?>
                            </div>
                        </div>
                    </li>

                </ul>
			</li>-->

			<!--<li class="no-down">
				<a href="/voce" >neki tekst<?php /* echo $jsonlang[173][$jezikId]; */?></a>
			</li>-->

			<!--<li class="dropdown navbar-right">
				<a href="#" class="dropdown-toggle" data-hover="dropdown"
				   data-toggle="dropdown"><?php /*echo $jsonlang[28][$jezikId]; */?></a>
				<ul class="dropdown-menu pages fadeInUp animated">
					<li>
						<div class="yamm-content">
							<div class="row">
								<div class='col-xs-12 col-sm-4 col-md-4'>
									<h2 class="title"><?php /*echo $jsonlang[26][$jezikId]; */?></h2>
                                  	<ul class='links'>
	                                  	<li><a href="index.php?page=fashion-v1">fashion-01</a></li>
										<li><a href="index.php?page=fashion-v2">fashion-02</a></li>
										<li><a href="index.php?page=fashion-v3">fashion-03</a></li>
										<li><a href="index.php?page=fashion-v4">fashion-04</a></li>
										<li><a href="index.php?page=fashion-v5">fashion-05</a></li>
										<li><a href="index.php?page=fashion-v6">fashion-06</a></li>
										<li><a href="index.php?page=food">food</a></li>
										<li><a href="index.php?page=digital">digital</a></li>
										<li><a href="index.php?page=handtools">hand tools</a></li>
										<li><a href="index.php?page=furniture">furniture</a></li>
										<li><a href="index.php?page=box">box</a></li>
                                  	</ul>
								</div>
								<div class='col-xs-12 col-sm-4 col-md-4'>
									<h2 class="title">shop pages</h2>
                                  	<ul class='links'>
                                  		<li><a href="index.php?page=category-v1">category-01</a></li>
                                  		<li><a href="index.php?page=category-v2">category-02</a></li>
                                  		<li><a href="index.php?page=category-v3">category-03</a></li>
                                  		<li><a href="index.php?page=details-v1">details-01</a></li>
                                  		<li><a href="index.php?page=details-v2">details-02</a></li>
	                                  	<li><a href="index.php?page=checkout">Checkout</a></li>
										<li><a href="index.php?page=blog">Blog</a></li>
										<li><a href="index.php?page=blog-single">Blog Detail</a></li>
										<li><a href="index.php?page=contact-us">Contact</a></li>
										<li><a href="index.php?page=cart">shopping cart</a></li>
										<li><a href="index.php?page=headers">header styles</a></li>
										<li><a href="index.php?page=footers">footer styles</a></li>
                                  	</ul>
								</div>
								<div class='col-xs-12 col-sm-4 col-md-4'>
									<h2 class="title">other pages</h2>
                                  	<ul class='links'>
										<li><a href="/login"><?php /*echo $jsonlang[18][$jezikId]; */?></a></li>
										<li><a href="index.php?page=blog">Blog</a></li>
										<li><a href="index.php?page=blog-single">Blog Detail</a></li>
										<li><a href="index.php?page=contact-us">Contact</a></li>
										<li><a href="index.php?page=headers">header styles</a></li>
										<li><a href="index.php?page=footers">footer styles</a></li>
                                  	</ul>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</li>-->

		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>
	</div><!-- /.nav-outer -->
</div><!-- /.navbar-collapse -->
<!-- ============================================== NAVBAR COLLPASE : END============================================== -->
