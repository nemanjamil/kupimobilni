<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 8.12.15.
 * Time: 10.41
 */


$mailBody .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$mailBody .= '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="'.DPROOT.'/obradi/cssMailAndroid/styles.css" />
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
    table {border-collapse: collapse;}
    </style>
    <![endif]-->
</head>';

$mailBody .= '<body>';
$mailBody .= '<center class="wrapper">';
    $mailBody .= '<div class="webkit">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center">
            <tr>
                <td>
        <![endif]-->';
    		$mailBody .= '<table class="outer" align="center">';

            $mailBody .= '<tr>
                <td class="full-width-image">
                    <img src="'.$linkdoSlike.'/header.jpg" width="600" alt="" />
                </td>
            </tr>';

            $mailBody .= '<tr>
                <td class="one-column">
                    <table width="100%">

                    <tr>
                            <td class="inner contents">
                                <p class="h1">Podaci korisnik </p>
								<div><strong>Ime  i prezime : </strong>'.$KomitentIme.' '.$KomitentPrezime.'</div>
								<div><strong>Email : </strong>'.$KomitentEmail.'</p>
                            </td>
                        </tr>


                    </table>
                </td>
            </tr>';

/*<tr>
                            <td class="inner contents">
                                <p class="h1">Podaci za Notifikacije</p>
                                <!--<p>Opis notifikacije</p>-->
                                <p><strong style="color: orange">Zuta notifikacija</strong> - znaci da je vrednosti izvan okvira dozvoljenih. Trebalo bi reagovati</p>
                                <p><strong style="color: red">Crvena notifikacija</strong> - znaci da je vrednosti pesla makimalno dozvoljene vrednosti. Hitno reagovanje</p>
                            </td>
                        </tr>*/


/*$mailBody .= '<tr>
					<td class="two-column">
						<!--[if (gte mso 9)|(IE)]>
						<table width="100%">
						<tr>
						<td width="50%" valign="top">
						<![endif]-->
						<div class="column">
							<table width="100%">
								<tr>
									<td class="inner">
										<table class="contents">
											<tr>
												<td>
													<img src="'.$linkdoSlike.'/two-column-01.jpg" width="280" alt="" />
												</td>
											</tr>
											<tr>
												<td class="text">
Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
						<!--[if (gte mso 9)|(IE)]>
						</td><td width="50%" valign="top">
						<![endif]-->
						<div class="column">
							<table width="100%">
								<tr>
									<td class="inner">
										<table class="contents">
											<tr>
												<td>
													<img src="'.$linkdoSlike.'/two-column-02.jpg" width="280" alt="" />
												</td>
											</tr>
											<tr>
												<td class="text">
													Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas sed ante pellentesque, posuere leo id, eleifend dolor.
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
						<!--[if (gte mso 9)|(IE)]>
						</td>
						</tr>
						</table>
						<![endif]-->
					</td>
				</tr>';*/




?>