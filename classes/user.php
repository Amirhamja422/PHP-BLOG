<?php 
$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../lib/formate.php');


class user{
    private $db;
    private $fr;
  
    public function __construct(){
     $this->db = new Database();
     $this->fr = new Format();
    }



 public function userBio(){
    $sql ="SELECT * FROM tbl_user";
    $result = $this->db->select($sql);
    return $result;

 }






}

?>