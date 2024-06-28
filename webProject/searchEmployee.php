<?php
require "dbconfig.in.php";
session_start();
if(isset($_SESSION["username"])&&$_SESSION['password']){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $searchKeyword = isset($_POST['searchKeyword']) ? $_POST['searchKeyword'] : '';
        $searchType = isset($_POST['searchType']) ? $_POST['searchType'] : '';
        $searchResults = [];
        if ($searchType === 'name') {
            $stmt = $pdo->prepare("SELECT * FROM product WHERE pro_name LIKE :searchKeyword");
            $stmt->bindValue(':searchKeyword', '%' . $searchKeyword . '%');
            $stmt->execute();
            $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }}
    else{
        header("Location: index.php");
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
            <form method="post">
                <fieldset>
                    <legend>Search Products</legend>
                    <p>
                        <label>Search by:</label>
                        <select name="searchType" required>
                            <option value="name">Product Name</option>
                            <option value="id">Product ID</option>
                        </select>
                    </p>
                    <p>
                        <label>Search Keyword:</label>
                        <input type="text" name="searchKeyword" required>
                    </p>
                    <p>
                        <input type="submit" name="search" value="Search">
                    </p>
                </fieldset>
            </form>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($searchResults)): ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searchResults as $result): ?>
                            <tr>
                                <td><?= $result['pro_name'] ?></td>
                                <td><a href="updateQuantity.php?id=<?= $result['id'] ?>"><?= $result['id'] ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
