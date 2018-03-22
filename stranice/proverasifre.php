<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 29.7.15.
 * Time: 11.20
 */
?>
<div class="body-content">
    <div class="container">
        <div class="minheight">
            <div class="row">
                <?php

                $db->where('KomitentSalt' , $string);
                $resultrows = $db->getOne('komitenti', 'KomitentId, KomitentEmail');

                if ($resultrows) {

                    $KomitentId = $resultrows['KomitentId'];
                    $KomitentEmail = $resultrows['KomitentEmail'];
                    $passwordorg1 = rand(100,1000);
                    $passwordorg = hash('sha512', $passwordorg1);
                    $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                    $password = hash('sha512', $passwordorg . $random_salt);

                    $data = Array(
                        'KomitentPassword' => $password,
                        'KomitentSalt' => $random_salt
                    );
                    $db->where('KomitentId', $KomitentId);
                    if ($db->update('komitenti', $data)) {

                          //  $opis = $db->count . ' records were updated <br/>';
                            $opis .= '<div class="alert alert-success"> <strong>NOVA SIFRA ! </strong> Uspešno ste promenuli šifru. Vaša nova šifra je : <b>'.$passwordorg1.'</b></div>';;
                            $opis .= '<div class="alert alert-danger"> <strong>Paznja ! </strong> Molimo Vas da je zapamtite, zapišete, ili što pre promenite ovu šifru u vašem profilu</div>';
                            $opis .= '<div class="alert alert-info"> <strong>Info LogIn ! </strong> Molimo da se ponovo <a href="/login">ulogujte</a>  na sistem koristeći novu šifru.</div>';
                            $opis .= '<br/>';

                    } else {
                        $opis = 'update failed: ' . $db->getLastError();
                        $opis .= 'Nije uspešno promenjena šifra';
                    }


                } else {

                    $opis = 'Nema takvog salta u bazi';
                }

                echo $opis;
                ?>

            </div>

        </div>
    </div>
</div>

