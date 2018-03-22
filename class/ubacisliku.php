<?php

class ubacisliku extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }

    /**
     * $slika - koja se slika upladuje
     * $imebrenda - ime kategorije ili brenbda
     * $idba - id kolone
     * $table - koja tabela
     * $kolona - koja kolona
     * $location - gde ce se slika upisati
     * $nazivInputPolja = 'slikeMultiple'; // naziv input polja u kome se nalazi file
     * $w = definisi sirinu slike - default je 200px
     * $h = definisi visinu slike - default je 200px
     * $preview = ako pravimo thumb sliku _mala (80, 110) i _srednja  250, 340
     * $orgSlika =  da li zelimo da snimimo i originalnu sliku
     */

    public function ubacislikuSve($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $error_msg = '';

        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema Naziva Slieke - dodaj naziv slike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if ($error_msg) {
            echo $error_msg;
            die;
        }

        $idkolone = ($idkolone) ? $idkolone : 'id'; // koji je id

        if ($slika && $idba > 0) { // if slika exists and id is higher then 0

            $common = new common($this->dbConn);

            // dali postoji folder
            $lok = $common->locationslika($idba);
            $lokslifol = DCROOT . $lok;

            if (!is_dir($lokslifol)) {
                mkdir($lokslifol, 0775, true);
            } // create dir

            $w = ($w) ? $w : 800; // width of picture
            $h = ($h) ? $h : 800; // height of picture


            $url_slike = $common->friendly_convert($imeslike);


            require_once('thumblib/ThumbLib.inc.php'); // include class
            $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


            $i = 0;
            if ($ukupno_fajlova > 0) {

                foreach($_FILES[$nazivInputPolja]['tmp_name'] as $key => $value){

                    try {

                        $rand =  rand(1, 150);


                        $slika = $_FILES[$nazivInputPolja]['tmp_name'][$i]; // superglobal
                        $thumb = PhpThumbFactory::create($slika);

                        $nameOfPic = $url_slike . '-' . $rand . ".".EXTPRED;

                        $img = $lokslifol . "/" . $nameOfPic;
                        //$thumb->resize(800,800);


                        if ($w != 'nema' || $h != 'nema') {
                            $thumb->adaptiveResize($w, $h);
                        }
                        // ubacujemo sliku u bazu
                        $data = Array("IdArtikliSlikePov" => $idba,
                            "ImeSlikeArtikliSlike" => $nameOfPic
                        );
                        $idUbacneslike = $this->dbConn->insert($table, $data);

                        if ($idUbacneslike) {

                            $error_msg .= 'user was created. Id=' . $idUbacneslike;

                            // setujemo sve prethodne slike da nisu glavne
                            $data = Array('MainArtikliSlike' => '0');
                            $this->dbConn->where('IdArtikliSlikePov', $idba);
                            $this->dbConn->update($table, $data);

                            // setijemo poslednju da je glavna slika
                            $dataMain = Array('MainArtikliSlike' => '1');
                            $this->dbConn->where('IdArtikliSlike', $idUbacneslike);
                            $this->dbConn->update($table, $dataMain);

                            // azuiramo naziv slike u bazi
                            $nameOfPic = $url_slike . '-' . $idUbacneslike . ".".EXTPRED;
                            $img = $lokslifol . "/" . $nameOfPic;

                            $dataMain = Array('ImeSlikeArtikliSlike' => $nameOfPic);
                            $this->dbConn->where('IdArtikliSlike', $idUbacneslike);
                            $this->dbConn->update($table, $dataMain);


                            if ($preview) {
                                $imgmala = $lokslifol . "/" . $url_slike . '-' . $idUbacneslike . '_mala.'.EXTPRED;
                                $thumbmala = PhpThumbFactory::create($slika);
                                $thumbmala->adaptiveResize(110,110);
                                $thumbmala->save($imgmala, EXTPRED);


                                $imgsrednja = $lokslifol . "/" . $url_slike . '-' . $idUbacneslike . '_srednja.'.EXTPRED;
                                $thumbsrednja = PhpThumbFactory::create($slika);
                                $thumbsrednja->adaptiveResize(195,195);
                                $thumbsrednja->save($imgsrednja, EXTPRED);


                                $imgmaloveca = $lokslifol . "/" . $url_slike . '-' . $idUbacneslike . '_maloVeca.'.EXTPRED;
                                $thumbmaloveca = PhpThumbFactory::create($slika);
                                $thumbmaloveca->adaptiveResize(350,350);
                                $thumbmaloveca->save($imgmaloveca, EXTPRED);
                            }

                            // mora na ovom mestu jer ne vidi prethodne slike
                            if ($orgSlika) {
                                move_uploaded_file($slika, $img);
                            } else {
                                $thumb->save($img, EXTPRED);
                            }


                        } else {
                            $error_msg .= 'Nije ubacen ID u bazu za slike';
                            die;
                        }


                    } catch (Exception $e) {
                        $error_msg .= "<br />Picture is not found<br />";
                    }

                    if ($slika) {
                        //unlink($slika);
                    }

                    $i++;


                }

            } // from for


        }
        // from if slika exists */
    } // end of function

    /**
     * @param $slika
     * @param $imeslike
     * @param $idba
     * @param $table
     * @param $kolona
     * @param $location
     * @param $nazivInputPolja
     * @param bool|false $idkolone
     * @param bool|false $w
     * @param bool|false $h
     * @param bool|false $preview
     * @param bool|false $orgSlika
     */

    public function ubacislikuKB($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if ($error_msg) {
            echo $error_msg;
            die;
        }

        if ($slika && $idba > 0) { // if slika exists and id is higher then 0

            $common = new common($this->dbConn);

            // dali postoji folder
            $lok = $common->locationslikaOstalo($location,$idba);
            $lokslifol = DCROOT . $lok;

            if (!is_dir($lokslifol)) {
                mkdir($lokslifol, 0775, true);
            } // create dir


            $w = ($w) ? $w : 400; // width of picture
            $h = ($h) ? $h : 400; // height of picture


            $url_slike = $common->friendly_convert($imeslike);


            require_once('thumblib/ThumbLib.inc.php'); // include class
            $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


            $i = 0;
            if ($ukupno_fajlova > 0) {



                    try {

                        $rand =  rand(1, 150);

                        $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal
                        $thumb = PhpThumbFactory::create($slika);

                        $nameOfPic = $url_slike . ".".EXTPRED;

                        $img = $lokslifol . "/" . $nameOfPic;
                        //$thumb->resize(800,800);


                        if ($w != 'nema' || $h != 'nema') {
                            $thumb->adaptiveResize($w, $h);
                        }


                            // setujemo sve prethodne slike da nisu glavne
                            $data = Array($kolona => $nameOfPic);
                            $this->dbConn->where($idkolone, $idba);
                            $this->dbConn->update($table, $data);


                            if ($preview) {
                                $imgmala = $lokslifol . "/" . $url_slike . '_mala.'.EXTPRED;
                                $thumbmala = PhpThumbFactory::create($slika);
                                $thumbmala->adaptiveResize(110,80);
                                $thumbmala->save($imgmala, EXTPRED);


                                $imgsrednja = $lokslifol . "/" . $url_slike . '_srednja.'.EXTPRED;
                                $thumbsrednja = PhpThumbFactory::create($slika);
                                $thumbsrednja->adaptiveResize(340,250);
                                $thumbsrednja->save($imgsrednja, EXTPRED);

                                // dodatno  172 x 170
                                $imgsrednja172 = $lokslifol . "/" . $url_slike . '_172.'.EXTPRED;
                                $thumbsrednja172 = PhpThumbFactory::create($slika);
                                $thumbsrednja172->adaptiveResize(172,170);
                                $thumbsrednja172->save($imgsrednja172, EXTPRED);

                            }

                            // mora na ovom mestu jer ne vidi prethodne slike
                            if ($orgSlika) {
                                move_uploaded_file($slika, $img);
                            } else {
                                $thumb->save($img, EXTPRED);
                            }




                    } catch (Exception $e) {
                        $error_msg .= "Picture is not found";
                    }

                    if ($slika) {
                        unlink($slika);
                    }

                    $i++;


                }

        }
        // from if slika exists */
    } // end of function


    public function ubacislikuKomitent($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if (!$error_msg) {

            if ($slika && $idba > 0) { // if slika exists and id is higher then 0

                $common = new common($this->dbConn);

                // dali postoji folder
                $lok = $common->locationslikaOstaloKomitent($location,$idba);
                $lokslifol = DCROOT . $lok;

                if (!is_dir($lokslifol)) {
                    mkdir($lokslifol, 0775, true);
                } // create dir


                $w = ($w) ? $w : 400; // width of picture
                $h = ($h) ? $h : 400; // height of picture


                $url_slike = $common->friendly_convert($imeslike);


                require_once('thumblib/ThumbLib.inc.php'); // include class
                $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


                $i = 0;
                if ($ukupno_fajlova > 0) {



                    try {

                        $rand =  rand(1, 150);

                        $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal

                        $thumb = PhpThumbFactory::create($slika);

                        $nameOfPic = $url_slike . ".".EXTPRED;

                        $img = $lokslifol . "/" . $nameOfPic;
                        //$thumb->resize(800,800);


                        if ($w != 'nema' || $h != 'nema') {
                            $thumb->adaptiveResize($w, $h);
                        }

                        // setujemo sve prethodne slike da nisu glavne
                        $data = Array($kolona => $nameOfPic);
                        $this->dbConn->where($idkolone, $idba);
                        $this->dbConn->update($table, $data);


                        if ($preview) {
                            $imgmala = $lokslifol . "/" . $url_slike . '_mala.'.EXTPRED;
                            $thumbmala = PhpThumbFactory::create($slika);
                            $thumbmala->adaptiveResize(110,80);
                            $thumbmala->save($imgmala, EXTPRED);


                            $imgsrednja = $lokslifol . "/" . $url_slike . '_srednja.'.EXTPRED;
                            $thumbsrednja = PhpThumbFactory::create($slika);
                            $thumbsrednja->adaptiveResize(340,250);
                            $thumbsrednja->save($imgsrednja, EXTPRED);

                            // dodatno  172 x 170
                            $imgsrednja172 = $lokslifol . "/" . $url_slike . '_172.'.EXTPRED;
                            $thumbsrednja172 = PhpThumbFactory::create($slika);
                            $thumbsrednja172->adaptiveResize(172,170);
                            $thumbsrednja172->save($imgsrednja172, EXTPRED);

                        }

                        // mora na ovom mestu jer ne vidi prethodne slike
                        if ($orgSlika) {
                            move_uploaded_file($slika, $img);
                        } else {
                            $thumb->save($img, EXTPRED);
                        }




                    } catch (Exception $e) {
                        $error_msg .= "Picture is not found";
                    }

                    if ($slika) {
                        unlink($slika);
                    }

                    $i++;


                }

            }
        } else {
            //echo $error_msg;
        }


        // from if slika exists */
    } // end of function


    public function ubacislikuGalKom($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {
        $slika = $_FILES[$nazivInputPolja]['tmp_name'][0]; // superglobal

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if (!$error_msg) {

            if ($slika && $idba > 0) { // if slika exists and id is higher then 0



                $common = new common($this->dbConn);

                // dali postoji folder
                $lok = $common->locationslikaOstaloGalKomitent($location,$idba);
                $lokslifol = DCROOT . $lok;

                if (!is_dir($lokslifol)) {
                    mkdir($lokslifol, 0777, true);
                } // create dir

                /* $lokIdSlike = $lokslifol.'/'.$idba;
                 if (!is_dir($lokIdSlike)) {
                     mkdir($lokIdSlike, 0775, true);
                 } // create dir*/


                $w = ($w) ? $w : 400; // width of picture
                $h = ($h) ? $h : 400; // height of picture


                $url_slike = $common->friendly_convert($imeslike);


                require_once('thumblib/ThumbLib.inc.php'); // include class
                $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


                $i = 0;
                if ($ukupno_fajlova > 0) {


                    foreach($_FILES[$nazivInputPolja]['tmp_name'] as $key => $value) {
                        try {

                            $rand = rand(1, 150);

                            $slika = $_FILES[$nazivInputPolja]['tmp_name'][$i]; // superglobal
                            $thumb = PhpThumbFactory::create($slika);

                            $nameOfPic = $url_slike . '-' . $rand . ".".EXTPRED;


                            $img = $lokslifol . "/" . $nameOfPic;

                            //$thumb->resize(800,800);


                            if ($w != 'nema' || $h != 'nema') {
                                $thumb->adaptiveResize($w, $h);
                            }

                            // ubacujemo sliku u bazu
                            $data = Array("IdKomitentiSlikePov" => $idba,
                                "ImeSlikeKomitentiSlike" => $nameOfPic
                            );
                            $idUbacneslike = $this->dbConn->insert($table, $data);

                            if ($idUbacneslike) {

                                $error_msg .= 'user was created. Id=' . $idUbacneslike;

                                // setujemo sve prethodne slike da nisu glavne
                                $data = Array('MainKomitentiSlike' => '0');
                                $this->dbConn->where('IdKomitentiSlikePov', $idba);
                                $this->dbConn->update($table, $data);

                                // setijemo poslednju da je glavna slika
                                $dataMain = Array('MainKomitentiSlike' => '1');
                                $this->dbConn->where('IdKomitentiSlike', $idUbacneslike);
                                $this->dbConn->update($table, $dataMain);

                                // azuiramo naziv slike u bazi
                                $nameOfPic = $url_slike . '-' . $idUbacneslike . ".".EXTPRED;
                                $img = $lokslifol . "/" . $nameOfPic;

                                $dataMain = Array('ImeSlikeKomitentiSlike' => $nameOfPic);
                                $this->dbConn->where('IdKomitentiSlike', $idUbacneslike);
                                $this->dbConn->update($table, $dataMain);


                                if ($preview) {
                                    $imgmala = $lokslifol . "/" . $url_slike . '-' . $idUbacneslike . '_mala.'.EXTPRED;
                                    $thumbmala = PhpThumbFactory::create($slika);
                                    $thumbmala->adaptiveResize(110,110);
                                    $thumbmala->save($imgmala, EXTPRED);


                                    $imgsrednja = $lokslifol . "/" . $url_slike . '-' . $idUbacneslike . '_srednja.'.EXTPRED;
                                    $thumbsrednja = PhpThumbFactory::create($slika);
                                    $thumbsrednja->adaptiveResize(195,195);
                                    $thumbsrednja->save($imgsrednja, EXTPRED);
                                }

                                // mora na ovom mestu jer ne vidi prethodne slike
                                if ($orgSlika) {
                                    move_uploaded_file($slika, $img);
                                } else {
                                    $thumb->save($img, EXTPRED);
                                }


                            } else {
                                $error_msg .= 'Nije ubacen ID u bazu za slike';
                                die;
                            }


                        } catch (Exception $e) {
                            $error_msg .= "Picture is not found";
                        }

                        if ($slika) {
                            unlink($slika);
                        }

                        $i++;
                    }


                }

            }

        } else {
            echo 'Nema slike';
        }


        // from if slika exists */
    } // end of function


    public function ubacislikuBanerNew($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if ($error_msg) {
            echo $error_msg;
            die;
        }


        if ($slika && $idba > 0) { // if slika exists and id is higher then 0

            $common = new common($this->dbConn);

            // dali postoji folder
            $lok = $common->locationslikaOstalo($location,$idba);
            $lokslifol = DCROOT . $lok;

            if (!is_dir($lokslifol)) {
                mkdir($lokslifol, 0775, true);
            } // create dir


            $w = ($w) ? $w : 400; // width of picture
            $h = ($h) ? $h : 400; // height of picture


            $url_slike = $common->friendly_convert($imeslike);


            require_once('thumblib/ThumbLib.inc.php'); // include class
            $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


            $i = 0;
            if ($ukupno_fajlova > 0) {



                try {

                    $rand =  rand(1, 150);

                    $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal
                    $thumb = PhpThumbFactory::create($slika);

                    $nameOfPic = $url_slike . ".".EXTPRED;

                    $img = $lokslifol . "/" . $nameOfPic;
                    //$thumb->resize(800,800);


                    if ($w != 'nema' || $h != 'nema') {
                        $thumb->adaptiveResize($w, $h);
                    }

                    // setujemo sve prethodne slike da nisu glavne
                    $data = Array($kolona => $nameOfPic);
                    $this->dbConn->where($idkolone, $idba);
                    $this->dbConn->update($table, $data);


                    if ($preview) {
                        $imgmala = $lokslifol . "/" . $url_slike . '_mala.'.EXTPRED;
                        $thumbmala = PhpThumbFactory::create($slika);
                        $thumbmala->adaptiveResize(270,370);
                        $thumbmala->save($imgmala, EXTPRED);


                        $imgsrednja = $lokslifol . "/" . $url_slike . '_srednja.'.EXTPRED;
                        $thumbsrednja = PhpThumbFactory::create($slika);
                        $thumbsrednja->adaptiveResize(870,250);
                        $thumbsrednja->save($imgsrednja, EXTPRED);

                        // dodatno 470 x 150
                        $imgmala470 = $lokslifol . "/" . $url_slike . '_470.'.EXTPRED;
                        $thumb470 = PhpThumbFactory::create($slika);
                        $thumb470->adaptiveResize(470,158);
                        $thumb470->save($imgmala470, EXTPRED);

                        // dodatno 470 x 150
                        $imgmala370 = $lokslifol . "/" . $url_slike . '_370.'.EXTPRED;
                        $thumb370 = PhpThumbFactory::create($slika);
                        $thumb370->adaptiveResize(370,158);
                        $thumb370->save($imgmala370, EXTPRED);

                    }



                    // mora na ovom mestu jer ne vidi prethodne slike
                    if ($orgSlika) {
                        move_uploaded_file($slika, $img);
                    } else {
                        $thumb->save($img, EXTPRED);
                    }




                } catch (Exception $e) {
                    $error_msg .= "Picture is not found";
                }



                if ($slika) {
                    unlink($slika);
                }

                $i++;


            }

        } else {
            echo 'Nema slike ili ID';
            die;
        }
        // from if slika exists */
    } // end of function


    public function ubacislikuVesti($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if ($error_msg) {
            echo $error_msg;
            die;
        }


        if ($slika && $idba > 0) { // if slika exists and id is higher then 0

            $common = new common($this->dbConn);

            // dali postoji folder

            $lok = $common->locationslikaOstalo($location, $idba);
            $lokslifol = DCROOT . $lok;

            // brisemo sve slike iz foldera // rizicna funkcija
            if ($idba) {
            //$common->rrmdir($lokslifol);
            }


            if (!is_dir($lokslifol)) {
                mkdir($lokslifol, 0775, true);
            } // create dir



            $w = ($w) ? $w : 400; // width of picture
            $h = ($h) ? $h : 400; // height of picture


            $url_slike = $common->friendly_convert($imeslike);


            require_once('thumblib/ThumbLib.inc.php'); // include class
            $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


            $i = 0;
            if ($ukupno_fajlova > 0) {


                try {

                    $rand = rand(1, 150);

                    $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal
                    $thumb = PhpThumbFactory::create($slika);

                    $nameOfPic = $url_slike . ".".EXTPRED;

                    $img = $lokslifol . "/" . $nameOfPic;
                    //$thumb->resize(800,800);


                    if ($w != 'nema' || $h != 'nema') {
                        $thumb->adaptiveResize($w, $h);
                    }

                    // setujemo sve prethodne slike da nisu glavne
                    $data = Array($kolona => $nameOfPic);
                    $this->dbConn->where($idkolone, $idba);
                    $this->dbConn->update($table, $data);


                    if ($preview) {
                        $imgmala = $lokslifol . "/" . $url_slike . '_mala.'.EXTPRED;
                        $thumbmala = PhpThumbFactory::create($slika);
                        $thumbmala->adaptiveResize(270, 159);
                        $thumbmala->save($imgmala, EXTPRED);


                     /*   $imgsrednja = $lokslifol . "/" . $url_slike . '_srednja.png';
                        $thumbsrednja = PhpThumbFactory::create($slika);
                        $thumbsrednja->adaptiveResize(870, 250);
                        $thumbsrednja->save($imgsrednja, EXTPRED);*/



                    }


                    // mora na ovom mestu jer ne vidi prethodne slike
                    if ($orgSlika) {
                        move_uploaded_file($slika, $img);
                    } else {
                        $thumb->save($img, EXTPRED);
                    }


                } catch (Exception $e) {
                    $error_msg .= "Picture is not found";
                }


                if ($slika) {
                    unlink($slika);
                }

                $i++;


            }

        } else {
            echo 'Nema slike ili ID';
            die;
        }
        // from if slika exists */
    } // end of function


    public function ubacislikuLs($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if ($error_msg) {
            echo $error_msg;
            die;
        }


        if ($slika && $idba > 0) { // if slika exists and id is higher then 0

            $common = new common($this->dbConn);

            // dali postoji folder
            $lok = $common->locationslikaOstalo($location, $idba);
            $lokslifol = DCROOT . $lok;

            if (!is_dir($lokslifol)) {
                mkdir($lokslifol, 0775, true);
            } // create dir


            $w = ($w) ? $w : 400; // width of picture
            $h = ($h) ? $h : 400; // height of picture


            $url_slike = $common->friendly_convert($imeslike);


            require_once('thumblib/ThumbLib.inc.php'); // include class
            $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


            $i = 0;
            if ($ukupno_fajlova > 0) {


                try {

                    $rand = rand(1, 150);

                    $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal
                    $thumb = PhpThumbFactory::create($slika);

                    $nameOfPic = $url_slike . ".".EXTPRED;

                    $img = $lokslifol . "/" . $nameOfPic;
                    //$thumb->resize(800,800);


                    if ($w != 'nema' || $h != 'nema') {
                        $thumb->adaptiveResize($w, $h);
                    }

                    // setujemo sve prethodne slike da nisu glavne
                    $data = Array($kolona => $nameOfPic);
                    $this->dbConn->where($idkolone, $idba);
                    $this->dbConn->update($table, $data);


                    if ($preview) {
                        $imgmala = $lokslifol . "/" . $url_slike . '_mala.'.EXTPRED;
                        $thumbmala = PhpThumbFactory::create($slika);
                        $thumbmala->adaptiveResize(270, 370);
                        $thumbmala->save($imgmala, EXTPRED);


                        $imgsrednja = $lokslifol . "/" . $url_slike . '_srednja.'.EXTPRED;
                        $thumbsrednja = PhpThumbFactory::create($slika);
                        $thumbsrednja->adaptiveResize(870, 250);
                        $thumbsrednja->save($imgsrednja, EXTPRED);

                        // dodatno 470 x 150
                        $imgmala470 = $lokslifol . "/" . $url_slike . '_470.'.EXTPRED;
                        $thumb470 = PhpThumbFactory::create($slika);
                        $thumb470->adaptiveResize(470, 158);
                        $thumb470->save($imgmala470, EXTPRED);

                        // dodatno 470 x 150
                        $imgmala370 = $lokslifol . "/" . $url_slike . '_370.'.EXTPRED;
                        $thumb370 = PhpThumbFactory::create($slika);
                        $thumb370->adaptiveResize(370, 158);
                        $thumb370->save($imgmala370, EXTPRED);

                    }


                    // mora na ovom mestu jer ne vidi prethodne slike
                    if ($orgSlika) {
                        move_uploaded_file($slika, $img);
                    } else {
                        $thumb->save($img, EXTPRED);
                    }


                } catch (Exception $e) {
                    $error_msg .= "Picture is not found";
                }


                if ($slika) {
                    unlink($slika);
                }

                $i++;


            }

        } else {
            echo 'Nema slike ili ID';
            die;
        }
        // from if slika exists */
    } // end of function


    public function ubacislikuBrend($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if ($error_msg) {
            echo $error_msg;
            die;
        }


        if ($slika && $idba > 0) { // if slika exists and id is higher then 0

            $common = new common($this->dbConn);

            // dali postoji folder
            $lok = $common->locationslikaOstalo($location, $idba);
            $lokslifol = DCROOT . $lok;

            if (!is_dir($lokslifol)) {
                mkdir($lokslifol, 0775, true);
            } // create dir


            $w = ($w) ? $w : 400; // width of picture
            $h = ($h) ? $h : 400; // height of picture


            $url_slike = $common->friendly_convert($imeslike);


            require_once('thumblib/ThumbLib.inc.php'); // include class
            $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


            $i = 0;
            if ($ukupno_fajlova > 0) {


                try {

                    $rand = rand(1, 150);

                    $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal
                    $thumb = PhpThumbFactory::create($slika);

                    $nameOfPic = $url_slike . ".".EXTPRED;

                    $img = $lokslifol . "/" . $nameOfPic;
                    //$thumb->resize(800,800);


                    if ($w != 'nema' || $h != 'nema') {
                        $thumb->adaptiveResize($w, $h);
                    }

                    // setujemo sve prethodne slike da nisu glavne
                    $data = Array($kolona => $nameOfPic);
                    $this->dbConn->where($idkolone, $idba);
                    $this->dbConn->update($table, $data);

                    // dzimo isti racio 1.37
                    if ($preview) {
                        $imgmala = $lokslifol . "/" . $url_slike . '_mala.'.EXTPRED;
                        $thumbmala = PhpThumbFactory::create($slika);
                        $thumbmala->adaptiveResize(270, 197);
                        $thumbmala->save($imgmala, EXTPRED);

                        // dodatno 470 x 150
                        $imgmala370 = $lokslifol . "/" . $url_slike . '_370.'.EXTPRED;
                        $thumb370 = PhpThumbFactory::create($slika);
                        $thumb370->adaptiveResize(370, 269);
                        $thumb370->save($imgmala370, EXTPRED);

                        // dodatno  172 x 170
                        $imgsrednjaa172 = $lokslifol . "/" . $url_slike . '_172.'.EXTPRED;
                        $thumb172 = PhpThumbFactory::create($slika);
                        $thumb172->adaptiveResize(172,125);
                        $thumb172->save($imgsrednjaa172, EXTPRED);

                    }


                    // mora na ovom mestu jer ne vidi prethodne slike
                    if ($orgSlika) {
                        move_uploaded_file($slika, $img);
                    } else {
                        $thumb->save($img, EXTPRED);
                    }


                } catch (Exception $e) {
                    $error_msg .= "Picture is not found";
                }


                if ($slika) {
                    unlink($slika);
                }

                $i++;


            }

        } else {
            echo 'Nema slike ili ID';
            die;
        }
        // from if slika exists */
    } // end of function

    public function ubacislikuKulture($slika, $imeslike, $idba, $table, $kolona, $location, $nazivInputPolja, $idkolone = false, $w = false, $h = false, $preview = false, $orgSlika = false)
    {

        $error_msg = '';
        if (!$slika) {
            $error_msg .= 'Nema Slike';
        }
        if (!$imeslike) {
            $error_msg .= 'Nema $imeslike';
        }
        if (!$idba) {
            $error_msg .= 'Nema $idba';
        }
        if (!$table) {
            $error_msg .= 'Nema Tabele';
        }
        if (!$kolona) {
            $error_msg .= 'Nema Kolone';
        }
        if (!$location) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$nazivInputPolja) {
            $error_msg .= 'Nema Lokacije Slike';
        }
        if (!$idkolone) {
            $error_msg .= 'Nema ID kolone gde se slika upisuje';
        }

        if ($error_msg) {
            echo $error_msg;
            die;
        }


        if ($slika && $idba > 0) { // if slika exists and id is higher then 0

            $common = new common($this->dbConn);

            // dali postoji folder

            $lok = $common->locationslikaOstalo($location, $idba);
            $lokslifol = DCROOT . $lok;

            // brisemo sve slike iz foldera // rizicna funkcija
            if ($idba) {
                //$common->rrmdir($lokslifol);
            }


            if (!is_dir($lokslifol)) {
                mkdir($lokslifol, 0775, true);
            } // create dir



            $w = ($w) ? $w : 400; // width of picture
            $h = ($h) ? $h : 400; // height of picture


            $url_slike = $common->friendly_convert($imeslike);


            require_once('thumblib/ThumbLib.inc.php'); // include class
            $ukupno_fajlova = count($_FILES[$nazivInputPolja]['tmp_name']);    // number of uploated files


            $i = 0;
            if ($ukupno_fajlova > 0) {


                try {

                    $rand = rand(1, 150);

                    $slika = $_FILES[$nazivInputPolja]['tmp_name']; // superglobal
                    $thumb = PhpThumbFactory::create($slika);

                    $nameOfPic = $url_slike . ".png";

                    $img = $lokslifol . "/" . $nameOfPic;
                    //$thumb->resize(800,800);


                    if ($w != 'nema' || $h != 'nema') {
                        $thumb->adaptiveResize($w, $h);
                    }

                    // setujemo sve prethodne slike da nisu glavne
                    $data = Array($kolona => $nameOfPic);
                    $this->dbConn->where($idkolone, $idba);
                    $this->dbConn->update($table, $data);


                    if ($preview) {
                        $imgmala = $lokslifol . "/" . $url_slike . '_mala.png';
                        $thumbmala = PhpThumbFactory::create($slika);
                        $thumbmala->adaptiveResize(270, 159);
                        $thumbmala->save($imgmala, 'png');


                        $imgsrednja = $lokslifol . "/" . $url_slike . '_srednja.png';
                        $thumbsrednja = PhpThumbFactory::create($slika);
                        $thumbsrednja->adaptiveResize(337, 270);
                        $thumbsrednja->save($imgsrednja, 'png');

                    }


                    // mora na ovom mestu jer ne vidi prethodne slike
                    if ($orgSlika) {
                        move_uploaded_file($slika, $img);
                    } else {
                        $thumb->save($img, 'png');
                    }


                } catch (Exception $e) {
                    $error_msg .= "Picture is not found";
                }


                if ($slika) {
                    unlink($slika);
                }

                $i++;


            }

        } else {
            echo 'Nema slike ili ID';
            die;
        }
        // from if slika exists */
    } // end of function


}

?>
