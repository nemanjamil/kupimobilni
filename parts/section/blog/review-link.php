<div class="blog-write-comment">
    <div class="col-md-12">
    <h4><?php echo $jsonlang[318][$jezikId]; ?></h4>
</div>
<?php
if ($vroj){
    ?>
    <!--Oceni artikal-->
    <div class="col-md-12 navbar-nav">


        <div class="list-group ">
            <a href="/ocene" target="_blank"
               class="list-group-item basic-alert textdesno"><?php echo $jsonlang[319][$jezikId]; ?></a>
            <a rel="nofollow" target="_blank" href="/ocene/<?php echo $id; ?>"
               class="list-group-item basic-alert textdesno"><?php echo $jsonlang[318][$jezikId]; ?> </a>
            <?php if ($KomitentUserName) {
                $a = '<a rel="nofollow" target="_blank" href="/p/str/mojerecenzije/' . $KomitentUserName . '" class="list-group-item basic-alert textdesno">' . $jsonlang[298][$jezikId] . ' </a>';
            }
            echo $a;
            ?>

        </div>
    </div>


<?php } else { ?>


    <div class="col-md-12 navbar-nav">

        <div class="list-group ">
            <a href="/ocene" target="_blank"
               class="list-group-item basic-alert centriraj"><?php echo $jsonlang[319][$jezikId]; ?></a>
            <a rel="nofollow" target="_blank" href="/ocene/<?php echo $id; ?>"
               class="list-group-item basic-alert centriraj"><?php echo $jsonlang[318][$jezikId]; ?> </a>
            <?php if ($KomitentUserName) {
                $a = '<a rel="nofollow" target="_blank" href="/p/str/mojerecenzije/' . $KomitentUserName . '" class="list-group-item basic-alert centriraj">' . $jsonlang[298][$jezikId] . ' </a>';
            }
            echo $a;
            ?>

        </div>
    </div>

<?php } ?>
</div>