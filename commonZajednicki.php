<?php
define('DPROOT', 'http://'.$_SERVER['HTTP_HOST']); //http://dodatnaoprema.com
define('DCROOT', $_SERVER['DOCUMENT_ROOT']); ///var/www/html/dodatnaoprema.com
define('DPROOTADMIN', DPROOT.'/admin'); ///var/www/html/dodatnaoprema.com
define('DCROOTADMIN', DCROOT.'/admin'); ///var/www/html/dodatnaoprema.com
define('URLCALCSERVICE', 'http://10.8.0.6/CalculusWebService/CalculusWebService.asmx/');
define('HOSTTIPLINUXSERVER', '$hostTip');

define('JEZIK', 'srblat');
define('JEZIKID', 5);
define('ACTIVEKATEG', 'KategorijaArtikalaActive');  // KategorijaArtikalaActive AGRO; KategorijaArtikalaActiveMasine MASINE
define('VALUTA', 'din');
define('VALUTAKOMITENT', '1');
define('URLVRATI', $_SERVER["HTTP_REFERER"]);
define('KATSLIKELOK', 'assets/images/slikekat');
define('KATSLIKELZDRAVLJE', 'assets/images/kategzdravlje');
define('KATSLIKELHEAD', 'assets/images/katslikehead');
define('BANERSLIKELOK', 'assets/images/banners');
define('BRENDSLIKELOK', 'assets/images/slikebrend');
define('VESTISLIKELOK', 'assets/images/vesti');
define('KULTURESLIKELOK', 'assets/images/kulture');
define('KOMSLIKE', 'assets/images/komslike');
define('LSSLIKE', 'assets/images/loksamoup');
define('SLIKALOGO', 'assets/images/kupimobilni.png');
define('TROSKOVIPREVOZA', 200);

define('REGISTROVANVP', 3);
define('USERIDOBICAN', 8999999999);
define('INSTALIRANAAPP', 1);
define('POPUSTAPP', 10); // kada se ovo menja mora da se menja i u stored proceduri
define('EXTJPG', 'jpg');
define('EXTPNG', 'png');
define('EXTPRED', 'png');

define('KOLIKOXML', 2); // koliko xml da prodje artikala u jednoj iteraciji
define('KOLIKOXML50', 50);
define('KOLIKOXML100', 100);
define('KOLIKOXML20', 20);
define('PROCPOVEZANIART', 10); // procenat povezani artikli. Kooliko da odabere artikal +- 10%
define('LOGOVANKAKOFB', 'FB');

define('LIMITPOSTRANI', 20);

define('LOCALIZATION_ENABLED', true);
define('LOCALIZATION_COUNTRY', 1);        // Srbija
define('LOCALIZATION_LANGUAGE', 5);        // srpski
define('LOCALIZATION_CURRENCY', 1);        // dinar
define('VALUTA_EUR', 2);        // euro
define('LANGUAGE_OLD', "srblat");        // euro


define('BANERPOCETNALEVILINK', "mobilni-73");
define('BANERPOCETNADESNILINK', "tablet-25232");

define('KATEGORIJESAJT', '11185, 11192, 11184, 11182');

//Calculus config
define('REGISTROVANIKORISNICIDOKUMENT', 'PO3GW'); //Dokument za registrovane korisnike
define('NEREGISTROVANIKORISNICIDOKUMENT', 'PO3GW'); //Dokument za neregistrovane korisnike

define('REGISTROVANIKORISNICIMAGACIN', 'Magacin Veleprodaje'); //MAGACIN za registrovane korisnike
define('NEREGISTROVANIKORISNICIMAGACIN', 'Maloprodaja Shop'); //MAGACIN za neregistrovane korisnike

define('NEREGISTROVANIKORISNICIKORISNIK', '3G Store Web Shop Kupovina'); //KORISNIK za neregistrovane korisnike
define('KREATORZASINHRONIZACIJUPORUDZBENICA', 0); //KREATOR za neregistrovane korisnike



?>