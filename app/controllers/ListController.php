<?php
require_once __DIR__ . '/../models/Element.php';

class ListController extends Controller 
{
    const LIST_VIEW = 'films_all';
    const LIMIT_ON_PAGE = 10;

    public $restful = true;    

    public function getIndex($page = null, $query = null)
    {
        $params = ['limit' => self::LIMIT_ON_PAGE];

        if (isset($_GET['page']) && (int) $_GET['page'] > 0) {
            $params['skip'] = self::LIMIT_ON_PAGE * $_GET['page'];
        }

        $query= isset($_GET['query']) ? $_GET['query']: '';

        $element = new Element();
        $result = $element->view(self::LIST_VIEW, $params);
    
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}