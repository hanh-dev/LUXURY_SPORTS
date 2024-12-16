<?php
    class DB {
        public $conn;
        public $servername = "localhost";
        public $username = "root";
        public $password = "";
        public $dbname = "luxury";

        function __construct() {
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

            mysqli_select_db($this->conn, $this->dbname);
            mysqli_query($this->conn, "SET NAMES 'utf8'");
        }
    }
?>