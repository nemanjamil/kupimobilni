<!-- ========================================== PRODUCT DETAILS ========================================= -->
<div itemscope itemtype="http://schema.org/Product" class="row">
    <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder"><!--wow fadeInUp-->
        <?php
        require RB_ROOT . '/parts/section/detail/product-gallery.php';
        ?>
    </div>
    <!-- /.col -->

    <div class="col-md-7 col-sm-6"> <!--wow fadeInUp-->

        <div class="product-name clearfix">
            <h1 class="proizvodsnippet"><span itemprop="name"><?php echo $ArtikalNaziv; ?></span></h1>
        </div>
        <div class="hidden"><span itemprop="mpn"><?php echo $ArtikalId; ?></span></div>
        <div class="hidden font12 bojasiva333"><span itemprop="brand"><?php echo $BrendIme; ?></span></div>

        <?php if ($kratakOpis) { ?>
            <div class="clearfix">
                <div><?php echo $kratakOpis; ?></div>
            </div>
        <?php } ?>

        <!--<div class="review-comment-stock">
            <span><a href="#"><?php /*echo $jsonlang[111][$jezikId]; */ ?></a></span>
			<span><a href="#"><?php /*echo $jsonlang[105][$jezikId]; */ ?></a></span>
            <span><a href="#"></a></span>
        </div>-->

        <div class="details-product-price">

            <div>
                <ins class="amount">
                    <span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="priceCurrency" content="RSD"/>
                        <span itemprop="price" content="<?php echo $cenaPrikazBrojInfo; ?>"><?php echo $cenaSamoBrojFormatInfo; ?></span>
                        <span><?php echo $cenaPrikazExtInfo; ?></span>
                    </span>

                </ins>
            </div>


            <?php if ($porez > '0') { ?>
                <p class="font10"><?php echo $jsonlang[287][$jezikId]; ?></p>
            <?php } ?>

            <?php
            // da li je instalira applikacija
            // require('cenaIstaliranApp.php');
            ?>

        </div>


        <div class="col-xs-12 col-md-12 details-product-price">

            <div class="col-xs-12 col-md-7 no-padding">

                <?php if ($dani > '0') { ?>
                    <h4><?php echo $jsonlang[230][$jezikId] . ' ' . $dani . ' ' . $jsonlang[231][$jezikId];; ?></h4>

                    <p><?php echo $jsonlang[232][$jezikId]; ?></p>

                    <p>
                        <a href="mailto:'<?php echo GLAVNIMAIL; ?>'?subject=<?php echo $jsonlang[234][$jezikId] . ': ' . $ArtikalNaziv; ?>
                        &amp;body=<?php echo $jsonlang[235][$jezikId] . ' ' . $ArtikalNaziv . ' (link: ' . DPROOT . $urlArtiklaLink . '). ' . $jsonlang[236][$jezikId] . '. ' . $KomitentIme . ' ' . $KomitentPrezime; ?>
                        "
                        onclick="ga('send', 'event', '<?php echo $KategorijaArtikalaNaziv; ?>',
                        '<?php echo $jsonlang[221][$jezikId]; ?>', '<?php echo $ArtikalNaziv; ?>', 0);"
                        title="<?php echo $jsonlang[233][$jezikId]; ?>"><i class="fa fa-envelope"></i>
                        <?php echo $jsonlang[233][$jezikId]; ?></a>
                    </p>

                    <div class="point-of-action">
                        <div class="quantity">
                            <label><?php echo $TipUnit; ?></label>
                            <input type="number" value="<?php echo $MinimalnaKol; ?>" id="kolicinaArt"
                                   placeholder="<?php echo $MinimalnaKol; ?>" min="<?php echo $MinimalnaKol; ?>">
                        </div>

                        <div class="add-to-cart">
                            <input type="hidden" id="ArtikalId" value="<?php echo $ArtikalId; ?>">
                            <a href="#" class="btn btn-primary disabled" id="dodajuKorpu"><i
                                    class="fa fa-shopping-cart"></i> <?php echo $jsonlang[107][$jezikId]; ?></a>
                            <span><?php echo $jsonlang[218][$jezikId] . ' : ' . $MinimalnaKol . ' ' . $TipUnit; ?></span>
                        </div>
                    </div>

                <?php } ?>

                <div class="font12 bojasiva333"><?php echo $jsonlang[263][$jezikId]; ?>
                    <span class="status"><?php echo $TipUnitcelo; ?></span>
                </div>
                <div class="font12 bojasiva333">
                    <span><?php echo $jsonlang[219][$jezikId] . ' : ' . $MinimalnaKol . ' ' . $TipUnit; ?></span>
                </div>
                <div class="font12 bojasiva333">
                    <!--ima na stanju-->
                    <?php $hovBack = ($ArtikalStanje) ? 'bg-success' : 'bg-danger'; ?>
                    <span class="status <?php echo $hovBack; ?>"><?php echo $stanjeProizInfo; ?></span>

                </div>


                <div class="clearfix kojijeId" data-ime="<?php echo $ArtikalId; ?>">
                    <?php
                    $starArr = '';
                    for ($i = 1; $i <= 5; $i++) {
                        $cekstar = ($i == $ocenaut) ? 'checked' : '';
                        $starArr .= '<input class="starri required" ' . $cekstar . ' type="radio" name="test-3A-rating-' . $ArtikalId . '" value="' . $i . '"/>';
                    }
                    echo $starArr;
                    ?>
                </div>
            </div>

            <div class="col-xs-12 col-md-5 no-padding">

                <div class="font12 bojasiva333">Id :
                    <span class="status"><?php echo $ArtikalId; ?></span>
                </div>

                <div class="font12 bojasiva333">Code :
                    <span class="status"><?php echo $proizVendorCode = $common->vendorCode($KomitentKolona, $ArtikalId); //echo $idd;;?></span>
                </div>
                <div class="font12 bojasiva333">
                    <!--<span class="product-stock">--><?php /*echo $jsonlang[106][$jezikId]; */ ?>
                    <span class="status"><?php echo $jsonlang[348][$jezikId] . ' : <b>  <a href="/'.$BrendIme.'/b" class="bojacrna"> ' . $BrendIme ?></a></b></span>
                </div>

                <?php if($ProizvodjacIme){?>
                    <div class="font12 bojasiva333">
                        <span class="status"><?php echo $jsonlang[426][$jezikId] . ' : <b>' . $ProizvodjacIme ?></b></span>
                    </div>
                <?php }?>
            </div>

        </div>

        <div class="col-xs-12 col-md-12 details-product-price">
            <?php echo $jsonlang[419][$jezikId] . ' : <a href="/' . $KategorijaArtikalaLink . '">' . $KategorijaArtikalaNaziv . '</a>'; ?>
        </div>

        <?php if (!$dani and $pravaMp > '0') { ?>
            <!--		<div class="custom-select">
                        <ul class="list-inline list-unstyled">
                            <li>
                                <label>Kolicina <span class="mandatory">*</span></label>
                                <select class="styled">
                                    <option>Plese select size</option>
                                    <option>Smal</option>
                                    <option>Large</option>
                                    <option>XL</option>
                                    <option>xxL</option>
                                    <option>xxxL</option>
                                </select>
                            </li>

                            <li>
                                <label>select color <span class="mandatory">*</span></label>
                                <select class="styled">
                                    <option>Plese select color</option>
                                    <option>Red</option>
                                    <option>yellow</option>
                                    <option>black</option>
                                    <option>green</option>
                                    <option>grey</option>
                                </select>
                            </li>
                        </ul>
                    </div>
            -->

            <div class="point-of-action col-xs-12 col-md-12">
                <div class="quantity">
                    <label><?php echo $TipUnit; ?></label>
                    <input type="number" value="<?php echo $MinimalnaKol; ?>" id="kolicinaArt"
                           placeholder="<?php echo $MinimalnaKol; ?>" min="<?php echo $MinimalnaKol; ?>">
                </div>

                <div class="add-to-cart">
                    <input type="hidden" id="ArtikalId" value="<?php echo $ArtikalId; ?>">
                    <a href="#" class="btn btn-primary" id="dodajuKorpu"><i
                            class="fa fa-shopping-cart"></i> <?php echo $jsonlang[107][$jezikId]; ?></a>

                </div>

            </div>


        <?php } ?>

        <!--Compare i send to friend-->
        <div class="product-btn col-xs-12 col-md-12">
            <ul class="list-unstyled">
                <li>
                    <a href="mailto:<?php echo GLAVNIMAIL; ?>?subject=<?php echo 'Pitanje za artikal id ->' . $ArtikalId . ' ', DPROOT; ?>&amp; body=<?php echo $jsonlang[220][$jezikId] . '  ', DPROOT . $urlArtiklaLink; ?>">
                        <i class="fa fa-question-circle"></i><?php echo $jsonlang[420][$jezikId]; ?></a></li>
                <!--<li><a href="#"><i class="fa fa-heart"></i><?php /*echo $jsonlang[84][$jezikId];  */ ?></a></li>
                <li><a href="#"><i class="fa fa-check-square"></i><?php /*echo $jsonlang[193][$jezikId]; */ ?></a></li>-->
                <li><a href="#" data-id="<?php echo $ArtikalId; ?>" class="dodajkompare"><i
                            class="fa fa-retweet"></i><?php echo $jsonlang[74][$jezikId]; ?></a></li>
                <li>
                    <a href="mailto:?subject=<?php echo $jsonlang[223][$jezikId] . ' ', DPROOT; ?>&amp; body=<?php echo $jsonlang[220][$jezikId] . '  ', DPROOT . $urlArtiklaLink; ?>"
                       onclick="ga('send', 'event', '<?php echo $KategorijaArtikalaNaziv; ?>', '<?php echo $jsonlang[221][$jezikId]; ?>', '<?php echo $ArtikalNaziv; ?>', 0);"
                       title="<?php echo $jsonlang[222][$jezikId]; ?>"><i
                            class="fa fa-envelope"></i><?php echo $jsonlang[108][$jezikId]; ?></a></li>
            </ul>
        </div>
        <!--!Compare i send to friend-->

        <!--<div class="product-btn">
			<ul class="list-unstyled">
				<li><a href="#"><i class="fa fa-heart"></i><?php /*echo $jsonlang[84][$jezikId]; */ ?></a></li>
				<li><a href="#"><i class="fa fa-check-square"></i><?php /*echo $jsonlang[193][$jezikId]; */ ?></a></li>
			</ul>
		</div>-->


        <div class="product-share-social hidden-xs">
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_native_toolbox"></div>
        </div>
    </div>
    <!-- /.col -->

    <div class="col-md-12 col-sm-12 col-xs-12 outer-top-vs10 outer-bottom-xs-10">
        <?php
        require RB_ROOT . '/parts/section/detail/product-info.php';
        ?>
    </div>
    <!-- /.col -->

</div><!-- /.row -->
<!-- ========================================== PRODUCT DETAILS : END ========================================= -->