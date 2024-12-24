<?php
class DetailsModel extends DB
{
    public function getProduct($productID) {
        $sql = "SELECT p.Name, p.Image, p.Description, pI.Price, p.Category_ID,pI.ID, c.CategoryName AS CategoryName 
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                JOIN Product_Item pI ON p.ID = pI.Product_ID
                WHERE p.ID = $productID";
        return mysqli_query($this->conn, $sql);
    }

    public function getRelatedProducts($productID, $categoryID) {
        $sql = "SELECT p.Name, p.Image, p.ID, pI.Price, c.CategoryName AS CategoryName
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                JOIN Product_Item pI ON p.ID = pI.Product_ID
                WHERE p.Category_ID = $categoryID AND p.ID != $productID"; /**Loại bỏ sản phẩm hiện tại khỏi danh sách. */
        return mysqli_query($this->conn, $sql);
    } 
}
?>