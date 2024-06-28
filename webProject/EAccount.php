<?php
include "dbconfig.in.php";
session_start();
    if(isset($_SESSION["name"])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['submit'])) {
                $username=$_POST['username'];
                $stmt=$pdo->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->bindvalue(':username',$username);
                $stmt->execute();
                $data=$stmt->fetch();
                if($data){
                    echo "this user name used by anther one";
                }
                else{
                if ($_POST['password'] == $_POST['cPassword']) {
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password'];
                    header("Location: confirmation.php");
                    exit();
                } else {
                    echo 'The passwords do not match.';
                }
             }
            }
        }
    }
    else{
        header("Location: Registration.php");
    }

  
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Account</title>
    <link rel="stylesheet" href="registrationStyle.css">
</head>
<body>

    <div class="wrapper">
        <form action="" method="post">
            
            <h1>E-Account</h1>
            <div class="input-box">
                <div class="input-field-E">
                    <input type="text" placeholder="Enter username" name="username" required minlength="6" maxlength="13" >
                </div>
            </div>
            <div class="input-box">
                <div class="input-field-E">
                    <input type="password" placeholder="Enter password" name="password" required minlength="8" maxlength="12">
                </div>
            </div>
            <div class="input-box">
                <div class="input-field-E">
                    <input type="password" placeholder="Confirm password" name="cPassword" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="Next">
            </div>
        </form>
    </div>

</body>
</html>
