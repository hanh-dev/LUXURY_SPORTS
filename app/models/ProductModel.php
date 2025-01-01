<?php
class ProductModel extends DB
{
    protected $data =  [];
    public function getProduct($id = null) {
        if ($id) {
            $sql = "select p.ID, p.Image,p.Description, p.Name, pi.Price, pi.Qty_in_stock, pi.Price, c.CategoryName
            from Category c
            join Product p on c.ID = p.Category_ID
            join product_item pi on pi.Product_ID = p.ID
            where p.ID = '$id'";
        }else {
            $sql = "select p.ID, p.Image,p.Description, p.Name, pi.Price, pi.Qty_in_stock, pi.Price from Product p
            join product_item pi on pi.Product_ID = p.ID";
        }
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
            $insert = "insert into Orders (User_ID) values('$userID')";
            $result = mysqli_query($this->conn, $insert);
            if($result) {
                $orderIDNew = $this->checkOrder($userID);
                // get price
                $insertOrderItem = "insert into Order_Item (Order_ID, Product_Item_ID, Qty, Total, Status) values ('$orderIDNew', '$productID', '$quantity', '$total', 1)";
                //update item status
                $updateStatus = "update Order_Item set Status = 1 where Order_ID = '$orderIDNew' and Product_Item_ID = '$productID'";
                $check = mysqli_query($this->conn, $updateStatus);
                if(!$check) {
                    return false;
                }
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
            $sql = "insert into Order_Item (Order_ID, Product_Item_ID, Qty, Total, Status) values ('$orderID', '$productID', '$quantity', '$total', 1)";
            $updateStatus = "update Order_Item set Status = 1 where Order_ID = '$orderID' and Product_Item_ID = '$productID'";
            $check = mysqli_query($this->conn, $updateStatus);
            if(!$check) {
                return false;
            }
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

    public function getQuantityCart($user_id) {
        $sql = "select sum(Qty) as total from Order_Item oi
        join Orders o on o.ID = oi.Order_ID
        where o.User_ID = '$user_id'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    
    

    public function getAll() {
        $sql = "select p.Name, p.Image, pi.Price, pi.ID, pi.Qty_in_stock from product_item pi
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

    // get category id
    public function getCategoryID($category) {
        $sql = "SELECT ID FROM Category WHERE CategoryName = '$category'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['ID'];
    }
    // create product
    public function createProduct($name, $des, $price, $image, $category, $qty) {
        $sql = "insert into Product(Name, Image, Description, Category_ID) values('$name', '$image', '$des', '$category')";
        $result = mysqli_query($this->conn, $sql);
        if($result) {
            $product_id = mysqli_insert_id($this->conn);
            // insert vào bảng product_item
            $sql = "insert into Product_Item(Product_ID, Price, Qty_in_stock) values('$product_id', '$price', '$qty')";
            $result = mysqli_query($this->conn, $sql);
            if($result) {
                return true;
            }
        }
        return false;
    }
    // delete product
    public function deleteProduct($id) {
        $sql = "DELETE FROM Product_Item WHERE Product_ID = '$id'";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $sql = "DELETE FROM Product WHERE ID = '$id'";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                return true;
            }
        }

        return false;
    }
    // update product
    public function updateProduct($id, $name, $des, $price, $image, $categoryID, $qty) {
        if($image!=null) {
            $sql = "UPDATE Product 
                    SET 
                        Name = '$name', 
                        Image = '$image', 
                        Description = '$des', 
                        Category_ID = '$categoryID'
                    WHERE 
                        ID = '$id'";
        }else {
            $sql = "UPDATE Product 
            SET 
                Name = '$name', 
                Description = '$des', 
                Category_ID = '$categoryID'
            WHERE ID = '$id'";
        }
    
        // Thực thi câu lệnh
        $result = $this->conn->query($sql);
        if($result) {
            $sql = "UPDATE Product_Item SET Price = '$price', Qty_in_stock = '$qty'
            WHERE Product_ID = '$id'";
            $resultP = $this->conn->query($sql);
            if($resultP) {
                return true;
            }
        }
        return false;
    }
    
    //get data order
    public function getOrder($status = null){
        // get status name
        $sql = "SELECT oi.*, pI.Price, pI.Qty_in_stock, p.Name, p.Image, p.ID, oi.Status, u.UserName, os.StatusName, oi.createdAt
        FROM Order_Status os
        JOIN Order_Item oi ON os.ID = oi.Status
        JOIN Orders o ON o.ID = oi.Order_ID
        JOIN Product_Item pI ON oi.Product_Item_ID = pI.ID
        JOIN Product p ON pI.Product_ID = p.ID
        JOIN User u ON o.User_ID = u.ID";
        
        if ($status !== null) {
            if ($status === 'admin') {
                $sql .= " WHERE os.StatusName NOT IN ('Pending', 'Pending Confirmation')";
            } else {
                $sql .= " WHERE os.StatusName = '$status'";
            }
        }
        $result = mysqli_query($this->conn, $sql);
        $oder = [];
        while($row = mysqli_fetch_assoc($result)) {
            $oder[] = $row;
        }
        return $oder;
    }

    public function updateStatus($id, $status, $userName) {
        $orderID = $this->getOrderID($userName);
        $statusID = $this->getStatusID($status);
        $sql ="update Order_Item set Status = '$statusID' where Product_Item_ID = '$id' and Order_ID = '$orderID'";
        $result = mysqli_query($this->conn, $sql);
        if(!$result) {
            return false;
        }
        return true;
    }

    public function getOrderID($userName) {
        $sql = "select Order_ID from Order_Item oi
        join Orders o on o.ID = oi.Order_ID
        join User u on u.ID = o.User_ID
        where u.UserName ='$userName'";

        $result = mysqli_query($this->conn, $sql);
        $orderID = mysqli_fetch_assoc($result);
        return isset($orderID['Order_ID'])?$orderID['Order_ID']:'';
    }

    public function getStatusID($status) {
        $sql = "select ID from Order_Status where StatusName = '$status'";
        $result = mysqli_query($this->conn, $sql);
        $statusID = mysqli_fetch_assoc($result);
        return isset($statusID["ID"])?$statusID["ID"]:"";
    }
    // get product detail
    public function getProductDetail($productID) {
        $sql = "SELECT p.Name, p.Image, p.Description, pI.Price, p.Category_ID,pI.ID, c.CategoryName AS CategoryName 
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                JOIN Product_Item pI ON p.ID = pI.Product_ID
                WHERE p.ID = $productID";
        return mysqli_query($this->conn, $sql);
    }
    //get related product
    public function getRelatedProducts($productID, $categoryID) {
        $sql = "SELECT p.Name, p.Image, p.ID, pI.Price, c.CategoryName AS CategoryName
                FROM Product p
                JOIN Category c ON p.Category_ID = c.ID
                JOIN Product_Item pI ON p.ID = pI.Product_ID
                WHERE p.Category_ID = $categoryID AND p.ID != $productID";
        return mysqli_query($this->conn, $sql);
    }
}