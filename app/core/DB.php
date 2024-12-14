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
<!-- 
-- Insert into product-item
insert into product_item(Qty_in_stock, Price, Product_ID) values
(12, 45, 1),
(3, 32, 2),
(8, 64, 3),
(6, 45, 4),
(10, 50, 5),
(11, 33, 6),
(2, 43, 7),
(5, 45, 8),
(6, 49, 9),
(9, 54, 10),
(3, 25, 11),
(3, 41, 12),
(8, 15, 13),
(12, 25, 14),
(16, 48, 15),
(21, 16, 16),
(1, 25, 17),
(2, 45, 18),
(13, 64, 19),
(1, 12, 20)
-->