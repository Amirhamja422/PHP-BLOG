<?php
include '../lib/database.php';
include '../lib/formate.php';

class Category{
    
    private $db;
    private $fr;

    public function __construct(){
     $this->db = new Database();
     $this->fr = new Format();
    }



    public function AddCategory($cat_name){
     $catName = $this->fr->validation($cat_name);

     if(empty($catName)){
        $msg ="Category name filed must not be empty";
        return $msg;
     }else{
        $query = "SELECT * FROM tbl_category WHERE cat_name = '$catName'";
        $result = $this->db->select($query);

        if($result > 0){
            $msg = "Category name already added";
            return $msg;
        }else{
            $insert_query = "INSERT INTO tbl_category (cat_name) VALUES ('$catName')";
            $insert_row = $this->db->insert($insert_query);
            if($insert_row){
                $msg = "Category insert successfully added";
                return $msg;
            }else{
                $msg= "Something wrong";
            }
        }
     }
    }



    public function AllCategory(){
        $query = "SELECT * FROM tbl_category";
        $allCat = $this->db->select($query);

        if($allCat !== false){
            return $allCat;
        }else{
            return false;
        }
    }


    public function getEditCat($id){
        $editData = "SELECT * FROM tbl_category WHERE cat_id = $id";
        $editResult = $this->db->select($editData);
        return $editResult;

    }


    public function UpdateCategory($cat_name,$id){
        $catName = $this->fr->validation($cat_name);

        if(empty($catName)){
           $msg ="Category name filed must not be empty";
           return $msg;
        }else{
           $query = "SELECT * FROM tbl_category WHERE cat_name = '$catName'";
           $result = $this->db->select($query);
   
           if($result > 0){
               $msg = "Category name already added";
               return $msg;
           }else{
               $update_query = "UPDATE tbl_category SET cat_name ='$catName' where cat_id = '$id'";
               $update_row = $this->db->insert($update_query);
               if($update_row){
                header('location:categoryList.php');
                   $msg = "Category Update successfully";
                   return $msg;
               }else{
                   $msg= "Something wrong";
               }
           }
        }
    }

}
?>