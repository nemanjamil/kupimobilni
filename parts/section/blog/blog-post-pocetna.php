<!--ovo je za Lista saveta na stranici strucni saveti-->
<?php

$cols = Array("V.*", "VN.VestiNaslov" . $jezik, "VO.VestiOpis" . $jezik, "K.KomitentIme, K.KomitentPrezime, K.KomitentiSlika");
$db->join("vestinaslov VN", "VN.IdVestiNaslov = V.IdVesti");
$db->join("vestiopis VO", "VO.IdVestiOpis = V.IdVesti");
$db->join("komitenti K", "K.KomitentId = V.IdKomitentVesti");
$db->join("kategorijeartikala KAT", "KAT.KategorijaArtikalaId = V.IdKategVesti");
$db ->where("V.SajtVesti = '1' ");
$dataVesti = $db->get("vesti V", array(0, 10), $cols);

$lisVestipoKat = '';

foreach ($dataVesti as $sds => $link) {
    $IdVesti = $link['IdVesti'];
    $NaslovVesti = $link['VestiNaslov' . $jezik];
    $VestiOpisVest = $link['VestiOpis' . $jezik];

    $DatumVesti = $link['DatumVesti'];
    $SlikaVesti = $link['SlikaVesti'];
    $MestoVesti = $link['MestoVesti'];

    $VestKomitentIme = $link['KomitentIme'];
    $VestKomitentPrezime = $link['KomitentPrezime'];
    $VestKomitentiSlika = $link['KomitentiSlika'];

    $UrlVesti = $link['UrlVesti'];
    $linkV = '/' . $UrlVesti . '/v';


    $imaPrevest = $VestKomitentIme . ' ' . $VestKomitentPrezime;

    // slika vest
    $slika = $common->locationslikaOstalo(VESTISLIKELOK, $IdVesti);
    $ext = pathinfo($SlikaVesti, PATHINFO_EXTENSION);
    $fileName = pathinfo($SlikaVesti, PATHINFO_FILENAME);
    $velika_slikaVest = $slika . '/' . $fileName . '.' . $ext;


    $lisVestipoKat .= '<div>';
        $lisVestipoKat .= '<div class="blog-post wow fadeInUp" style="max-height: 600px; overflow: hidden">';
         $lisVestipoKat .= '<a class="post-image" href="' . $linkV . '"><img class="img-responsive" src="' . $velika_slikaVest . '" alt="#"></a>';
            $lisVestipoKat .= '<h1><a href="' . $linkV . '">' . $NaslovVesti . '</a></h1>';
            $lisVestipoKat .= '<br>';
//  $lisVestipoKat .= '<span class="author-date">By : '.$imaPrevest.' od datuma : '.$DatumVesti.'</span>';
            $lisVestipoKat .= '<p>' . $VestiOpisVest . '</p>';
    $lisVestipoKat .= '</div>';
    $lisVestipoKat .= '<a href="' . $linkV . '" class="btn btn-upper btn-primary">' . $jsonlang[162][$jezikId] . '</a>';
        $lisVestipoKat .= '<hr>';
    $lisVestipoKat .= '</div>';
}

echo $lisVestipoKat;


?>


