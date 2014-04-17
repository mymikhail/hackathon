<?php
require_once __DIR__ . '/../models/Element.php';

class ListController extends Controller 
{
    const LIST_VIEW = 'films_all';
    const LIMIT_ON_PAGE = 10;

    public $restful = true;    

    public function getIndex()
    {
        $query= isset($_GET['query']) ? $_GET['query']: '';
        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;

        $title = isset($_GET['title']) ? $_GET['title']: '';
        $genres = isset($_GET['genres']) ? $_GET['genres']: '';
        $year = isset($_GET['year']) ? $_GET['year']: '';;
        $actors = isset($_GET['actors']) ? $_GET['actors']: '';;
        $directors = isset($_GET['directors']) ? $_GET['directors']: '';;
        $producers = isset($_GET['producers']) ? $_GET['producers']: '';;
        $advanced_search = ($title || $genres || $year || $actors || $directors || $producers);


        if ($query) {
            $result = $this->getFromElastic($query, [
                'descending'    => true,
                'limit'         => self::LIMIT_ON_PAGE,
                'skip'          => self::LIMIT_ON_PAGE * $page,
            ]);
        } elseif ($advanced_search) {
            $result = $this->getFromElasticAdvanced($title, $genres, $year, $actors, $directors, $producers, [
                'descending'    => true,
                'limit'         => self::LIMIT_ON_PAGE,
                'skip'          => self::LIMIT_ON_PAGE * $page,
            ]);
        } else {
            $result = $this->getFromCbView([
                'descending'    => true,
                'limit'         => self::LIMIT_ON_PAGE,
                'skip'          => self::LIMIT_ON_PAGE * $page,
            ]);
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    protected function getFromCbView($params)
    {
        $couchbase = new Couchbase('10.20.10.149:8091', '', '', 'films');
        $searchResult = $couchbase->view('films', 'films_all', $params);
        $doc_ids = array_map(function($result) {
                return $result['id'];
            }, $searchResult['rows']
        );

        $docs = $couchbase->getMulti($doc_ids);

        $result = ['total_rows' => $searchResult['total_rows'], 'rows' => []];
        foreach ($docs as $id => $doc) {
            $result['rows'][] = [
                'id' => $id,
                'key' => $id,
                'value' => json_decode($doc)
            ];
        }
        return $result;
    }

    protected function getFromElastic($query, $params)
    {
        $client = new Elasticsearch\Client([
            'hosts' => ['10.20.10.149:9200',]
        ]);

        $search = '{"query":{"bool":{"must":[{"query_string":{"default_field":"_all","query":"|query|"}},{"term":{"couchbaseDocument.doc.type":"film"}}]}},"from":|offset|,"size":|limit|}';
        $search = str_replace('|query|', $query, $search);
        $search = str_replace('|offset|', $params['skip'], $search);
        $search = str_replace('|limit|', $params['limit'], $search);

        $searchParams = [
            'index' => 'films',
            'type' => 'couchbaseDocument',
            'body' => json_decode($search),
        ];

        $searchResult = $client->search($searchParams);

        $doc_ids = array_map(function($result) {
                return $result['_id'];
            }, $searchResult['hits']['hits']
        );

        $couchbase = new Couchbase('10.20.10.149:8091', '', '', 'films');
        $docs = $couchbase->getMulti($doc_ids);

        $result = ['total_rows' => $searchResult['hits']['total'], 'rows' => []];
        foreach ($docs as $id => $doc) {
            $result['rows'][] = [
                'id' => $id,
                'key' => $id,
                'value' => json_decode($doc)
            ];
        }
        return $result;
    }

    private function getFromElasticAdvanced($title, $genres, $year, $actors, $directors, $producers, $params)
    {
        $client = new Elasticsearch\Client([
                'hosts' => ['10.20.10.149:9200',]
            ]);

        $must = [];
        $must[] = [
            'term' => [
                'couchbaseDocument.doc.type' => 'film',
            ],
        ];

        if ($title) {
            $must[] = [
                'fuzzy' => [
                    'couchbaseDocument.doc.title' => [
                        'value' => $title,
                    ],
                ],
            ];
        }
        if ($genres) {
            $must[] = [
                'fuzzy' => [
                    'couchbaseDocument.doc.genres' => [
                        'value' => $genres,
                    ],
                ],
            ];
        }
        if ($year) {
            $must[] = [
                'text' => [
                    'couchbaseDocument.doc.year' => $year,
                ],
            ];
        }
        if ($actors) {
            $must[] = [
                'fuzzy' => [
                    'couchbaseDocument.doc.actors.name' => [
                        'value' => $actors,
                    ],
                ],
            ];
        }
        if ($directors) {
            $must[] = [
                'fuzzy' => [
                    'couchbaseDocument.doc.directors.name' => [
                        'value' => $directors,
                    ],
                ],
            ];
        }
        if ($producers) {
            $must[] = [
                'fuzzy' => [
                    'couchbaseDocument.doc.producers.name' => [
                        'value' => $producers,
                    ],
                ],
            ];
        }

        $searchParams = [
            'index' => 'films',
            'type' => 'couchbaseDocument',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => $must,
                    ],
                ],
                'from' => 0,
                'size' => 10,
            ],
        ];

        $searchResult = $client->search($searchParams);

        $doc_ids = array_map(function($result) {
                return $result['_id'];
            }, $searchResult['hits']['hits']
        );

        $couchbase = new Couchbase('10.20.10.149:8091', '', '', 'films');
        $docs = $couchbase->getMulti($doc_ids);

        $result = ['total_rows' => $searchResult['hits']['total'], 'rows' => []];
        foreach ($docs as $id => $doc) {
            $result['rows'][] = [
                'id' => $id,
                'key' => $id,
                'value' => json_decode($doc)
            ];
        }
        return $result;
    }
}