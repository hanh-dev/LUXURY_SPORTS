<?php
        class CartModel extends DB
        {
            public function getProductCart($status = 'All') {
                $userID = $_SESSION['user_id'];
                $orderID = $this->getOrderID($userID);
                if($status!='All') {
                    $sql = "SELECT oi.*, pI.Price, pI.Qty_in_stock, p.Name, p.Image, P.ID, oi.Status
                            FROM Order_Status os
                            JOIN Order_Item oi on os.ID = oi.Status
                            JOIN Orders o on o.ID = oi.Order_ID
                            JOIN Product_Item pI ON oi.Product_Item_ID = pI.ID
                            JOIN Product p ON pI.Product_ID = p.ID
                            WHERE oi.Order_ID = '$orderID' AND os.StatusName = '$status'";
                } else if($status === null || $status === 'All') {
                    $sql = "SELECT oi.*, pI.Price, pI.Qty_in_stock, p.Name, p.Image, P.ID, oi.Status
                            FROM Orders o
                            JOIN Order_Item oi ON o.ID = oi.Order_ID
                            JOIN Product_Item pI ON oi.Product_Item_ID = pI.ID
                            JOIN Product p ON pI.Product_ID = p.ID
                            WHERE oi.Order_ID = '$orderID'";
                }
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
                return isset($orderID['Order_ID'])?$orderID['Order_ID']:'';
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

            public function getStatus($statusID) {
                $sql = "SELECT StatusName FROM Order_Status WHERE ID = '$statusID'";
                $result = mysqli_query($this->conn, $sql);
                $row = mysqli_fetch_assoc($result);
                return $row['StatusName'];
            }

            // removeItem
            public function removeItem($orderID, $productID) {
                $sql = "DELETE FROM Order_Item WHERE Order_ID = '$orderID' AND Product_Item_ID = '$productID'";
                $result = mysqli_query($this->conn, $sql);
                if (!$result) {
                    return false;
                }
                return true;
            }

            // update status of orders
            public function updateOrderStatus($productID, $action = null) {
                // get orderID
                $userID = $_SESSION['user_id'];
                $orderID = $this->getOrderID($userID);

                $status = 'Pending Confirmation';

                if($action != null && $action == 'cancel') {
                    $status = 'Cancelled';
                }elseif($action = ! null && $action == 'confirm') {
                    $status = 'Paid';
                }

                // get status id based on status name
                $statusID = $this->getStatusID($status);
                foreach($productID as $id) {
                    $sql = "UPDATE Order_Item SET Status = '$statusID' WHERE Order_ID = '$orderID' AND Product_Item_ID = '$id'";
                    $result = mysqli_query($this->conn, $sql);
                    if (!$result) {
                        return false;
                    }
                }

                return true;
            }
            public function getStatusID($statusName) {
                $sql = 'select ID from Order_Status where StatusName = "'.$statusName.'"';
                $result = mysqli_query($this->conn, $sql);
                $row = mysqli_fetch_assoc($result);
                return $row['ID'];
            }

            public function getPendingQuantity() {
                $total = 0;
                $rows = [];
            
                $sql = "SELECT createdAt, Status FROM Order_Item";
                $result = mysqli_query($this->conn, $sql);
            
                while ($row = mysqli_fetch_assoc($result)) {
                    $row['createdAt'] = substr($row['createdAt'], 0, 16);
                    $rows[] = $row;
                }
            
                $processed = [];
            
                for ($i = 0; $i < count($rows); $i++) {
                    if (in_array($i, $processed)) {
                        continue;
                    }
            
                    $groupHasPending = false;
            
                    for ($j = 0; $j < count($rows); $j++) {
                        if ($rows[$i]['createdAt'] === $rows[$j]['createdAt']) {
                            if ($rows[$j]['Status'] == 5) {
                                $groupHasPending = true;
                            }
                            $processed[] = $j;
                        }
                    }
            
                    if ($groupHasPending) {
                        $total++;
                    }
                }
            
                return $total;
            }
                    
        }
