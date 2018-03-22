<div class="product-filter filters-panel">
    <div class="row">
        <div class="col-md-2 visible-lg">
            <div class="view-mode">
                <div class="list-view">
                    <!--<button class="btn btn-default grid " data-view="grid" data-toggle="tooltip" data-original-title="Grid"><i class="fa fa-th"></i></button>
                    <button class="btn btn-default list active" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>-->
                </div>
            </div>
        </div>
        <div class="short-by-show form-inline text-right col-md-7 col-sm-8 col-xs-12">
            <form class="relativ clearfix formToolbar select-fields-form-articles-cat" enctype="multipart/form-data" method="POST" onchange="submit()">
                <div class="form-group short-by">
                    <label class="control-label" for="input-sort">Sort By:</label>
                    <select id="input-sort" name="kontrole[sortKontrole]" class="form-control">
                        <?php $KonArray = array(
                            1 => "Name (A - Z)",
                            2 => "Name (Z - A)",
                            3 => "Cena (Mala &gt; Veca)",
                            4 => "Price (Veca &gt; Mala)",
                            5 => "Najnoviji",
                            6 => "Najgledaniji",
                        );
                        foreach ($KonArray as $k => $v):
                            $kodPosel = ($k == $kontrole['sortKontrole']) ? 'selected' : '';
                            echo '<option value="' . $k . '" ' . $kodPosel . '>' . $v . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-limit">Show:</label>
                    <select id="input-limit" class="form-control" name="kontrole[limitpostrani]">
                        <?php $KonArray = array(
                            2 => 2,
                            5 => 5,
                            10 => 10,
                            30 => 30,
                            50 => 50,
                            100 => 100
                        );
                        foreach ($KonArray as $k => $v):
                            $kodPosel = ($k == $kontrole['limitpostrani']) ? 'selected' : '';
                            echo '<option value="' . $k . '" ' . $kodPosel . '>' . $v . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="box-pagination col-md-3 col-sm-4 col-xs-12 text-right">
            <ul class="pagination">
                <?php
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $linkUrlPage = parse_url($actual_link);
                $linkPath =  $linkUrlPage['path'];
                $queryPath =  $linkUrlPage['query'];
                if ($queryPath) { $staExplode = explode('&',$queryPath);  }
                $upitSteExplode = ($staExplode[0]) ? '?'.$staExplode[0] : '';

                $linkDoUPita = DPROOT.$linkPath.$upitSteExplode;


                $strEls = '';
                $kojaJeStranaEs = (int) $_GET['stranaEs'];
                if ($kojaJeStranaEs) {

                    for ($i = 1; $i <= $kojaJeStranaEs; $i++) {
                        if ($i==7) {
                            break;
                        }
                        if ($i==$kojaJeStranaEs) {
                            $strEls .= '<li class="active"><span>'.$i.'</span></li>';
                        } else {
                            $strEls .= '<li><a href="'.$linkDoUPita.'&stranaEs='.$i.'">'.$i.'</a></li>';
                        }
                    }

                    $strEls .= '<li><a href="'.$linkDoUPita.'&stranaEs='.$i.'">'.$i.'</a></li>';
                } else {
                    $strEls .= '<li class="active"><span>1</span></li>';
                    $strEls .= '<li><a href="'.$linkDoUPita.'&stranaEs=2">2</a></li>';
                    $strEls .= '<li><a href="'.$linkDoUPita.'&stranaEs=3">3</a></li>';
                }
                echo $strEls;
                ?>
                <!--<li class="active"><span>1</span></li>
                <li><a href="">2</a></li>
                <li><a href="">&gt;</a></li>
                <li><a href="">&gt;|</a></li>-->
            </ul>
        </div>
    </div>
</div>