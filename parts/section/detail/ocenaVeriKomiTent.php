<?php
if ($OcenaVeriKomi) {
    ?>
    <div role="tabpanel" class="tab-pane fade" id="product-komitent">


        <div class="col-xs-12 col-sm-12 col-md-12">
            <?php echo $jsonlang[177][$jezikId]; ?> <a
                href="/<?php echo $KomitentiUserNameKom; ?>"> <?php echo $jsonlang[178][$jezikId]; ?> </a>
        </div>

        <div class="clearfix odvojKategBaner"></div>

        <div class="col-xs-6 col-sm-6 col-md-4">
            <?php echo $slikaKomitent; ?>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-8">
            <?php echo $komArra; ?>
        </div>
        <div class="odvojKategBaner clearfix"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 borderMoj2">
            <?php echo $jsonOsn[$jezikId]["OstaliPodaciOsnPodaci"]; ?>

        </div>


    </div>

    <?php
}
?>