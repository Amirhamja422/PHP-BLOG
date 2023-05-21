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


}

?>