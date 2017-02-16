<?php

namespace Libs;

use PDO;

class DatabaseLib extends PDO {

    //REQUIRED

    private $host = DB_HOST; // Host name 
    private $db_username = DB_USER; // Mysql username 
    private $db_password = DB_PASS; // Mysql password 
    private $db_name = DB_NAME; // Database name 
    protected $tables = array();

    public function __construct() {
        $connectionString = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        parent::__construct($connectionString, $this->db_username, $this->db_password);
    }

    //FUNCTIONAL

    public function disconnect() {
        mysql_close();
    }

    //CHECKS
    //GETTERS
    //SETTERS
}

?>