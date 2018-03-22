<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 13. 08. 2015.
 * Time: 16:47
 */

$KomitentIdPost = $_POST['KomitentId'];

?>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Pronadji komitenta</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                <form enctype="multipart/form-data" class="form-horizontal row-border" method="post" id="validate-1">
                      <!--action="/akcija.php?action=XXX"-->


                    <div class="form-group">
                        <label class="col-md-2 control-label">Komitent</label>

                        <div class="col-md-10">

                            <select id="KomitentId" name="KomitentId" class="select2 required full-width-fix">
                                <option value=""></option>
                                <?php
                                $data = $db->get('komitenti');
                                foreach ($data as $sds => $s) {
                                    echo '<option value="' . $s['KomitentId'] . '">' . $s['KomitentNaziv'] . ' - ' . $s['KomitentIme'] . ' ' .$s['KomitentPrezime'] . ' - ' .$s['KomitentMesto'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-actions">
                        <input type="submit" value="Nadji korisnika" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<?php if($KomitentIdPost){

    $db->where('KomitentId', $KomitentIdPost);
$komi = $db->getOne('komitenti');

    $KomitentId = $komi ['KomitentId'];
    $KomitentSifra = $komi ['KomitentSifra'];
    $KomitentIme = $komi ['KomitentIme'];
    $KomitentPrezime = $komi ['KomitentPrezime'];
    $KomitentNaziv = $komi ['KomitentNaziv'];

    /*if(!empty($KomitentIme) && !empty($KomitentPrezime)){
        $Komit = $KomitentIme . ' ' . $KomitentPrezime ;
    }
    else {
        $Komit = $KomitentNaziv;
    }*/
    if(!is_null($KomitentIme) && !is_null($KomitentPrezime)){
        $Komit = $KomitentIme . ' ' . $KomitentPrezime ;
    }
    else {
        $Komit = $KomitentNaziv;
    }
    $KomitentEmail = $komi ['KomitentEmail'];
    $KomitentActive = $komi ['KomitentActive'];
    $act = ($KomitentActive) ? 'checked="checked"' : '';


    $KomitentRabat = $komi ['KomitentRabat'];


    ?>



<div class="col-md-12 col-xs-6">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="icon-list-alt"></i>Komitent Info</h4>

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
                    <th>Komitent</th>
                    <th>Sifra</th>
                    <th>E-mail</th>
                    <th>Rabat</th>
                    <th>Aktivan</th>
                    <th>Porudzbine</th>
                    <th>Izaberi</th>
                </tr>
                </thead>
                <tbody>
                <?php

                    $tab .=
                        '<tr>

                    <td>' . $Komit . '</td>
                    <td>' . $KomitentSifra . '</td>
                    <td>' . $KomitentEmail . '</td>
                    <td>' . $KomitentRabat . '</td>
                    <td class = "centriraj"><input type="checkbox" class="centriraj AktivirajKomitenta" data-id="'.$KomitentId.'"   value="' . $KomitentActive . '" ' . $act . ' ></td>
                    <td class = "centriraj"><a href="/admin/str/porudzbineuser/'.$KomitentId.'" target="_blank  "><input type="submit" value="Porudzbine" class="btn btn-primary centriraj"></a></td>

                    <td class="align-center">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-dashboard"></i> Akcija
                                <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/str/editkomitenta/' . $KomitentId . '"> <i class="icon-edit"> </i> Izmeni korisnika</a></li>

                                </ul>
                        </div>
                    </td>
                </tr>';

                echo $tab; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php }?>