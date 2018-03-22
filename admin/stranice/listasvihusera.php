<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 08. 2015.
 * Time: 3:32 PM
 * Edited: 09:13 PM
 */

?>


<div class="row">
    <div style="float: right; padding-top: 1%; padding-bottom: 1%; padding-right: 2%;"><a
            data-original-title="Lista svih artikala"
            href="/admin/dodajkomitenta" class="btn btn-info">Dodaj komitenta</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Lista artikala</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content no-padding">

                <table
                    class="table table-striped table-bordered table-hover table-checkable table-columnfilter datatable"
                    data-columnFilter='{"aoColumns": [ null, {"type": "text"}, {"type": "text"}, {"type": "text"}, { "type": "select" } ]}'
                    data-columnFilter-select2="true">
                    <thead>
                    <tr>
                        <th class="checkbox-column ">
                            <input type="checkbox" class="uniform">
                        </th>
                        <th>Korisnik</th>
                        <th class="align-center">Valuta</th>
                        <th class="align-center">Lista artikala</th>
                        <th class="align-center">Izmeni komitenta</th>
                        <th class="align-center">Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="checkbox-column">
                            <input type="checkbox" class="uniform">
                        </td>
                        <td><a href="<?php echo DPROOTADMIN; ?>/str/listaartikalauser/0">Lista svih artikala</a>
                        </td>
                        <td></td>
                        <td class="align-center"><a data-original-title="Lista svih artikala"
                                                    href="<?php echo DPROOTADMIN; ?>/str/listaartikalauser/0"
                                                    class="btn btn-md bs-tooltip "><i class=" icon-archive"></i></a>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    $data = $db->get('komitenti');
                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $KomitentId = $link['KomitentId'];
                        $KomitentIme = $link['KomitentIme'];
                        $KomitentPrezime = $link['KomitentPrezime'];

                        $KomitentiValuta = $link['KomitentiValuta'];

                        $db->where('ValutaId', $KomitentiValuta);
                        $data = $db->get('valuta');
                        foreach ($data as $sds => $s) {
                            $ValutaId = $s['ValutaId'];
                            $ValutaNaziv = $s['ValutaNaziv'];
                            $selektovano = ($KomitentiValuta == $ValutaId) ? 'selected' : '';

                        }
                        $komitent .= '<tr>';
                        $komitent .= '<td class="checkbox-column">';
                        $komitent .= '<input type="checkbox" class="uniform">';
                        $komitent .= '</td>';
                        $komitent .= '<td>' . $KomitentIme . ' ' . $KomitentPrezime . '</td>';
                        $komitent .= '<td class="align-center">' . $ValutaNaziv . '</td>';
                        $komitent .= '<td class="align-center">
                            <span class="btn-group">
                            <a data-original-title="Lista artikala"  href="' . DPROOTADMIN . '/str/listaartikalauser/' . $KomitentId . '" class="btn btn-md bs-tooltip " title="">
                            <i class=" icon-align-justify"></i></a>
                            </span></td>';

                        $komitent .= '<td class="align-center">
                            <a data-original-title="Izmeni"  href="' . DPROOTADMIN . '/str/editkomitenta/' . $KomitentId . '" class="btn btn-md bs-tooltip " title="">
                            <i class=" icon-edit"></i>
                            </a></td>';


                        $komitent .= '<td class="align-center"><span class="btn-group">
                            <a data-original-title="Obrisi"  href="/akcija.php?action=obrisikomitenta&id=' . $KomitentId . '" class="btn btn-md bs-tooltip " title=""><i class=" icon-trash"></i></a>
                            </span></td>';

                        $komitent .= '</tr>';

                    }
                    echo $komitent; ?>


                    </tbody>
                    <tfoot>
                    <!--<tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th class="hidden-xs">Username</th>
                        <th>Status</th>
                    </tr>-->
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Column Filter -->

<!--=== Page Content ===-->
