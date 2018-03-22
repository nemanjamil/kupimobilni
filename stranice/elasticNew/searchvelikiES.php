<?php
/**
 * Created by PhpStorm.
 * User: ITCluster Serbia
 * Date: 28.3.2016.
 * Time: 17:34
 * Izmena 25.04.2016.
 */
?>
<div class="toolbarArticles">
    <ul>
        <li class="listToolbar">
            <div class="toolbarHBox">
                <form class="relativ clearfix formToolbar select-fields-form-articles-cat" enctype="multipart/form-data" method="POST" onchange="submit()">

                    <div class="sortirajPo"><p>Sortiraj po:</p>
                        <select id="listSort" name="sortiraj">
                            <option value="0" <? if ($gled==0) echo 'selected="selected"'; ?>>Kriterijumu pretrage</option>
                            <option value="1" <? if ($gled==1) echo 'selected="selected"'; ?>>Abecedi ABC</option>
                            <option value="5" <? if ($gled==5) echo 'selected="selected"'; ?>>Abecedi CBA</option>
                            <option value="2" <? if ($gled==2) echo 'selected="selected"'; ?>>Gledanosti</option>
                            <option value="3" <? if ($gled==3) echo 'selected="selected"'; ?>>Ceni opadajuće</option>
                            <option value="4" <? if ($gled==4) echo 'selected="selected"'; ?>>Ceni rastuće</option>

                           <!-- <option value="5" <?/* if ($gled==5) echo 'selected="selected"'; */?>>Poslednji dodat</option>-->
                        </select>
                    </div>

                    <div class="hidden-xs poStranici"><p>Po stranici:</p>
                        <select id="listItemsPerPage" name="postrani">
                            <option value="5" <? if ($limitpostrani==5) echo 'selected="selected"'; ?>>5</option>
                            <option value="10" <? if ($limitpostrani==10) echo 'selected="selected"'; ?>>10</option>
                            <option value="20" <? if ($limitpostrani==20) echo 'selected="selected"'; ?>>20</option>
                            <option value="50" <? if ($limitpostrani==50) echo 'selected="selected"'; ?>>50</option>
                            <option value="75" <? if ($limitpostrani==75) echo 'selected="selected"'; ?>>75</option>
                            <option value="100" <? if ($limitpostrani==100) echo 'selected="selected"'; ?>>100</option>
                        </select>
                    </div>



                </form>

                <?
                if ($numberOfArticles>$limitpostrani) {
                    ?>
                    <div id="pag" class="floatright pagination noRightBox">
                        <? include('paginacija.php'); ?>
                    </div>
                    <?
                }
                ?>
            </div>
        </li>
    </ul>
</div>
