<?php

class functions extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }


    /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     * PHP 5.4.9
     *
     * this is a beginners template for simple encryption decryption
     * before using this in production environments, please read about encryption
     *
     * @param string $action : can be 'encrypt' or 'decrypt'
     * @param string $string : string to encrypt or decrypt
     *
     * @return string
     */
    function encrypt_decrypt($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'key-kriptuj-mail';
        $secret_iv = 'iv-kriptuj-mail';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }


    public function generateCredentialsCookie($email, $password)
    {
        $encrypted = $email . ':' . hash_hmac('sha256', $password, SIFRAZACOOKIE);
        setcookie('credentials', $encrypted, time() + (86400 * 30 * 12), "/", '', 0, 1); // 86400 = 1 day

    }

    public function sec_session_start()
    {

        $session_name = 'sec_session_id';   // Set a custom session name
        //$secure = SECURE;
        $secure = '';

        // This stops JavaScript being able to access the session id.
        // koristimo da mozemo sa pridjemo preko PHP-a
        $httponly = true;
        // Forces sessions to only use cookies.
        if (!ini_set('session.use_only_cookies', 1)) {
            header("Location: /error?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Gets current cookies params.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

        session_name($session_name);
        session_start();
        // session_regenerate_id(true);    // regenerated the session, delete the old one.

    }


    public function loginIos($email, $passwordString)
    {

        $this->dbConn->join("tipusera t", "k.KomitentTipUsera = t.IdTipUsera", "LEFT");
        $this->dbConn->where('KomitentEmail', $email);
        $sad = $this->dbConn->getOne("komitenti k", null);


        $user_id = $sad['KomitentId'];
        $salt = $sad['KomitentSalt'];
        $KomitentPassword = $sad['KomitentPassword'];


        $saltPostoji = true;

        if (!$salt) {

            $saltPostoji = false;
            $o['tag'] = 'login';
            $o['success'] = false;
            $o['error'] = 9;
            $o['error_msg'] = 'Ne postoji salt!';
            return json_encode($o, JSON_UNESCAPED_UNICODE);

        }


        if ($sad && $saltPostoji) {


            // ako samo saljemo pravu sifru
            $passwordString = hash('sha512', $passwordString);
            $passwordCript = hash('sha512', $passwordString . $salt);


            if ($this->checkbrute($user_id) == true) {

                // login Check BRUTE
                $o['tag'] = 'login';
                $o['success'] = false;
                $o['error'] = 4;
                $o['error_msg'] = 'Account is LOCKED!';


            } else {
                if ($KomitentPassword == $passwordCript) {

                    $o['tag'] = 'login';
                    $o['error'] = 0;
                    $o['success'] = true;
                    $o['uid'] = $sad['KomitentId'];
                    $o['user']['KomitentNaziv'] = $sad['KomitentNaziv'];
                    $o['user']['KomitentIme'] = $sad['KomitentIme'];
                    $o['user']['KomitentPrezime'] = $sad['KomitentPrezime'];
                    $o['user']['KomitentAdresa'] = $sad['KomitentAdresa'];
                    $o['user']['KomitentPosBroj'] = $sad['KomitentPosBroj'];
                    $o['user']['KomitentMesto'] = $sad['KomitentMesto'];
                    $o['user']['KomitentTelefon'] = $sad['KomitentTelefon'];
                    $o['user']['KomitentMobTel'] = $sad['KomitentMobTel'];
                    $o['user']['KomitentEmail'] = $sad['KomitentEmail'];
                    $o['user']['KomitentUserName'] = $sad['KomitentUserName'];
                    $o['user']['KomitentTipUsera'] = $sad['KomitentTipUsera'];
                    $o['user']['KomitentFirma'] = $sad['KomitentFirma'];
                    $o['user']['KomitentMatBr'] = $sad['KomitentMatBr'];
                    $o['user']['KomitentPIB'] = $sad['KomitentPIB'];
                    $o['user']['KomitentFirmaAdresa'] = $sad['KomitentFirmaAdresa'];

                    $o['artUkorpi'] = $this->kolikoArtUKorpi($user_id);

                } else {

                    $o['tag'] = 'login';
                    $o['success'] = false;
                    $o['error'] = 5;
                    $o['error_msg'] = 'Incorrect email or password!';

                }

                return json_encode($o, JSON_UNESCAPED_UNICODE);

            }

        } else {
            return false;
        }


    }

    public function kolikoArtUKorpi($userId){
        $upitBrArtKorpa = "CALL KolikoUkorpi($userId);";
        $upitBrArtKorpaUpit = $this->dbConn->rawQuery($upitBrArtKorpa);


        if ($upitBrArtKorpaUpit) {
            $KorpaKolTempArt = $upitBrArtKorpaUpit[0]['brojArtuKorpi'];
            $m['ukupnaKolicina'] = (int) ($KorpaKolTempArt);
        } else {
            $m['ukupnaKolicina'] = (int) 0;
        }

        return $m;
    }

    public function cekirajuserazaformu($id)
    {

        $query = "SELECT * FROM komitenti WHERE KomitentId = '$id'";
        return $this->dbConn->fetchassoc($query);

    }

    public function login($email, $passwordprvi)
    {

        $errorLog = '';
        $user_browser = GLAVNIMAIL; // $_SERVER['HTTP_USER_AGENT'];


        $this->dbConn->join("tipusera t", "k.KomitentTipUsera = t.IdTipUsera", "LEFT");
        $this->dbConn->where('KomitentEmail', $email);
        $sad = $this->dbConn->getOne("komitenti k", null);


        $user_id = $sad['KomitentId'];
        $salt = $sad['KomitentSalt'];
        $KomitentPassword = $sad['KomitentPassword'];
        $KomitentNaziv = $sad['KomitentNaziv'];
        $KorisnikTipUsera = $sad['KomitentTipUsera'];
        $TipUseraOpis = $sad['TipUseraOpis'];
        $KomitentUserName = $sad['KomitentUserName'];
        $KomitentRabat = $sad['KomitentRabat'];
        $KomitentiValuta = $sad['KomitentiValuta'];


        $password = hash('sha512', $passwordprvi . $salt);
        // odavde pocinje ovo moje
        // uzimam vec kriptovan pass i dokriptujem ga jos malo
        $pas = hash('sha512', $password . $salt);
        // ovde mi setujem cookie. Sada imam cookie sa user i pass i expire date 30 dana


        $encrypted_mail = $this->encrypt_decrypt('encrypt', $email);

        $this->generateCredentialsCookie($encrypted_mail, $pas);


        if ($sad && $user_id) {


            if ($this->checkbrute($user_id) == true) {
                $error_msg['err'] = 'Account is locked';
                // Send an email to user saying their account is locked
                //return false;
                return $error_msg;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($KomitentPassword == $password) {
                    //echo 'Password is correct!';
                    // Get the user-agent string of the user.

                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user']['KomitentId'] = $user_id;
                    $_SESSION['user']['KomitentEmail'] = $encrypted_mail;
                    $_SESSION['user']['KomitentUserName'] = $KomitentUserName;
                    $_SESSION['user']['KomitentNaziv'] = $KomitentNaziv;
                    $_SESSION['user']['KomitentTipUsera'] = $KorisnikTipUsera;
                    $_SESSION['user']['KomitentRabat'] = $KomitentRabat;
                    $_SESSION['user']['TipUseraOpis'] = $TipUseraOpis;
                    $_SESSION['user']['KomitentiValuta'] = $KomitentiValuta;
                    $_SESSION['user']['login_string'] = hash('sha512', $KomitentPassword . $user_browser);

                    //$_SESSION['valuta'] = $KomitentiValuta;


                    // echo  'Login successful.'.var_dump($_SESSION);

                    return '1';
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();

                    $data = Array("UserId" => $user_id,
                        "SecVreme" => $now
                    );
                    $id = $this->dbConn->insert('loginattempts', $data);

                    if ($id) {
                        $error_msg['err'] = 'WRONG PASS';
                    } else {
                        $error_msg['err'] = 'insert failed: ' . $this->dbConn->getLastError();
                    }


                    return $error_msg;
                    //return false;
                }
            }

        } else {
            $error_msg['err'] = 'No user exists';
            return $error_msg;
            //return false;
        }


    }

    public function checkbrute($user_id)
    {

        // Get timestamp of current time
        $now = time();

        // All login attempts are counted from the past 2 hours.
        $valid_attempts = $now - (2 * 60 * 60);


        $this->dbConn->where("UserId", $user_id);
        $this->dbConn->where("SecVreme", $valid_attempts, ">");
        $user = $this->dbConn->withTotalCount()->getOne("loginattempts");

        //echo "Showing  {$this->dbCould not create a preparedConn->totalCount}";

        if ($user) {


            $brojup = $this->dbConn->totalCount;

            // If there have been more than 5 failed logins
            if ($brojup > 10) {
                return true;
            } else {
                return false;
            }
        } else {
            //echo 'Nije bilo logovanja';
            //echo '<br>';
            //header("Location: ../error.php?err=Database error: cannot prepare statement");
            //exit();
        }

    }

    public function login_check()
    {
        $user_browser = GLAVNIMAIL; //$_SERVER['HTTP_USER_AGENT'];


        // Check if all session variables are set
        if (isset($_SESSION['user']['KomitentEmail']) && isset($_SESSION['user']['login_string']) && isset($_SESSION['user']['KomitentId'])) {


            // da preslozimo SESSION
            if ($_SESSION['korpasescase']) {
                asort($_SESSION['korpasescase']);
            }
            //if ($_SESSION['korpases']) { asort($_SESSION['korpases']); }

            $user_id = $_SESSION['user']['KomitentId'];
            $login_string = $_SESSION['user']['login_string'];
            $KomitentEmail = $_SESSION['user']['KomitentEmail'];

            // Get the user-agent string of the user.
            //$this->dbConn->setTrace(true);
            $this->dbConn->where("KomitentId", $user_id);
            $this->dbConn->where("KomitentActive", '1');
            $userTipUpit = $this->dbConn->getOne("komitenti");

            //var_dump($this->dbConn->trace);


            if ($userTipUpit) {


                $KomitentPassword = $userTipUpit['KomitentPassword'];
                $KomitentSalt = $userTipUpit['KomitentSalt'];

                if ($KomitentPassword) { // $brojup==1


                    $login_check = hash('sha512', $KomitentPassword . $user_browser);
                    if ($login_string == $login_check) {


                        /*unset($_SESSION['korpases']);
                        $upitdaliima = "select * from tempArt where TempArtKorisnik = '$user_id' and TempArtMyCase = '0'";
                        $nestoupir = $this->dbConn->executeQuery($upitdaliima);
                        if ($nestoupir) {
                            foreach ($nestoupir as $m => $g) {
                                $tempArtIdInc = $g[TempArtIdInc];
                                $tempArtKolicina = $g[TempArtKolicina];
                                $my_array = array("idproiz" => $tempArtIdInc, "boje" => '', "kolicina" => $tempArtKolicina, "velicina" => '');
                                $_SESSION['korpases'][$tempArtIdInc] = $my_array;
                            }
                        }

                        unset($_SESSION['korpasescase']);
                        $upitdaliima = "select * from tempArt where TempArtKorisnik = '$user_id' and TempArtMyCase = '1'";
                        $nestoupir = $this->dbConn->executeQuery($upitdaliima);
                        if ($nestoupir) {
                            foreach ($nestoupir as $m => $g) {
                                $TempArtId = $g[TempArtId];
                                $tempArtIdInc = $g[TempArtIdInc];
                                $tempArtKolicina = $g[TempArtKolicina];
                                $TempArtMyCaseCena = $g[TempArtMyCaseCena];
                                $my_array = array("idproiz" => $tempArtIdInc, "kolicina" => $tempArtKolicina, "cenacase" => $TempArtMyCaseCena);
                                $_SESSION['korpasescase'][$TempArtId] = $my_array;
                            }
                        }*/

                        return true;
                    } else {
                        unset($_SESSION['user']);
                        echo 'Not logged in 1';
                        return false;
                    }
                } else {
                    echo 'Not logged in 2';
                    return false;
                }

            } else {

                //var_dump($_SESSION);
                //echo  'Could not prepare statement';
                unset($_SESSION['user']);
                setcookie("credentials", "", time() - 3600);
                header("Location: /login?err=nije-sesn-kako-user-nije-aktivan-komitent");
                exit();
            }


        } else {


            if ($_COOKIE['credentials']) {

                // echo 'da li je obican ima credentials. Ako ima prijavi ga.';
                list ($email, $pasCook) = explode(':', $_COOKIE['credentials'], 2);


                $encrypted_mail = $this->encrypt_decrypt('decrypt', $email);


                $this->dbConn->where("KomitentEmail", $encrypted_mail);
                $this->dbConn->where("KomitentActive", '1');
                $sad = $this->dbConn->getOne("komitenti");


                if ($sad) {


                    $KomitentPasswordCook = $sad['KomitentPassword'];
                    $KomitentSaltCook = $sad['KomitentSalt'];


                    $passwordCookie = hash('sha512', $KomitentPasswordCook . $KomitentSaltCook);

                    $kojijeCookiPass = hash_hmac('sha256', $passwordCookie, SIFRAZACOOKIE);


                    if ($kojijeCookiPass == $pasCook) {


                        $user_id = $sad[KomitentId];
                        $userExtId = $sad[KomitentExtId];
                        $salt = $sad[KomitentSalt];
                        $KomitentPassword = $sad['KomitentPassword'];
                        $KomitentNaziv = $sad[KomitentNaziv];
                        $KorisnikTipUsera = $sad['KomitentTipUsera'];
                        $TipUseraOpis = $sad[TipUseraOpis];
                        $KomitentUserName = $sad[KomitentUserName];

                        $_SESSION['user']['KomitentId'] = $user_id;
                        $_SESSION['user']['KomitentEmail'] = $email;
                        $_SESSION['user']['KomitentUserName'] = $KomitentUserName;
                        $_SESSION['user']['KomitentNaziv'] = $KomitentNaziv;
                        $_SESSION['user']['KorisnikTipUsera'] = $KorisnikTipUsera;
                        $_SESSION['user']['TipUseraOpis'] = $TipUseraOpis;
                        $_SESSION['user']['login_string'] = hash('sha512', $KomitentPassword . $user_browser);


                        /* $upitdaliima = "select * from tempArt where TempArtKorisnik = '$user_id' and TempArtMyCase = '0'";
                         $nestoupir = $this->dbConn->executeQuery($upitdaliima);
                         if ($nestoupir) {
                             foreach ($nestoupir as $m => $g) {
                                 $tempArtIdInc = $g[TempArtIdInc];
                                 $tempArtKolicina = $g[TempArtKolicina];
                                 $my_array = array("idproiz" => $tempArtIdInc, "boje" => '', "kolicina" => $tempArtKolicina, "velicina" => '');
                                 $_SESSION['korpases'][$tempArtIdInc] = $my_array;
                             }
                         }

                         $upitdaliima = "select * from tempArt where TempArtKorisnik = '$user_id' and TempArtMyCase = '1'";
                         $nestoupir = $this->dbConn->executeQuery($upitdaliima);
                         if ($nestoupir) {
                             foreach ($nestoupir as $m => $g) {
                                 $TempArtId = $g[TempArtId];
                                 $tempArtIdInc = $g[TempArtIdInc];
                                 $tempArtKolicina = $g[TempArtKolicina];
                                 $TempArtMyCaseCena = $g[TempArtMyCaseCena];
                                 $my_array = array("idproiz" => $tempArtIdInc, "kolicina" => $tempArtKolicina, "cenacase" => $TempArtMyCaseCena);
                                 $_SESSION['korpasescase'][$TempArtId] = $my_array;
                             }
                         }*/


                        // da je registrovan mora da se stavi true;
                        return true;

                    } else {
                        //echo 'Pass dont match <br>';
                        //$error_msg['err'] = 'Pass dont match';
                        setcookie("credentials", "", time() - 3600);
                        return false;
                    }

                } else {
                    echo 'Ima cookie ali ne postoji email u bazi <br>';
                    setcookie("credentials", "", time() - 3600);
                    header("Location: /login?err=Morate ponovo da se registrujete");
                    exit();
                }

            } else {
                //echo 'Nije ni nigistrovan, nema ni podatke da ga automatski registujemo.';
                // ali zato cekiramo da li ima nesto u bazi kod nas.

                 if ($_COOKIE['sajtcheck']) {

                     $_SESSION['sajtcheck'] = $_COOKIE['sajtcheck'];
                     /*$cols = Array("IdArtTempArt", "KolTempArt");
                     $this->dbConn->where("KomiTempArt", $_COOKIE['sajtcheck']);
                     $artikli = $this->dbConn->get("tempart", null, $cols);
                     var_dump($artikli);
                     if ($this->dbConn->count > 0) {
                         if ($artikli) {

                             foreach ($artikli as $m => $g) {
                                 $tempArtIdInc = $g['IdArtTempArt'];
                                 $tempArtKolicina = $g['KolTempArt'];
                                 $my_array = array("idproiz" => $tempArtIdInc, "boje" => '', "kolicina" => $tempArtKolicina, "velicina" => '');
                                 $_SESSION['korpases'][$tempArtIdInc] = $my_array;
                             }
                         }

                     } else {
                         unset($_SESSION['korpases']);
                     }*/


                 } else {

                     $er['tip'] = false;
                     $er['message'] = 'Nije ni nigistrovan, nema mi podatke da ga automatski registujemo
                Ali zato cekiramo da li ima nesto u bazi kod nas. Treba da koristimo sajtcheck
                jer sec_session_id traje samo dok traje session';

                     session_unset();
                     session_destroy();

                     return false;
                     //return json_encode($er);



                 }

                // return false;
            }
        }


    }

}