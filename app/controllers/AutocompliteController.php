<?php
require_once __DIR__ . '/../models/Element.php';

class AutocompliteController extends Controller 
{    
    const LIMIT_ON_PAGE = 10;

    public $restful = true;    

    public function getGenres()
    {
        $query = isset($_GET['query']) && strlen($_GET['query']) > 2 ? $_GET['query']: '';

        $genres =  ["Боевики","Триллеры","Мистика","Детективы","Фантастика","Приключения","Комедии","Драмы","Мюзиклы","Артхаус","Короткометражные","Документальные","Научные","Фильмы для детей","Мультфильмы","Эротика","Музыкальные программы","Образовательные программы","Спорт","Прочее","Аниме","Мелодрамы","Отечественные фильмы","Российские фильмы","Сериалы","Юмор","Ужасы","Военные фильмы","Криминал","Исторические фильмы","Биография","Вестерн","Для взрослых","Игра","Концерт","Новости","Семейный","Ток-шоу","Фильм-нуар","Фэнтези"];

        if ($query) {

            $result = [];
            foreach ($genres as $key => $genre) {
                
                if (preg_match("~$query~iu", $genre, $m)) {
                    $result[] = $genre;
                }
            }
            
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }


    public function getPerson()
    {
        $query= isset($_GET['query']) && strlen($_GET['query']) > 2 ? $_GET['query']: '';

        if ($query) {

            $client = new Elasticsearch\Client([
                    'hosts' => ['10.20.10.149:9200',]
                ]);

            $must = [];
            $must[] = [
                'term' => [
                    'couchbaseDocument.doc.type' => 'person',
                ],
            ];

            $must[] = [
                'fuzzy' => [
                    'couchbaseDocument.doc.name' => [
                        'value' => $query,
                    ],
                ],
            ];

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

            $results = [];
            foreach ($docs as $id => $value) {
                $value_new = json_decode($value);

                
                $results[] = [
                    'id' => $id, 
                    'name' => $value_new->name, 
                    'type' => "person", 
                    'image_id' => $value_new->image_id
                ];
            }

            echo json_encode($results, JSON_UNESCAPED_UNICODE);
        }
    }
}