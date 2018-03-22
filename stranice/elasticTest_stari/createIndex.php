<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 4.10.16.
 * Time: 21.41
 */
$imeAnalyzer = 'analajzersrb';
$imeFiltera = 'filtersrb';
$searchAnalyzer = 'srcanalajzer';

$params = [
    'index' => $indexEl,
    'body' => [
        'settings' => [
            'number_of_shards' => 5,
            'number_of_replicas' => 1,
            'analysis' => [
                'filter' => [
                    $imeFiltera => [
                        'type' => 'edge_ngram',
                        'min_gram' => 2,
                        'max_gram' => 5

                        /*"token_chars": [
                        "letter",
                        "digit",
                        "punctuation",
                        "symbol"
                        ]*/
                    ]
                ],

                /* 'char_filter' => [
                     'pre_negs' => [
                         'type' => 'pattern_replace',
                         'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
                         'replacement' => '~$1 $2'
                     ],
                     'post_negs' => [
                         'type' => 'pattern_replace',
                         'pattern' => '\\b((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\s+(\\w+)',
                         'replacement' => '$1 ~$2'
                     ]
                 ],*/
                "analyzer" => [
                    $imeAnalyzer => [
                        "type" => "custom",
                        "tokenizer" => "whitespace", // standard  // https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-tokenizers.html
                        "filter" => [
                            "lowercase",
                            $imeFiltera
                        ]
                    ],
                    $searchAnalyzer => [
                        "type" => "custom",
                        "tokenizer" => "whitespace", // standard
                        "filter" => [
                            "lowercase",
                            $imeFiltera,
                            "asciifolding" // ovo smo ubacili ovde zbog https://qbox.io/blog/multi-field-partial-word-autocomplete-in-elasticsearch-using-ngrams
                        ]
                    ]
                ]
            ]
        ],
        'mappings' => [

            /*'_default_' => [  // https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/_index_management_operations.html
                'properties' => [
                    'title' => [
                        'type' => 'string',
                        'analyzer' => $imeAnalyzer,
                        'term_vector' => 'yes',
                        'copy_to' => 'combined'
                    ],
                    'body' => [
                        'type' => 'string',
                        'analyzer' => $imeAnalyzer,
                        'term_vector' => 'yes',
                        'copy_to' => 'combined'
                    ],
                    'combined' => [
                        'type' => 'string',
                        'analyzer' => $imeAnalyzer,
                        'term_vector' => 'yes'
                    ],
                    'topics' => [
                        'type' => 'string',
                        'index' => 'not_analyzed'
                    ],
                    'places' => [
                        'type' => 'string',
                        'index' => 'not_analyzed'
                    ]
                ]
            ],*/
            $typeEl => [
                'properties' => [
                    'ArtikalNaziv' => [
                        "type" => "string",
                        "index" => "not_analyzed",
                        "analyzer" => $imeAnalyzer,
                        "search_analyzer" => $searchAnalyzer
                    ],
                    'KategorijaArtikalaNaziv' => [
                        "type" => "string",
                        "index" => "not_analyzed",
                        "analyzer" => $imeAnalyzer,
                        "search_analyzer" => $searchAnalyzer
                    ]

                ]
            ]
        ]
    ]
];

$response = $client->indices()->create($params);
//$response = $client->indices()->putMapping($params);
print_r($response);