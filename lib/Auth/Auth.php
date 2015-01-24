<?php
include(dirname(__FILE__) . '/../FlatDB.php');
/**
 * Description of Auth
 *
 * @author marshs
 */
class Auth {
    
    private $db;
    
    private function _getNextID() {
        $db = $this->db->db();
        $last = intval($db[count($db)-1][0]);
        if(is_numeric($last)) {
            return $last+1;
        }else{
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
            }else{
                if($a[$col] == $searchString) {
                    array_push($newArray, $a);
                }
            }
        }
        
        return $newArray;
    }
    
    
    private function connect() {
        $this->db = new FlatDB(dirname(__FILE__) .'/../../db/db.csv');
        return $this->db->db();
    }
    
    private function _addUser($username, $password, $sprite) {
        $id = $this->_getNextID();
        if($this->db->add_record(array($id,$username, $password, $sprite))) {
            return $id;
        }else{
            return "Database Connection Failure";
        }
    }


//put your code here
    public function echoStuff($type, $args) {
        return $args;
    }
    
    public function getDB($type, $args) {
        return $this->connect();
    }
    
    public function addUser($type, $args) {
        if($type !== 'POST' || count($args) !== 3) { return "Invalid Arguments"; }
        $db = $this->connect();
        if(count($this->_find($db, 1, $args['username']))>0) {
            return 'exists';
        }
        return $this->_addUser($args['username'], md5($args['password']), $args['sprite']);
    }
}
