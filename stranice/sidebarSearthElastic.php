<div class="side-menu">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="centriraj padding15">
            <button type="reset" id="resetujFiltereEs" class="btn btn-primary filter_resetES"><?php echo $jsonlang[428][$jezikId]; ?></button>
        </div>
        <!--Kategorije-->
        <?php
        require('elasticUpitSearch/SidebarSearchElasticKategorije.php');
        ?>
        <!--Brendovi-->
        <?php
        require('elasticUpitSearch/SidebarSearchElasticBrendovi.php');
        ?>
        <!--Specifikacije-->
        <?php
        require('elasticUpitSearch/SidebarSearchElasticSpecifikacije.php');
        ?>


    </div>

</div>
<!--Cena range-->
<?php
//require('elasticUpitSearch/SidebarSearchElasticCenaRange.php');
?>

