<?php
        class CartModel extends DB
        {
            public function getProductCart() {
                $sql = "SELECT oi.*, pI.Price, pI.Qty_in_stock, p.Name, p.Image, P.ID
                        FROM Order_Item oi
                        JOIN Product_Item pI ON oi.Product_Item_ID = pI.ID
                        JOIN Product p ON pI.Product_ID = p.ID";
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
