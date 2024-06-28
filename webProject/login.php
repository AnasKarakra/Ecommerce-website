<?php
include "dbconfig.in.php";
session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['login'])) {

            $username=$_POST['username'];
            $password=$_POST['password'];
        
            $stmt=$pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
            $stmt->bindvalue(':username',$username);
            $stmt->bindvalue(':password',$password);
            $stmt->execute();
            $data=$stmt->fetch();
            if($data){
                if($data['isadmin']==0){
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['isAdmin'] = 0;
                    header("location: custmerPage.php");
                    exit();
                }else{
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['isAdmin'] = 1;
                    header("location: EmployeePanel.php");
                    exit();
                   
                }
               
            }
            else{
                echo "there is an error in username or in password";
               
            }
        
            
        }
    }
 ?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="registrationStyle.css">
</head>
<body>

    <div class="wrapper">
        <form action="" method="post">
            
            <h1>Login Page </h1>
            <div class="input-box">
                <div class="input-field-E">
                    <input type="text" placeholder="Enter username" name="username" >
                </div>
            </div>
            <div class="input-box">
                <div class="input-field-E">
                    <input type="password" placeholder="Enter password" name="password">
                </div>
            </div>
            <div class="button">
                <input type="submit" name="login" value="login">
            </div>
            <div class="button-reg">
                <p>i don't have an account : <a href="Registration.php">Register</a> </p>
               
            </div>
        </form>
        <?php
        ?>
    </div>

</body>
</html>
