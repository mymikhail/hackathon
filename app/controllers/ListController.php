<?php

class ListController extends Controller 
{
    const LIST_VIEW = 'films_all';
    const LIMIT_ON_PAGE = 10;

    public $restful = true;    

    public function getIndex($page = null, $query = null)
    {
        $element = new Element();
    

        print_r($page);
        print_r($query);

        
        $result = $element->view(self::LIST_VIEW, ['limit' => self::LIMIT_ON_PAGE]);
                
        $elements = array();
        
        foreach($result['rows'] as $row) {

            $doc = $element->get($row['id']);

            if($doc) {
                $doc = json_decode($doc, true);
                $elements[] = $doc;
            }
        }


echo json_encode($elements);
        
    }
}