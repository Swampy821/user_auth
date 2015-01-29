<?php

    function __autoload($class_name)
    {
        $nameSpace = array(
            'Auth'
        );
        foreach ($nameSpace as $space) {
            $fileLocation = __DIR__ . '/' . $space . '/' . $class_name . '.php';
            if (file_exists($fileLocation)) {
                include $space . '/' . $class_name . '.php';
            }
        }
    }

    class Rest {

        public function process(array $getArray, array $postArray) {
            $vars = $this->computeURL($_SERVER['PHP_SELF']);
            if(count($vars)>1) {
                $class = $vars[0];
                $activeClass = new $class();
                $method = $vars[1]; 
                $vars = array_slice($vars, 2);
                $argArray = array();
                $type = 'GET';
                if(count($getArray)) {
                    $argArray = $getArray;
                    $type = 'GET';
                }else if(count($postArray)) {
                    $argArray = $postArray;
                    $type = 'POST';
                }else{
                    $argArray = $vars;
                    $type = 'GET';
                }
                return $activeClass->$method($type, $argArray);
            }
        }
        
        
        private function computeURL($url) {
            $url = substr($url, strpos($url, 'index.php') + 9);
            $url = explode('/', $url);
            return array_slice($url,1);
        }

    }


?>