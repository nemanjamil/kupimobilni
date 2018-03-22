<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 10.42
 */

//$limit = Array (0, 10);

$pieces = explode(",", SVEKATEGORIJEMASINE);

$cols = Array("A.ArtikalId", "A.KategorijaArtikalId","A.ArtikalLink", "ANN.OpisArtikla","ASS.ImeSlikeArtikliSlike");
$db->join("artiklislike ASS", "ASS.IdArtikliSlikePov = A.ArtikalId");
$db->join("artikalnazivnew ANN", "ANN.ArtikalId = A.ArtikalId");
$db->where("ASS.MainArtikliSlike",1);
$user = $db->get("artikli A", null , $cols);

$m = array();

$i = 0;
foreach ($user as $key => $value) {



    $KategorijaArtikalId =  $value['KategorijaArtikalId'];
    $ArtikalId =  $value['ArtikalId'];
    $ImeSlikeArtikliSlike = $value['ImeSlikeArtikliSlike'];
    $ArtikalLink = $value['ArtikalLink'];


    if (!in_array($KategorijaArtikalId, $pieces)) {
        continue;
    }

    $ext = pathinfo($ImeSlikeArtikliSlike, PATHINFO_EXTENSION);
    $fileName = pathinfo($ImeSlikeArtikliSlike, PATHINFO_FILENAME);
    $mala_slika = $fileName . '_mala.' . $ext;

    $lokrel = $common->locationslika($ArtikalId);

    $lok = DCROOT.$lokrel.'/'.$mala_slika;
    if (is_file($lok)) {
        $slikaKategBaner = $lokrel.'/'.$mala_slika;
    } else {
        $slikaKategBaner = '/assets/images/banners/1.png';
    }


    $m[$i]['value'] .= $ArtikalId;
    $m[$i]['text'] .= $value['OpisArtikla'];
    $m[$i]['slika'] .= $slikaKategBaner;
    $m[$i]['artlink'] .= $ArtikalLink;
   // $m[$i]['continent'] .= $value['bazacron'];

    $i++;

}
$cities = json_encode($m, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES |JSON_HEX_APOS |JSON_HEX_QUOT);

/*JSON_UNESCAPED_UNICODE da bi dobili utf-8
http://se2.php.net/manual/en/json.constants.php*/
//$post_data = json_encode($e, JSON_UNESCAPED_UNICODE);


$fp = fopen(DCROOT.'/cron/crongotovo/artikliNaziv.json', 'w+');
fwrite($fp, $cities);
fclose($fp);

