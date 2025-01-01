<?php
class UserModel extends DB
{
    public function getAllUser() {
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function createUser($Name, $Email, $Password) {
        // $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO User(EmailAddress, UserName, Password, Role_ID) VALUES('$Email', '$Name', '$Password', 2)";
        
        // thực hiện truy vấn
        $result = mysqli_query($this->conn, $sql);
    
        // truy vấn thành công, trả về true ngược lại falsefalse
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmail($email) {
        $sql = "SELECT * FROM User WHERE EmailAddress = '$email'";
        $result = mysqli_query($this->conn, $sql);
        
        //hàm đếm số lượng: Kiểm tra xem có data trả về không, nếu có thì > 0 sẽ là true ngược lại là false
        return mysqli_num_rows($result) > 0;
    }

    public function checkUsername($username) {
        $sql = "SELECT * FROM User WHERE UserName = '$username'";
        $result = mysqli_query($this->conn, $sql);
        
        //hàm đếm số lượng: Kiểm tra xem có data trả về không, nếu có thì > 0 sẽ là true ngược lại là false
        return mysqli_num_rows($result) > 0;
    }

    public function getUserbyID($id) {
        $sql = "select * from user where ID = '$id'";
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data;
    }
    
    

    public function checkUsernamePassword($username, $password) {
        $sql = "SELECT * FROM User WHERE UserName = '$username'";
        $result = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $user = mysqli_fetch_array($result);
            if(($password ==$user["Password"])) {
                return true;
            }
        }
        return false;
    }

    public function getUserID($username) {
        $sql = "SELECT ID FROM User WHERE UserName = '$username'";
        $result = mysqli_query($this->conn, $sql);
        $userID = mysqli_fetch_array($result);
        return $userID["ID"];
    }

    // Update user
    public function updateUser($id, $name, $email, $phone) {
        $sql = "update User set UserName = '$name', EmailAddress = '$email', PhoneNumber = '$phone' where ID = '$id'";
        $result = mysqli_query($this->conn, $sql);
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateImageUser($id, $url) {
        $sql = "update User set Image = '$url' where ID = '$id'";
        $result = mysqli_query($this->conn, $sql);

        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getRoleID($userID) {
        $sql = "SELECT Role_ID FROM User WHERE ID = '$userID'";
        $result = mysqli_query($this->conn, $sql);
        $roleID = mysqli_fetch_assoc($result);

        return $roleID["Role_ID"];
    }

    //Delete User by ID
    public function deleteUser($id) {
        $sql = "DELETE FROM User WHERE ID = '$id'";
        $result = mysqli_query($this->conn, $sql);
    }

    // Update User
    public function updateInforUser($userID, $name, $email, $password) {
        $sql =  "update User set UserName = '$name', EmailAddress = '$email', Password = '$password'
        where ID = '$userID'";
        $result = mysqli_query($this->conn, $sql);
    }

    // Add to WishList
    public function addToWishList($userID, $productID) {
        $sql = "insert into WishList (User_ID, Product_Item_ID) 
        values ('$userID', '$productID')";

        return mysqli_query($this->conn, $sql);
    }
}