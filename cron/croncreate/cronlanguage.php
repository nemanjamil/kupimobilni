<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 10.42
 */

$array = array(400,40);
$cols = Array ("T.IdTranslate", "T.ParentTranslate", "T.TypeLanguage");
$users = $db->get ("translate T", null, $cols);


if ($db->count > 0) {
    foreach ($users as $k => $v) {

        $IdTranslate = $v['IdTranslate'];

        //$tr['IdTranslate'] = $IdTranslate;
        $tr['ParentTranslate'] = $v['ParentTranslate'];
        $tr['TypeLanguage'] = $v['TypeLanguage'];


        $cols = Array ("TN.IdLanguage","TN.NazivTranslate");
        $db->join("translatenaziv TN","TN.IdTranslate = T.IdTranslate");
        $db->where("T.IdTranslate",$IdTranslate);
        $podaci = $db->get ("translate T", null, $cols);

        if ($podaci) {
            foreach ($podaci as $m => $r) {
                $NazivTranslate = $r['NazivTranslate'];
                $IdLanguage = $r['IdLanguage'];
                $tr[$IdLanguage] = $NazivTranslate;
            }


        } else {
              $tr[$IdLanguage] = 'Nema podataka u tabeli translatenaziv';
        }

        $e[$IdTranslate] = $tr;


    }
}


$post_data = json_encode($e, JSON_UNESCAPED_UNICODE);
$fp = fopen(DCROOT.'/cron/crongotovo/langNew.json', 'w+');
fwrite($fp, $post_data);
fclose($fp);


$e= '';
$k = "SELECT * FROM translate";
$m = $db->rawQuery($k);

foreach ($m as $key => $value) {
    $e[$value['IdTranslate']] = $value; // moze i array($value) ali onda $json_a[2][0][srb];
}

/*JSON_UNESCAPED_UNICODE da bi dobili utf-8
http://se2.php.net/manual/en/json.constants.php*/
$post_data = json_encode($e, JSON_UNESCAPED_UNICODE);
$fp = fopen(DCROOT.'/cron/crongotovo/lang.json', 'w+');
fwrite($fp, $post_data);
fclose($fp);

