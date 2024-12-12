<?php
class ProductModel extends DB
{
    protected $data =  [];
    public function getProduct() {
        $sql = "select * from Product";
        $result = mysqli_query($this->conn, $sql);

        if(!$result) {
            die('Query error');
        }

        $products = [];
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        return $products;
    }

    public function getCategory() {
        $sql = "select * from Category";

        $result = mysqli_query($this->conn, $sql);
        $category = [];

        while($row = mysqli_fetch_assoc($result)) {
            $category[] = $row;
        }

        return $category;
    }
}