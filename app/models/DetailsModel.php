<?php
class DetailsModel extends DB
{
    public function getProduct($productID) {
        $sql = "SELECT p.Name, p.Image, p.Description, p.Category_ID, c.Name AS CategoryName 
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                WHERE p.ID = $productID";
        return mysqli_query($this->conn, $sql);
    }

    public function getRelatedProducts($productID, $categoryID) {
        $sql = "SELECT p.Name, p.Image, p.Category_ID, c.Name AS CategoryName
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                WHERE p.Category_ID = $categoryID AND p.ID != $productID 
                LIMIT 4";
        return mysqli_query($this->conn, $sql);
    } 
}
?>