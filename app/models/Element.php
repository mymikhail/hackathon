<?php
require_once __DIR__ . '/../extentions/Couchbase.php';

class Element extends Hackaton\Couchbase
{	
	protected $prefics_key = "film::";


    public function set($data, $id = null)
    {
        if (!trim($data['title'])) {
            $error['errors'] = ['title' => 'required'];
            return $error;            
        } else {
        	return parent::set($data, $id);	
        }    	
    }

}