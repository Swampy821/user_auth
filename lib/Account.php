<?php

    class Account {

        // Private

        private $db;

        private function _getNextID() {
            $db = $this->db->db();
            $last = intval($db[count($db)-1][0]);
            if(is_numeric($last)) {
                return $last+1;
            } else {
                return 1;
            }
        }

        private function _find($array, $col, $searchString, $caseSensitive=false) {
            $newArray = array();
            if(!$caseSensitive) {
                $searchString = strtolower($searchString);
            }
            foreach($array as $a) {
                if(!$caseSensitive) {
                    if(strtolower($a[$col]) == $searchString) {
                        array_push($newArray, $a);
                    }
                } else {
                    if($a[$col] == $searchString) {
                        array_push($newArray, $a);
                    }
                }
            }
            return $newArray;
        }

        private function _addUser($username, $password, $sprite) {
            $id = $this->_getNextID();
            if($this->db->add_record(array($id,$username, $password, $sprite))) {
                return $id;
            } else {
                return "Database Connection Failure";
            }
        }

        // Public

        public function __construct($db) {
            $this->db = $db;
        }

        public function addUser($type, $args) {
            var_dump($args);
            if($type !== 'POST' || count($args) < 3) { echo "Invalid"; return "Invalid Arguments"; }
            $db = $this->db->db();
            if(count($this->_find($db, 1, $args['username']))>0) {
                return 'exists';
            }
            return $this->_addUser($args['username'], md5($args['password']), $args['sprite']);
        }

        public function echoStuff() {
            echo "Account <br>";
            var_dump($this->db->db());
        }

    }