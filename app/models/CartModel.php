<?php
        class CartModel extends DB
        {
            public function getProductCart() {
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

            public function getOrderID($userID) {
                $sql = "select Order_ID from Order_Item oi
                join Orders o on o.ID = oi.Order_ID
                where o.User_ID = '$userID'";

                $result = mysqli_query($this->conn, $sql);
                $orderID = mysqli_fetch_assoc($result);
                return $orderID['Order_ID'];
            }

            public function removeProduct($ProductID) {
                $sql = "DELETE FROM Order_Item WHERE Product_Item_ID = ?";
                $stm = $this->conn->prepare($sql);
                $stm->bind_param('i', $ProductID);
                $result = $stm->execute();

                if(!$result) {
                    return false;
                }
                return true;
            }

            public function updateProductQty($productID, $quantity) {
                $sql = "UPDATE Order_Item SET Qty = ? WHERE Product_Item_ID = ?";
                $stm = $this->conn->prepare($sql);
                $stm->bind_param('ii', $quantity, $productID);
                $result = $stm->execute();
           
                if (!$result) {
                    die("Error updating quantity in database");
                }
                return $result;
            }    

            public function getProductStock ($ProductID) {
                $sql = "SELECT Qty_in_stock FROM Product_Item WHERE ID = ?";
                $stm = $this->conn->prepare($sql);
                $stm->bind_param('i', $ProductID);
                $stm->execute();
                $result = $stm->get_result();


                if($row = $result->fetch_assoc()) {
                    return $row['Qty_in_stock'];
                }
            }

        }
    ?>
