<?php



    $pokazi .= '<li><strong style="color: orange"> Povuci Spec</strong></li>';
    $data = Array(
        'povuciSpec' => 1,
    );
    $db->where ('ArtikalId', $idArt);
    if ($db->update ('artikli', $data)) {

        $pokazi .= '<li>'.$db->count . ' Povuci Spec UPDATE</li>';

    }    else {
        $pokazi .= '<li>update failed Povuci spec : '.$idArt.' => error : ' . $db->getLastError().'</li>';
    }





?>
