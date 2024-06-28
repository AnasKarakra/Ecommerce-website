<?php
include "dbconfig.in.php";
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $stmtProduct = $pdo->prepare("SELECT * FROM product WHERE id = :pro_id");
        $stmtProduct->bindParam(':pro_id', $order['pro_id']);
        $stmtProduct->execute();
        $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestinian Souvenirs Shop</title>
    <link rel="stylesheet" href="custmerStyle.css">
</head>
<body class="viewOrderId">
    <header>
        <div class="shopeName">
            <img src="logo.png" alt="Shop Logo">
            <a href="custmerPage.php" class="logo"><span>Palestinian Souvenirs Shop</span></a>
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
            <a href="custmerViewOrder.php">View Orders</a>
        </nav>
            
        <main>
            <h2>Order Details</h2>
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
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= $order['order_date'] ?></td>
                        <td><?= $order['order_amount'] ?></td>
                        <td><?= $order['oreder_status'] ?></td>
                    </tr>
                </tbody>
            </table>

            <h2>Product Details</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['pro_name'] ?></td>
                        <td><?= $product['pro_price'] ?></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>

    <footer>
        <div class="shopeName">
            <img src="logo.png" alt="Shop Logo">
            <span>Palestinian Souvenirs Shop</span>
            <span class="copyright">&copy; 2024 Palestinian Souvenirs Online Store. All rights reserved.</span>
            <a href="aboutUs.php" class="ContactUs">Contact Us</a>
        </div>
    </footer>
</body>
</html>


<?php
} else {
echo "Order not found!";
}
} else {
echo "Order ID is missing!";
}
?>
