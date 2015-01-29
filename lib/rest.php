<?php

    function __autoload($class_name) {

        $nameSpace = array();
        foreach ($nameSpace as $space) {
            $fileLocation = __DIR__ . '/' . $space . '/' . $class_name . '.php';
            if (file_exists($fileLocation)) {
                include $space . '/' . $class_name . '.php';
            }
        }

        if(file_exists(__DIR__.'/'.$class_name.'.php')) {
            include __DIR__.'/'.$class_name.'.php';
        }

    }

    class Rest {

        // Private

        private $db;

        private function _getURLSegments($url) {
            $url = substr($url, strpos($url, 'index.php') + 9);
            $url = explode('/', $url);
            return array_slice($url,1);
        }

        // Public

        public function __construct() {
            $this->db = new FlatDB(dirname(__FILE__).'/../db/db.csv');
        }

        public function process(array $getArray, array $postArray) {
            $segments = $this->_getURLSegments($_SERVER['PHP_SELF']);
            if(count($segments) > 1) {
                $class = new $segments[0]($this->db);
                $method = $segments[1];
                $segments = array_slice($segments, 2);
                if (count($getArray)) {
                    $args = $getArray;
                    $type = 'GET';
                } else if (count($postArray)) {
                    $args = $postArray;
                    $type = 'POST';
                } else {
                    $args = $segments;
                    $type = 'GET';
                }
                $class->$method($type, $args);
            }
        }

    }