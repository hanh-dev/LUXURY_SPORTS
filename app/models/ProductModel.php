<?php
class ProductModel extends DB
{
    protected $data =  [];
    public function getProduct() {
        $sql = "select p.ID, p.Image, p.Name, pi.Price from Product p
                join product_item pi on pi.Product_ID = p.ID";
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

    public function createOrder($userID,$productID, $quantity) {

        $orderID = $this->checkOrder($userID);

        $price = $this->getPrice($productID);
        $total = $price * $quantity;

        if($orderID == 0) {
            $insert = "insert into Orders (User_ID, Order_Status_ID) values('$userID', 1)";
            $result = mysqli_query($this->conn, $insert);
            if($result) {
                $orderIDNew = $this->checkOrder($userID);
                // get price
                $insertOrderItem = "insert into Order_Item (Order_ID, Product_Item_ID, Qty, Total) values ('$orderIDNew', '$productID', '$quantity', '$total')";
                $resultInsert = mysqli_query($this->conn, $insertOrderItem);
                if($resultInsert) {
                    return true;
                }
                return false;
            }else {
                return false;
            }
        } else {
            $checkProductItemExist = $this->checkProductID($userID,$productID);

            if($checkProductItemExist == true) {
                $sql = "UPDATE Order_Item 
                        SET Qty = Qty + '$quantity', 
                            Total = Qty * '$price' 
                        WHERE Order_ID = '$orderID' 
                        AND Product_Item_ID = '$productID';
                        ";
                $result = mysqli_query($this->conn, $sql);
                if($result) {
                    return true;
                }

                return false;
            }
            // get Total
            $sql = "insert into Order_Item (Order_ID, Product_Item_ID, Qty, Total) values ('$orderID', '$productID', '$quantity', '$total')";
            $resultInsert = mysqli_query($this->conn, $sql);

            if (!$resultInsert) {
                return false;
            }
            
            return true;
        }
    }
    // Check user already have order or not
    public function checkOrder($userID) {
        $sql = "select ID from Orders where User_ID = '$userID'";

        $result = mysqli_query($this->conn, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
return $row['ID'];
        }
    
        return 0;
    }
    // Get price of product
    public function getPrice($productID) {
        $price = "select Price from Product_Item where ID = '$productID'";

        $resultPrice = mysqli_query($this->conn, $price);

        if ($resultPrice && mysqli_num_rows($resultPrice) > 0) {
            $row = mysqli_fetch_assoc($resultPrice);
            $priceValue = $row['Price']; 
        } else {
            die("Product not found or price unavailable.");
        }

        return $priceValue;
    }
    public function checkProductID($userID, $productID) {
        $sql = "SELECT * 
                FROM Order_Item od
                JOIN Orders o ON o.ID = od.Order_ID
                WHERE o.User_ID = '$userID' AND od.Product_Item_ID = '$productID'";
    

        $result = mysqli_query($this->conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return true; 
        }
    
        return false;
    }

    public function getAll() {
        $sql = "select p.Name, p.Image, pi.Price, pi.ID from product_item pi
        join product p on p.ID = pi.Product_ID";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
    
    public function searchProduct($key) {
        $sql = "select p.Name, p.Image, pi.Price, pi.ID from product_item pi
        join product p on p.ID = pi.Product_ID
        where p.Name LIKE '%$key%'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

}