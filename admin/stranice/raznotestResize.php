<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Nemanja Test</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <?php
                /*
                         * POCETAK TEST
                         */
                $slika = 'http://masine/p/64/641/wall-chaser-gnf-35-ca-3724-641.png';

                $imeSlikeKodNas = '/var/www/masine/p/64/641/wall-chaser-gnf-35-ca-3724-641.png';
                $linkSlikaDodatna = "http://images.bosch-professional.com/rs/sr/productimages/usageimg/wall-chaser-gnf-35-ca-2614.png";
                $kanvas = 200;
                $im = imagecreatetruecolor($kanvas, $kanvas);
                $white = imagecolorallocate($im, 255, 255, 255);
                imagefilledrectangle($im, 0, 0, $kanvas, $kanvas, $white);

                list($width, $height) = getimagesize($linkSlikaDodatna);
                $icon1 = imagecreatefrompng($linkSlikaDodatna);

                echo '<br/> $maxD : ';
                echo $maxD = ($width>$height) ?  $width : $height;

                if ($maxD>$kanvas) {
                    echo '<br/> $racio : ';
                    echo $racio = $kanvas/$maxD*0.9;
                    $resW = $width*$racio;
                    $resH = $height*$racio;
                } else {
                    $resW = $width*0.95;
                    $resH = $height*0.95;
                }

                echo '<br/> $resW : ';
                echo $resW;
                echo '<br/> $resH : ';
                echo $resH;
                echo '<br/> W : ';
                echo $width;
                echo '<br/> H : ';
                echo $height;
                echo '<br/>X :';
                echo $x = intval(($kanvas - $resW) / 2);
                echo '<br/> Y : ';
                echo $y = intval(($kanvas - $resH) / 2);
                echo '<br/>';
                imagecopyresampled($im, $icon1, $x, $y, 0, 0, $resW, $resH, $width, $height);


                imagepng($im, $imeSlikeKodNas);
                imagedestroy($im);
                /*
                 * KRAJ TEST
                 */
                ?>
            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->