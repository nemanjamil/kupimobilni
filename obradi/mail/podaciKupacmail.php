<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 23.8.15.
 * Time: 17.33
 */

$bodyMail .= '<tr>';
    $bodyMail .= '<td align="center" valign="top">';

        $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
            $bodyMail .= '<tr>';
                $bodyMail .= '<td align="center" valign="top">';

                    $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="flexibleContainer">';
                        $bodyMail .= '<tr>';
                            $bodyMail .= '<td align="center" valign="top" width="600" class="flexibleContainerCell bottomShim">';
                                $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="nestedContainer">';
                                    $bodyMail .= '<tr>';
                                        $bodyMail .= '<td align="center" valign="top" class="nestedContainerCell">';

                                            $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                                                $bodyMail .= '<tr>';
                                                    $bodyMail .= '<td valign="top" class="textContent">';
                                                        $bodyMail .= '<h3 style="text-transform: uppercase">'.$jsonlang[274][$jezikId].'</h3>';

                                                        $bodyMail .= '<ul>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[140][$jezikId].'</b> : '.$KomitentIme.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[141][$jezikId].'</b> : '.$KomitentPrezime.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[155][$jezikId].'</b> : '.$KomitentAdresa.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[143][$jezikId].'</b> : '.$KomitentMesto.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[137][$jezikId].'</b> : '.$KomitentPosBroj.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[31][$jezikId].'</b> : '.$email.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[151][$jezikId].'</b> : '.$KomitentMobTel.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[148][$jezikId].'</b> : '.$KomitentTelefon.'</li>';
                                                            $bodyMail .= '<li><b>'.$jsonlang[152][$jezikId].'</b> : '.$napomenaNarudz.'</li>';
                                                        $bodyMail .= '</ul>';

                                                    $bodyMail .= '</td>';
                                                $bodyMail .= '</tr>';
                                            $bodyMail .= '</table>';

                                        $bodyMail .= '</td>';
                                    $bodyMail .= '</tr>';
                                $bodyMail .= '</table>';
                            $bodyMail .= '</td>';
                        $bodyMail .= '</tr>';
                    $bodyMail .= '</table>';

                $bodyMail .= '</td>';
            $bodyMail .= '</tr>';
        $bodyMail .= '</table>';

    $bodyMail .= '</td>';
$bodyMail .= '</tr>';
