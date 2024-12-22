<?php
    class CheckoutModel extends DB
    {
        public function getOrderID($userID) {
            $sql = "SELECT Order_ID FROM Order_Item oi
            JOIN Orders o ON o.ID = oi.Order_ID
            WHERE o.User_ID = '$userID'";

            $result = mysqli_query($this->conn, $sql);
            $orderID = mysqli_fetch_assoc($result);
            return $orderID['Order_ID'];
        }
        
        public function getProductOrder() {
            $userID = $_SESSION['user_id'];
            $orderID = $this->getOrderID($userID);
            $sql = "SELECT oi.*, pI.Price, pI.Qty_in_stock, p.Name, p.Image, P.ID
                    FROM Orders o
                    JOIN Order_Item oi ON o.ID = oi.Order_ID
                    JOIN Product_Item pI ON oi.Product_Item_ID = pI.ID
                    JOIN Product p ON pI.Product_ID = p.ID
                    WHERE oi.Order_ID = '$orderID'";
            $result = mysqli_query($this->conn,$sql);

            if(!$result) {
                die('Query error');
            }

            $productCart = [];
            while($row = mysqli_fetch_assoc($result)) {
                $productCart [] = $row;
            }
            return $productCart;
        }

    }






?>

