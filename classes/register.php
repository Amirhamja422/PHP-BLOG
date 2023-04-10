<?php
include '../lib/database.php';
include '../lib/formate.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
include '../PHPMailer/PHPMailerAutoload.php';

// include '../PHPMailer/PHPMailer.php';
// include '../PHPMailer/SMTP.php';
// include '../PHPMailer/Exception.php';


  class Register{

  public  $db;
  public  $fr;


  public function __construct(){
    $this->db = new Database();
    $this->fr = new Format();

  }

  public function addUser($data){

    function sendmail_varifi($name,$receiver_email,$v_token){
      $sender_email = 'amirhamja422@gmail.com';
      $sender_mail_password = 'kmtoffozvuhpohxl';
      $sender_name = 'Google';
      // $receiver_email = 'shantakhananisa@gmail.com';
      // $receiver_email = 'amirhamja422@gmail.com';
      
      $mail = new PHPMailer(true);
      $mail->IsSMTP();
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 587;
      $mail->IsHTML(true);
      $mail->Username = $sender_email;
      $mail->Password = $sender_mail_password;
      $mail->SetFrom($sender_email, $sender_name);
      $mail->Subject = 'Anisha';
      $email_template ="
      <h2>you have register with amir</h2>
      <h5>verify your email address to login please check the link below</h5>
      <a href='http://localhost/personal-webpage/admin/verify_email.php?token =$v_token'>Click here</a>
      ";
      $mail->Body = $email_template;
      $mail->AddAddress($receiver_email);
      
      if (!$mail->send()) {
          echo $mail->ErrorInfo . '<br>';
      } else {
          echo 'Email has been sent. <br>';
      }

    }



    $name = $this->fr->validation($data['name']);
    $phone = $this->fr->validation($data['phone']);
    $email = $this->fr->validation($data['email']);
    $password = $this->fr->validation($data['password']);
    $v_token = md5(rand());

     if(empty($name) || empty($email) || empty($phone) || empty($password)){
      $error ="Field must no be empty";
      return $error;
     }else{
      $email_query = "SELECT * FROM tbl_user WHERE email = '$email'";
      $check_email = $this->db->select($email_query);
      
      if($check_email>0){
          $error ="Ths email is already exist";
          return $error;
          header('location:register.php');
  
        }else{
          $insert_query ="INSERT INTO `tbl_user`(username,phone,email,password,v_token)values('$name','$phone','$email','$password','$v_token')";
          $insert_row = $this->db->insert($insert_query);
          if($insert_row){
            sendmail_varifi($name,$email,$v_token);
            $success = 'Registration successfully registered and check your email inbox for varifi email';
            return $success;
          }else {
            $error = 'Registration failed';
            return $error;
          }


        }

     } 
  
  }


  }


?>