<!-- ========================================= CONTENT ========================================= -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Search</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content">
    <div class="container">
        <div class="row blog">

            <div class="col-md-9 col-xs-12">
                <?php

                if (isset($_GET['q'])) {
                    $qq = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
                } else {
                    $qq = '';
                }

                $term = trim($qq);
                $term = strtolower($term);
                $kolikoArtikalaMaxEs = 20000;
                $kolikoArtikalaSugest = 1000;


                require('elasticNew/sesionVarElasticSearch.php');
                require('elasticNew/upitNumberOfArticlesElastic.php');

                ?>

                <div class="search-result-container">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product"> <!-- bilo je inner-top-xs -->
                                <div class="controls-product-top outer-top-vs wow fadeInUp">
                                    <?php
                                        require_once('controls-elastic-search.php');
                                    ?>
                                </div>

                                <div class="row" style="text-align: left"> <!--style="text-align: left"-->

                                    <?php
                                    if ($qq) {
                                        require_once('searchProizElastic.php'); // G:\projects\Masine\trunk\stranice\searchProiz.php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.sidebar -->

            <div class="col-md-3 col-xs-12 sidebar">
<form>

                <?php
                    require_once('sidebarSearthElastic.php');
                ?>
                <!-- <script>
                     (function () {
                         var cx = '007233513435156911827:x6h25cvudrk';
                         var gcse = document.createElement('script');
                         gcse.type = 'text/javascript';
                         gcse.async = true;
                         gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                             '//cse.google.com/cse.js?cx=' + cx;
                         var s = document.getElementsByTagName('script')[0];
                         s.parentNode.insertBefore(gcse, s);
                     })();
                 </script>
                 <gcse:searchresults-only></gcse:searchresults-only>-->
</form>
            </div>
            <!-- /.col -->


        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div><!-- /.body-content -->
<!-- ========================================= CONTENT : END========================================= -->
