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
        $element = new Element();

        $element_id = 2;

        $document = [
            'element_id' => $element_id,
            'title' => 'Терминатор',
            'year' => '2003',
        ];
        
        $result = $element->set($element_id, json_encode($document, JSON_UNESCAPED_UNICODE));
        echo '<pre>';
        var_dump($result);
        echo '</pre>';

    }

    public function putIndex($element_id = null)
    {

    }

    public function deleteIndex($element_id = null)
    {
        if (isset($element_id)) {
            $element = new Element();
            $element->delete($element_id);
        }
    } 
}