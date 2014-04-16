<?php

class ListController extends Controller 
{

    public $restful = true;

    public function getIndex($page = null)
    {

        echo 'sdfsdf'; die;
        $couchbase = array(         
            'host'     => '10.20.30.95',
            'port'     => '8091',
            'username' => 'root',
            'password' => 'sun2902',
            'bucket'   => 'films'
        );

        $instance = \Simplon\Db\DbInstance::Couchbase(
            $couchbase['host'],
            $couchbase['port'], 
            $couchbase['username'],
            $couchbase['password'], 
            $couchbase['bucket']
        );

        $manager = new \Simplon\Db\CouchbaseManager($instance);
        $elementCouchDao = new ElementCouchDao($manager);

        // fetch
        $result = $elementCouchDao->fetch('tino');
        echo '<pre>';
        var_dump($result);
        echo '</pre>';
    }
}