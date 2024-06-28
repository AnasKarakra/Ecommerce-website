<?php
include "dbconfig.in.php";

// Check if the user is logged in as an employee, if not, redirect to login page
session_start();
if (isset($_SESSION['username']) || $_SESSION['isadmin'] == 1) {
    // Fetch orders from the database, sorted by order status and order date
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY oreder_status DESC, order_date ASC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else{
    header("Location: login.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestinian souvenirs shop</title>
    <link rel="stylesheet" href="EmployeeStyle.css">
</head>
<body>
    <header>
         <div class="shopeName">
            <img src="logo.png" >
            <a href="EmployeePanel.php" class="logo"><span>Palestinian souvenirs shop</span></a>
        </div>

        <div class="user-profile">
            <!-- <h2>Admin Panel</h2> -->
            <a href="aboutUs.php">About Us</a>
            <a href="Registration.php">Register</a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div  style="display: flex; flex: 1;">
            <nav class="navigation">
                <a href="EmployeePanel.php">Home</a>
                <a href="viewProducts.php">Products</a>
                <a href="addProducts.php">add Products</a>
                <a href="searchEmployee.php">update Quantity</a>
                <a href="employeeViewOrder.php">view Orders</a>
                <!-- <a href="newSearch.php">new search</a> -->
            </nav>


        <main>
                                        
            <body>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Order Date</th>
                                <th>Order Total Amount</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><a href="employeeOrderDetails.php?order_id=<?= $order['order_id'] ?>" target="_blank"><?= $order['order_id'] ?></a></td>
                                    <td><?= $order['order_date'] ?></td>
                                    <td><?= $order['order_amount'] ?></td>
                                    <td><?= $order['oreder_status'] ?></td>
                                    <td>
                                        <a href="employeeUpdateOrder.php?order_id=<?= $order['order_id'] ?>" target="_blank">Update Status</a>
                                    </td>
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
