<?php
class ProductModel extends DB
{
    public function getProduct() {
        $sql = "select * from Product";
        return mysqli_query($this->conn, $sql);
    }
}