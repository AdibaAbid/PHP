<?php
class database {
    private $host= "Localhost";
    private $user="root";
    private $password="";
    private $project_name ="books-list";
    private $conn;

function __construct(){
    $this->conn = new mysqli($this->host, $this->user, $this->password,
    
    $this->project_name);
    if($this->conn->connect_error){
        echo 'connection failed';
    }else{
        return $this->conn;
    }
  } //constructor close

  //insert record function
  public function insertRecord($post){

  $author = $post['author'];
  $bookTitle = $post['bookTitle'];
  $category = $post['category'];
  $pageNum = $post['pageNum']; 

  $sql = "INSERT INTO booksstore( title, author, categories, pageNumber)
  VALUES ('$bookTitle', '$author', '$category', '$pageNum')";
  
  $result = $this->conn->query($sql);
  
  if($result){
    //   header('location:index.php?msg=insert');
  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Congratulations!", "Data insert successfully", "success");';
  echo '}, 1000);</script>';
  }else{
      echo 'Error' . $sql . '<br/> '. $this->conn->error;
  }
} //insert record function close


//display record function
public function displayRecord(){
    $sql = "SELECT * FROM booksstore";
    $result = $this->conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
             $data[]= $row;
        }//while close
        return $data;
    }//if close
}//displayRecord close

//Update function
public function displayRecordByID($editid){
    $sql = "SELECT * FROM booksstore WHERE id='$editid'";
    $result = $this->conn->query($sql);

    if($result->num_rows==1){
        $row = $result->fetch_assoc();
        return $row;
    } //if close
} //function displayByID close

//Update record function
  public function updateRecord($post){

  $author = $post['author'];
  $bookTitle = $post['bookTitle'];
  $category = $post['category'];
  $pageNum = $post['pageNum']; 
  $editid = $post['hid'];
  $sql = "UPDATE booksstore SET title='$bookTitle', author='$author', categories='$category', pageNumber='$pageNum' WHERE id='$editid'";
  
  $result = $this->conn->query($sql);
  
  if($result){
      header('location:index.php?msg=update');
  }else{
      echo 'Error' . $sql . '<br/> '. $this->conn->error;
  }
} 

//Delete record
public function deleteRecord($delid){
    $sql = "DELETE FROM booksstore WHERE id='$delid'";
    $result = $this->conn->query($sql);
    if($result){
        // header('location:index.php?msg=deletesuccesful');
  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("OOh!", "Data delete successfully", "success");';
  echo '}, 1000);</script>';
    }else{
        echo "ERROR". $sql . "<br/>". $this->conn->error;
    }
}

//view summary

//class close


?>