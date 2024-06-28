<?php
include "dbconfig.in.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['productId']) ? $_POST['productId'] : '';
    $newQuantity = isset($_POST['newQuantity']) ? $_POST['newQuantity'] : '';

    $stmt = $pdo->prepare("UPDATE product SET pro_quantity = :newQuantity WHERE id = :productId");
    $stmt->bindValue(':newQuantity', $newQuantity);
    $stmt->bindValue(':productId', $productId);
    $stmt->execute();
    header("Location: searchEmployee.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Quantity</title>
    <link rel="stylesheet" href="EmployeeStyle.css">
</head>
<body>
    <header>
        <div class="shopeName">
            <img src="logo.png">
            <a href="EmployeePanel.php" class="logo"><span>Palestinian souvenirs shop</span></a>
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
                <a href="EmployeePanel.php">Home</a>
                <a href="viewProducts.php">Products</a>
                <a href="addProducts.php">add Products</a>
                <a href="searchEmployee.php">update Quantity</a>
                <!-- <a href="newSearch.php">new search</a> -->
            </nav>

        <main class="main-updateQuantity">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])): ?>
                <?php
                $productId = $_GET['id'];
                $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :productId");
                $stmt->bindValue(':productId', $productId);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>

                <form method="post">
                    <fieldset>
                        <legend>Update Quantity</legend>
                        <p>
                            <label>Product Name:</label>
                            <?= $product['pro_name'] ?>
                        </p>
                        <p>
                            <label>Current Quantity:</label>
                            <?= $product['pro_quantity'] ?>
                        </p>
                        <p>
                            <label>New Quantity to Add:</label>
                            <input type="number" name="newQuantity" required>
                        </p>
                        <input type="hidden" name="productId" value="<?= $productId ?>">
                        <p>
                            <input type="submit" name="updateQuantity" value="Update Quantity">
                        </p>
                    </fieldset>
                </form>
            <?php endif; ?>
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
