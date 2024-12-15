<?php
class UserModel extends DB
{
    public function createUser($Email, $Name, $Password) {
        // $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        // thêm user
        $sql = "INSERT INTO User(EmailAddress, Name, Password, Role_ID) VALUES('$Email', '$Name', '$Password', 2)";
        
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
        $sql = "SELECT * FROM User WHERE Name = '$username'";
        $result = mysqli_query($this->conn, $sql);
        
        //hàm đếm số lượng: Kiểm tra xem có data trả về không, nếu có thì > 0 sẽ là true ngược lại là false
        return mysqli_num_rows($result) > 0;
    }

    public function checkUsernamePassword($username, $password) {
        $sql = "SELECT * FROM User WHERE Name = '$username'";
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
        $sql = "SELECT ID FROM User WHERE Name = '$username'";
        $result = mysqli_query($this->conn, $sql);
        $userID = mysqli_fetch_array($result);
        return $userID["ID"];
    }
}