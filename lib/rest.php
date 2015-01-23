<?php 
    class Rest {
        public function process(array $getArray, array $postArray) {
            $vars = $this->computeURL($_SERVER['PHP_SELF']);
            var_dump($vars);
        }
        
        
        private function computeURL($url) {
            $url = substr($url, strpos($url, 'index.php') + 9);
            $url = explode('/', $url);
            return $url;
        }


    }


?>