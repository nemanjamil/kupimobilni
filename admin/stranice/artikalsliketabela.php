<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 12:54
 */
?>
<div class="col-md-7">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-picture"></i> Slike artikala</h4>
        </div>
        <div class="widget-content">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Mala Slika</th>
                    <th>Link ka velikoj slici</th>
                    <th>Glavna Slika</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $cols = Array("IdArtikliSlike", "ImeSlikeArtikliSlike", "MainArtikliSlike");
                $db->where("IdArtikliSlikePov", $id);
                $tagoviArtupit = $db->get('artiklislike', null, $cols);
                if ($tagoviArtupit) {
                    foreach ($tagoviArtupit as $key => $val) {
                        $slikaV = $val['ImeSlikeArtikliSlike'];
                        $IdArtikliSlike = $val['IdArtikliSlike'];
                        $MainArtikliSlike = $val['MainArtikliSlike'];
                        $artAktMainSl = ($MainArtikliSlike) ? 'checked' : '';


                        $lokDoslike = $common->locationslika($id);
                        $ext = pathinfo($slikaV, PATHINFO_EXTENSION);
                        $fileName = pathinfo($slikaV, PATHINFO_FILENAME);
                        $mala_slika = $fileName . '_mala.' . $ext;
                        $likDoslike = $lokDoslike . '/' . $slikaV;
                        if (file_exists(DCROOT . '/' . $likDoslike)) {

                            $slikaML = DPROOT . $lokDoslike . '/' . $mala_slika;
                            $slikaVpri = DPROOT.$likDoslike;
                            $sl .= '<tr>';
                            $sl .= '<td><img src="' .$slikaML . '" alt=""></td>';
                            $sl .= '<td><a target="_blank" href="'.$slikaVpri.'">'.$slikaVpri.'</a></td>';
                            $sl .= '<td><input '.$artAktMainSl.' type="checkbox" data-name="'.$IdArtikliSlike.'" class="MainArtSlikeEdit"></td>';
                            $sl .= '<td class="align-center">
                                                        <span class="btn-group">
                                                         <a data-original-title="Delete" href="javascript:void(0);" lds="' . $slikaV . '" idSlike="' . $IdArtikliSlike . '" idArt="' . $id . '" class="btn btn-xs bs-tooltip obrisiSlikuArtikal" title=""><i class="icon-trash"></i></a>
                                                        </span>
                                                        </td>';
                            $sl .= '</tr>';
                        } else {
                            $sl .= '<tr>';
                            $sl .= '<td><img src="' . DPROOT . $lokDoslike . '/' . $mala_slika . '" alt=""></td>';
                            $sl .= '<td><a href="">Link</a></td>';
                            $sl .= '<td class="align-center">
                                                        <span class="btn-group">
                                                         <a data-original-title="Delete" href="javascript:void(0);" lds="' . $slikaV . '" idSlike="' . $IdArtikliSlike . '" idArt="' . $id . '" class="btn btn-xs bs-tooltip obrisiSlikuArtikal" title=""><i class="icon-trash"></i></a>
                                                        </span>
                                                        </td>';
                            $sl .= '</tr>';
                        }
                    }
                }
                echo $sl;

                ?>


                </tbody>
            </table>
        </div>
    </div>
    <!-- /Simple Table -->

    <?php

    /*$lok = $common->locationslika($idArt);
    $lokslifol = DCROOT . $lok;*/
    $filesDoSlike = DCROOT . $lokDoslike;
    $files = glob($filesDoSlike.'/*'); // get all file names

    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            //echo '<div>'.$file.' => <span><a href="">del</a></span></div>';
           // unlink($file); // delete file
        }
    }

    ?>
</div>