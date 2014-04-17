<?php

class CouchModel 
{
	const DESIGN_DOC_NAME = "films";

	protected $_instance;
	protected $prefics_key;

	public function __construct()
	{
     /*   $couchbase = array(         
            'host'     => '10.20.30.95',
            'port'     => '8091',
            'username' => 'root',
            'password' => 'sun2902',
            'bucket'   => 'films'
        );
*/
        $couchbase = array(         
            'host'     => '10.20.10.149',
            'port'     => '8091',
            'username' => '',
            'password' => '',
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

	public function get($id)
	{
		return isset($id) ? $this->_instance->get($id) : null;
	}

	public function set($data, $id = null)
	{
		$id = isset($id) ? $id : $this->generateUniqueId();

		if ($data['id'] == 'null') {
			$data['id'] = $id;
			$data['type'] = 'film';
		}

		$this->_instance->set(
			$id, 
			json_encode($data, JSON_UNESCAPED_UNICODE)
		);	

		return json_encode(['id' => $id], JSON_UNESCAPED_UNICODE);
	}

	public function view($view_name, $params = array(), $design_doc_name = self::DESIGN_DOC_NAME)
	{
		return $this->_instance->view(
			$design_doc_name,
			$view_name, 
			$params
		);
	}

	public function delete($id)
	{
		return $this->_instance->delete($id);
	}

	protected function generateUniqueId()
	{
		return $this->prefics_key.J20\Uuid\Uuid::v4();
	}

	public function getMulti($ids)
	{
		return $this->_instance->getMulti($ids);
	}
}


class Element extends CouchModel
{	
	protected $prefics_key = "film::";
}