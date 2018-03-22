<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 19. 01. 2016.
 * Time: 16:51
 */

?>

<div class="blog-comments clearfix">

    <?php
    $asdad = "SELECT s1, ProizvodRecenzije, KomentarAktivanRecenzije, COUNT(*) AS broj
					FROM
					(
					SELECT StarCenaRecenzije AS s1, ProizvodRecenzije, KomentarAktivanRecenzije FROM recenzije
					UNION ALL
					SELECT StarKvalitetRecenzije, ProizvodRecenzije, KomentarAktivanRecenzije FROM recenzije
					UNION ALL
					SELECT StarLakocaRecenzije,  ProizvodRecenzije, KomentarAktivanRecenzije FROM recenzije
					UNION ALL
					SELECT StarKorisnostRecenzije,  ProizvodRecenzije, KomentarAktivanRecenzije FROM recenzije
					) AS all_users
			WHERE ProizvodRecenzije = '$ArtikalId' AND KomentarAktivanRecenzije = 1
			GROUP BY s1
			ORDER BY s1 DESC";
    $data = $db->rawQuery($asdad);

    ?>
    <div class="uvuciocenu clearfix">
        <?php
        if ($data) {

            foreach ($data as $key => $val) {
                $koj = $val[s1];
                $broj = $val[broj];
                $kolbor += $val[broj];
                $uku += $koj * $broj;
            }
            $uss = $uku / $kolbor;
            ?>
            <div class="hajduj" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
                <span itemprop="itemreviewed"><?php echo $ArtikalNaziv; ?></span>
                <!--treba resiti--><img itemprop="photo"
                                        src="/p/<?php echo $urlArtiklaLink . '/' . $ArtikalId . '/' . $ImeSlikeArtikliSlike; ?>"/>
            <span itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">
                <span itemprop="average"><?php echo round($uss, 2); ?></span>
                <span itemprop="best">5</span>
            </span>
                <span itemprop="votes"><?php echo $vidimikirec; ?></span>
            </div>



            <!--prosecna ocena-->
            <div class="col-md-6 ">
                <h5 id="avg-rating " class="centrirajNE"><?php echo $jsonlang[315][$jezikId]; ?> (<span style="color: #0d7da3;"> <?php echo round($uss, 2); ?></span> )<b>
                        <span> <?php echo $jsonlang[316][$jezikId] . ' ' . $vidimikirec . ' ' . $jsonlang[264][$jezikId]; ?></span></b>
                </h5>
                <?php

                foreach ($data as $key => $val) {
                    $koj = $val[s1];
                    $broj = $val[broj];
                    $vroj = $broj / $kolbor * 100;

                    ?>
                    <!--sidebar-->

                    <div class="clearfix moj-col-md-6">
                        <div class="moj-col-md-3">
                            <div class="floatleft " style="margin-right: 5px;"
                                 title="Rated <?php echo $koj; ?>out of 5"> <?php echo $koj; ?> <?php echo $jsonlang[317][$jezikId]; ?>
                                :
                            </div>
                        </div>
                        <div class="col-md-7" style="padding-right: 0 !important">
                            <div class="progress progress-striped active">
                                <div
                                    class="progress-bar progress-bar-danger progres<?php echo $koj . '"' . 'style=" width: ' . $vroj ?>%;"></div>
                            </div>
                        </div>
                        <div class="moj-col-md-2">
                            <div class="floatright centriraj"><?php echo round($vroj, 0) . '% (' . $broj; ?>)</div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--/prosecna ocena-->
        <?php } ?>
        <!--/Oceni artikal-->
    </div>
    <!--OCENA i RECENZIJA-->
    <div class="uvuciocenu clearfix">

        <?php



        $sfas = "
SELECT
  s1.*,
  ROUND((s2.StarCenaRecenzije + s2.StarKvalitetRecenzije + s2.StarLakocaRecenzije + s2.StarKorisnostRecenzije)/4) AS ukupno,
  KD.KolikoDugoTabelaOpis" . $jezikSrb . ", KO.KomitentIme, KO.KomitentPrezime, KO.KomitentUserName, KO.KomitentEmail
FROM recenzije s1
  LEFT JOIN recenzije s2
    ON s1.IdRecenzije= s2.IdRecenzije
  LEFT JOIN kolikodugotabela KD
    ON s1.KolikoDugoRecenzije = KD.KolikoDugoTabelaId
    LEFT JOIN komitenti KO
    ON s1.KomitentRecenzije = KO.KomitentId
