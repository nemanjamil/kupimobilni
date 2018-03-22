<!-- ============================================== PRODUCT TAGS ============================================== -->
<?php
/*$cols = Array("T.TagoviId", "T.TagoviIme");
$db->join("tagovi T", "T.TagoviId = TA.IdOdTagovaArt");
$db->where('TA.IdTagoviArtikli', $id);
$db->orderBy("T.TagoviIme", "DESC");
$tagArt = $db->get("tagoviartikli TA", null, $cols);*/

$tagArt = $db->rawQuery("CALL tagoviArtPripad($ArtikalId)");

if ($tagArt) {
    ?>
    <div class="product-tag"><!--wow fadeIn-->
        <h3 class="section-title"><?php echo $jsonlang[112][$jezikId]; ?></h3>

        <div class="tag-list">
            <?php
            foreach ($tagArt as $k => $v):
                $TagoviIme = $v['TagoviIme'];
                $TagoviId = $v['TagoviId'];
                echo '<a href="/tag/' . $TagoviId . '" title="Fashion" class="item">' . $TagoviIme . '</a>';
            endforeach;
            ?>

        </div>
    </div>

<?php } ?>
<!-- ============================================== PRODUCT TAGS : END ============================================== -->