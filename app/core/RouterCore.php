<?php

namespace app\core;

class RouterCore
{
    private $uri;
    private $method;
    private $getArr = [];

    public function __construct()
    {
        $this->initialize();
        require_once('../app/config/Router.php');
        $this->execute();
    }

    private function initialize()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        //dd($_SERVER);
        $uri = $_SERVER['REQUEST_URI'];
        //dd($uri);
        //dd(str_replace('/framework/', '', $uri));
        $ex = explode('/', $uri);

        $uri = $this->normalizeURI($ex);

        for($i =0; $i < UNSET_URI_COUNT;$i++)
        {
            unset($uri[$i]);
        }

        $this->uri = implode('/', $this->normalizeURI($uri));
        if(DEBUG_URI) dd($this->uri);
    }

    private function get($router, $call)
    {
        $this->getArr[] = [
            'router' => $router,
            'call' =>$call
        ];
    }

    private function execute()
    {
        switch($this->method){
            case 'GET':
                $this->executeGET();
            break;
            case 'POST':
            break;
        }
    }

    private function executeGET()
    {
        foreach($this->getArr as $get){
            //dd($get, false);
            $r = substr($get['router'],1);
            if($r == $this->uri)
            {
                if(is_callable($get['call']))
                {
                    $get['call']();
                    break;
                }
            }
        }
    }

    private function normalizeURI($arr)
    {
        return array_values(array_filter($arr));
    }
}

?>