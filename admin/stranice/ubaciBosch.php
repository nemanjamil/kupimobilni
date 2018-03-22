<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i><strong style="color: red">BOSCH</strong> Povuci podatke sa sajta</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">


        <?php if ($codeboschlink) {
            // hvatam koji je link i proveravam URL odakle dolazi link
            $parse = parse_url($codeboschlink);
            if ($parse['host'] == 'www.bosch-professional.com') {
                ?>
                <form action="/akcija.php?action=povucispec" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo  $ArtikalId ?>">
                    <input type="hidden" name="koji_link" value="<?php echo  $codeboschlink ?>">
                    <button type="submit">POVUCI SPECIFIKACIJU ALAT</button>
                </form>
            <?php } elseif ($parse['host'] == 'www.bosch-garden.com') { ?>
                <form action="/akcija.php?action=povucispecbasta" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo  $ArtikalId ?>">
                    <input type="hidden" name="koji_link" value="<?php echo  $codeboschlink ?>">
                    <button type="submit">POVUCI SPECIFIKACIJU BASTA</button>
                </form>


            <?php } elseif ($parse['host'] == 'www.bosch-pt.com') { ?>
                <form action="/akcija.php?action=povucispecpribor" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo  $ArtikalId; ?>">
                    <input type="hidden" name="koji_link" value="<?php echo  $codeboschlink ?>">
                    <button type="submit">POVUCI SPECIFIKACIJU PRIBOR</button>
                </form>

            <?php } elseif ($parse['host'] == 'www.dremeleurope.com') { ?>

                <form action="/akcija.php?action=povucispecpriborDremel" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo  $ArtikalId ?>">
                    <input type="hidden" name="koji_link" value="<?php echo  $codeboschlink ?>">
                    <button type="submit">POVUCI SPECIFIKACIJU DREMEL</button>
                </form>


            <?php } elseif ($parse['host'] == 'www.skilmasters.com') { ?>

                <form action="/akcija.php?action=povucispecskilmasters" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo  $ArtikalId ?>">
                    <input type="hidden" name="koji_link" value="<?php echo  $codeboschlink ?>">
                    <button type="submit">POVUCI SPECIFIKACIJU SKIL MASTERS</button>
                </form>


            <?php } elseif ($parse['host'] == 'www.skileurope.com') {
                $milere = explode('/', $parse[path]);
                if ($milere[4] == 'alati') {
                    ?>

                    <form action="/akcija.php?action=povucispecskil" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="<?php echo  $ArtikalId ?>">
                        <input type="hidden" name="koji_link" value="<?php echo  $codeboschlink ?>">
                        <button type="submit">POVUCI SPECIFIKACIJU SKIL ALATI EUROPE</button>
                    </form>

                <?php } else { ?>
                    <form action="/akcija.php?action=povucispecskilpribor" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="<?php echo  $ArtikalId ?>">
                        <input type="hidden" name="koji_link" value="<?php echo  $codeboschlink ?>">
                        <button type="submit">POVUCI SPECIFIKACIJU SKIL PRIBOR EUROPE</button>
                    </form>

                <?php }

            } else { ?>

                <button id="pokaziButton">NIJE SETOVANO</button>
                <?php
            }

        }

        ?>

            </div>
        </div>
    </div>

</div>



