<?php
include "dbconfig.in.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: rgb(224, 227, 225);
            font-family: "Poppins", sans-serif;
        }

        form {
            text-align: center;
            background: rgb(224, 227, 225);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 18px;
            color: green;
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 20px;
        }

        .button a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #e81616;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .button a:hover {
            background-color: #c41515;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Confirmation Page</h1>
        <h3>Registration Done Successfully</h3>
        <?php 
            $username = $_SESSION['username'];
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $userid = $stmt->fetch();
        ?>
        <p>Your User ID: <?php echo $userid['id']; ?></p>
        <div class="button">
            <a href="login.php">Login</a>
        </div>
    </form>
</body>
</html>
