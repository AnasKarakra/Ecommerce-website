<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['dob'] = $_POST['dob'];
            $_SESSION['idNumber'] = $_POST['idNumber'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['telephone'] = $_POST['telephone'];
            $_SESSION['creditCardNumber'] = $_POST['creditCardNumber'];
            $_SESSION['expirationDate'] = $_POST['expirationDate'];
            $_SESSION['cardHolderName'] = $_POST['cardHolderName'];
            $_SESSION['issuedBank'] = $_POST['issuedBank'];
            header("Location: EAccount.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="registrationStyle.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="post">
            <h1>Registration Page</h1>
            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Enter name" name="name" required>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Enter address" name="address" required>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                    <input type="date" name="dob" required>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Enter ID number" name="idNumber" required>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                    <input type="email" placeholder="Enter email" name="email" required>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Enter telephone number" name="telephone" required>
                </div>
            </div>
            <h2>Enter your credit card details </h2>
            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Enter credit card number" name="creditCardNumber" required>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Enter expiration date" name="expirationDate" required>
                </div>
            </div>
            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Enter card holder name" name="cardHolderName" required>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Enter issued bank" name="issuedBank" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="Next">
            </div>
        </form>
    </div>
</body>
</html>
