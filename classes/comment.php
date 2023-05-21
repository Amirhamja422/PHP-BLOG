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
  // $query = "SELECT tbl_comment.*, tbl_post.post_id FROM tbl_comment INNER JOIN tbl_post ON tbl_comment.postId =tbl_post.post_id where tbl_comment.postId = '$pId'  AND tbl_comment.status == '1'";
  $query = "SELECT tbl_comment.*, tbl_post.post_id FROM tbl_comment INNER JOIN tbl_post ON tbl_comment.postId =tbl_post.post_id where tbl_comment.postId = '$pId'";
  $allPost = $this->db->select($query);
  if($allPost !== false){
      return $allPost;
  }else{
      return false;
  }
}


public function adminComment($id){
  $query = "SELECT tbl_comment.*, tbl_user.userId FROM tbl_comment INNER JOIN tbl_user ON tbl_comment.userId =tbl_user.userId where tbl_comment.userId = '$id'";
  $adminCom = $this->db->select($query);
  return $adminCom;

}



public function activePost($aid){
  $sql ="UPDATE tbl_comment SET status = '0' WHERE post_id = '$aid'";
  $ar = $this->db->update($sql);
  If($ar){
   $msg="Post Deactivate & not show";
   return $msg;
  }
}

public function deactivatePost($did){
  $sql ="UPDATE tbl_comment SET status = '1' WHERE post_id = '$did'";
  $ar = $this->db->update($sql);
  If($ar){
   $msg="Post Activate & show";
   return $msg;
  }
}




  }



?>