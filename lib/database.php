<?php
$filepath = realpath(dirname(__FILE__));

 include ($filepath.'/../config/config.php');
 class Database{
    public $host = HOST;    
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABASE;

    public $link;
    public $error;

    public function __construct(){
        $this->dbConnect();
    }

 ## d connects to the database
    public function dbConnect(){
        $this->link = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        if(!$this->link){
            $this->error = 'Database connection failed';
            return false;
        }
    }

## select statement for database connection from database table 
    public function select($query){
        $result = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
        if(mysqli_num_rows($result)>0){
            return $result;
        }else{
            return false;
        }
    }



    public function insert($query){
        $result = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }

    }

    public function update($query){
        $result = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }

    }


    public  function delete($query){
        $result = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }

    }

    

 }
   
?>