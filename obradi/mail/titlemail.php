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
                            $bodyMail .= '<td align="center" valign="top" width="600" class="flexibleContainerCell">';

                                $bodyMail .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                                    $bodyMail .= '<tr>';
                                        $bodyMail .= '<td valign="top" class="textContent">';
                                          $bodyMail .= '<h3>'. $jsonlang[271][$jezikId] . ' '. $idNar.'</h3>';
                                          $bodyMail .= '<br>';
                                            $bodyMail .= '<h2 style="text-align: center; text-transform: uppercase">'. $jsonlang[273][$jezikId].'</h2>' ;
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

