<?php 
include "dbconfig.in.php";
session_start();

if (isset($_SESSION["username"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['confirm'])) {
            $name = $_SESSION['name'];
            $address = $_SESSION['address'];
            $dob = $_SESSION['dob'];
            $idNumber = $_SESSION['idNumber'];
            $email = $_SESSION['email'];
            $telephone = $_SESSION['telephone'];
            $creditCardNumber = $_SESSION['creditCardNumber'];
            $expirationDate = $_SESSION['expirationDate'];
            $cardHolderName = $_SESSION['cardHolderName'];
            $issuedBank = $_SESSION['issuedBank'];
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];

            
            $stmt = $pdo->prepare("INSERT INTO users (name, address, dob, idnumber, email, tel, creditcardnumber, expirationdate, cardname, issuedbank, username, password) VALUES (:name, :address, :dob, :idNumber, :email, :telephone, :creditCardNumber, :expirationDate, :cardHolderName, :issuedBank, :username, :password)");
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':address', $address);
            $stmt->bindValue(':dob', $dob);
            $stmt->bindValue(':idNumber', $idNumber);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':telephone', $telephone);
            $stmt->bindValue(':creditCardNumber', $creditCardNumber);
            $stmt->bindValue(':expirationDate', $expirationDate);
            $stmt->bindValue(':cardHolderName', $cardHolderName);
            $stmt->bindValue(':issuedBank', $issuedBank);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();

            
            session_destroy();
            session_start();
            $_SESSION['username']=$username;
            header("Location: confirmation2.php");
            exit();
        }
    }
} else {
    
    header("Location: EAccount.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>
    <link rel="stylesheet" href="registrationStyle.css">
</head>
<body>

<div class="wrapper">
        <form action="" method="post">
            <h1>Confirmation Page(Your Information)</h1>
            <div class="input-box">
                <div class="input-field">
                <p>Name: <?php echo $_SESSION['name']; ?></p>
                </div>
                <div class="input-field">
                <p>Address: <?php echo $_SESSION['address']; ?></p>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                <p>Date of Birth: <?php echo $_SESSION['dob']; ?></p>
                </div>
                <div class="input-field">
                <p>ID Number: <?php echo $_SESSION['idNumber']; ?></p>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                    <p>Email: <?php echo $_SESSION['email']; ?></p>
                </div>
                <div class="input-field">
                    <p>Telephone: <?php echo $_SESSION['telephone']; ?></p>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                 <p>Credit Card Number: <?php echo $_SESSION['creditCardNumber']; ?></p>
                </div>
                <div class="input-field">
                 <p>Expiration Date: <?php echo $_SESSION['expirationDate']; ?></p>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                    <p>Card Holder Name: <?php echo $_SESSION['cardHolderName']; ?></p>
                </div>
                <div class="input-field">
                    <p>Issued Bank: <?php echo $_SESSION['issuedBank']; ?></p>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field-E">
                <p>Your Username: <?php echo $_SESSION['username']; ?></p>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field-E">
                <p>Your password: <?php echo $_SESSION['password']; ?></p>
                </div>
            </div>
            <div class="button">
                <input type="submit" name="confirm" value="confirm">
            </div>
           
        </form>
    </div>
    
</body>
</html>