<div class="news-letter">
    <h3 class="section-title"><?php echo $jsonlang[408][$jezikId]; ?></h3>

    <div>
        <?php
        if ($jezik == 'srb') {
            require_once('cron/crongotovo/informacije-cir-cron.php');
        } else {
            require_once('cron/crongotovo/informacije-lat-cron.php');
        }
        /* $upirKh = "CALL listaKatHeadId(16,1,$jezikId,'','');";
         $upitHead = $db->rawQuery($upirKh);
         if ($upitHead) {

             $khul = '<ul>';
             foreach ($upitHead AS $k => $v) {

                 $IdKategHead = $v['IdKategHead'];
                 $ParentKategHead = $v['ParentKategHead'];
                 $LinkKategHead = $v['LinkKategHead'];
                 $AktivanKategHead = $v['AktivanKategHead'];
                 $MestoKategHead = $v['MestoKategHead'];
                 $NaslovKategHead =  mb_strtoupper($v['NaslovKategHead'], 'UTF-8');
                 $khul .= '<li>';
                      $khul .= '<a href="/'.$LinkKategHead.'">'.$NaslovKategHead.'</a>';
                 $khul .= '</li>';

             }
             echo $khul .= '</ul>';


         }
 */
        ?>
    </div>
</div><!-- /.news-letter -->
<!-- ============================================== NEWSLETTER : END ============================================== -->