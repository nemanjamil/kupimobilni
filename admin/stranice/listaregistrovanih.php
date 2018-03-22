<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 09. 02. 2016.
 * Time: 15:57
 */

?>

<div class="row">
    <div style="float: right; padding-top: 1%; padding-bottom: 1%; padding-right: 2%;"><a
            data-original-title="Lista svih artikala"
            href="/admin/dodajkomitenta" class="btn btn-info">Dodaj <b>Korisnika</b></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Lista regstrovanih korisnika</h4>

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
                        <th class="align-center">Adresa</th>
                        <th class="align-center">Mail</th>
                        <th class="align-center">Telefon</th>
                        <th class="align-center">Izmeni korisnika</th>
                        <th class="align-center">Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $data = $db->get('komitenti');

                    $i = 1;
                    foreach ($data as $sds => $link) {
                        $KomitentId = $link['KomitentId'];
                        $KomitentIme = $link['KomitentIme'];
                        $KomitentPrezime = $link['KomitentPrezime'];
                        $KomitentAdresa = $link['KomitentAdresa'];
                        $KomitentMesto = $link['KomitentMesto'];
                        $KomitentEmail = $link['KomitentEmail'];
                        $KomitentTelefon = $link['KomitentTelefon'];
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
                        $komitent .= '<td class="align-center">' . $KomitentAdresa .'  ' . $KomitentMesto. '</td>';
                        $komitent .= '<td class="align-center">' . $KomitentEmail . '</td>';
                        $komitent .= '<td class="align-center">' . $KomitentTelefon . '</td>';


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


