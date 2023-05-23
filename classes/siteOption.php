<?php 
$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../lib/formate.php');


class siteOption{
    
  private $db;
  private $fr;

  public function __construct(){
   $this->db = new Database();
   $this->fr = new Format();
  }



public function aboutInfo(){
    $about_sql="SELECT * FROM tbl_about where aboutId = '1'";
    $about_result = $this->db->select($about_sql);
    return $about_result;
}



public function latestPost(){
  $sql ="SELECT tbl_post.*, tbl_user.username, tbl_user.pro_image FROM tbl_post inner join tbl_user on tbl_post.userId = tbl_user.userId WHERE tbl_post.status ='1' order by tbl_post.post_id DESC limit 3";
  $latest_post_result =$this->db->select($sql);
  return $latest_post_result;
}


}

?>