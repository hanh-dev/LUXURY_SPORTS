<?php
class DetailsModel extends DB
{
    public function getProduct($productID) {
        $sql = "SELECT p.Name, p.Image, p.Description, pI.Price, p.Category_ID, c.Name AS CategoryName 
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                JOIN Product_Item pI ON p.ID = pI.Product_ID
                WHERE p.ID = $productID";
        return mysqli_query($this->conn, $sql);
    }

    public function getRelatedProducts($productID, $categoryID) {
        $sql = "SELECT p.Name, p.Image, p.ID, pI.Price, c.Name AS CategoryName
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                JOIN Product_Item pI ON p.ID = pI.Product_ID
                WHERE p.Category_ID = $categoryID AND p.ID != $productID ";
        return mysqli_query($this->conn, $sql);
    } 
}
?>