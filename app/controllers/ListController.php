<?php

class ListController extends Controller 
{
    const LIST_VIEW = 'films_all';
    const LIMIT_ON_PAGE = 10;

    public $restful = true;    

    public function getIndex($page = null, $query = null)
    {
        $element = new Element();

        $params = ['limit' => self::LIMIT_ON_PAGE];

        if (isset($_GET['page'])) {
            $params['skip'] = self::LIMIT_ON_PAGE*$_GET['page'];
        }

        $query= isset($_GET['query']) ? $_GET['query']: '';

        $result = $element->view(self::LIST_VIEW, $params);
                
        echo json_encode($result);
    }
}