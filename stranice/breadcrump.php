<!-- ========================================= CONTENT BREADCRUMP ========================================= -->

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <?php
            if ($KategorijaArtikalaIdOS) {
                $upitBreArr = "CALL breadCrumpNew($KategorijaArtikalaIdOS,$jezikId)";
                $uptBC = $db->rawQuery($upitBreArr);


                if ($uptBC) {
                    $uptBC = array_reverse($uptBC);
                    $brC = '<ul  class="list-inline list-unstyled" itemscope itemtype="http://schema.org/BreadcrumbList">';
                    $brC .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/"><span itemprop="name">' . $jsonlang[27][$jezikId] . '</span></a>
                                <meta itemprop="position" content="1" />
                             </li>';
                    $i = 2;
                    foreach ($uptBC as $bk => $bv) {
                        $bcime = $bv['KatIme'];
                        $bclink = $bv['link'];

                        $brC .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item"  href="/' . $bclink . '" class="active"><span itemprop="name">' . $bcime . '</span></a>
                                    <meta itemprop="position" content="' . $i . '" />
                                </li>';
                        $i++;
                    }
                    $brC .= '</ul>';
                }
                echo $brC;
            }

            $brC = '';

            if ($katZdravljeID) {
                $upitBreArr = "CALL bkZdravlje($katZdravljeID)";
                $uptBC = $db->rawQuery($upitBreArr);

                if ($uptBC) {
                    $uptBC = array_reverse($uptBC);
                    $brC = '<ul class="list-inline list-unstyled" itemscope itemtype="http://schema.org/BreadcrumbList">';
                    $brC .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/"><span itemprop="name">' . $jsonlang[27][$jezikId] . '</span></a>
                                <meta itemprop="position" content="1" />
                             </li>';
                    $i = 2;
                    foreach ($uptBC as $bk => $bv) {
                        $bcime = $bv['Kat' . $jezik];
                        $bclink = $bv['link'];

                        $brC .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="/z/' . $bclink . '" class="active"><span itemprop="name">' . $bcime . '</span></a>
                                    <meta itemprop="position" content="' . $i . '" />
                                 </li>';
                        $i++;
                    }
                    $brC .= '</ul>';
                }
                echo $brC;
            }
            ?>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div><!-- /.breadcrumb -->

<!-- ========================================= CONTENT BREADCRUMP : END ========================================= -->