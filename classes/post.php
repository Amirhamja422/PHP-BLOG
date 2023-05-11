<?php 
$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../lib/formate.php');


class post{
    
  private $db;
  private $fr;

  public function __construct(){
   $this->db = new Database();
   $this->fr = new Format();
  }


    public function AddPost($data,$file){
      $title = $this->fr->validation($data['cat_name']);
      $catId = $this->fr->validation($data['catId']);
      $disOne = $this->fr->validation($data['dis_one']);
      $disTwo = $this->fr->validation($data['dis_two']);
      $post_tags = $this->fr->validation($data['post_tags']);
      $post_type = $this->fr->validation($data['post_type']);
      $userId = "12";



      $permited = array('jpg','png','gif','jpeg');
      $file_name = $file['imageOne']['name']; 
      $file_size = $file['imageOne']['size'];
      $file_temp = $file['imageOne']['tmp_name'];

      $div = explode('.',$file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
      $upload_image = "upload/".$unique_image;


     
      $permited_two = array('jpg','png','gif','jpeg');
      $file_name_two = $file['imageTwo']['name']; 
      $file_size_two = $file['imageTwo']['size'];
      $file_temp_two = $file['imageTwo']['tmp_name'];

      $div_two = explode('.',$file_name_two);
      $file_ext_two = strtolower(end($div_two));
      $unique_image_two = substr(md5(time()),0,10).'.'.$file_ext_two;
      $upload_image_two = "upload/".$unique_image_two;

      if(empty($title) || empty($catId) || empty($disOne) || empty($disTwo) || empty($post_tags) ){
        $msg = "Field must not be empty";
        return $msg;
      }else if($file_size>1048555567){
        $msg ="File size must be less than 1 MB";
        return $msg;
      }else if($file_size_two>1048567){
        $msg ="File size must be less than 1 MB";
        return $msg;

      }else if(in_array($file_ext,$permited) == false){
        $msg = "You can upload only: ". implode(', ',$permited);
        return $msg;
       }else if(in_array($file_ext_two,$permited_two) == false){
        $msg = "You can upload only: ". implode(', ',$permited);
        return $msg;
      }else{
        move_uploaded_file($file_temp, $upload_image);
        move_uploaded_file($file_temp_two, $upload_image_two);
  
        $insert_query = "INSERT INTO `tbl_post`(`userId`,`post_title`, `cat_id`, `image_one`, `description_one`, `image_two`, `description_two`, `post_type`, `post_tags`)values('$userId','$title','$catId','$upload_image','$disOne','$upload_image_two','$disTwo','$post_type','$post_tags')";
        $insert_row = $this->db->insert($insert_query);
        if($insert_row){
         $msg ="Post created successfully";
         return $msg;
        }else{
         $msg = "Something is wrong post not added";
         return $msg;
        }
      }


    }



    public function AllPost($id){
      $query = "SELECT * FROM `tbl_post` where `userId` = '$id'";
      $allPost = $this->db->select($query);
      if($allPost !== false){
          return $allPost;
      }else{
          return false;
      }
  }




  // public function latestPost(){
  //   $query = "SELECT * FROM `tbl_post`";
  //   $allPost = $this->db->select($query);
  //   if($allPost !== false){
  //       return $allPost;
  //   }else{
  //       return false;
  //   }

  // }


  public function latestPost(){
  $query = "SELECT tbl_post.*, tbl_user.username, tbl_post.image_one FROM tbl_post INNER JOIN tbl_user ON tbl_post.userId = tbl_user.userId ORDER BY tbl_post.post_id DESC";
  $post_result = $this->db->select($query);
  return $post_result;
  }


  // public function allView($id){
  //   $viewData = "SELECT * FROM tbl_post WHERE post_id = $id";
  //   $viewDataResult = $this->db->select($viewData);
  //   return $viewDataResult;
  //   // $md = "SELECT tbl_post.*, tbl_category.catName FROM tbl_post inner join tbl_category on tbl_post.catId = tbl_category.catId";
  //   // $mr = $this->db->select($md);
  //   // return $mr;
  // }



}

?>