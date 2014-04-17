<?php

class Element
{
	const DESIGN_DOC_NAME = "films";

	protected $_instance;

	public function __construct()
	{
        $couchbase = array(         
            'host'     => '10.20.30.95',
            'port'     => '8091',
            'username' => 'root',
            'password' => 'sun2902',
            'bucket'   => 'films'
        );

        $this->_instance = new Couchbase(
            $couchbase['host'].":".$couchbase['port'],
            $couchbase['username'],
            $couchbase['password'], 
            $couchbase['bucket'],
            true
        );        
	}

	public function get($element_id)
	{
		return isset($element_id) ? $this->_instance->get($element_id) : null;
	}

	public function set($element_id, $data)
	{
		return $this->_instance->set($element_id, $data);	
	}

	public function view($view_name, $params = array(), $design_doc_name = self::DESIGN_DOC_NAME)
	{
		return $this->_instance->view($design_doc_name, $view_name, $params);
	}

	public function delete($element_id)
	{
		return $this->_instance->delete($element_id);
	}
}