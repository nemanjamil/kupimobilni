<?php



if ($stranica == 'proveraSifreLog') {


    $db->where('KomitentSalt' , $string);
    $resultrows = $db->getOne('komitenti', 'KomitentId, KomitentEmail');

    if ($resultrows) {

        $KomitentId = $resultrows['KomitentId'];

        $KomitentEmail = $resultrows['KomitentEmail'];
        $passwordorg1 = $common->randomPassword(); // rand(100,1000);
        $passwordorg = hash('sha512', $passwordorg1);
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
        $password = hash('sha512', $passwordorg . $random_salt);

        $data = Array(
            'KomitentPassword' => $password,
            'KomitentSalt' => $random_salt
        );
        $db->where('KomitentId', $KomitentId);
        if ($db->update('komitenti', $data)) {

            $opis .= '<div class="inner-box">';
                $opis .= '<div class="content">';
                    $opis .= '<div class="forgot-password-done">';
                        $opis .= '<i class="icon-ok success-icon"></i>';
                        $opis .= '<span>USPELA AKTIVACIJA</span>';
                        $opis .= '<div class="alert alert-success"> <strong>NOVA SIFRA ! </strong> Uspešno ste promenuli šifru. Vaša nova šifra je : <b>'.$passwordorg1.'</b></div>';;
                        $opis .= '<div class="alert alert-danger"> <strong>Paznja ! </strong> Molimo Vas da je zapamtite, zapišete, ili što pre promenite ovu šifru u vašem profilu</div>';
                        $opis .= '<div class="alert alert-info"> <strong>Info LogIn ! </strong> Molimo da se ponovo <a href="/login">ulogujte</a>  na sistem koristeći novu šifru.</div>';
                    $opis .= '</div>';
                $opis .= '</div>';
            $opis .= '</div>';


        } else {
            // $opis = 'update failed: ' . $db->getLastError();

            $opis = '<div class="inner-box">';
                $opis .= '<div class="content">';
                    $opis .= '<div class="forgot-password-done">';
                    $opis .= '<i class="icon-bug error-icon"></i>';
                    $opis .= '<span>Nije uspešno promenjena šifra</span>';
                    $opis .= '</div>';
                $opis .= '</div>';
            $opis .= '</div>';


        }


    } else {

        $opis = '<div class="inner-box">';
            $opis .= '<div class="content">';
                $opis .= '<div class="forgot-password-done">';
                    $opis .= '<i class="icon-bug error-icon"></i>';
                    $opis .= '<span>Nema takvog salta u bazi</span>';
                $opis .= '</div>';
            $opis .= '</div>';
        $opis .= '</div>';
    }

    echo $opis;

}

?>
