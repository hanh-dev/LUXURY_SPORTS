<?php
class UserModel extends DB
{
    public function createUser($Email, $Name, $Password) {
        // thêm user
        $sql = "INSERT INTO User(EmailAddress, Name, Password, Role_ID) VALUES('$Email', '$Name', '$Password', 2)";
        
        // thực hiện truy vấn
        $result = mysqli_query($this->conn, $sql);
    
    
        // truy vấn thành công, trả về true
        return true;
    }
    
}