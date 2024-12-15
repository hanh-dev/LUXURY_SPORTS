<?php
class UserModel extends DB
{
    public function createUser($Email, $Name, $Password) {
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
        
        // hàm đếm số lượng: Kiểm tra xem có data trả về không, nếu có thì > 0 sẽ là true ngược lại là false
        return mysqli_num_rows($result) > 0;
    }

    public function getUserbyID($id) {
        $sql = "select * from user where ID = '$id'";
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data;
    }
    
    
}