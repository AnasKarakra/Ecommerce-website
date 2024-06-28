<!-- =========================================== PHP code  ========================================= -->
<?php
include "dbconfig.in.php";//conect data base using PDO
$stmt = $pdo->query("SELECT * FROM product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- =========================================== HTML Code =============================================== -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palestinian souvenirs shop</title>
    <link rel="stylesheet" href="indexStyle.css">
</head>
<body>
    <!-- ==================================== Header ========================================= -->
    <header>
         <div class="shopeName">
            <img src="logo.png" ><a href="index.php" class="logo"><span>Palestinian souvenirs shop</span></a>
        </div>
        <div class="user-profile">
            <a href="aboutUs.php">About Us</a><a href="Registration.php">Register</a><a href="login.php">Login</a><a href="index.php">Logout</a>
        </div>
    </header>
     <!-- ==================================== nav ========================================= -->
    <div  style="display: flex; flex: 1;">
            <nav class="navigation">
                <a href="index.php">Home</a>
                <a href="viewProducts.php">Products</a>
                <a href="search.php">search</a>
            </nav>

     <!-- ==================================== main ========================================= -->
            <main>
                        
                        <body class="product-view">
                           <?php foreach ($products as $product): ?>
                               <div class="product-box">
                                   <?php if (!empty($product['pro_image'])): ?>
                                       <img src="<?= $product['pro_image'] ?>" alt="<?= $product['pro_name'] ?>">
                                   <?php else: ?>
                                       <p>No Image</p>
                                   <?php endif; ?>
                                   <h3><?= $product['pro_name'] ?></h3>
                                   <p><strong>Price:$</strong><?= $product['pro_price'] ?></p>
                                   <p><strong>Category:</strong> <?= $product['pro_cat'] ?></p>
                                   <p><strong>Quantity:</strong> <?= $product['pro_quantity'] ?></p>
                                   <p><strong>Size:</strong> <?= $product['pro_size'] ?></p>
                                   <p><strong>Description:</strong> <?= $product['pro_des'] ?></p>
                                   <p><strong>Remarks:</strong> <?= $product['pro_remarks'] ?></p>
                                   
                               </div>
                           <?php endforeach; ?>
                       </body>
       
               </main>
    </div>
    <!-- ==================================== FOOTER ========================================= -->                              
    <footer>
        <div class="shopeName">
            <img src="logo.png" >
            <span> Palestinian souvenirs shope</span>
            <span class="copyright"> &copy;  2024 Palestinian Souvenirs Online Store </span>
            <a href="aboutUs.php" class="ContactUs">Contact Us</a>
        </div>
    </footer>   

</body>
</html>
