<div>
    <?php
    //if (!$InstaliranAppAnd) {

    $nakasdInfoProizApp = $common->stanjeOpisSveId(  $ArtikalStanje,
                                                $ArtikalMPCena,
                                                $sesValuta,
                                                $jsonlang[229][$jezikId],
                                                $jsonlang[117][$jezikId],
                                                $jsonlang[116][$jezikId],
                                                $pravaVpApp,
                                                $pravaMpApp,
                                                $tipUsera,
                                                $dani   );

    $cenaSamoBrojFormatInfoApp = $nakasdInfoProizApp['cenaSamoBrojFormat'];
    $cenaPrikazExtInfoApp = $nakasdInfoProizApp['cenaPrikazExt'];

    echo '<div class="bojacrvenasajt">
                        <a class="bojasiva4f" target="_blank" href="'.ANDRAPP.'"> ' . $jsonlang[416][$jezikId] . '
                        <span class="bojacrvenasajt"><b> Android </b>' . $jsonlang[417][$jezikId] . ' </span> ' . $jsonlang[418][$jezikId] . ' </a>
                        <span></span>' . $cenaSamoBrojFormatInfoApp . ' ' . $cenaPrikazExtInfoApp . '</div>';

    // }
    ?>
</div>