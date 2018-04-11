<?php

class common extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }

    public function strLower($string)
    {
        $string = mb_convert_case($string, MB_CASE_LOWER, "UTF-8");
        return $string = ucfirst($string);
    }


    public function friendly_convert($string)
    {

        $string = trim($string);
        $string = strtolower($string);
        $find = array('/ć/', '/Ć/', '/č/', '/Č/', '/đ/', '/Ð/', '/ž/', '/Ž/', '/š/', '/Š/', '/\s{2,}/', '/\s?-\s?/', '/\s?_\s?/', '/\s?\/\s?/', '/\s?\\\s?/', '/\s/', '/"/', '/\'/', '/[^a-zA-Z0-9-]/');
        $replace = array('c', 'c', 'c', 'c', 'dj', 'dj', 'z', 'z', 's', 's', ' ', '-', '-', '-', '-', '-', '', '', '');

        $friendly_url = preg_replace($find, $replace, $string);

        return $friendly_url;

    }

    public function clearvariable($value)
    {
        $value = trim($value);
        $value = str_replace("\t", " ", $value);
        $value = str_replace("'", "&#39;", $value); // asci
        $value = str_replace('"', "&quot;", $value); // asci &#34;  = html &quot;
        //$value = filter_var($value, FILTER_SANITIZE_STRING);
        //$value = strip_tags($value); // da dozvolimo  <p> and <a> i ostale
        //$value = addslashes($value);
        return $value;
    }


    public function clearvariableTekst($value)
    {
        $value = trim($value);
        $value = str_replace("'", "&#39;", $value); // asci
        //$value = strip_tags($value); // da dozvolimo  <p> and <a> i ostale
        //$value = addslashes($value);
        return $value;
    }


    public function limit_text_obican($text, $limit)
    {
        $text = strip_tags($text);
        //$text = mb_substr(utf8_encode($text), 0,$limit);
        //$text = utf8_decode($text);
        $text = mb_substr($text, 0, $limit);
        //$text =   mb_substr($text, 0, $limit);
        $staizbaci = array("&nbsp;");
        $text = str_replace($staizbaci, "", $text);
        $text = trim($text);
        // $text = mb_substr ($text, 0, $limit, 'utf-8');
        // $text =  mb_strimwidth($text,0,$limit,'...','utf-8');

        return $text;
    }


    function limit_text_obican_mb($text, $limit)
    {

        $text = mb_strimwidth($text, 0, $limit, '...', 'utf-8');

        return $text;
    }

    public function array_2_csv_sa_dodatkomnavodnika($array)
    {
        $csv = array();
        foreach ($array as $item) {
            if (is_array($item)) {
                $csv[] = $this->array_2_csv_sa_dodatkomnavodnika($item);
            } else {
                //
                //$csv[] = '\''.$item.'\'';
                $csv[] = $item;
            }
        }
        return implode(',', $csv);
    }

    public function daLiPostojiSlika($slika)
    {
        $loktwo = DCROOT . $slika;
        return $loktwo = (is_file($loktwo)) ? $slika : '/assets/images/noimage.png';
    }

    public function locationslika($idart)
    {
        $folderslika = substr($idart, 0, 3);
        return '/p/' . $folderslika . '/' . $idart;  // with "/" works uploadujsamosliku
    }

    public function locationslikaOstalo($lokacija, $idart)
    {
        $folderslika = substr($idart, 0, 2);
        return '/' . $lokacija . '/' . $folderslika;
    }

    public function locationslikaOstaloGalKomitent($lokacija, $idart)
    {
        $folderslika = substr($idart, 0, 2);
        return '/' . $lokacija . '/' . $folderslika . '/' . $idart . '/gal';
    }

    public function locationslikaOstaloKomitent($lokacija, $idart)
    {
        $folderslika = substr($idart, 0, 2);
        return '/' . $lokacija . '/' . $folderslika . '/' . $idart;
    }



    public function IsNullOrEmptyString($str) {
        return (!isset($str) || trim($str) === '');
    }

    /*
       * FILTER_SANITIZE_STRING
       * FILTER_SANITIZE_NUMBER_INT
       * $limit = $common->isEmpty($_GET['limit'],FILTER_SANITIZE_NUMBER_INT);
       * */
    // isset isnull isEmpty
    // https://www.virendrachandak.com/techtalk/php-isset-vs-empty-vs-is_null/
    // isset — Determine if a variable is set and is not NULL
    // empty — Determine whether a variable is empty
    // is_null — Finds whether a variable is NULL
    public function isEmpty($var, $sta = false, $ret = false)
    {
        // ako ne postoji Sta onda je po DEFAULT  FILTER_SANITIZE_STRING
        //$sta = ($sta) ? $sta : FILTER_SANITIZE_STRING;
        $varijabla = ($sta) ? filter_var($var, FILTER_SANITIZE_NUMBER_INT) : filter_var($var, FILTER_SANITIZE_STRING);


        if (isset($varijabla) && !is_null($varijabla)) {

            switch ($sta) {
                case 'int':
                    return (int)$varijabla;
                    break;
                default:
                    return $varijabla;
            }

        } else {
            if ($ret) {
                return $ret; // /var/www/manastir/obradi/podacizaInsert.php $KomitentBrBrakova
            } else {
                return '';
            }

        }
    }

    public function nemaSlikeMala($slika)
    {
        $lokSli = DCROOT . '/' . $slika;
        if (!is_file($lokSli)) {
            $slika = '/assets/images/noimageMala.png';
        } else {
            $slika = $slika;
        }
        return $slika;
    }

    public function nemaSlike($slika)
    {
        $lokSli = DCROOT . '/' . $slika;
        if (!is_file($lokSli)) {
            $slika = '/assets/images/noimage.png';
        } else {
            $slika = $slika;
        }
        return $slika;
    }

    public function nemaSlikeBezCrte($slika)
    {
        $lokSli = DCROOT . $slika;
        if (!is_file($lokSli)) {
            $slika = '/assets/images/noimage.png';
        } else {
            $slika = $slika;
        }
        return $slika;
    }

    public function friendly_convert_tag($string)
    {

        // First remove all html-tags
        $string = preg_replace("/<[^>]+>/", " ", $string);

        $string = trim($string);

        // cirilaja
        $englishtranslationtable = array('ć' => 'c', 'Ć' => 'c', 'č' => 'c', 'Č' => 'c', 'đ' => 'dj', 'Đ' => 'dj', 'ž' => 'z', 'Ž' => 'z', 'š' => 's', 'Š' => 's', 'ч' => 'c', 'Ч' => 'c', 'ћ' => 'c', 'Ћ' => 'c', 'Ш' => 's', 'ш' => 's', 'Ж' => 'z', 'ж' => 'z', 'Ђ' => 'dj', 'ђ' => 'dj', 'љ' => 'lj', 'Љ' => 'lj', 'Њ' => 'nj', 'њ' => 'nj', 'џ' => 'dz', 'Џ' => 'dz');

        $string = strtr($string, $englishtranslationtable);

        // ovde smo dodali space
        $find = array('/"/', '/\'/', '/[^a-zA-Z0-9-\s]/');
        $replace = array('', '', '');

        $friendly_url = preg_replace($find, $replace, $string);

        // First correct multiple spaces
        $string = preg_replace("/  +/", " ", $string);

        //  Make string lowercase and return string
        $string = strtolower($string);

        return $friendly_url;
    }


    public function formatCenaId($cena, $valuta)
    {

        switch ($valuta) {
            case 1:
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="RSD" /><span itemprop="price">' . number_format($cena, 2, ",", ".") . ' DIN' . '</span></span>';
                break;
            case 3:
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="USD" /><span itemprop="price"><i class="fa fa-' . $valuta . '"></i>' . number_format($cena, 3, ".", ",") . '</span></span>';
                break;
            case 4:
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="EUR" /><span itemprop="price"><i class="fa fa-' . $valuta . '"></i> ' . number_format($cena, 3, ".", ",") . '</span></span>';
                break;
            case 5:
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="RUB" /><span itemprop="price"><i class="fa fa-' . $valuta . '"></i> ' . number_format($cena, 3, ".", ",") . '</span></span>';
                break;
            default:
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="RSD" /><span itemprop="price">' . number_format($cena, 2, ",", ".") . ' DIN' . '</span></span>';
        }

        return $priceFormat;
    }

    public function formatCenaSamoBrojId($cena, $valuta)
    {

        switch ($valuta) {
            case 1:
                $priceFormat = number_format($cena, 2, ",", ".");
                break;
            case 3:
                $priceFormat = number_format($cena, 2, ".", ",");
                break;
            case 4:
                $priceFormat = number_format($cena, 2, ".", ",");
                break;
            case 5:
                $priceFormat = number_format($cena, 2, ".", ",");
                break;
            default:
                $priceFormat = number_format($cena, 2, ".", ",");
        }

        return $priceFormat;
    }

    public function formatCenaExtId($cena, $valuta)
    {

        switch ($valuta) {
            case 1:
                $priceFormat = 'DIN';
                break;
            case 2:
                $priceFormat = 'GBP';
                break;
            case 3:
                $priceFormat = '$';
                break;
            case 4:
                $priceFormat = '&euro;';
                break;
            case 5:
                $priceFormat = 'RUB';
                break;
            default:
                $priceFormat = 'DIN';
        }

        return $priceFormat;
    }

    public function formatCenaExt($cena, $valuta)
    {

        switch ($valuta) {
            case '1':
                $priceFormat = 'DIN';
                break;
            case '2':
                $priceFormat = 'GBP';
                break;
            case '3':
                $priceFormat = '$';
                break;
            case '4':
                $priceFormat = '&euro;';
                break;
            case '4':
                $priceFormat = 'RUB;';
                break;
            default:
                $priceFormat = 'DIN';
        }

        return $priceFormat;
    }


    public function formatCenaVrednostiValuta($cena, $valuta)
    {

        switch ($valuta) {
            case 1: //'din':
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="RSD" /><span itemprop="price">' . number_format($cena, 2, ",", ".") . ' DIN' . '</span></span>';
                break;
            case 3: //'usd':
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="USD" /><span itemprop="price"><i class="fa fa-' . $valuta . '"></i>' . number_format($cena, 3, ".", ",") . '</span></span>';
                break;
            case 4: //'eur':
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="EUR" /><span itemprop="price"><i class="fa fa-' . $valuta . '"></i> ' . number_format($cena, 3, ".", ",") . '</span></span>';
                break;
            case 5: //'rub':
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="RUB" /><span itemprop="price"><i class="fa fa-' . $valuta . '"></i> ' . number_format($cena, 3, ".", ",") . '</span></span>';
                break;
            default:
                $priceFormat = '<span itemprop="offers" class="value" itemscope itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="RSD" /><span itemprop="price">' . number_format($cena, 2, ",", ".") . ' DIN' . '</span></span>';
        }

        return $priceFormat;
    }

    public function formatCenaSamoBroj_depricated($cena, $valuta)
    {

        switch ($valuta) {
            case 'din':
                $priceFormat = number_format($cena, 2, ",", ".");
                break;
            case 'usd':
                $priceFormat = number_format($cena, 2, ".", ",");
                break;
            case 'eur':
                $priceFormat = number_format($cena, 2, ".", ",");
                break;
            case 'rub':
                $priceFormat = number_format($cena, 2, ".", ",");
                break;
            default:
                $priceFormat = number_format($cena, 2, ".", ",");
        }

        return $priceFormat;
    }




    public function valutaIdUString($idValute)
    {

        switch ($idValute) {
            case 1:
                $priceFormat = 'din';
                break;
            case 2:
                $priceFormat = 'GBP';
                break;
            case 3:
                $priceFormat = 'usd';
                break;
            case 4:
                $priceFormat = 'eur';
                break;
            case 5:
                $priceFormat = 'rub';
                break;
            default:
                $priceFormat = 'din';
        }

        return $priceFormat;
    }

    public function displayProduct(
        $ArtikalId,
        $ArtikalNaziv,
        $NaAkciji,
        $velika_slika,
        $srednja_slika,
        $urlArtiklaLink,
        $cenaPrikaz,
        $ImeSlikeArtikliSlike,
        $opisDetaljnije,
        $wishlist,
        $compare,
        $pozovite,
        $pravaMp

    )
    {
        $oldPrice = '';
        $dp = '';

        $dp .= '<div class="product">';
        $dp .= '<div class="product-image">';
        //$dp .= '<a href="'.$velika_slika.'" data-lightbox="image-'.$ArtikalId.'">';
        $dp .= '<a href="' . $urlArtiklaLink . '">';
        $dp .= '<div class="image">';
        //$dp .= '<img src="assets/images/blank.gif" data-echo="'.$srednja_slika.'" class="img-responsive" alt="">';
        $dp .= '<img src="' . $srednja_slika . '" class="img-responsive" alt="' . $ArtikalNaziv . '">';
        $dp .= '</div>';

        if ($NaAkciji == 6 || $NaAkciji == 1):
            $dp .= '<div class="tag">';
            $dp .= '<div class="tag-text sale">sale</div></div>';
        endif;
        if ($NaAkciji == 7 || $NaAkciji == 2):
            $dp .= '<div class="tag">';
            $dp .= '<div class="tag-text new">new</div></div>';
        endif;
        if ($NaAkciji == 8 || $NaAkciji == 3):
            $dp .= '<div class="tag">';
            $dp .= '<div class="tag-text hot">hot</div></div>';
        endif;

        $dp .= '<div class="hover-effect"><i class="fa fa-search"></i></div>';
        $dp .= '</a>';
        $dp .= '</div>';


        $dp .= '<div class="product-info">';
        $dp .= '<h3 class="name"><a href="' . $urlArtiklaLink . '">' . $ArtikalNaziv . '</a></h3>';

        $dp .= '<div class="star-rating" title="Rated 4.50 out of 5">';
        $dp .= '<span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>';
        $dp .= '</div>';

        $dp .= '<div class="product-price">';
        if ($pravaMp > '0') {
            $dp .= '<ins>';
            $dp .= '<span class="amount">' . $cenaPrikaz . '</span>';
            $dp .= '</ins>';
        } else {
            $dp .= '<ins>';
            $dp .= '<span class="availability">' . $pozovite . '</span>';
            $dp .= '</ins>';
        }

        if ($oldPrice):
            $dp .= '<del><span class="amount">' . $cenaPrikaz . '</span></del>';
        endif;

        $dp .= '</div>';

        $dp .= '</div>';


        $dp .= '<div class="cart animate-effect">';
        $dp .= '<div class="action">';
        $dp .= '<ul class="list-unstyled">';
        $dp .= '<li class="add-cart-button">';
        $dp .= '<a class="btn btn-primary" href="' . $urlArtiklaLink . '">' . $opisDetaljnije . ' </a>';
        $dp .= '</li>';

        /* $dp .= '<li>';
         $dp .= '<a class="btn btn-primary whislist" href="#" title="'.$wishlist.'">';
         $dp .= '<i class="icon fa fa-heart"></i>';
         $dp .= '</a>';
         $dp .= '</li>';*/

        $dp .= '<li>';
        $dp .= '<a class="btn btn-primary compare dodajkompare" href="#" data-id="' . $ArtikalId . '" title="' . $compare . '">';
        $dp .= '<i class="fa fa-exchange"></i>';
        $dp .= '</a>';
        $dp .= '</li>';


        $dp .= '</ul>';
        $dp .= '</div>';
        $dp .= '</div>';
        $dp .= '</div>';

        return $dp;


    }


    public function  specPoArtiklu($idArt, $jezikId)
    {

        $co = Array("SG.IdSpecGrupe", "SGN.NazivSpecGrupe");
        $this->dbConn->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SAP.IdSpecArtikalGrupaPove");
        $this->dbConn->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
        $this->dbConn->where("SAP.IdSpecArtikalPov", $idArt);
        $specGrupe = $this->dbConn->get("specartikalpov SAP", null, $co);
        if ($specGrupe) {


            $sd = '';
            $sd .= '<ul class="font10">';
            foreach ($specGrupe as $k => $v):
                $IdSpecGrupe = $v['IdSpecGrupe'];
                $ImeSpecGrupe = $v['NazivSpecGrupe'];


                $co = Array("SV.IdSpecVrednosti", "SVN.SpecVredNaziv");
                $this->dbConn->join("specvrednosti SV", "SV.IdSpecVrednosti = SAP.IdSpecArtikalPovIme");
                $this->dbConn->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
                $this->dbConn->where("SAP.IdSpecArtikalPov", $idArt);
                $this->dbConn->where("SAP.IdSpecArtikalGrupaPove", $IdSpecGrupe);
                $specGrupeVre = $this->dbConn->getOne("specartikalpov SAP", null, $co);

                $sd .= '<li>';
                $sd .= '<span>' . $ImeSpecGrupe . '</span>';
                $sd .= '<span> => </span>';
                $sd .= '<span class="text-danger">' . $specGrupeVre['SpecVredNaziv'] . '</span>';
                $sd .= '</li>';

            endforeach;
            $sd .= '</ul>';

            return $sd;

        }
    }


    public function displayListProduct(
        $ArtikalId,
        $ArtikalNaziv,
        $OpisKratakOpis,
        $OpisArtTekst,
        $ArtikalNaAkciji,
        $velika_slika,
        $srednja_slika,
        $urlArtiklaLink,
        $cenaSamoBrojFormat,
        $cenaPrikazExt,
        $ImeSlikeArtikliSlike,
        $opisTekstArt,
        $ocenaut,
        $Jedinica,
        $Najmanje,
        $opisDetaljnjije,
        $compare,
        $pravaMp,
        $pozovite,
        $BrendIme,
        $brendPrevod,
        $ArtikalStanje,
        $ImaNaStanju,
        $jezikId
    )
    {
        $oldPrice = '';
        $dp = '';

        $dp .= '<div class="row">';
        /*Slika*/
        $dp .='<div class="hidden"><span itemprop="mpn">'.$ArtikalId.'</span></div>';
        $dp .= '<div class="col-md-3 col-sm-4 col-xs-12">';
            $dp .= '<div class="product-image">';
                $dp .= '<a href="' . $urlArtiklaLink . '">';
                    $dp .= '<div class="image">';
                    $dp .= '<img itemprop="image" src="' . $srednja_slika . '" class="img-responsive" alt="'. $ArtikalNaziv . '">';
                    $dp .= '</div>';


                    if ($ArtikalNaAkciji == 6):
                        $dp .= '<div class="tag">';
                        $dp .= '<div class="tag-text sale">sale</div></div>';
                    endif;
                    if ($ArtikalNaAkciji == 7):
                        $dp .= '<div class="tag">';
                        $dp .= '<div class="tag-text new">new</div></div>';
                    endif;
                    if ($ArtikalNaAkciji == 8):
                        $dp .= '<div class="tag">';
                        $dp .= '<div class="tag-text hot">hot</div></div>';
                    endif;

                $dp .= '</a>';



            $dp .= '</div><!-- /.product-image -->';
        $dp .= '</div><!-- /col-md-3 col-sm-4 col-xs-12-->';
        /*/Slika*/

        /*Opis*/
        //$dp .= '<div class="col-md-9 col-sm-8 col-xs-12">';
        $dp .= '<div class="col-md-7 col-sm-8 col-xs-12">';
        $dp .= '<div class="product-info text-left">';
        $dp .= '<h3 class="nameJedPrikaz"><a href="' . $urlArtiklaLink . '"><span itemprop="name">' . $ArtikalNaziv . '</span></a></h3>';


        $dp .= ($OpisKratakOpis) ? '<p>'.$OpisKratakOpis.'</p>' : '';


        $dp .= '<div class="product-price">';
        $dp .= $this->specPoArtiklu($ArtikalId,$jezikId);
        $dp .= '</div>';


        $dp .= '<div class="product-price odvojKategBaner "><span itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
            if ($pravaMp > '0') {
                $dp .= '<ins>';
                $dp .= '<span class="amount" itemprop="price">' . $cenaSamoBrojFormat . '</span>';
                $dp .= '<span class="" itemprop="priceCurrency"> ' . $cenaPrikazExt . '</span>';
                $dp .= '</ins>';
            } else {
                $dp .= '<ins>';
                $dp .= '<span class="availability">' . $pozovite . '</span>';
                $dp .= '</ins>';
            }
           if ($oldPrice):
                $dp .= '<del><span class="amount"> ' . $cenaPrikazExt . ' </span></del>';
            endif;
        $dp .= '</span></div><!-- /.product-price -->';

        // specifikacije
        $dp .= '<div class="spec clearfix">';
        $dp .= '<ul>';
        $dp .= '<li>' . $brendPrevod . ' : <span itemprop="brand"><b>' . $BrendIme . '</b></span></li>';

        $hovBack = ($ArtikalStanje) ? 'bg-success' : 'bg-danger';
        $hovBackIme = ($ArtikalStanje) ? $ImaNaStanju : 'Nema';

        if ($ArtikalStanje == 1):
            $dp .= '<li>' . $Najmanje . ' : ' . ' <b>' . '<span class="status ">'.$hovBackIme.'</span>' . '</b>'; //'.$hovBack.'
            $dp .= '</li>';
        endif;

        if ($ArtikalStanje == 0):
            $dp .= '<li>' . $Najmanje . ' : ' . ' <b>' . $pozovite . '</b>';
            $dp .= '</li>';
        endif;

        $dp .= '</ul>';
        $dp .= '</div>';
        // kraj specifikacije

        $dp .= '<div class="clearfix kojijeId marginadole10 pull-left" data-ime="' . $ArtikalId . '">';
        $dp .= '<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
        $dp .= '<span itemprop="ratingValue" hidden>'. $ocenaut. '</span>';
        for ($irp = 1; $irp <= 5; $irp++) {
            $cekstar = ($irp == $ocenaut) ? 'checked' : '';
            $dp .= '<input class="starri required" ' . $cekstar . ' type="radio" name="zvezdicaUser-' . $ArtikalId . '" value="' . $irp . '"/>';
        }
        $dp .= '<span itemprop="reviewCount" hidden>'.$ocenaut.'</span>';
        $dp .= '</div>';


        if ($OpisArtTekst):
            $dp .= '<div class="product-short-desc">';
            $dp .= '<p itemprop="description">' . $OpisArtTekst . '</p>';
            $dp .= '</div><!-- .product-short-desc -->';
        endif;

        $dp .= '</div><!-- /.product-info -->';
        $dp .= '</div>';
        /*/Opis*/

        /*Dugmici*/
        $dp .= '<div class="col-md-2 col-sm-12 col-xs-12">';



        $dp .= '<div class="cart animate-effect">
                    <div class="action">
                        <ul class="list-unstyled">
                            <li class="add-cart-button">
                            <a class="btn btn-primary" href="' . $urlArtiklaLink . '">' . $opisDetaljnjije . '</a>
                            </li>
                            <!--<li>
                                <a class="btn btn-primary whislist" href="#" title="Wishlist">
                                    <i class="icon fa fa-heart"></i>
                                </a>
                            </li>-->
                            <li>
                                <a class="btn btn-primary compare dodajkompare" href="#" data-id="' . $ArtikalId . '" title="' . $compare . '">
                                    <i class="fa fa-exchange"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>';


               /* $dp .= '<div class="cart animate-effect pull-right">';
                    $dp .= '<div class="action">';
                    $dp .= '<ul class="list-unstyled">';
                    $dp .= '<li class="add-cart-button">';
                        $dp .= '<a class="btn btn-primary" href="' . $urlArtiklaLink . '"><i class="fa fa-info">' . ' &nbsp ' . $opisDetaljnjije . '</i></a>';
                    $dp .= '</li>';
                    $dp .= '<br>';
                    $dp .= '<br>';*/

                    /*  $dp .= '<li>';
                          $dp .= '<a class="btn btn-primary whislist" href="#" title="Wishlist">';
                              $dp .= '<i class="icon fa fa-heart"></i>';
                          $dp .= '</a>';
                      $dp .= '</li>';*/

                    /*$dp .= '<li class="pull-right">';
                    $dp .= '<a class="btn btn-primary compare dodajkompare" href="#" data-id="' . $ArtikalId . '" href="#" title=' . $compare . '>';
                    $dp .= '<i class="fa fa-exchange">' . ' ' . $compare . '</i>';
                    $dp .= '</a>';
                    $dp .= '</li>';
                    $dp .= '</ul>';
                    $dp .= '</div><!-- /.action -->';
                $dp .= '</div><!-- /.cart -->';*/
        $dp .= '</div>';
        /*/Dugmici*/

        $dp .= '</div><!-- /.row -->';

        return $dp;

    }

    public function displayListProductSearch(
        $ArtikalId,
        $ArtikalNaziv,
        $OpisKratakOpis,
        $OpisArtTekst,
        $ArtikalNaAkciji,
        $srednja_slika,
        $urlArtiklaLink,
        $ocenaut,
        $opisDetaljnjije,
        $compare,
        $BrendIme,
        $brendPrevod,
        $ArtikalStanje,
        $ImaNaStanju,
        $jezikId,
        $Najmanje,
        $KategorijaArtikalaNaziv,
        $KategorijaArtikalaLink,
        $kategorijaPrevod,
        $pozovite,
        $cenaSamoBrojFormat,
        $cenaPrikazExt,
        $pravaMp
    )
    {
        $oldPrice = '';
        $dp = '';

        $dp .= '<div class="row">';
        /*Slika*/
        $dp .='<div class="hidden"><span itemprop="mpn">'.$ArtikalId.'</span></div>';
        $dp .= '<div class="col-md-3 col-sm-4 col-xs-12">';
            $dp .= '<div class="product-image">';
                $dp .= '<a href="' . $urlArtiklaLink . '">';
                    $dp .= '<div class="image">';
                    $dp .= '<img itemprop="image" src="' . $srednja_slika . '" class="img-responsive" alt="'. $ArtikalNaziv . '">';
                    $dp .= '</div>';


                    if ($ArtikalNaAkciji == 6 || $ArtikalNaAkciji == 1):
                        $dp .= '<div class="tag">';
                        $dp .= '<div class="tag-text sale">sale</div></div>';
                    endif;
                    if ($ArtikalNaAkciji == 7 || $ArtikalNaAkciji == 2):
                        $dp .= '<div class="tag">';
                        $dp .= '<div class="tag-text new">new</div></div>';
                    endif;
                    if ($ArtikalNaAkciji == 8 || $ArtikalNaAkciji == 3):
                        $dp .= '<div class="tag">';
                        $dp .= '<div class="tag-text hot">hot</div></div>';
                    endif;

                $dp .= '</a>';



            $dp .= '</div><!-- /.product-image -->';
        $dp .= '</div><!-- /col-md-3 col-sm-4 col-xs-12-->';
        /*/Slika*/


        /*Opis*/
            //$dp .= '<div class="col-md-9 col-sm-8 col-xs-12">';
            $dp .= '<div class="col-md-6 col-sm-8 col-xs-12">';
            $dp .= '<div class="product-info">';
            $dp .= '<h3 class="nameJedPrikaz"><a href="' . $urlArtiklaLink . '"><span itemprop="name">' . $ArtikalNaziv . '</span></a></h3>';
            $dp .= '<div class="product-price"><span itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
            if ($pravaMp > '0') {
                $dp .= '<ins>';
                $dp .= '<span class="amount" itemprop="price">' . $cenaSamoBrojFormat . '</span>';
                $dp .= '<span class="" itemprop="priceCurrency"> ' . $cenaPrikazExt . '</span>';
                $dp .= '</ins>';
            } else {
                $dp .= '<ins>';
                $dp .= '<span class="availability">' . $pozovite . '</span>';
                $dp .= '</ins>';
            }
            if ($oldPrice):
                $dp .= '<del><span class="amount"> ' . $cenaPrikazExt . ' </span></del>';
            endif;
            $dp .= '</span></div><!-- /.product-price -->';




            $dp .= ($OpisKratakOpis) ? '<p>'.$OpisKratakOpis.'</p>' : '';


            $dp .= '<div class=" col-md-12 col-sm-12 col-xs-12 no-padding">';

            $dp .= '<div class="product-price col-md-6 col-sm-6 col-xs-12 no-paddingLevoDesno">';
            $dp .= $this->brend2kolona($brendPrevod,$BrendIme,$kategorijaPrevod,$KategorijaArtikalaLink,$KategorijaArtikalaNaziv,$ArtikalStanje,$ImaNaStanju,$Najmanje,$pozovite);
            $dp .= $this->zvezdice($ArtikalId,$ocenaut);
            $dp .= '</div>';

                $dp .= '<div class="product-price col-md-6 col-sm-6 col-xs-12 no-paddingLevoDesno">';
                    $dp .= $this->specPoArtiklu($ArtikalId,$jezikId);
                $dp .= '</div>';



            $dp .= '</div>';

            // kraj specifikacije

            /*if ($OpisArtTekst):
                $dp .= '<div class="product-short-desc nopaddingnomargin">';
                $dp .= '<p itemprop="description font8"><em><small>' . $OpisArtTekst . '</small></em></p>';
                $dp .= '</div><!-- .product-short-desc -->';
            endif;*/

            $dp .= '</div><!-- /.product-info -->';
            $dp .= '</div>';
        /* KRAJ /Opis*/

        /*Dugmici*/
        $dp .= '<div class="col-md-3 col-sm-12 col-xs-12">';
        $dp .= '<div class="cart animate-effect">
                    <div class="action">
                        <ul class="list-unstyled">
                            <li class="add-cart-button">
                            <a class="btn btn-primary" href="' . $urlArtiklaLink . '">' . $opisDetaljnjije . '</a>
                            </li>
                            <!--<li>
                                <a class="btn btn-primary whislist" href="#" title="Wishlist">
                                    <i class="icon fa fa-heart"></i>
                                </a>
                            </li>-->
                            <li>
                                <a class="btn btn-primary compare dodajkompare" href="#" data-id="' . $ArtikalId . '" title="' . $compare . '">
                                    <i class="fa fa-exchange"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>';
        $dp .= '</div>';
        /* kraj dugmici*/


        $dp .= '</div><!-- /.row -->';

        return $dp;

    }

    private function brend2kolona($brendPrevod,$BrendIme,$kategorijaPrevod,$KategorijaArtikalaLink,$KategorijaArtikalaNaziv,$ArtikalStanje,$ImaNaStanju,$Najmanje,$pozovite ){
        $dp = '';
        // specifikacije
        $dp .= '<div class="spec clearfix font10">';
        $dp .= '<ul>';
        $dp .= '<li>' . $brendPrevod . ' : <span itemprop="brand">' . $BrendIme . '</span></li>';
        $dp .= '<li>' . $kategorijaPrevod . ' : <span itemprop="categories"><a href="/'.$KategorijaArtikalaLink.'">' . $KategorijaArtikalaNaziv . '</a>  </span></li>';

        $hovBack = ($ArtikalStanje) ? 'bg-success' : 'bg-danger';
        $hovBackIme = ($ArtikalStanje) ? $ImaNaStanju : 'Nema';

        if ($ArtikalStanje == 1):
            $dp .= '<li>' . $Najmanje . ' : ' . ' <b>' . '<span class="status '.$hovBack.'">'.$hovBackIme.'</span>' . '</b>';
            $dp .= '</li>';
        endif;

        if ($ArtikalStanje == 0):
            $dp .= '<li>' . $Najmanje . ' : ' . ' <b>' . $pozovite . '</b>';
            $dp .= '</li>';
        endif;
        $dp .= '</ul>';
        $dp .= '</div>';

        return $dp;
    }

    private function zvezdice($ArtikalId,$ocenaut){

        $dp  = '';
        // zvezdice
        $dp .= '<div class="clearfix kojijeId marginadole10" data-ime="' . $ArtikalId . '">'; // bio je u klasi  pull-right
        $dp .= '<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
        $dp .= '<span itemprop="ratingValue" hidden>'. $ocenaut. '</span>';
        for ($irp = 1; $irp <= 5; $irp++) {
            $cekstar = ($irp == $ocenaut) ? 'checked' : '';
            $dp .= '<input class="starri required" ' . $cekstar . ' type="radio" name="zvezdicaUser-' . $ArtikalId . '" value="' . $irp . '"/>';
        }
        $dp .= '<span itemprop="reviewCount" hidden>'.$ocenaut.'</span>';
        $dp .= '</div>';

        return $dp;
        // kraj zvezdice

    }

    public function smallProduct(
        $ArtikalId,
        $ArtikalNaziv,
        $NaAkciji,
        $mala_slika,
        $srednja_slika,
        $urlArtiklaLink,
        $cenaPrikaz,
        $cenaPrikazExt,
        $ImeSlikeArtikliSlike,
        $pravaMpSmall,
        $pozovite
    )
    {

        $sp = '';

        $sp .= '<div class="row products-small">';
        $sp .= '<div class="col-md-4 col-xs-4 product-image">';
        $sp .= '	<a href="' . $urlArtiklaLink . '"><img src="' . $mala_slika . '" class="img-responsive" alt=""></a>';
        $sp .= '	</div>';
        $sp .= '	<div class="col-md-8 col-xs-8 product-info">';
        $sp .= '		<h5><a href="' . $urlArtiklaLink . '">' . $ArtikalNaziv . '</a></h5>';


        /*if ($pravaMpSmall > '0') {

            $sp .= '	    <div class="product-price">';
            $sp .= '			<ins><span class="amount">' . $cenaPrikaz . ' '.$cenaPrikazExt.'</span></ins>';
            $sp .= '		</div>';
        } else {
            $sp .= '     <div class="product-price">';
            $sp .= '			<ins><span class="availability">' . $pozovite . '</span></ins>';
            $sp .= '		</div>';
        }*/
        $sp .= '	</div>';
        $sp .= '	</div>';

        return $sp;

        /* <div class="star-rating" title="Rated 4.50 out of 5">
                     <span style="width:90%"><strong class="rating">4.50</strong> out of 5</span>
                 </div>*/
        // <del><span class="amount">$400,99</span></del>
    }


    public function istiProfilLink($idLogovanog, $linkProfila)
    {

        //$this->dbConn->setTrace(true);
        $cols = Array("KomitentId");
        $this->dbConn->where('KomitentUserName', $linkProfila);
        $users = $this->dbConn->getOne("komitenti", null, $cols);
        //var_dump($this->dbConn->trace);

        if ($this->dbConn->count > 0) {
            if ($users['KomitentId'] == $idLogovanog) {
                $odg = true;
            } else {
                $odg = false;
            }

        } else {
            $odg = false;
        }

        return $odg;


    }

    public function getPodatkeodUserName($linkProfila)
    {

        $cols = Array("K.KomitentId", "K.KomitentNaziv", "K.KomitentIme", "K.KomitentPrezime", "K.KomitentAdresa", "K.KomitentPosBroj",
            "K.KomitentMesto", "K.KomitentTelefon", "K.KomitentUserName", "K.KomitentEmail");
        $this->dbConn->where('K.KomitentUserName', $linkProfila);
        $users = $this->dbConn->getOne("komitenti K", null, $cols);

        return $users;
    }

    public function obrisiFolderodId($idArt)
    {
        $stajeObisano = '';
        $lok = $this->locationslika($idArt);
        $filesDoSlike = DCROOT . $lok;
        $files = glob($filesDoSlike.'/*'); // get all file names

        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                $stajeObisano .= '<div>'.$file.' => <span><a href="">del</a></span></div>';
                unlink($file); // delete file
            }
        }
        return $stajeObisano;
    }

    public function obrisiFolderodIdRazno($lokacija)
    {
        $stajeObisano = '';
        $files = glob($lokacija.'/*'); // get all file names

        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                $stajeObisano .= '<div>'.$file.' => <span><a href="">del</a></span></div>';
                unlink($file); // delete file
            }
        }
        return $stajeObisano;
    }

    public function obrisiSlikeIzBaze($idArt)
    {
        $this->dbConn->where('IdArtikliSlikePov', $idArt);
        if($this->dbConn->delete('artiklislike')) {
            return true;
        } else {
            return false;
        }
    }


    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") rrmdir($dir . "/" . $object); else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }


    public function stanjeOpisSveId($ArtikalStanje, $ArtikalMPCena, $valutaId, $m229, $m117, $m116, $pravaVp = false, $pravaMp = false, $tipUsera = false, $dani = false)
    {
        $r = array();

        if ($ArtikalStanje > 0 and $ArtikalMPCena > 0) {
            $r['mozedasekupi'] = 1;
            $r['stanjeProiz'] = $m116;
            $r['cenaPrikaz'] = ($tipUsera >= 3) ? $this->formatCenaId($pravaVp, $valutaId) : $this->formatCenaId($pravaMp, $valutaId);
            $cenaPrikazBr = ($tipUsera >= 3) ? $pravaVp : $pravaMp;
            // ovde sam dodao floatval
            $r['cenaPrikazBroj'] = floatval($cenaPrikazBr);
            // ova dva se koriste
            $r['cenaSamoBrojFormat'] = ($tipUsera >= 3) ? $this->formatCenaSamoBrojId($pravaVp, $valutaId) : $this->formatCenaSamoBrojId($pravaMp, $valutaId);
            $r['cenaPrikazExt'] =  ($tipUsera >= 3) ? $this->formatCenaExtId($pravaVp, $valutaId) : $this->formatCenaExtId($pravaMp, $valutaId);
        } elseif ($dani > '0') {
            $r['mozedasekupi'] = 'disabled="disabled"';
            $r['stanjeProiz'] = $m229;
            $r['cenaPrikazBroj'] = '';

            $r['cenaSamoBrojFormat'] = '';
            $r['cenaPrikazExt'] = '';

        } else {
            $r['mozedasekupi'] = 'disabled="disabled"';
            $r['cenaPrikazBroj'] = '';

            $r['cenaSamoBrojFormat'] = $m117;
            $r['cenaPrikazExt'] = '';
        }

        return $r;

    }

    public function stanjeOpisOLD($ArtikalStanje, $ArtikalMPCena, $sesValuta, $m229, $m117, $m116, $pravaVp = false, $pravaMp = false, $tipUsera = false, $dani = false)
    {
        $r = array();

        if ($ArtikalStanje > 0 and $ArtikalMPCena > 0) {
            $r['mozedasekupi'] = 1;
            $r['stanjeProiz'] = $m116;
            $r['cenaPrikaz'] = ($tipUsera >= 3) ? $this->formatCenaId($pravaVp, $sesValuta) : $this->formatCenaId($pravaMp, $sesValuta);
            $cenaPrikazBr = ($tipUsera >= 3) ? $pravaVp : $pravaMp;
            // ovde sam dodao floatval
            $r['cenaPrikazBroj'] = floatval($cenaPrikazBr);
            // ova dva se koriste
            $r['cenaSamoBrojFormat'] = ($tipUsera >= 3) ? $this->formatCenaSamoBroj($pravaVp, $sesValuta) : $this->formatCenaSamoBroj($pravaMp, $sesValuta);
            $r['cenaPrikazExt'] =  ($tipUsera >= 3) ? $this->formatCenaExt($pravaVp, $sesValuta) : $this->formatCenaExt($pravaMp, $sesValuta);
        } elseif ($dani > '0') {
            $r['mozedasekupi'] = 0;
            $r['stanjeProiz'] = $m229;
            $r['cenaPrikazBroj'] = floatval(0);

            $r['cenaSamoBrojFormat'] = '';
            $r['cenaPrikazExt'] = '';

        } else {
            $r['mozedasekupi'] = 0;
            $r['cenaPrikazBroj'] = floatval(0);

            $r['cenaSamoBrojFormat'] = $m117;
            $r['cenaPrikazExt'] = '';
        }

        return $r;


    }


    public function titleMail(
        $Narudzbina
        //  $idNar
    )
    {
        $bodyMail = '';

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
        $bodyMail .= '<h3>' . $Narudzbina . '</h3>';

        $bodyMail .= $Narudzbina;
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

        return $bodyMail;
    }


    public function displayProductSuper(
        $ArtikalId,
        $ArtikalNaziv,
        $NaAkciji,
        $velika_slika,
        $mala_slika,
        $srednja_slika,
        $urlArtiklaLink,
        $cenaPrikaz,
        $ImeSlikeArtikliSlike,
        $opisDetaljnije,
        $pozovite,
        $pravaMp

    )
    {
        $oldPrice = '';
        $dp = '';

        $dp .= '<div class="row products-small">';
        $dp .= '<div class="col-md-4 col-xs-4 product-image">';
        $dp .= '<a href="' . $urlArtiklaLink . '">';
        $dp .= '<img src="' . $mala_slika . '" class="img-responsive" alt="' . $ArtikalNaziv . '">';
        $dp .= '</a>';
        $dp .= '</div>';

        $dp .= '<div class="col-md-8 col-xs-8 product-info">';
        $dp .= '<h5>';
        $dp .= '<a href="' . $urlArtiklaLink . '">' . $ArtikalNaziv . '</a>';
        $dp .= '</h5>';

        $dp .= '<div class="product-price">';

        if ($pravaMp > '0') {
            $dp .= '<ins>';
            $dp .= '<span class="amount">' . $cenaPrikaz . '</span>';
            $dp .= '</ins>';
        } else {
            $dp .= '<ins>';
            $dp .= '<span class="availability">' . $pozovite . '</span>';
            $dp .= '</ins>';
        }
        if ($oldPrice):
            $dp .= '<del><span class="amount">' . $cenaPrikaz . '</span></del>';
        endif;

        $dp .= '</div>';
        $dp .= '</div>';
        $dp .= '</div>';


        return $dp;


    }

    public function cenamarzadin3000($ProductPartnerPrice)
    {
        if ($ProductPartnerPrice < 100) {
            $marzaid = '15';
        } // 3
        elseif ($ProductPartnerPrice >= 100 and $ProductPartnerPrice < 200) {
            $marzaid = '11';
        } //  2
        elseif ($ProductPartnerPrice >= 200 and $ProductPartnerPrice < 300) {
            $marzaid = '6';
        } //  2
        elseif ($ProductPartnerPrice >= 300 and $ProductPartnerPrice < 500) {
            $marzaid = '6';
        } //  1.9
        elseif ($ProductPartnerPrice >= 500 and $ProductPartnerPrice < 700) {
            $marzaid = '5';
        } // 1.6
        elseif ($ProductPartnerPrice >= 700 and $ProductPartnerPrice < 1000) {
            $marzaid = '4';
        } // 1.5
        elseif ($ProductPartnerPrice >= 1000 and $ProductPartnerPrice < 1500) {
            $marzaid = '4';
        } //1.4
        elseif ($ProductPartnerPrice >= 1500 and $ProductPartnerPrice < 2000) {
            $marzaid = '3';
        } //1.3
        elseif ($ProductPartnerPrice >= 2000 and $ProductPartnerPrice < 2500) {
            $marzaid = '31';
        } // 1.18
        elseif ($ProductPartnerPrice >= 2500 and $ProductPartnerPrice < 3000) {
            $marzaid = '29';
        } // 1.25

        elseif ($ProductPartnerPrice >= 3000) {
            $marzaid = '3';
        } // 1.05
        return $marzaid;
    }

    public function cenamarzadin($ProductPartnerPrice)
    {
        if ($ProductPartnerPrice < 100) {
            $marzaid = '13';
        } // 2.5
        elseif ($ProductPartnerPrice >= 100 and $ProductPartnerPrice < 200) {
            $marzaid = '11';
        } //  2
        elseif ($ProductPartnerPrice >= 200 and $ProductPartnerPrice < 300) {
            $marzaid = '9';
        } //  1.8
        elseif ($ProductPartnerPrice >= 300 and $ProductPartnerPrice < 500) {
            $marzaid = '8';
        } //  1.7
        elseif ($ProductPartnerPrice >= 500 and $ProductPartnerPrice < 700) {
            $marzaid = '7';
        } // 1.6
        elseif ($ProductPartnerPrice >= 700 and $ProductPartnerPrice < 1000) {
            $marzaid = '4';
        } // 1.3
        elseif ($ProductPartnerPrice >= 1000 and $ProductPartnerPrice < 1500) {
            $marzaid = '27';
        } //1.25
        elseif ($ProductPartnerPrice >= 1500 and $ProductPartnerPrice < 2000) {
            $marzaid = '30';
        } //1.22
        elseif ($ProductPartnerPrice >= 2000 and $ProductPartnerPrice < 2500) {
            $marzaid = '3';
        } // 1.2
        elseif ($ProductPartnerPrice >= 2500 and $ProductPartnerPrice < 3000) {
            $marzaid = '44';
        } // 1.19
        elseif ($ProductPartnerPrice >= 3000 and $ProductPartnerPrice < 4000) {
            $marzaid = '31';
        } // 1.18
        elseif ($ProductPartnerPrice >= 4000 and $ProductPartnerPrice < 6000) {
            $marzaid = '32';
        } // 1.17
        elseif ($ProductPartnerPrice >= 6000 and $ProductPartnerPrice < 8000) {
            $marzaid = '29';
        } // 1.15
        elseif ($ProductPartnerPrice >= 8000 and $ProductPartnerPrice < 10000) {
            $marzaid = '39';
        } // 1.13
        elseif ($ProductPartnerPrice >= 10000 and $ProductPartnerPrice < 15000) {
            $marzaid = '2';
        } // 1.1
        elseif ($ProductPartnerPrice >= 15000 and $ProductPartnerPrice < 20000) {
            $marzaid = '34';
        } // 1.08
        elseif ($ProductPartnerPrice >= 20000 and $ProductPartnerPrice < 25000) {
            $marzaid = '26';
        } // 1.07
        elseif ($ProductPartnerPrice >= 25000 and $ProductPartnerPrice < 30000) {
            $marzaid = '33';
        } // 1.06
        elseif ($ProductPartnerPrice >= 30000) {
            $marzaid = '25';
        } // 1.05
        return $marzaid;
    }

    public function cenamarzadinObori($ProductPartnerPrice)
    {
        if ($ProductPartnerPrice < 100) {
            $marzaid = '5';
        } // 3
        elseif ($ProductPartnerPrice >= 100 and $ProductPartnerPrice < 200) {
            $marzaid = '4';
        } //  1.3
        elseif ($ProductPartnerPrice >= 200 and $ProductPartnerPrice < 300) {
            $marzaid = '4';
        } //  1.3
        elseif ($ProductPartnerPrice >= 300 and $ProductPartnerPrice < 500) {
            $marzaid = '3';
        } //  1.9
        elseif ($ProductPartnerPrice >= 500 and $ProductPartnerPrice < 700) {
            $marzaid = '2';
        } // 1.6
        elseif ($ProductPartnerPrice >= 700 and $ProductPartnerPrice < 1000) {
            $marzaid = '2';
        } // 1.5
        elseif ($ProductPartnerPrice >= 1000 and $ProductPartnerPrice < 1500) {
            $marzaid = '2';
        } //1.4
        elseif ($ProductPartnerPrice >= 1500 and $ProductPartnerPrice < 2000) {
            $marzaid = '2';
        } //1.3
        elseif ($ProductPartnerPrice >= 2000 and $ProductPartnerPrice < 2500) {
            $marzaid = '2';
        } // 1.2
        elseif ($ProductPartnerPrice >= 2500 and $ProductPartnerPrice < 3000) {
            $marzaid = '2';
        } // 1.25
        elseif ($ProductPartnerPrice >= 3000 and $ProductPartnerPrice < 4000) {
            $marzaid = '26';
        } // 1.2
        elseif ($ProductPartnerPrice >= 4000 and $ProductPartnerPrice < 6000) {
            $marzaid = '26';
        } // 1.1
        elseif ($ProductPartnerPrice >= 6000 and $ProductPartnerPrice < 8000) {
            $marzaid = '26';
        } // 1.07
        elseif ($ProductPartnerPrice >= 8000 and $ProductPartnerPrice < 10000) {
            $marzaid = '25';
        } // 1.05
        elseif ($ProductPartnerPrice >= 10000) {
            $marzaid = '25';
        } // 1.05
        return $marzaid;
    }

    public function cenamarzaeur($ProductPartnerPrice)
    {
        if ($ProductPartnerPrice < 2) {
            $marzaid = '11';
        } // 2
        elseif ($ProductPartnerPrice >= 2 and $ProductPartnerPrice < 3) {
            $marzaid = '10';
        } //  2
        elseif ($ProductPartnerPrice >= 3 and $ProductPartnerPrice < 5) {
            $marzaid = '5';
        } //  1.4
        elseif ($ProductPartnerPrice >= 5 and $ProductPartnerPrice < 7) {
            $marzaid = '5';
        } // 1.4
        elseif ($ProductPartnerPrice >= 7 and $ProductPartnerPrice < 10) {
            $marzaid = '4';
        } // 1.5
        elseif ($ProductPartnerPrice >= 10 and $ProductPartnerPrice < 15) {
            $marzaid = '3';
        } //1.3
        elseif ($ProductPartnerPrice >= 15 and $ProductPartnerPrice < 20) {
            $marzaid = '3';
        } //1.3
        elseif ($ProductPartnerPrice >= 20 and $ProductPartnerPrice < 25) {
            $marzaid = '31';
        } // 1.18
        elseif ($ProductPartnerPrice >= 25 and $ProductPartnerPrice < 30) {
            $marzaid = '32';
        } // 1.17
        elseif ($ProductPartnerPrice >= 30 and $ProductPartnerPrice < 40) {
            $marzaid = '2';
        } // 1.2
        elseif ($ProductPartnerPrice >= 40 and $ProductPartnerPrice < 60) {
            $marzaid = '2p';
        } // 1.1
        elseif ($ProductPartnerPrice >= 60 and $ProductPartnerPrice < 80) {
            $marzaid = '26';
        } // 1.07
        elseif ($ProductPartnerPrice >= 80 and $ProductPartnerPrice < 100) {
            $marzaid = '25';
        } // 1.05
        elseif ($ProductPartnerPrice >= 100) {
            $marzaid = '25';
        } // 1.05
        return $marzaid;
    }

    public function  kojiMarzaProc($mid)
    {

        $mid = (int)$mid;

        if ($mid) {
            $this->dbConn->where("MarzaId", $mid);
            $user = $this->dbConn->getOne("marza");
            return $user['MarzaMarza'];
        }

    }

    public function vendorCode($idvendor, $idartikla)
    {
        /*$cols = Array ("KomitentKolona");
        $this->dbConn->where("K.KomitentId",$idvendor);
        $users = $this->dbConn->get("komitenti K", null, $cols);
        if ($this->dbConn->count > 0) {
            $imev = $users[0]['KomitentKolona'];
        }*/

        $idartikla = (int)$idartikla;

        if (!$idartikla) {
            echo 'Ne postoji Artiklal ID';
        }

        $cols = Array($idvendor . " as vrednostKolone");
        $this->dbConn->where("A.ArtikalId", $idartikla);
        $users = $this->dbConn->get("artikli A", null, $cols);
        if ($this->dbConn->count > 0) {
            $imev = $users[0]['vrednostKolone'];
            return $imev = ($imev) ? $imev : 'x';
        }

    }

    public function snimiSlikuGD($linkSlikeRemote, $linkSlikeKodNas, $kanvas)
    {
        list($width, $height, $type, $attr) = getimagesize($linkSlikeRemote);

        if ($width) {

            $extEnzija = pathinfo($linkSlikeRemote, PATHINFO_EXTENSION);

            // pravimo kvadrat bele boje
            $im = imagecreatetruecolor($kanvas, $kanvas);
            $white = imagecolorallocate($im, 255, 255, 255);
            imagefilledrectangle($im, 0, 0, $kanvas, $kanvas, $white);

            switch ($extEnzija) {
                case 'gif':
                    $icon1 = imagecreatefromgif($linkSlikeRemote);
                    break;
                case 'jpg':
                    $icon1 = imagecreatefromjpeg($linkSlikeRemote);
                    break;
                case 'png':
                    $icon1 = imagecreatefrompng($linkSlikeRemote);
                    break;
            }


            $maxD = ($width > $height) ? $width : $height;

            if ($maxD > $kanvas) {
                $racio = $kanvas / $maxD * 0.95;
                $resW = $width * $racio;
                $resH = $height * $racio;
            } else {
                $resW = $width * 0.95;
                $resH = $height * 0.95;
            }

            $x = intval(($kanvas - $resW) / 2);
            $y = intval(($kanvas - $resH) / 2);
            imagecopyresampled($im, $icon1, $x, $y, 0, 0, $resW, $resH, $width, $height);
            imagepng($im, $linkSlikeKodNas);
            imagedestroy($im);
            return true;
        } else {
            return false;
        }

    }

    public function microtime_float()
    {
        list ($msec, $sec) = explode(' ', microtime());
        $microtime = (float)$msec + (float)$sec;
        return $microtime;
    }

    public function microtime_floatProlaz($start, $var = false)
    {
        $vrm = $this->microtime_float() - $start;
        $pokazi = '<div class="bg-primary">Vreme : ' . $var . ' => ' . $vrm . '</div>';
        return $pokazi;
    }

    public function linkoDoArt($ArtikalId)
    {

        $ArtId = (int)$ArtikalId;

        $cols = Array("ArtikalLink", "ArtikalId");
        $this->dbConn->where('ArtikalId', $ArtId);
        $users = $this->dbConn->getOne("artikli", null, $cols);

        if ($users) {
            $ArtikalLink = $users['ArtikalLink'];
            $ArtikalId = $users['ArtikalId'];

            return '/' . $ArtikalLink . '/' . $ArtikalId;
        }


    }

}