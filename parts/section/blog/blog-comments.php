<!-- ============================================== BLOG COMMENTS ============================================== -->
<?php
$cols = Array("K.UserKomentari", "K.EmailKomentar", "K.ImeKomentar",
    "K.VremeKomentar", "K.KomentarKomentari", "Komit.KomitentEmail", "Komit.KomitentIme", "Komit.KomitentPrezime", "Komit.KomitentiSlika");
$db->join("komitenti Komit", "Komit.KomitentId = K.UserKomentari", "LEFT");
$db->where("K.ArtikalKomentar", $ArtikalId);
$db->where("K.ActiveKomentar", 1);
$KomentariUp = $db->get("komentari K", null, $cols);
if ($KomentariUp) {
    ?>

    <div class="blog-comments wow fadeInUp">
        <h3 class="title"><?php echo $jsonlang[251][$jezikId]; ?><span class="comments-count"></span></h3>

        <ul class="media-list">
            <!--	<li class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="/assets/images/blog/11.jpg" alt="#">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Doe Jone</h4>
                        <div class="comment-action">
                            <ul class="list-inline list-unstyled">
                                <li>03 days ago</li>
                                <li><a href="#">repost</a></li>
                                <li><a href="#">reply</a></li>
                            </ul>
                        </div>
                        <p class="primary-comment">Aliquam tristique bibendum velit vel pellentesque. Morbi eget semper ipsum. Maecenas cursus perdiet leo, egestas ullamcorper mauris mattis et. Aenean posuere feugiat fermentum serts. Maecenas mentum sollicitudin congue. </p>
                        <div class="media secondary-comment">
                            <div class="media-left">
                                <a href="#">
                                      <img class="media-object" src="/assets/images/blog/11.jpg" alt="#">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Alexan</h4>
                                <div class="comment-action">
                                    <ul class="list-inline list-unstyled">
                                        <li>03 days ago</li>
                                        <li><a href="#">repost</a></li>
                                        <li><a href="#">reply</a></li>
                                    </ul>
                                </div>
                                <p>Aliquam tristique bibendum velit vel pellentesque. Morbi eget semper ipsum. Maecenas cursus perdiet leo, egestas ullam.</p>
                            </div>
                        </div>
                        <div class="media secondary-comment">
                            <div class="media-left">
                                <a href="#">
                                      <img class="media-object" src="/assets/images/blog/11.jpg" alt="#">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Doe Jone</h4>
                                <div class="comment-action">
                                    <ul class="list-inline list-unstyled">
                                        <li>03 days ago</li>
                                        <li><a href="#">repost</a></li>
                                        <li><a href="#">reply</a></li>
                                    </ul>
                                </div>
                                <p>Aliquam tristique bibendum velit vel pellentesque. Morbi eget semper ipsum. Maecenas cursus perdiet leo, egestas ullam.</p>
                            </div>
                        </div>
                    </div>
                </li>
        -->

            <?php
            $komArray = '';
            foreach ($KomentariUp as $k => $v):

                $IdKomentariArt = $v['IdKomentari'];

                $UserKomentariArt = $v['UserKomentari'];
                $EmailKomentarArt = $v['EmailKomentar'];
                $ImeKomentarArt = $v['ImeKomentar'];
                $VremeKomentarArt = $v['VremeKomentar'];
                $KomentarKomentariArt = $v['KomentarKomentari'];
                $KomitentEmailArt = $v['KomitentEmail'];
                $KomitentImeArt = $v['KomitentIme'];
                $KomitentPrezimeArt = $v['KomitentPrezime'];
                $KomitentiSlikaArt = $v['KomitentiSlika'];


                $VremeKomentarArt = date('d M Y', strtotime($v['VremeKomentar'])); //H:i:s

                $imekomi = ($KomitentImeArt) ? $KomitentImeArt : $ImeKomentarArt;


                $lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $UserKomentariArt);

                $ext = pathinfo($KomitentiSlikaArt, PATHINFO_EXTENSION);
                $fileName = pathinfo($KomitentiSlikaArt, PATHINFO_FILENAME);

                $mala_slika = $fileName . '_mala.' . $ext;


                $lok = DCROOT . $lokrel . '/' . $mala_slika;
                if (file_exists($lok)) {
                    $sliKomiKom = $lokrel . '/' . $mala_slika;
                } else {
                    $sliKomiKom = '/assets/images/blog/11.jpg';
                }


                $komArray .= '<li class="media">';

                $komArray .= '<div class="media-left">';
                $komArray .= '<a href="#">';
                $komArray .= '<img class="media-object" src="' . $sliKomiKom . '" alt="#">';
                $komArray .= '</a>';
                $komArray .= '</div>';

                $komArray .= '<div class="media-body">';
                $komArray .= '<h4 class="media-heading">' . $imekomi . '</h4>';
                $komArray .= '<div class="comment-action">';
                $komArray .= '<ul class="list-inline list-unstyled">';
                $komArray .= '<li>' . $VremeKomentarArt . '</li>';
                //$komArray .= '<li><a href="#">repost</a></li>';
                //$komArray .= '<li><a href="#">reply</a></li>';
                $komArray .= '</ul>';
                $komArray .= '</div>';
                $komArray .= '<p class="primary-comment">' . $KomentarKomentariArt . '</p>';
                $komArray .= '</div>';

                $komArray .= '</li>';


            endforeach;

            echo $komArray;
            $komArray = '';

            ?>


        </ul>


    </div>
<?php } else {

    echo '<div class="blog-comments" >
            <br>
        <p>'.$jsonlang[407][$jezikId] .'
            <a class="text-danger font14 text-capitalize" href="/contact-us" target="_blank">
                '.$jsonlang[58][$jezikId] .'
            </a>
        </p>
</div>';
} ?>

<!-- ============================================== BLOG COMMENTS : END ============================================== -->