WHERE s1.ProizvodRecenzije = '$id' AND s1.KomentarAktivanRecenzije = 1";
        $data = $db->rawQuery($sfas);

        if ($data) {
            foreach ($data as $key => $val) {

                $ukupno = $val[ukupno];
                $starcena = $val[StarCenaRecenzije];
                $starkvalitet = $val[StarKvalitetRecenzije];
                $starlakoca = $val[StarLakocaRecenzije];
                $starkorisnost = $val[StarKorisnostRecenzije];
                $naslov = $val[NaslovRecenzije];
                $ime = $val[KomitentIme];
                $prezime = $val[KomitentPrezime];
                $username = $val[KomitentUserName];
                $za = $val[KomentarZaRecenzije];
                $protiv = $val[KomentarProtivRecenzije];
                $datum = $val[DatumRecenzije];
                $datum_clanka = date("d.m.Y H:i:s", strtotime($datum));
                $KomitentEmail = $val[KomitentEmail];
                ?>
                <!--Problem je ova klasa jednaocena-->
                <div class="jednaocena col-md-12">

                    <div class="floatleft col-md-4 col-xs-12 ">
                        <div class="clearfix podvucenoukupc">
                            <div class="floatleft ovojukupnaoc"><strong><?php echo $jsonlang[319][$jezikId]; ?></strong>
                            </div>
                            <div class="floatleft">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <input name="ocen<?php echo $rr; ?>" type="radio" class="star"
                                           value="<?php echo($i); ?>"
                                           title="<?php echo($i); ?>"
                                           disabled="disabled" <?php if ($i == $ukupno) { ?>  checked="checked" <?php } ?> />
                                <?php } ?>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="floatleft ovojukupnaoc"><?php echo $jsonlang[71][$jezikId]; ?></div>
                            <div class="floatleft">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <input name="cena<?php echo $rr; ?>1" type="radio" class="star"
                                           value="<?php echo($i); ?>"
                                           title="<?php echo($i); ?>"
                                           disabled="disabled" <?php if ($i == $starcena) { ?>  checked="checked" <?php } ?> />
                                <?php } ?>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="floatleft ovojukupnaoc"><?php echo $jsonlang[304][$jezikId]; ?></div>
                            <div class="floatleft">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <input name="kva<?php echo $rr; ?>1" type="radio" class="star"
                                           value="<?php echo($i); ?>"
                                           title="<?php echo($i); ?>"
                                           disabled="disabled" <?php if ($i == $starkvalitet) { ?>  checked="checked" <?php } ?> />
                                <?php } ?>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="floatleft ovojukupnaoc"><?php echo $jsonlang[305][$jezikId]; ?></div>
                            <div class="floatleft">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <input name="lak<?php echo $rr; ?>1" type="radio" class="star"
                                           value="<?php echo($i); ?>"
                                           title="<?php echo($i); ?>"
                                           disabled="disabled" <?php if ($i == $starlakoca) { ?>  checked="checked" <?php } ?> />
                                <?php } ?>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="floatleft ovojukupnaoc"><?php echo $jsonlang[306][$jezikId]; ?></div>
                            <div class="floatleft">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <input name="kor<?php echo $rr; ?>1" type="radio" class="star"
                                           value="<?php echo($i); ?>"
                                           title="<?php echo($i); ?>"
                                           disabled="disabled" <?php if ($i == $starkorisnost) { ?>  checked="checked" <?php } ?> />
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="floatleft col-md-8 col-xs-12  desnoopisza no-padding">
                        <h3><?php echo $naslov; ?></h3>

                        <div
                            class="bojasiva666"><?php echo $jsonlang[321][$jezikId] . ': <strong>' . $ime . ' ' . $prezime . '</strong>&nbsp;' .
                                $jsonlang[231][$jezikId] . ' :  ' . $datum_clanka; ?> </div>
                        <div style="margin:10px 0;"><strong><?php echo $jsonlang[307][$jezikId]; ?> : </strong> <span
                                class="bojasiva666"><?php echo $za; ?></span></div>
                        <div><strong><?php echo $jsonlang[308][$jezikId]; ?> :</strong> <span
                                class="bojasiva666"><?php echo $protiv; ?></span></div>
                    </div>
                </div>

                <?php $rr++;
            }
        }
        ?>
    </div>
<?php
if(!$data){

    ?>

    <div class="col-md-8 col-sm-9 hidden-xs centriraj ">
        <div class="btn btn-primary padding-10-10 marginadole10">
        <a target="_blank" href="/ocene/<?php echo $id; ?>"><strong><i class="fa fa-thumbs-o-up"></i> <?php echo $jsonlang[405][$jezikId]; ?></strong></a></div>
    </div>

    <div class="visible-xs centriraj">
        <div class="btn btn-primary">
            <a target="_blank" href="/ocene/<?php echo $id; ?>"></a><strong><i class="fa fa-thumbs-o-up"></i> <?php echo $jsonlang[406][$jezikId]; ?></strong></div>

    </div>
    <?php
}

?>
</div>

