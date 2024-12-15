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
<!-- -- create table Role(
-- 	ID int(10) primary key auto_increment,
--     Name varchar(10) not null
-- );

-- create table User(
-- 	ID int(10) primary key auto_increment,
--     Name varchar(50) not null,
--     EmailAddress varchar(50) not null,
--     Password varchar(100) not null,
--     Role_ID int(4),
--     Image varchar(200),
--     PhoneNumber varchar(11),
--     foreign key (Role_ID)  references Role(ID)
-- );

-- Insert data for Role
-- insert into Role values(1, 'Admin'), (2, 'User');
-- Insert data for User
-- insert into User values(1, 'Ho Van Hanh', 'hanh@gmail.com', 'hanhkx12#', 2, null, null); -->
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