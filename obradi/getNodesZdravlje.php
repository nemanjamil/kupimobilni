<?php
$idagro = $_POST['id'];
$adminfunkc = new adminfunkc($db);
$array = array();
$m = $adminfunkc->listaKategZdravlje($idagro, $array);
echo json_encode($m, JSON_UNESCAPED_SLASHES);

?>
