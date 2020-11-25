<?php
require('user-validator.php');


if(isset($_POST['submit'])){
    //validate the entries
    $validation = new UserValidator($_POST); 
    $errors = $validation->validateForm();  
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Form With OOP</title>
</head>

<body>
    <div class="new-user">
        <h2>Create new user</h2>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? "") ?> ">
            <div class="error">
                <?php
                echo $errors['username'] ?? ''
                ?>
            </div>

            <label>Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? "") ?>">
            <div class="error">
                <?php
                echo $errors['password'] ?? ''
                ?>
            </div>

            <input type="submit" value="submit" name="submit">

        </form>
    </div>
</body>

</html>