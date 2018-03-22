<!-- ============================================== BLOG SLIDER ============================================== -->
<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 18. 03. 2016.
 * Time: 15:22
 */
$jezikTrenutni = 'srb';

$cols = Array("V.*","VN.VestiNaslov".$jezikTrenutni, "VO.VestiOpis".$jezikTrenutni);
$db->join("vestinaslov VN", "VN.IdVestiNaslov = V.IdVesti");
$db->join("vestiopis VO", "VO.IdVestiOpis = V.IdVesti");
$db->where("V.SajtVesti = '1'");
$dataVest = $db->get("vesti V", Array(0,5), $cols);

$datveArr = '';
if ($dataVest) {

    foreach ($dataVest as $k => $link){

        $IdVesti = $link['IdVesti'];
        $NaslovVesti = $link['VestiNaslov' . $jezikTrenutni];
        $DatumVesti = $link['DatumVesti'];
        $SlikaVesti = $link['SlikaVesti'];
        $MestoVesti = $link['MestoVesti'];
        $UrlVesti = $link['UrlVesti'];
        $procitaj = 'прочитајте још';


        $linkV = '/' . $UrlVesti . '/v';

        $slika = $common->locationslikaOstalo(VESTISLIKELOK, $IdVesti);

        $ext = pathinfo($SlikaVesti, PATHINFO_EXTENSION);
        $fileName = pathinfo($SlikaVesti, PATHINFO_FILENAME);

        $mala_slika = $fileName . '_mala.' . $ext;


        $lok = DCROOT . $slika . '/' . $mala_slika;
        if (file_exists($lok)) {
            $slikaV = '<img class="img-responsive" src="' . $slika . '/' . $mala_slika . '" alt="' . $NaslovVesti . '">';
        } else {
            $slikaV = '<img src="/assets/images/blog/18.jpg" alt="" class="img-responsive">';
        }

        $datum = $db->query("SELECT  YEAR(DatumVesti) as god, MONTHNAME(DatumVesti) as mes From vesti WHERE IdVesti = $IdVesti");
        foreach ($datum as $sds => $s) {
            $god = $s['god'];
            $mes = $s['mes'];

        }

        $datveArr .= '<div class="item">';
        $datveArr .= '<div class="blog-post">';
        $datveArr .= '<div class="blog-post-image">';
        $datveArr .= '<div class="image">';
        $datveArr .= '<a href="' . $linkV . '">' . $slikaV . '</a>';
        $datveArr .= '</div>';
        $datveArr .= '<div class="post-when">';
        $datveArr .= '<span class="month">' . $mes . '</span><span class="year">' . $god . '</span> ';
        $datveArr .= '</div>';
        $datveArr .= '</div><!-- /.blog-post-image -->';

        $datveArr .= '<div class="blog-post-info">';
        $datveArr .= '<h3 class="name"><a href="' . $linkV . '" class="read-more">' . $NaslovVesti . '</a></h3>';

        $datveArr .= '<p class="text"> [ <a	href="' . $linkV . '" class="read-more">' . $procitaj . '</a> ]</p>';
        $datveArr .= '</div><!-- /.blog-post-info -->';
        $datveArr .= '</div><!-- /.blog-post -->';
        $datveArr .= '</div><!-- /.item -->';

    }
}
$fpp = fopen(DCROOT.'/cron/crongotovo/blog-single-fashion-cron-cir.php', 'w+');
fwrite($fpp, $datveArr);
fclose($fpp);

?>



