<?php
class database {
    private $host;
    private $user;
    private $password;
    private $db_name;

    function __construct(){
        $this->host= "localhost";
        $this->user= "root";
        $this->password= "";
        $this->db_name= "e_commerce";
        $this->connect();
    }
    
    function connect(){
    return mysqli_connect($this->host, $this->user,  $this->password, $this->db_name);
    if(mysqli_connect_error()){
        die('not connected');
    }else{
        echo 'connected';
    }
  }
}
 




    // class dbconfig 
    // {

    // public  $connection;
    //     public function __construct()
    //     {
    //         $this->db_connect();
    //     }
       
    //     public function db_connect()
    //     {
    //         $connection = mysqli_connect('localhost','root','','e_commerce');
    //         if(mysqli_connect_error())
    //         {
    //             die(" Connect Failed ");
    //         }
    //         else{
    //             echo "connection successful";
    //         }
    //     }

       
    // }

?>