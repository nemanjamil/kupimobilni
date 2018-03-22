<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 4.10.16.
 * Time: 21.41
 */
$ngramAnalyzer = 'ngramAnalyzer';
$ngramFilter = 'ngramFilter';
$searchAnalyzer = 'searchAnalyzer';
$standardAnalizer = 'standardAnalizer';
$standardFilter = 'standardFilter';
$ngramTokenizer = 'ngramTokenizer';

/*
 * OVAJ JE PRAVI
 * */
$params = [
    'index' => $indexEl,
    'body' => [
        'settings' => [
            'number_of_shards' => 5,
            'number_of_replicas' => 1,
            'analysis' => [

                /*'tokenizer' => [
                    $ngramTokenizer => [
                        'type' => 'edge_ngram',
                        'min_gram' => 2,
                        'max_gram' => 5,
                        "token_chars" => [ "letter", "digit" ]
                    ]
                ],*/

                'filter' => [
                    $ngramFilter => [
                        'type' => 'edge_ngram', //edge_ngram
                        'min_gram' => 1,
                        'max_gram' => 9,
                        "token_chars" => ["letter", "digit"] // "whitespace"
                    ],
                    $standardFilter => [
                        'type' => 'standard',
                        //"token_chars" => ["letter", "digit"] // "whitespace"
                    ]
                ],

                /* "char_filter" => [
                     "my_mapping" => [
                         "type" => "mapping",
                         "mappings" => [
                             "torb => turb",
                             "qu => k"
                         ]
                     ]
                 ],*/

                /* "char_filter" => [
                     "my_mapping" => [
                         "type" => "mapping",
                         "mappings" => [
                             "ajfon" => "iphone",
                             "ifon" => "iphone",
                             "torbica" => "turb",
                             "gludalica" => "glodalica"
                         ]
                     ],
 //                    "hyphen" => [
 //                        "type" => "pattern_replace",
 //                        "pattern" => "[-]",
 //                        "replacement" => ""
 //                    ],
 //                    "space" => [
 //                        "type" => "pattern_replace",
 //                        "pattern" => " ",
 //                        "replacement" => ""
 //                    ]
                 ],*/

                /*'char_filter' => [ // ovo koristimo da pri upucavanju reci zamenimo rec
                    'pre_negs' => [
                        'type' => 'pattern_replace',
                        'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
                        'replacement' => '~$1 $2'
                    ],
                    'post_negs' => [
                        'type' => 'pattern_replace',
                        'pattern' => '\\b((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\s+(\\w+)',
                        'replacement' => '$1 ~$2'
                    ],
                    'test_moj' => [
                        'type' => 'pattern_replace',
                        'pattern' => 'Torbica',
                        'replacement' => 'miki'
                    ],
                    "my_mapping" => [
                        "type" => "mapping",
                        "mappings" => [
                            "torb => turb",
                        ]
                    ]
                ],*/

                "analyzer" => [
                    $ngramAnalyzer => [
                        "type" => "custom",
                        "tokenizer" => "whitespace", //  whitespace standard
                        //"char_filter" => ["test_moj"], // "hyphen","space"
                        "filter" => [
                            "lowercase",
                            $ngramFilter,
                        ],

                        //  // moze da se doda koliko god filtera, ali moradju da budu u filterima
                    ],
                    $searchAnalyzer => [
                        "type" => "custom",
                        "tokenizer" => "whitespace", // standard
                        "filter" => [
                            "lowercase",
                            "asciifolding" // ovo smo ubacili ovde zbog https://qbox.io/blog/multi-field-partial-word-autocomplete-in-elasticsearch-using-ngrams
                        ]
                    ],

                    $standardAnalizer => [
                        "type" => "custom",
                        "tokenizer" => "whitespace", // standard
                        "filter" => [
                            "lowercase",
                            "asciifolding", // ovo smo ubacili ovde zbog https://qbox.io/blog/multi-field-partial-word-autocomplete-in-elasticsearch-using-ngrams
                            $standardFilter
                        ]
                    ],

                ],

            ]
        ],
        'mappings' => [
            $typeEl => [
                /* "_all" => [
                    "type" => "string",
                    "analyzer" => $imeAnalyzer,
                    "search_analyzer" => $searchAnalyzer,

                ],*/
                'properties' => [
                    'ArtikalNaziv' => [
                        "type" => "string",
                        //"term_vector" => "yes",  // https://www.elastic.co/guide/en/elasticsearch/reference/current/term-vector.html
                        "analyzer" => $ngramAnalyzer, //'standardAnalizer'],
                        "search_analyzer" => $searchAnalyzer,
                    ],
                    'KategorijaArtikalaNaziv' => [
                        "type" => "string",
                        "analyzer" => $standardAnalizer,
                        "search_analyzer" => $searchAnalyzer,
                        //"index"=> "not_analyzed" // samo ovo znaci da ubaci u serach ceo podatak i da ne rasparcava
                        /*"index" => "no", // znaci da uopste ne uvuce
                        "include_in_all" => false*/
                    ],
                    'ArtikalBrPregleda' => [
                        "type" => "integer",
                        //"term_vector" => "yes",
                        //"analyzer" => "standard",
                        //"index" => "not_analyzed",
                    ],

                    'ArtikalLink' => [
                        "type" => "string",
                        "analyzer" => $ngramAnalyzer,
                        "search_analyzer" => $searchAnalyzer,
                        "index" => "no",
                        "include_in_all" => false
                    ],
                    'KategorijaArtikalId' => [
                        "type" => "integer",
                        "include_in_all" => false
                    ],
                    'KategorijaArtikalaLink' => [
                        "type" => "string",
                        "analyzer" => $ngramAnalyzer,
                        "search_analyzer" => $searchAnalyzer,
                        "index" => "no",
                        "include_in_all" => false
                    ],
                    'Mozedasekupi' => [
                        "type" => "integer",
                        "include_in_all" => false
                    ],
                    'ArtikalStanje' => [
                        "type" => "integer",
                        "include_in_all" => false
                    ],
                    'ArtikalNaAkciji' => [
                        "type" => "integer",
                        "include_in_all" => false
                    ],
                    'ArtikalBrendId' => [
                        "type" => "integer",
                        "include_in_all" => false
                    ],
                    'BrendLink' => [
                        "type" => "string",
                        "analyzer" => $ngramAnalyzer,
                        "search_analyzer" => $searchAnalyzer,
                        "index" => "no",
                        "include_in_all" => false
                    ],
                ]
            ]
        ]
    ]
];

$response = $client->indices()->create($params);
//$response = $client->indices()->putMapping($params);
print_r($response);