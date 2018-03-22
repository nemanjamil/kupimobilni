<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12. 08. 2015.
 * Time: 11:11 AM
 */

?>

<!--=== Page Content ===-->
<div class="col-md-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i> Lista Tagova</h4>

            <div class="toolbar">
                <div class="btn-group">
                    <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                </div>
            </div>
        </div>
        <div class="widget-content">
            <table
                class="table table-striped table-bordered table-hover ">
                <thead>
                <tr>
                    <th>Tag Id</th>
                    <th>Ime</th>
                    <th>Akcija</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $data = $db->get('tagovi');
                $i = 1;
                foreach ($data as $sds => $link) {
                    $TagoviId = $link[TagoviId];
                    $TagoviIme = $link[TagoviIme];
                    //  $TagoviGrupa = $link[TagoviGrupa];
                    $tag .=
                        '<tr>
                    <td>' . $TagoviId . '</td>
                    <td>' . $TagoviIme . '</td>
                    <td>
                        <div class="btn-group">
                        		<button class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											<i class="icol-cog"></i> Akcija
											<span class="caret"></span>
										</button>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/index.php?stranica=edittag&id=' . $TagoviId . '"> <i class="icon-edit"> </i> Izmeni</a></li>
                                <li><a href="/akcija.php?action=obrisitag&id=' . $TagoviId . '"> <i class="icon-remove"> </i> Obrisi</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>';
                }
                echo $tag; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>