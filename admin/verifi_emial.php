<?php
 include '../lib/session.php';
 Session::init();
 include '../lib/database.php';
 $db= new Database();

 if(isset($_GET['token'])){
    $token = $_GET['token'];
    echo $query ="SELECT v_token, v_status FROM tbl_user  WHERE v_token = '$token'";
    $result = $db->select($query);
    if($result !='false'){
        $row = mysqli_fetch_assoc($result);
        if($row['v_status']==0){
            $click_token =$row['v_token'];
            $update_status = "UPDATE tbl_user set v_status ='1' WHERE v_token ='$click_token'";
            $update_result = $db->update($update_status);
            if($update_result){
             $_SESSION['status']='your account has been verified successfully';
             header('location:login.php');
            }else{
             $_SESSION['status']='Please verified your account';
             header('location:login.php');
            }
        }else{
            $_SESSION['status'] ='This Email is already verified please login';
            header('location:login.php');
        }

    }else{
        $_SESSION['status'] ='This Token does not exist';
        header('location:login.php');
    }
 }else{
    $_SESSION['status'] = "Not allowed";
    header('location:login.php');
}
?>