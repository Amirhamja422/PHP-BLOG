<?php
include '../lib/Session.php';
Session::loginCheck();
include '../lib/database.php';
include '../lib/formate.php';

class AdminLogin{
    
    private $db;
    private $fr;

    public function __construct(){
     $this->db = new Database();
     $this->fr = new Format();
    }


    public function LoginUser($email,$password){
     $email = $this->fr->validation($email);
     $password = $this->fr->validation($password);
     if(empty($email) && empty($password)){
      $error = "Field's can not be empty";
      return $error;
    }else{
      $query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";
      $result = $this->db->select($query);
      if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        if($row['v_status']==1){
         Session::set('login',true);
         Session::set('userId',$row['userId']);
         Session::set('username',$row['username']);
         Session::set('email',$row['email']);
         header('Location:index.php');

        }else{
         $error = 'please first verify your email';
         return $error;
        }
        
      }else{
        $error = "Invalid Email Or Password";

      }
    }
}
}

?>