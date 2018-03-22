<?php
$ngramAnalyzer = 'ngramAnalyzer';
$edgeNgramFilter = 'edgeNgramFilter';
$ngramFilter = 'ngramFilter'; // https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-ngram-tokenizer.html
$searchAnalyzer = 'searchAnalyzer';
$standardAnalizer = 'standardAnalizer';
$standardFilter = 'standardFilter';
$ngramTokenizer = 'ngramTokenizer';
$tokenizer1 = 'tokenizer1';
$tokenizer2 = 'tokenizer2';
$mojFilter = 'mojfilter';
$mojFilter2 = 'mojfilter2';
$mojFilter3 = 'mojfilter3';
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

                'tokenizer' => [
                    $tokenizer1 => [
                        "type" => "pattern",
                        "pattern"=> "/"
                    ],
                    $tokenizer2 => [
                        "type" => "pattern", // https://www.elastic.co/guide/en/elasticsearch/reference/5.1/analysis-pattern-tokenizer.html
                    ]
                ],

                'filter' => [
                    $edgeNgramFilter => [
                        'type' => 'edge_ngram',
                        'min_gram' => 1,
                        'max_gram' => 12,
                        "token_chars" => ["letter", "digit"] // "whitespace" https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-edgengram-tokenizer.html
                    ],

                    $ngramFilter => [
                        'type' => 'ngram',
                        'min_gram' => 3,
                        'max_gram' => 12,
                        "token_chars" => ["letter", "digit"] // "whitespace"
                    ],

                    $standardFilter => [
                        'type' => 'standard',
                        //"token_chars" => ["letter", "digit"] // "whitespace"
                    ]
                ],

                 "char_filter" => [
                     $mojFilter => [
                         "type" => "mapping",
                         "mappings" => [
                             "PopNekaRec123 => nesto", // kada naidje na PopNekaRec123 stavi nista nesto
                         ]
                     ],
                     $mojFilter2 => [
                         "type" => "pattern_replace",
                         "pattern" => "/",
                         "replacement" => " "
                     ],
                     $mojFilter3 => [
                         "type" => "mapping",
                         "mappings" => [
                             "case => torbica", // kada naidje na case stavi tobica
                             "charger => punjac",
                             "kabl => kabel",
                             "kabal => kabel",

                         ]
                     ],
                     $mojFilter4 => [
                         "type" => "pattern_replace",
                         "pattern" => "/",
                         "replacement" => " "
                     ],
                     /*$mojFilter3 => [
                         "type" => "pattern_replace",
                         "pattern" => "+",
                         "replacement" => " "
                     ],*/

                 ],

                "analyzer" => [
                    $ngramAnalyzer => [
                        "type" => "custom",
                        "tokenizer" => $tokenizer2, // $tokenizer2,//'whitespace', //  whitespace standard
                        "char_filter" => ["$mojFilter","$mojFilter2"], //["test_moj"], // "hyphen","space" https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-mapping-charfilter.html
                        "filter" => [
                            "lowercase",
                            $ngramFilter
                            //$edgeNgramFilter

                        ],

                        //  // moze da se doda koliko god filtera, ali moradju da budu u filterima
                    ],
                    $searchAnalyzer => [
                        //"type" => "custom",
                        "tokenizer" => "standard", // standard keyword
                        "char_filter" => ["$mojFilter3"],
                        "filter" => [
                            "lowercase",
                            "asciifolding" // ovo smo ubacili ovde zbog https://qbox.io/blog/multi-field-partial-word-autocomplete-in-elasticsearch-using-ngrams
                        ]
                    ],

                    $standardAnalizer => [
                        "type" => "custom",
                        "tokenizer" => "standard", // standard whitespace
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
                 /*"_all" => [
                    "type" => "string",
                    "analyzer" => $ngramAnalyzer,
                    "search_analyzer" => $searchAnalyzer,

                ],*/
                'properties' => [
                    'ArtikalNaziv' => [
                        "type" => "string",
                        //"term_vector" => "yes",  // https://www.elastic.co/guide/en/elasticsearch/reference/current/term-vector.html
                        "analyzer" => $ngramAnalyzer, //'standardAnalizer'],
                        "search_analyzer" => $searchAnalyzer,
                    ],
                    'ArtikalNazivStandard' => [
                        "type" => "string",
                        "analyzer" => $standardAnalizer,
                        "search_analyzer" => $searchAnalyzer,
                    ],
                    'ArtikalNazivSort' => [
                        "type" => "string",
                        "index"=> "not_analyzed"
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
                    ],
                    'ArtikalId' => [
                        "type" => "integer",
                    ],

                    'ArtikalLink' => [
                        "type" => "string",
                        "index"=> "not_analyzed"
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
                    'ArtikalVPCena' => [
                        "type" => "float",
                    ],
                    'ArtikalMPCena' => [
                        "type" => "float",
                    ],
                    'ArtikalStanje' => [
                        "type" => "integer",
                        //"include_in_all" => false
                    ],
                    'ArtikalSifra' => [
                        "type" => "string",
                        "index"=> "not_analyzed"
                        /*"analyzer" => $standardAnalizer,
                        "search_analyzer" => $searchAnalyzer,*/
                        /*"type" => "integer",*/
                        /*"index"=> "not_analyzed",*/
                        /*"include_in_all" => false,*/

                    ],
                    'ArtikalNaAkciji' => [
                        "type" => "integer",
                        //"include_in_all" => false
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
                    'BrendIme' => [
                        "type" => "string",
                        "analyzer" => $ngramAnalyzer,
                        "search_analyzer" => $searchAnalyzer,
                        "index" => "no",
                        "include_in_all" => false
                    ],
                    'Modeli' => [
                        "type" => "nested", // https://www.elastic.co/guide/en/elasticsearch/reference/current/nested.html
                        'properties' => [
                            'ModelId' => [
                                'type'=> "integer",
                            ],
                            'ModelNaziv'=> [
                                'type' => "string"
                            ]
                        ]
                    ],
                    'SpecValue' => [
                        "type" => "nested",
                        'properties' => [
                            'IdGrupeSpecKategorija' => [
                                'type'=> "integer",
                            ],
                            'IdSpecVrednosti'=> [
                                'type' => "integer"
                            ]
                        ]
                    ],

                ]
            ]
        ]
    ]
];

$response = $client->indices()->create($params);
//$response = $client->indices()->putMapping($params);
print_r($response);
