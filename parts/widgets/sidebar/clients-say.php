<!-- ============================================== CLIENT SAY ============================================== -->
<h3 class="section-title"><?php echo $jsonlang[95][$jezikId]; ?></h3>
<div class="clients-say">

    <?php

    $db->join("komitenti k", "r.KomitRekOnama=k.KomitentId");
    $db ->where("r.SajtOnama = '1' ");
    $dataOnama = $db->get("rekonama r", null, "r.idRekOnam,r.OpisRekONama,r.KomitRekOnama,k.KomitentIme,k.KomitentFirma,k.KomitentiSlika,k.KomitentId");

    $i = 1;
    $tab = '';
    if ($dataOnama) {
        foreach ($dataOnama as $sds => $link) {
            $idRekOnam = $link['idRekOnam'];
            $OpisRekONama = $link['OpisRekONama'];
            $KomitRekOnama = $link['KomitRekOnama'];
            $KomitentFirma = $link['KomitentFirma'];
            $KomitentiSlika = $link['KomitentiSlika'];
            $KomitentIme = $link['KomitentIme'];
            $KomitentId = $link['KomitentId'];

            $lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $KomitentId);
            $ext = pathinfo($KomitentiSlika, PATHINFO_EXTENSION);
            $fileName = pathinfo($KomitentiSlika, PATHINFO_FILENAME);
            $mala_slika = $fileName . '_mala.' . $ext;
            $lok = DCROOT . $lokrel . '/' . $mala_slika;

            if (file_exists($lok)) {
                $tabSlika = '<img src="' . $lokrel . '/' . $mala_slika . '" alt="Avatar">';
            } else {
                $tabSlika = '<img src="/assets/images/testimonial/1.jpg" alt="" class="img-responsive">';
            }

            $tab .= '<div class="item">';

                $tab .= '<div class="content-box">';
                    $tab .= '<p class="content"> ' . $OpisRekONama . '</p >';
                $tab .= '</div>';

                $tab .= '<div class="client-info media">';
                      /*$tab .= '<div class="media-left">';
                          $tab .= $tabSlika;
                      $tab .= '</div>';*/

                   /* $tab .= '<div class="media-body client-name">';
                         $tab .= '<h4>' . $KomitentIme . ' </h4>';
                             $tab .= '<span class="client-company"> ' . $KomitentFirma . '</span>';
                    $tab .= '</div>';*/
                $tab .= '</div>';

            $tab .= '</div>';
        }
        echo $tab;
        $i++;
    }
    ?>
</div><!-- /.clients-say -->
<!-- ============================================== CLIENT SAY : END ============================================== -->