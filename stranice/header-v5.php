<!-- ============================================== HEADER-v5 ============================================== -->
<header>
    <!--ovde smo setovali komitent id-->
    <input type="hidden" id="KomitentId" value="<?php echo $KomitentId; ?>">

    <div class="header-v5">
        <div class="top">
            <div class="container">
                <div class="row">
                    <!--<div class="col-xs-12 col-sm-12 col-md-4 top-bar">
                        <div class="language-currency">
                            <?php  /* require RB_ROOT . '/parts/widgets/header/language-currency.php'; */ ?>
                        </div>
                        <span class="welcome-msg hidden-xs"><?php  /*echo $jsonlang[13][$jezikId];  */?></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-1 ">
                    </div> -->
                    <div class="col-md-4"></div>
                    <div  class="col-xs-12 col-md-4 boldirano font16 bojacrnadef text-left header-phone">
                        <?php echo $jsonlang[1][$jezikId] . ': ' . $jsonOsn[$jezikId]["TelefonOsnPodaci"] . ' '. $jsonlang[414][$jezikId] .' ' . $jsonOsn[$jezikId]["MobTelOsnPodaci"] ?>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-4 top-navbar">
                        <?php require RB_ROOT . '/parts/navigation/top-navbar.php'; ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.top -->
        <div class="middle bott">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-4 logo">
                       <!-- <div class="col-xs-12 col-sm-4 col-md-2"></div>-->


                        <div class="navbar-headerXXX col-xs-12 col-sm-6 col-md-10">
                            <a href="/" class="navbar-brand">
                                <?php require RB_ROOT . '/parts/widgets/header/logo.php'; ?>
                            </a>
                            <button data-target=".mc-horizontal-menu-collapse1" data-toggle="collapse"
                                    class="navbar-toggle collapsed" type="button">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-2"></div>


                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <?php require RB_ROOT . '/parts/widgets/header/option-search-bar.php'; ?>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="dropdown dropdown-cart shopping-cart">
                            <?php
                            require('headerKorpa.php');
                            ?>

                            <?php require RB_ROOT . '/parts/widgets/header/cart-style-v2.php'; ?>
                            <?php //require RB_ROOT . '/parts/widgets/header/shopping-cart.php'; ?>

                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.middle -->

        <div class="navbar-wrapper bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 navbar">
                        <?php require RB_ROOT . '/parts/navigation/navbar.php'; ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.bottom -->
    </div>
    <!-- /.header-v5 -->

</header>
<!-- ============================================== HEADER-v5 : END ============================================== -->
