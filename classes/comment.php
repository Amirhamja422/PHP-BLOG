<?php

$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../lib/formate.php');


  class Comment{
    private $db;
    private $fr;
  
    public function __construct(){
     $this->db = new Database();
     $this->fr = new Format();
    }
  

    public function addComment($data){
        $name = $this->fr->validation($data['name']);
        $postId = $this->fr->validation($data['post_id']);
        $email = $this->fr->validation($data['email']);
        $website = $this->fr->validation($data['website']);
        $message = $this->fr->validation($data['message']);

        if($name=="" || $email ==""  || $website == "" || $message == ""){
          $msg ="Field must be empty";
          return $msg;
        }else{
          $sql = "INSERT INTO `tbl_comment`(`postId`,`name`, `email`, `website`, `message`) VALUES ('$postId','$name','$email','$website','$message')";
          $insert_row = $this->db->insert($sql);
          if($insert_row){
           $msg ="Comment created successfully";
           return $msg;
          }else{
           $msg = "Something is wrong post not added";
           return $msg;
          }
        }

    }
    
//   public function allComment(){
//     $query = "SELECT * FROM `tbl_comment`";
//     $allPost = $this->db->select($query);
//     if($allPost !== false){
//         return $allPost;
//     }else{
//         return false;
//     }
// }

public function allComment($pId){
  $query = "SELECT tbl_comment.*, tbl_post.post_id FROM tbl_comment INNER JOIN tbl_post ON tbl_comment.postId =tbl_post.post_id where tbl_comment.postId = '$pId'";
  $allPost = $this->db->select($query);
  if($allPost !== false){
      return $allPost;
  }else{
      return false;
  }
}


  }



?>