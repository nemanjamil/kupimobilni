<!-- ========================================== CONTROLS PRODUCT ITEM ========================================= -->
<div class="controls-product-item row">
    <div class="col-xs-12 col-md-6">
        <div class="product-item-view">
            <ul class="nav nav-tabs">
                <li><span><?php echo $jsonlang[60][$jezikId]; ?></span></li>
                <li ><a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th"></i></a></li>
                <li class="active"><a data-toggle="tab" href="#list-container" aria-expanded="true"><i class="icon fa fa-th-list"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div id="reloadKategSearch" class="col-xs-12 col-md-1 hidden-xs" style="display: none">
        <a class="text-danger boldirano" href=""><?php echo $jsonlang[422][$jezikId]; ?></a>
    </div>
    <div class="col-xs-12 col-md-5 formaMoja pull-right hidden-xs">
       <!-- <input id="targetArtikal" kateg="<?php /*echo $KategorijaArtikalaIdOS; */?>" placeholder="<?php /*echo $jsonlang[421][$jezikId]; */?>" type="text">-->
    </div>


</div>

<div class="controls-product-item row">

    <!--Kontrole sortiraj i prikazi-->

    <div class="col-sm-8 col-md-8 col-xs-6"><!--no-padding-->
        <div class="custom-select pull-left">
            <form id="Kontrole" action="" onchange="submit()" method="POST">
                <ul class="list-unstyled">

                    <li class="short-by ">

                        <select class="styled" name="kontrole[brend]">
                            <?php
                            echo '<option value="0">'. $jsonlang[348][$jezikId].'</option>';
                            if ($upitBrendKat) {
                                // ovo dobijamo od /var/www/masine/stranice/opisivacstrane.php linija 92
                                foreach ($upitBrendKat as $k => $v):
                                    $kodBrend = ($v['ArtikalBrendId'] == $kontrole['brend']) ? 'selected' : '';
                                    echo '<option value="' . $v['ArtikalBrendId'] . '" ' . $kodBrend . '>' . $v['BrendIme'] . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                    </li>

                    <li class="short-by hidden-xs">
                        <!--<label><?php /*echo $jsonlang[66][$jezikId]; */ ?>:</label>-->
                        <select class="styled" name="kontrole[sortKontrole]">
                            <?php $KonArray = array(

                                1 => $jsonlang[61][$jezikId], //Po gledanosti
                                2 => $jsonlang[62][$jezikId], //Ceni rastuce ASC
                                3 => $jsonlang[63][$jezikId], //Ceni opadajuce DESC
                                4 => $jsonlang[64][$jezikId] . ' A-Z', //Po nazivu
                                5 => $jsonlang[64][$jezikId] . ' Z-A', //Po nazivu
                                6 => $jsonlang[65][$jezikId]  //Po poslednjedodatom proizvodu

                            );
                            foreach ($KonArray as $k => $v):
                                $kodPosel = ($k == $kontrole['sortKontrole']) ? 'selected' : '';
                                echo '<option value="' . $k . '" ' . $kodPosel . '>' . $v . '</option>';
                            endforeach;
                            ?>
                        </select>
                    </li>

                    <li class="show-page hidden-xs">
                        <label class=""><?php echo $jsonlang[67][$jezikId]; ?>:</label>
                        <select class="styled" name="kontrole[limitpostrani]">
                            <?php $KonArray = array(
                                "2" => "2",
                                "5" => "5",
                                "10" => "10",
                                "20" => "20",
                                "50" => "50",
                                "100" => "100"
                            );
                            foreach ($KonArray as $k => $v):
                                $kodPosel = ($k == $kontrole['limitpostrani']) ? 'selected' : '';
                                echo '<option value="' . $k . '" ' . $kodPosel . '>' . $v . '</option>';
                            endforeach;
                            ?>


                        </select>
                    </li>

                </ul>
            </form>
        </div>
    </div>
    <!-- /.col -->


    <div class="col-sm-4 col-md-4 col-xs-6 no-padding">
        <?php
        echo $pag;
        ?>
    </div>
    <!-- /.col -->


</div><!-- /.row -->
<!-- ========================================== CONTROLS PRODUCT ITEM : END ========================================= -->