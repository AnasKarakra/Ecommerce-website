<?php
include "dbconfig.in.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect=customerViewOrder.php");
    exit();
}
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found!";
    exit();
}
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC");
$stmt->bindParam(':user_id', $user['id']);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestinian souvenirs shop</title>
    <link rel="stylesheet" href="custmerStyle.css">
</head>
<body>
    <header>
         <div class="shopeName">
            <img src="logo.png" >
            <a href="custmerPage.php" class="logo"><span>Palestinian souvenirs shop</span></a>
        </div>

        <div class="user-profile">
            <a href="aboutUs.php">About Us</a>
            <a href="Registration.php">Register</a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div  style="display: flex; flex: 1;">
            <nav class="navigation">
                <a href="custmerPage.php">Home</a>
                <a href="viewProducts.php">Products</a>
                <a href="searchCustomer.php">Search</a>
                <a href="custmerViewOrder.php">view orders</a>
            </nav>


        <main>
                        
        <body>
            <h2>Your Orders</h2>
            <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Order Total Amount</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><a href="viewOrderId.php?order_id=<?= $order['order_id'] ?>" target="_blank"><?= $order['order_id'] ?></a></td>
                        <td><?= $order['order_date'] ?></td>
                        <td><?= $order['order_amount'] ?></td>
                        <td><?= $order['oreder_status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>

        </main>
    </div>

    <footer>
        <div class="shopeName">
            <img src="logo.png" >
            <span> Palestinian souvenirs shope</span>
            <span class="copyright"> &copy;  2024 Palestinian Souvenirs Online Store. All rights reserved.</span>
            <a href="aboutUs.php" class="ContactUs">Contact Us</a>
        </div>
    </footer>   

</body>
</html>