<?php
include('connect_db/connection.php');

$obj = new database();

 class UserValidator extends database{
     private $data;
     private $errors =[];
     private static $fields = ['username', 'password'];
     private $dbh ;

     public function __construct($post_data){
         $this->data = $post_data;

     }
     
     public function validateForm(){
         global $obj;
         foreach(self::$fields as $field){
             if(!array_key_exists($field, $this->data)){
                 trigger_error("$field is not present in data");
                 return;
             }else {
                $userName = $this->validateUsername();
                $userPassword = $this->validatePassword();
                echo 'username****' . $userName;
                echo 'userpass****' . $userPassword;
            //     $sql = "SELECT * FROM admin_login where admin_name = '$userName' 
            //     and admin_password= '$userPassword'";
            //     $query = mysqli_query($obj, $sql);
            //     // $row = mysqli_num_rows($query){
            //     if( mysqli_num_rows($query)){
            //     echo 'login successfully';
            //     }else {
            //     echo 'not login';
            //  }
                
                return $this->errors;
             }
             }
         
       
     }

     
     private function validateUsername(){ 

         $val = trim($this->data['username']);

        if(empty($val)){
            $this->addError('username', 'username cannot be empty');
        } else{
             if(!preg_match('/^[a-zAZ0-9]{6,9}$/', $val)){
             $this->addError('username','username mustr be 6-9 chars & alphanumeric');
            }
        return $val;
     }
    }
     
     private function validatePassword(){
         $val = trim($this->data['password']);

          if(empty($val)){
            $this->addError('password', 'password cannot be empty');
        } else{
             if(strlen($val) <= 5){
             $this->addError('password','password must be 5 character long');
            }
        return $val;
     }

     }

     private function addError($key, $val){
         $this->errors[$key] = $val;
     }
}

?>