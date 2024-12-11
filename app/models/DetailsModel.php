<?php
    class DetailsModel extends DB
    {
        public function getProduct($productID) {
            $sql = "SELECT p.Name, p.Image, p.Description, c.Name as CategoryName 
                    FROM Product p
                    JOIN Category c ON p.Category_ID = c.ID
                    WHERE p.ID = $productID";
                    return mysqli_query($this->conn, $sql);
        }


    }
?>