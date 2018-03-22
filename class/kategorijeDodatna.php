<?php

class kategorijeDodatna extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }


    function updateKategDodatna($idKateg, $kategorija_dodatna_funkc = false, $broj = false, $jezLan)
    {
        echo '<ul>';
        $cols = Array("*");
        $this->dbConn->where('parent_id', $kategorija_dodatna_funkc);
        $users = $this->dbConn->get("kategorije", null, $cols);

        if ($this->dbConn->count > 0) {
            foreach ($users as $user) {


                $kat_name = $user['kat_name'];
                $id = $user['id'];
                $parent_id = $user['parent_id'];


                /*
                 * Da li ima data kategorija kod nas u Bazi
                 *  */
                $cols = Array("*");
                $this->dbConn->join("kategorijeartikalanaslov KAN", "KAN.IdKategorije = KategorijaArtikalaId AND KAN.IdLanguage = 5", "LEFT");
                $this->dbConn->where('Kategorija_dodatna', $id);
                $daLiImaKateg = $this->dbConn->getOne("kategorijeartikala", null, $cols);

                $NazivKategorije = $daLiImaKateg['NazivKategorije'];
                $KategorijaArtikalaId = $daLiImaKateg['KategorijaArtikalaId'];
                $ParentKategorijaArtikalaId = $daLiImaKateg['ParentKategorijaArtikalaId'];
                $Kategorija_dodatna = $daLiImaKateg['Kategorija_dodatna'];

                if ($daLiImaKateg) {
                    echo '<li style="color: green">Ima kod nas u bazi Agro : <strong>'.$NazivKategorije.'</strong> ||||| Dodatna : '.$kat_name.'</li>';
                    echo '<ul>';
                        echo '<li>Provera da li pripada dobroj nadkategoriji</li>';
                        $this->daLiPripadaDobrojKateg($ParentKategorijaArtikalaId, $NazivKategorije, $KategorijaArtikalaId,$parent_id,$kat_name,$id,$idKateg);
                    echo '</ul>';

                } else {
                    echo '<li style="color: red">Nema kod nas u bazi : '.$kat_name.' sa Id kod Dodatne : '.$id.'</li>';
                    $this->insertjsonDodatna($idKateg, $kategorija_dodatna_funkc, $jezLan);
                    sleep(1);
                }

                if ($broj < 50) {
                    $this->updateKategDodatna($KategorijaArtikalaId, $id, $broj, $jezLan);
                    //usleep(100000);
                } else {
                    die;
                }
                //usleep(500000);

            }
        } else {

            echo '<li style="color: red;font-weight: bold"><strong>Insert -> Provera da li ima podkategorije</strong></li>>';
            $this->insertjsonDodatna($idKateg, $kategorija_dodatna_funkc, $jezLan);
            sleep(1);

            //echo '<br /> Ubacen id : ';
            //echo $isterted;
            //usleep(500000);
            //  break;
        }
        echo '</ul>';
    }

    function daLiPripadaDobrojKateg($ParentKategorijaArtikalaId, $NazivKategorije, $KategorijaArtikalaId,$parent_id,$kat_name,$id,$idKateg)
    {
        $cols = Array("*");
        $this->dbConn->join("kategorijeartikalanaslov KAN", "KAN.IdKategorije = KategorijaArtikalaId AND KAN.IdLanguage = 5", "LEFT");
        $this->dbConn->where('KategorijaArtikalaId', $ParentKategorijaArtikalaId);
        $daLiImaKategParent = $this->dbConn->getOne("kategorijeartikala", null, $cols);
        $NazivKategorijeParent = $daLiImaKategParent['NazivKategorije'];
        $KategorijaArtikalaIdParent = $daLiImaKategParent['KategorijaArtikalaId'];
        $Kategorija_dodatnaParent = $daLiImaKategParent['Kategorija_dodatna'];


        echo '<ul>';
        echo '<li style="color: purple">Agro</li>';
        echo '<li>Kategorija <strong>'.$NazivKategorije.'</strong> sa id '.$KategorijaArtikalaId.' </li>';
        echo '<li>pripada kategoriji <strong>'.$NazivKategorijeParent.'</strong> sa id '.$KategorijaArtikalaIdParent.' </li>';
        echo '<li>Kateg dodatna parent <strong>'.$Kategorija_dodatnaParent.'</strong></li>';
        echo '</ul>';


        $cols = Array("*");
        $this->dbConn->where('id', $parent_id);
        $usersParentKategDod = $this->dbConn->getOne("kategorije", null, $cols);
        $kat_nameParentDod = $usersParentKategDod['kat_name'];
        $IdParentDod = $usersParentKategDod['id'];
        $kat_linkDod = $usersParentKategDod['kat_link'];

        echo '<ul>';
        echo '<li style="color: blue">Dodatna</li>';
        echo '<li>Kategorija <strong>'.$kat_name.'</strong> sa id '.$id.' </li>';
        echo '<li>pripada kategoriji <strong>'.$kat_nameParentDod.'</strong> sa id '.$IdParentDod.' </li>';
        echo '</ul>';


        echo '<ul>';
        if ($IdParentDod==$Kategorija_dodatnaParent) {
            echo '<li style="color: green">Sve je ok</li>';
        } else {
            echo '<li style="color: red">Ne pripada Kategoriji - Mora da se radi update '.$IdParentDod.' != '.$Kategorija_dodatnaParent.'</li>';
            echo '<ul>';
            echo '<li style="color: blue">Proveravamo na dodatnoj kojoj kategoriji kategorija pripada $idKateg '.$idKateg.' $IdParentDod '.$id.'</li>';


            $data = Array (
                'ParentKategorijaArtikalaId' => $idKateg,
                //'KategorijaArtikalaLink' => $kat_linkDod,
            );
            $this->dbConn->where('Kategorija_dodatna', $id);

            if ($this->dbConn->update("kategorijeartikala", $data)) {
                echo '<li style="color: blue">'.$this->dbConn->count . ' records were updated</li>';
            } else {
                echo '<li style="color: red">update failed: ' . $this->dbConn->getLastError().'</li>';
            }



            echo '</ul>';

        }
        echo '</ul>';

    }


    function insertjsonDodatna($idKateg, $kategorija_dodatna_funkc, $jezLan)
    {

        echo '<ul>';
        $linkdo3guzmijed = "http://dodatnaoprema.com/koment.php?akcija=jsondodatnaviseartjson&br=$kategorija_dodatna_funkc";
        $json = file_get_contents($linkdo3guzmijed);
        if ($json) {
            $obj = json_decode($json);
            foreach ($obj as $mydata => $m) {

                $id = $m->{'id'};
                $kat_name = $m->{'kat_name'};
                $kat_link = $m->{'kat_link'};
                //$kat_opis = $m->{'kat_opis'};
                $slikica = $m->{'slikica'};
                $activ = $m->{'activ'};
                $keywords = $m->{'keywords'};

                echo '<li>Id kategorije : '.$id.'</li>';
                echo '<li>Ime kategorije : '.$kat_name.'</li>';


                // prvo proveravamo da li imamo u bazi date kategorije
                $cols = Array("KategorijaArtikalaId");
                $this->dbConn->where('Kategorija_dodatna', $id);
                if (!$this->dbConn->getOne("kategorijeartikala", null, $cols)) {

                    echo '<li style="color: red;font-weight: bold"> Nemamo -> ' . $kat_name.'</li>';

                    $this->dbConn->startTransaction();

                    /*
                     * Insert U kategoriju
                     * */
                    $data = Array(
                        'ParentKategorijaArtikalaId' => $idKateg,
                        'KategorijaArtikalaLink' => $kat_link,
                        "KategorijaArtikalaSlika" => $slikica,
                        "Kategorija_dodatna" => $id
                    );

                    $idKategUbaceno = $this->dbConn->insert('kategorijeartikala', $data);
                    if ($idKategUbaceno) {
                         echo '<li>'.$idKategUbaceno . ' records were INSERT on kategorijeartikala </li>';
                    } else {
                        echo '<li>Insert <strong style="color: red">failed</strong> on  kategorijeartikala: ' . $this->dbConn->getLastError().'</li>';
                        // ako je zabo insert
                        var_dump($data);
                        die;
                    }

                    /*
                     * Insert u kategorijeartikalanaslov*/
                    if ($idKategUbaceno) {
                        foreach ($jezLan AS $k => $v) {
                            $IdLanguage = $v['IdLanguage'];
                            $ShortLanguage = $v['ShortLanguage'];
                            $katNaziv = ($IdLanguage == 1) ? $this->vice_versa_cySR($kat_name, 'cy') : $kat_name;

                            $data = Array(
                                'IdKategorije' => $idKategUbaceno,
                                'IdLanguage' => $IdLanguage,
                                'NazivKategorije' => $katNaziv
                            );
                            $idKategNaziv = $this->dbConn->insert('kategorijeartikalanaslov', $data);

                        }

                    }

                    if (!$idKategNaziv) {
                        $this->dbConn->rollback();
                    } else {
                        $this->dbConn->commit();
                    }




                } else {
                    echo '<li>Imamo -> ' . $kat_name.'</li>';

                }


            }

        } else {
            echo '<li>NEMA JSON</li>';
        }

        echo '</ul>';
    }

    function get_http_response_code($url)
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }


    function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");


        if (curl_exec($ch) !== FALSE) {
            return true;
        } else {
            return false;
        }
    }


    function cleanUTF($name)
    {
        $name = str_replace(array('š', 'č', 'đ', 'č', 'ć', 'ž', 'ñ'), array('s', 'c', 'd', 'c', 'c', 'z', 'n'), $name);
        $name = str_replace(array('Š', 'Č', 'Đ', 'Č', 'Ć', 'Ž', 'Ñ'), array('S', 'C', 'D', 'C', 'C', 'Z', 'N'), $name);
        $name = str_replace(array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'љ', 'м', 'н', 'њ', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'џ', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'Љ', 'М', 'Н', 'Њ', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Џ', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'),
            array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'z', 'z', 'i', 'j', 'k', 'l', 'lj', 'm', 'n', 'nj', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'c', 'dz', 's', 's', 'i', 'j', 'j', 'e', 'ju', 'ja', 'A', 'B', 'V', 'G', 'D', 'E', 'E', 'Z', 'Z', 'I', 'J', 'K', 'L', 'Lj', 'M', 'N', 'Nj', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'C', 'Dz', 'S', 'S', 'I', 'J', 'J', 'E', 'Ju', 'Ja'), $name);
        return $name;
    }


    function doMain_cySR($text, $bID)
    {
        $arrLA = array(
            'A', 'B', 'V', 'W', 'Y', 'G', 'Đ', 'DŽ', 'Dž', 'D', 'Ž', 'E', 'Z', 'NJ', 'Nj', 'LJ', 'Lj',
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'Ć', 'U', 'F', 'H', 'C', 'Č', 'Š',
            'a', 'b', 'v', 'w', 'y', 'g', 'đ', 'dž', 'd', 'ž', 'e', 'z', 'nj', 'lj',
            'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'ć', 'u', 'f', 'h', 'c', 'č', 'š'
        );

        $arrCY = array(
            'А', 'Б', 'В', 'В', 'Y', 'Г', 'Ђ', 'Џ', 'Џ', 'Д', 'Ж', 'Е', 'З', 'Њ', 'Њ', 'Љ', 'Љ',
            'И', 'Ј', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'Ћ', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш',
            'а', 'б', 'в', 'в', 'y', 'г', 'ђ', 'џ', 'д', 'ж', 'е', 'з', 'њ', 'љ',
            'и', 'ј', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'ћ', 'у', 'ф', 'х', 'ц', 'ч', 'ш'
        );

        $a_La = str_replace($arrCY, $arrLA, $text);
        $a_Sr = str_replace($arrLA, $arrCY, $text);
        return ($bID == 'la') ? $a_La : $a_Sr;
    }

    function vice_versa_cySR($text, $bID)
    {
        /*  $args=func_get_args();
          $text=$args[0];
          $bID=$args[1];*/

        $output = $this->doMain_cySR($text, $bID);
        return str_replace
        (
            array('ДЖ', 'Дж', 'дж', 'СХ', 'Сх', 'сх'),
            array('Џ', 'Џ', 'џ', 'Ш', 'Ш', 'ш'), $output
        );
    }


}