<?php

    // Include Database Class
    include(dirname(__FILE__) . '/../FlatDB.php');

    /**
     * Description of Auth
     *
     * @author marshs
     */

    class Authentication {

        // Private

        private $db;

        // Public

        public function __construct($db) {
            $this->db = $db;
        }

        public function getDB($type, $args) {
            return $this->_connect();
        }


    }
