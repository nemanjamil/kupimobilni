<!-- ============================================== NAVBAR COLLPASE ============================================== -->
<div class="navbar-collapse collapse mc-horizontal-menu-collapse1" >
	<div class="nav-outer">
		<ul class="nav navbar-nav">
<!--pocetna-->
            <li class="no-down">
                <a href="/"><?php echo $jsonlang[27][$jezikId]; ?></a>
            </li>

            <!--<li class="dropdown yamm-fw">
				<a href="#"  class="dropdown-toggle" data-toggle="dropdown">
					AUTO
				</a>
				<ul class="dropdown-menu fadeInUp animatedfadeInUp animated">
					<li>
						<?php /*require RB_ROOT.'/parts/navigation/megamenu_bez_slike.php';*/?>
					</li>
				</ul>
			</li>


            <li class="dropdown yamm-fw">
				<a href="#"  class="dropdown-toggle" data-toggle="dropdown">
					MOBILNI
				</a>
				<ul class="dropdown-menu fadeInUp animatedfadeInUp animated">
					<li>
						<?php /*require RB_ROOT.'/parts/navigation/megamenu_bez_slike.php';*/?>
					</li>
				</ul>
			</li>


            <li class="dropdown yamm-fw">
				<a href="#"  class="dropdown-toggle" data-toggle="dropdown">
					RACUNAR
				</a>
				<ul class="dropdown-menu fadeInUp animatedfadeInUp animated">
					<li>
						<?php /*require RB_ROOT.'/parts/navigation/megamenu_bez_slike.php';*/?>
					</li>
				</ul>
			</li>


            <li class="dropdown yamm-fw">
				<a href="#"  class="dropdown-toggle" data-toggle="dropdown">
					TABLET
				</a>
				<ul class="dropdown-menu fadeInUp animatedfadeInUp animated">
					<li>
						<?php /*require RB_ROOT.'/parts/navigation/megamenu_bez_slike.php';*/?>
					</li>
				</ul>
			</li>-->

			<?php
			//require_once 'navbar_kategorije_izlistavanje_full.php';
			require_once 'cron/crongotovo/menu-kategorije-navbar-cron.php';

			?>

			<!--<li class="no-down">
				<a href="/prodajna-mesta">PRODAJNA MESTA</a>
			</li>

			<li class="no-down">
				<a href="javascript:void(0);">VESTI</a>
			</li>


			<li class="no-down">
				<a href="/info-o-dostavi">ISPORUKA</a>
			</li>-->


<!--o nama-->
			<!--<li class="no-down">
				<a href="/o-nama"><?php /*echo $jsonlang[95][$jezikId]; */?></a>
			</li>-->
<!--kontakt-->
			<li class="no-down">
				<a href="/contact-us"><?php echo $jsonlang[58][$jezikId]; ?></a>
			</li>

		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>
	</div><!-- /.nav-outer -->
</div><!-- /.navbar-collapse -->
<!-- ============================================== NAVBAR COLLPASE : END============================================== -->
