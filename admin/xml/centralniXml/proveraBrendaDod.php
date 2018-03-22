<?php

$cols = Array ("B.BrendLink", "B.BrendId", "BI.BrendIme");
$db->join("brendoviime BI", "BI.BrendId = B.BrendId AND BI.IdLanguage = 5");
$db->where("B.BrendLink", $brand_linkDodatna);
$products = $db->get ("brendovi B", null, $cols);

if ($db->count > 0) {
    foreach ($products as $keB => $vaB ) {

        $BrendIdAgro = $vaB['BrendId'];
        $BrendImeAgro = $vaB['BrendIme'];
        $pokazi .= '<div>Radi se update brenda sa dodatne na AGRO => '.$BrendImeAgro.'</div>';

        $data = Array(
            'ArtikalBrendId' => $BrendIdAgro,
            );

        $db->where('ArtikalId', $idArti0);
        if ($db->update('artikli', $data)) {
            $pokazi .= '<div>' . $db->count . ' records were updated : BrendDodatna : '.$BrendIdAgro.' na Artiklu Agro : '.$idArti0.' , file :  centralniXml/proveraBrendaDod.php</div>';
        } else {
            echo $pokazi .= 'update failed: centralniXml/proveraBrendaDod.php ' . $db->getLastError();
            die;
        }

    }

} else {
    $log->lwrite('Nema datog brenda kod nas u Bazi => '.$brand_linkDodatna);
    echo $pokazi .= 'Nema datog brenda kod nas u Bazi => '.$brand_linkDodatna;


    $data = Array(
        'BrendSajt' => 2,
        'BrendShow' => 0,
        'BrendLink' => $brand_linkDodatna,
        'BrendActive' => 1
    );


    $idubacenogBredn = $db->insert('brendovi', $data);


    if ($idubacenogBredn) {
        $pokazi .= '<div>Ubacen Brend ID '.$brand_linkDodatna.'</div>';
        $log->lwrite('Ubacen Brend ID '.$brand_linkDodatna.' id : '.$idubacenogBredn);
    } else {
        $pokazi .= '<div></div>';
        $log->lwrite('Nije ubacen Brend ID '.$brand_linkDodatna);
    }

    if ($idubacenogBredn) {
        $insert_query = Array('BrendId' => $idubacenogBredn, 'IdLanguage' => 5, 'BrendIme' => $brand_linkDodatna);
        $db->setQueryOption(Array('IGNORE'));
        $idImeNewInsertBrend = $db->insert('brendoviime', $insert_query);

        $insert_query = Array('BrendId' => $idubacenogBredn, 'IdLanguage' => 2, 'BrendIme' => $brand_linkDodatna);
        $db->setQueryOption(Array('IGNORE'));
        $idImeNewInsertBrend = $db->insert('brendoviime', $insert_query);

        if ($idImeNewInsertBrend) {
            $pokazi .= '<div>Ubacen Brend ID '.$brand_linkDodatna.'</div>';
            $log->lwrite('Ubacen Brend ID NAZIV '.$brand_linkDodatna);
        } else {
            $pokazi .= '<div>Nije ubacen Brend ID '.$brand_linkDodatna.'</div>';
            $log->lwrite('Nije ubacen Brend ID NAZIV '.$brand_linkDodatna);
        }
    }


    die;

}