<?php
$cols = Array("BR.BrendId","BR.BrendLink", "BR.BrendNaslovna", "BR.BrendActive", "BR.BrendSlika", "BI.BrendIme", "BO.BrendOpis");
$db->join("brendoviime BI", "BI.BrendId = BR.BrendId AND BI.IdLanguage = 5", "LEFT");
$db->join("brendoviopis BO", "BO.BrendId = BR.BrendId AND BO.IdLanguage = 5 ", "LEFT");
//$db->where("BR.BrendShow = 1 AND BR.BrendNaslovna = 1");
$data = $db->get("brendovi BR", null, $cols);

$i = 1;

$brand='';
foreach ($data as $sds => $link) {
    $BrendId = $link['BrendId'];
    $BrendIme = $link['BrendIme'];
    $BrendLink = $link['BrendLink'];
    $BrendSlika = $link['BrendSlika'];

    $linkB = $BrendLink . '/b';

    $slaa = $common->locationslikaOstalo(BRENDSLIKELOK, $BrendId);

    $ext = pathinfo($BrendSlika, PATHINFO_EXTENSION);
    $fileName = pathinfo($BrendSlika, PATHINFO_FILENAME);
    //$mala_slika = $fileName . '_mala.' . $ext;
    $mala_slika = $fileName . '.' . $ext;

    //$lok = DCROOT . $slaa . '/' . $mala_slika;
    $lok = DCROOT.'/'.BRENDSLIKELOK.'/'.$mala_slika;

    //$slika = $fileName . '_172.' . $ext;
    $slika = $fileName . '.' . $ext;

    if (is_file($lok)) {
        $slikaBrend = BRENDSLIKELOK.'/'.$mala_slika;
        $brand .= '<div class="item wow fadeInUp" data-wow-delay="0.2s"><a href="/' . $linkB . '" class="logo"><img src="/'.$slikaBrend. '"  alt="' . $BrendIme . '" title="' . $BrendIme . '" class="img-responsive"></a></div>';
    } else {
        $brand .= '<div class="item wow fadeInUp" data-wow-delay="0.2s"><a href="/' . $linkB . '"><b>' . $BrendIme . '</b></a></div>';
    }

    // echo '<div class="item wow fadeInUp" data-wow-delay="0.2s"><a href="/'.$linkB.'" class="logo"><img src="/assets/images/brands/'.$BrendId .'/'.$slika.'"  alt="'.$BrendIme.'" title="'.$BrendIme.'" class="img-responsive"></a></div>';

}

$fpp = fopen(DCROOT.'/cron/crongotovo/our-brands-v2-cron.php', 'w+');
fwrite($fpp, $brand);
fclose($fpp);
