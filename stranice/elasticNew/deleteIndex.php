<?php

$deleteParams = [
    'index' => $indexEl
];
$response = $client->indices()->delete($deleteParams);
print_r($response);

?>