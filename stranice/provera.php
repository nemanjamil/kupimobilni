<div class="body-content">
    <div class="container">
        <div class="minheight">
        <div class="row">
            <?php
            $id = $_GET['string'];
            $db->where("KomitentSalt", $id);

            if ($db->has("komitenti")) {

                $data = Array(
                    'KomitentActive' => '1',
                    'KomitentTipUsera' => '2'
                );
                $db->where('KomitentSalt', $id);

                if ($db->update('komitenti', $data)) {
                   // echo $db->count . ' records were updated';
                    //echo '<br>';
                    //echo 'OK registrovani ste';

                    // sada setujemo session
                    $db->where("KomitentSalt", $id);
                    $user = $db->getOne("komitenti");

                    $emailreg = $user['KomitentEmail'];
                    $KomitentSaltreg = $user['KomitentSalt'];
                    $KomitentPassword = $user['KomitentPassword'];

                    // kripujemo mail
                    $encrypted_mail = $sesKor->encrypt_decrypt('encrypt', $emailreg);

                    /* echo $decrypted_mail = $sesKor->encrypt_decrypt('decrypt', $encrypted_mail);*/


                    // setujemo u sesion kriptovani mail
                    $_SESSION['KomitentEmail'] = $encrypted_mail;
                    $_SESSION['KomitentSalt'] = $KomitentSaltreg;
                    $_SESSION['KomitentTipUsera'] = $user['KomitentTipUsera'];
                    $_SESSION['KomitentId'] = $user['KomitentId'];
                    $_SESSION['KomitentActive'] = $user['KomitentActive'];



                    // i ovde setujemo cookie koji sadrzi elemente za registraciju
                    // $pas = hash('sha512', $password . $salt);

                    //$passwordCookie = hash('sha512', $KomitentPassword . $KomitentSaltreg);
                    // uzimamo sifru i pass

                    //$sesKor->generateCredentialsCookie($encrypted_mail, $passwordCookie );

                    echo '<div class="alert alert-success" role="alert">
                    <span class="fa fa-check" aria-hidden="true"></span>
                    <span class="sr-only">Uspelo:</span>
                    Uspela je aktivacija. Molimo vas idite na <a href="/login">login stranu  i logujte se</a>
                    </div>';


                } else {
                    echo 'update failed: ' . $db->getLastError();
                }

            } else {
                echo '<div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    Nije uspela aktivacija. Molimo vas kontaktirajte podrsku na mail.
                    </div>';
            }
            ?>
        </div>
        <!-- /.row -->
        </div>
    </div>
    <!-- /.container -->
</div><!-- /.body-content -->