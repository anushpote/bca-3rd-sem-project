<?php 
class Database{
    public function dbConnection(){
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'social_db';
        //database connection
        $connect = mysqli_connect($host,$username,$password,$database);

        if($connect){
            return $connect;
        }
    }

    public function listUser(){
        //database connection
        $connect = $this->dbConnection();
        $sql = "SELECT * FROM tbl_social_users";
        $query = $connect->query($sql);
        return $query;
    }

    public function addUser($username,$email,$password,$address,$joined){
        //database connection
        $connect = $this->dbConnection();
        if($connect){
            //insert query
            $sql = "INSERT INTO tbl_social_users(username,email,password,address,joined) 
            VALUES('$username','$email','$password','$address','$joined')";
            $query = $connect->query($sql);
            if($query){
                return true;
            }
        }
    }

    public function login($username,$password){
        $connect = $this->dbConnection();
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $query = $connect->query($sql);
      
        return $query;
    }

    public function editUser($id,$username,$email) {
        $connect = $this->dbConnection();
        if($connect){
                //update query
                $sql = "UPDATE tbl_social_users SET username='$username',email='$email'
                        WHERE id='$id'";
                $query = $connect->query($sql);
                if($query){
                    return true;
                }
        }

    }

    public function getUserById($id){
        $connect = $this->dbConnection();
        $sql = "SELECT * FROM tbl_social_users where id='$id'";
        $query = $connect->query($sql);
        $data = $query->fetch_assoc();
        return $data;
    }

    public function deleteUser($id){
        $connect = $this->dbConnection();
        $sql = "DELETE FROM tbl_social_users where id='$id'";
        $query = $connect->query($sql);
        return $query;
    }

    public function numOfRows($table_name){
        $connect = $this->dbConnection();
        $sql = "SELECT * FROM `$table_name`";
        $query = $connect->query($sql);

        $num_rows = mysqli_num_rows($query);
        return $num_rows;
    }

    public function selectLatest($table_name){
        $connect = $this->dbConnection();
        $sql = "SELECT * FROM `$table_name` WHERE id=(SELECT max(id) FROM `$table_name`)";
        $query = $connect->query($sql);

        $data = $query->fetch_assoc(); 
        return $data;
    }

    public function getPosts($orderBy){
        $connect = $this->dbConnection();
        $sql = "SELECT * FROM tbl_posts ORDER BY `$orderBy` DESC";
        $query = $connect->query($sql);
 
        return $query;
    }
}

?>