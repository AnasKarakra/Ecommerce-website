<?php
include "dbconfig.in.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect=view_product.php");
    exit();
}
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$product) {
        echo "Product not found!";
        exit();
    }
} else {
    echo "Product ID is missing!";
    exit();
}
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found!";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = isset($_POST['quantity']) ? ($_POST['quantity']) : 1;
    $orderAmount = $product['pro_price'] * $quantity;

    // Insert order into the database
    $stmt = $pdo->prepare("INSERT INTO orders (pro_id, user_id, order_amount, order_date, oreder_status) VALUES (:pro_id, :user_id, :order_amount, NOW(), 'waiting for processing')");
    $stmt->bindParam(':pro_id', $product_id);
    $stmt->bindParam(':user_id', $user['id']); 
    $stmt->bindParam(':order_amount', $orderAmount);

    if ($stmt->execute()) {
        echo "Order added successfully!";
    } else {
        echo "Error adding order!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestinian souvenirs shop - Search Products</title>
    <link rel="stylesheet" href="custmerStyle.css">
</head>
<body>
    <header>
        <div class="shopeName">
            <img src="logo.png">
            <a href="custmerPage.php" class="logo"><span>Palestinian souvenirs shop</span></a>
        </div>

        <div class="user-profile">
            <a href="aboutUs.php">About Us</a>
            <a href="Registration.php">Register</a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div style="display: flex; flex: 1;">
            <nav class="navigation">
                <a href="custmerPage.php">Home</a>
                <a href="viewProducts.php">Products</a>
                <a href="searchCustomer.php">Search</a>
                <a href="custmerViewOrder.php">view orders</a>
            </nav>

            <main class="ProductDetails">
                <h2>Product Details</h2>
                <img src="<?= $product['pro_image'] ?>" alt="<?= $product['pro_name'] ?>" style="max-width: 200px;"><br>
                <strong>ID:</strong> <?= $product['id'] ?><br>
                <strong>Name:</strong> <?= $product['pro_name'] ?><br>
                <strong>Price:</strong> <?= $product['pro_price'] ?><br>
                <strong>Category:</strong> <?= $product['pro_cat'] ?><br>
                <strong>Quantity:</strong> <?= $product['pro_quantity'] ?><br>

                <!-- Add to Order Form -->
                <form action="view_product.php?product_id=<?= $product['id'] ?>" method="post">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                    <button type="submit">Add to Order</button>
                </form>
            </main>
    </div>

    <footer>
        <div class="shopeName">
            <img src="logo.png">
            <span> Palestinian souvenirs shope</span>
            <span class="copyright"> &copy;  2024 Palestinian Souvenirs Online Store. All rights reserved.</span>
            <a href="aboutUs.php" class="ContactUs">Contact Us</a>
        </div>
    </footer>

</body>
</html>
