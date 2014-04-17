<?php

require_once __DIR__ . '/../models/Element.php';

class ElementController extends Controller 
{
    public $restful = true;

    public function getIndex($element_id = null)
    {
        if(isset($element_id)) {

            $element = new Element();
            
            if($result = $element->get($element_id)) {
                echo $result;
            } else {
                echo json_encode(['status' => 'not found'], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function postIndex()
    {       
        $data = Input::get();

        if (!empty($data)) {            

            $element = new Element();
            return $element->set($data);            
        }

    }

    public function putIndex($element_id = null)
    {        
        $data = Input::get();

        if (isset($element_id) && !empty($data)) {            

            $element = new Element();
            return $element->set($data, $element_id);            
        }
    }

    public function deleteIndex($element_id = null)
    {
        if (isset($element_id)) {
            $element = new Element();
            $element->delete($element_id);
        }
    } 
}