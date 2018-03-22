<?php
?>

<div class="controls-product-item row">

    <!--Kontrole sortiraj i prikazi-->

    <div class="col-sm-9 col-md-9 col-xs-7"><!--no-padding-->
        <div class="custom-select pull-left">
            <form id="Kontrole" action="" onchange="submit()" method="POST">
                <ul class="list-unstyled">


                    <li class="short-by hidden-xs">
                        <!--<label><?php /*echo $jsonlang[66][$jezikId]; */ ?>:</label>-->
                        <select class="styled" name="kontrole[sortKontrole]">
                            <?php $KonArray = array(

                                1 => $jsonlang[61][$jezikId], //Po gledanosti
                                2 => $jsonlang[62][$jezikId], //Ceni rastuce ASC
                                3 => $jsonlang[63][$jezikId], //Ceni opadajuce DESC
                                4 => $jsonlang[64][$jezikId] . ' A-Z', //Po nazivu
                                5 => $jsonlang[64][$jezikId] . ' Z-A', //Po nazivu
                                6 => $jsonlang[65][$jezikId],//Po poslednjedodatom proizvodu
                                

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
                                2 => 2,
                                5 => 5,
                                10 => 10,
                                20 => 20,
                                50 => 50,
                                100 => 100
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

    <div class="col-sm-3 col-md-3    col-xs-5 no-padding">
        <ul class="pagination">
            <?php
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $linkUrlPage = parse_url($actual_link);
            $linkPath = $linkUrlPage['path'];
            $queryPath = $linkUrlPage['query'];
            if ($queryPath) {
                $staExplode = explode('&', $queryPath);
            }
            $upitSteExplode = ($staExplode[0]) ? '?' . $staExplode[0] : '';

            $linkDoUPita = DPROOT . $linkPath . $upitSteExplode;


            $strEls = '';
            $kojaJeStranaEs = (int)$_GET['stranaEs'];
            if ($kojaJeStranaEs) {

                for ($i = 1; $i <= $kojaJeStranaEs; $i++) {
                    if ($i == 7) {
                        break;
                    }
                    if ($i == $kojaJeStranaEs) {
                        $strEls .= '<li class="active"><span>' . $i . '</span></li>';
                    } else {
                        $strEls .= '<li><a href="' . $linkDoUPita . '&stranaEs=' . $i . '">' . $i . '</a></li>';
                    }
                }

                $strEls .= '<li><a href="' . $linkDoUPita . '&stranaEs=' . $i . '">' . $i . '</a></li>';
            } else {
                $strEls .= '<li class="active"><span>1</span></li>';
                $strEls .= '<li><a href="' . $linkDoUPita . '&stranaEs=2">2</a></li>';
                $strEls .= '<li><a href="' . $linkDoUPita . '&stranaEs=3">3</a></li>';
            }
            echo $strEls;
            ?>
        </ul>
    </div>
</div>
