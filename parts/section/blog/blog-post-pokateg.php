<!--ovo je za Lista saveta po kategoriji-->
<?php

// upit smo prebacili u opisivacstrane na liniju gde je case "vestipokateg":

$lisVestipoKat = '';
if ($dataVesti) {
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
            $lisVestipoKat .= '<div class="blog-post wow fadeInUp"  style="max-height: 700px; overflow: hidden">';
                $lisVestipoKat .= '<a class="post-image" href="' . $linkV . '"><img class="img-responsive" src="' . $velika_slikaVest . '" alt="#"></a>';
                $lisVestipoKat .= '<h1><a href="' . $linkV . '">' . $NaslovVesti . '</a></h1>';
                   $lisVestipoKat .= '<br>';
                 //$lisVestipoKat .= '<span class="author-date">By : ' . $imaPrevest . ' od datuma : ' . $DatumVesti . '</span>';
                 //dogovorili smo sa Maretom da nam ne treba ovde, samo u samom tekstu
                      $lisVestipoKat .= '<p>' . $VestiOpisVest . '</p>';
            $lisVestipoKat .= '</div>';
         $lisVestipoKat .= '<a href="' . $linkV . '" class="btn btn-upper btn-primary">' . $jsonlang[162][$jezikId] . '</a>';
            $lisVestipoKat .= '<hr>';
        $lisVestipoKat .= '</div>';
    }

    echo $lisVestipoKat;

}
?>