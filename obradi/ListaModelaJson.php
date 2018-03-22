<?php
/**
 * Project: manastir
 * Created by PhpStorm.
 * User: Nikola
 * Date: 06. 10. 2016.
 * Time: 16:49
 */

require DCROOT.'/obradi/proveriAjaxDeny.php';
$term = $_GET['q'];



$upit = "SELECT ModelId,ModelNaziv FROM modeli WHERE ModelNaziv LIKE '%$term%'"; // $dodajuUpit
$dlim = $db->rawQuery($upit);

$f = array();

if ($dlim) {

    $m['tag'] = 'model';
    $m['success'] = true;
    $m['error'] = 0;
    $m['error_msg'] = "Nema Errora";
    $m['total_count'] = 0;
    $m['incomplete_results'] = false;


    foreach ($dlim as $k => $keyArt):

        $ModelNaziv = $keyArt['ModelNaziv'];
        $ModelId = $keyArt['ModelId'];


        $n['ModelNaziv'] = $ModelNaziv;
        $n['id'] = $ModelId;  // mora da bude ID

        $f[] = $n;

    endforeach;

    $m['items'] = $f;


} else {
    $m['tag'] = 'model';
    $m['success'] = false;
    $m['error'] = 1;
    $m['error_msg'] = "Nema podataka";
    $m['total_count'] = 0;
}


echo $m = json_encode($m, JSON_UNESCAPED_UNICODE);
/*$miks = '{
  "total_count": 219,
  "incomplete_results": false,
  "items": [
    {
      "id": 3446079,
      "name": "mikidown",
      "full_name": "ShadowKyogre/mikidown"

    },
    {
      "id": 19564285,
      "name": "miki",
      "full_name": "ryanramage/miki"
    }

  ]
}
';*/
