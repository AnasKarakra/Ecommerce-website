<?php
include "dbconfig.in.php";
$productName = '';
$minPrice = null;
$maxPrice = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $minPrice = isset($_POST['min_price']) ? $_POST['min_price'] : null;
    $maxPrice = isset($_POST['max_price']) ? $_POST['max_price'] : null;
    $sql = "SELECT * FROM product WHERE 1";

    if (!empty($productName)) {
        $sql .= " AND (pro_name LIKE :product_name OR pro_name LIKE :partial_product_name)";
    }

    if ($minPrice !== null && $maxPrice !== null) {
        $sql .= " AND (pro_price BETWEEN :min_price AND :max_price OR (pro_price IS NULL AND :min_price IS NULL AND :max_price IS NULL))";
    }

    $stmt = $pdo->prepare($sql);

    if (!empty($productName)) {
        $stmt->bindValue(':product_name', '%' . $productName . '%');
        $stmt->bindValue(':partial_product_name', $productName . '%');
    }

    if ($minPrice !== null && $maxPrice !== null) {
        $stmt->bindParam(':min_price', $minPrice);
        $stmt->bindParam(':max_price', $maxPrice);
    }

    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestinian souvenirs shop - Search Products</title>
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

        <main class="main-searchProducts">
                <body>
                    <h2>Product Search</h2>
                    <form method="post" action="">
                        <label>Product Name: <input type="text" name="product_name" value="<?= $productName ?>"></label><br>
                        <label>Minimum Price: <input type="number" name="min_price" step="0.01" value="<?= $minPrice ?>"></label><br>
                        <label>Maximum Price: <input type="number" name="max_price" step="0.01" value="<?= $maxPrice ?>"></label><br>
                        <button type="submit">Search</button>
                    </form>

                    <?php if (isset($products)): ?>
                        <h3>Search Results</h3>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Toggle Checked</th>
                                    <th>Reference Number</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Product Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr class="category<?= $product['pro_cat'] ?>">
                                        <td><input type="checkbox" name="checked_items[]" value="<?= $product['id'] ?>"></td>
                                        <td><a href="view_product.php?product_id=<?= $product['id'] ?>" target="_blank"><?= $product['id'] ?></a></td>
                                        <td><?= $product['pro_price'] ?></td>
                                        <td><?= $product['pro_cat'] ?></td>
                                        <td><?= $product['pro_quantity'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                </body>
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
