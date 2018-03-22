<?php
// JSON header
header("Content-type: text/json");

// vreme puta 1000
$x = time() * 1000;
// random od 0 do 100
$y = rand(0, 100);

// PHP array kao JSON
$ret = array($x, $y);
echo json_encode($ret);


// rezultat treba da bude u obliku [1449058622000,7]
?>