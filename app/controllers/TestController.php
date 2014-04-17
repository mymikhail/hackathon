<?php

class TestController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function index()
    {
//        $user = User::find($id);
//
//        return View::make('user.profile', array('user' => $user));
//        $params = [];
//        $params['hosts'] = [
//            '10.20.10.149:9200',         // IP + Port
//        ];

//        $client = new Elasticsearch\Client($params);
//        $searchParams['index'] = 'films';
//        $searchParams['type']  = 'couchbaseDocument';
//        $searchParams['body']['query']['match']['doc.actors.name'] = 'Брюс';
//        $searchParams['body']['size'] = 20;
//        $retDoc = $client->search($searchParams);
//
////        print_r($retDoc);
//
//        if (!$retDoc['hits'] || !$retDoc['hits']['hits'])
//            die('not found');
//
//        echo '<code>'. $retDoc['hits']['total']. '</code><br />';
//        $results = $retDoc['hits']['hits'];
//        foreach ($results as $result) {
//            echo '<code>'. $result['_id']. '</code><br />';
//        }

        //        $couchbase = new Couchbase('', '', '', 'films');
        $couchbase = new Couchbase('10.20.30.95:8091', '', '', 'films');
        $result = $couchbase->view('films', 'films_all', ['limit' => 10]);
        xdebug_var_dump($result);

    }

}