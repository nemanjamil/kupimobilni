<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 4.10.16.
 * Time: 21.41
 */



/*$deleteParams = [
    'index' => $indexEl
];
$response = $client->indices()->delete($deleteParams);
print_r($response);*/


// Create the index
$params = [
    'index' => $indexEl
];
$response = $client->indices()->create($params);


/*$params = [
    'index' => 'my_index',
    'body' => [
        'settings' => [
            'number_of_replicas' => 1,
            'refresh_interval' => '1s',
            // 'number_of_shards' => 5 - ovo ne mozemo odma da menjamo moramo kroz reIndex
        ]
    ]
];
$response = $client->indices()->putSettings($params);*/


/*// Get settings for one index
$params = ['index' => 'my_index'];
$response = $client->indices()->getSettings($params);
var_dump($response);*/


// Set the index and type
$params = [
    'index' => $indexEl,
    'type' => $typeEl,
    'body' => [
        $typeEl => [
            '_source' => [
                'enabled' => true
            ],
            'properties' => [
                'first_name' => [
                    'type' => 'string'

                ],
                'age' => [
                    'type' => 'integer'
                ]
            ]
        ]
    ]
];
$client->indices()->putMapping($params);
