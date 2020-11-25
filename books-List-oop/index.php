<?php

include 'db/db.php';

$obj = new database();

//Insert Record
if(isset($_POST['submit'])){

//Check validation
  if(empty($_POST['bookTitle']) || empty($_POST['author']) || empty($_POST['pageNum']) || empty($_POST['category'])){ 
  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("OOps!", "All Fields must be fill!", "warning");';
  echo '}, 1000);</script>';
} else {
    $obj->insertRecord($_POST);
}
}

//Update Record
if(isset($_POST['update'])){
    $obj->updateRecord($_POST);
}

//Delete Record
if(isset($_GET['deleteid'])){
    $delid = $_GET['deleteid'];
    $obj->deleteRecord($delid);
}

//View Summary
if(isset($_GET['sumid'])){
    $sumid = $_GET['sumid'];
    $obj->viewSummary($sumid);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Book List</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
</head>

<body class=' indigo lighten-5'>
    <nav class=" indigo lighten-5 z-depth-0">
        <div class="container ">
            <a href="user-login-form/index.php" class="brand-logo deep-purple-text">Book List</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="./index.php" class="btn light-blue darken-4 z-depth-0">Home</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="center">Favorite Book List</h1>
        <?php
        //Fetch record for update
        if(isset($_GET['editid'])){
          $editid = $_GET['editid'];
          $myRecord = $obj->displayRecordByID($editid);
        ?>
        <!-- Upadate -->
        <div class="row  center">
            <form action="" method="POST">
                <div>
                    <div class="input-field">
                        <i class="material-icons prefix">book</i>
                        <input id="book" type="text" class="validate" value="<?php echo $myRecord['title'];?>"
                            name="bookTitle">
                        <label for="book">Book Name</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">person</i>
                        <input id="person" type="text" class="validate" value="<?php echo $myRecord['author'];?>"
                            name="author">
                        <label for="person">Author</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_emoticon</i>
                        <input id="genre" type="text" class="validate" value="<?php echo $myRecord['categories'];?>"
                            name="category">
                        <label for="genre">Genre</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">library_books</i>
                        <input type="number" class="validate" value="<?php echo $myRecord['pageNumber'];?>"
                            name="pageNum">
                        <label for="page-num">No.of Pages</label>
                    </div>
                </div>
                <input type="hidden" name="hid" value="<?php echo $myRecord['ID'];?>">
                <input class="waves-effect waves-light btn  indigo darken-3" name='update' type='submit'
                    value="Update Book">
            </form>
        </div>

        <?php 
        } else {
        ?>
        <div class="row  center">
            <form action="" method="POST">
                <div>
                    <div class="input-field">
                        <i class="material-icons prefix">book</i>
                        <input id="book" type="text" class="validate" name="bookTitle">
                        <label for="book">Book Name</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">person</i>
                        <input id="person" type="text" class="validate" name="author">
                        <label for="person">Author</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_emoticon</i>
                        <input id="genre" type="text" class="validate" name="category">
                        <label for="genre">Genre</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">library_books</i>
                        <input type="number" class="validate" name="pageNum">
                        <label for="page-num">No.of Pages</label>
                    </div>
                </div>
                <input class="waves-effect waves-light btn  teal darken-3" name='submit' type='submit' value="Add Book">
            </form>
        </div>

        <?php 
        } //else close
        ?>
        <table>
            <thead>
                <tr class='center'>
                    <th>#</th>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Category Price</th>
                    <th>No.of Pages</th>
                    <th colspan='2'>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                 //Display Record
                $data = $obj->displayRecord();
                $Sno=1;
                foreach($data as $value){
                    ?>
                <tr>
                    <td><?php echo $value['ID'];?></td>
                    <td><?php echo $value['title']?></td>
                    <td><?php echo $value['author']?></td>
                    <td><?php echo $value['categories']?></td>
                    <td><?php echo $value['pageNumber']?></td>
                    <td>
                        <a href="index.php?deleteid=<?php
                            echo $value['ID'];?>" class="waves-effect waves-light btn red accent-2" type='button'
                            value="Delete">Delete</a>
                        <a href="index.php?editid=<?php
                            echo $value['ID'];?>" class="waves-effect waves-light btn  teal darken-3" type='button'
                            name='updatebtn' value="Update">Update</a>
                        <a href="index.php?sumid=<?php
                            echo $value['ID'];?>" class="waves-effect waves-light btn  green darken-3" type='button'
                            name='sumbtn' value="Summary">Summary</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>

    <footer class="section">
        <div class="center grey-text">Copyright 2020 Adiba Abid</div>
    </footer>
    <!-- Script tags -->
    <script src="../js/sweetalert.min.js"></script>
    <script src="../js/script.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>