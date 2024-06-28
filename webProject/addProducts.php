<?php
require "dbconfig.in.php";

session_start();
if(isset($_SESSION["username"])&&$_SESSION['password']){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pro_name = isset($_POST['pro_name']) ? $_POST['pro_name'] : '';
        $pro_price = isset($_POST['pro_price']) ? $_POST['pro_price'] : '';
        $pro_cat = isset($_POST['pro_cat']) ? $_POST['pro_cat'] : '';
        $pro_quantity = isset($_POST['pro_quantity']) ? $_POST['pro_quantity'] : '';
        $pro_size = isset($_POST['pro_size']) ? $_POST['pro_size'] : '';
        $pro_des = isset($_POST['pro_des']) ? $_POST['pro_des'] : '';
        $pro_remarks = isset($_POST['pro_remarks']) ? $_POST['pro_remarks'] : '';
        $pro_image = isset($_FILES['pro_image']) ? $_FILES['pro_image'] : '';
        $pro_photoPath = '';
    
        if (!empty($pro_image['name'])) {
            $file_ext = strtolower(pathinfo($pro_image['name'], PATHINFO_EXTENSION));
    
            if ($file_ext !== 'jpeg') {
                echo ("Invalid extension for image");
            } else {
                $pro_photoPath = 'images/' . $pro_name . '_' . time() . '.jpeg';
                move_uploaded_file($pro_image['tmp_name'], $pro_photoPath);
            }
        }
    
        // insert to database 
        $stmt = $pdo->prepare("INSERT INTO product (pro_name, pro_price, pro_cat, pro_quantity, pro_size, pro_des, pro_remarks, pro_image) VALUES (:pro_name, :pro_price, :pro_cat, :pro_quantity, :pro_size, :pro_des, :pro_remarks, :pro_image)");
        $stmt->bindValue(':pro_name', $pro_name);
        $stmt->bindValue(':pro_price', $pro_price);
        $stmt->bindValue(':pro_cat', $pro_cat);
        $stmt->bindValue(':pro_quantity', $pro_quantity);
        $stmt->bindValue(':pro_size', $pro_size);
        $stmt->bindValue(':pro_des', $pro_des);
        $stmt->bindValue(':pro_remarks', $pro_remarks);
        $stmt->bindValue(':pro_image', $pro_photoPath);
        $stmt->execute();
        echo "Product added successfully!";
    }
}
else{
    header("Location: index.php");
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
                <!-- <a href="newSearch.php">new search</a> -->
            </nav>


        <main>
            <form method="post" enctype="multipart/form-data" class="main-addProducts" >
                <fieldset>
                    <legend>Add Products</legend>
                    <p>
                        <label>Product Name</label>
                        <input type="text" name="pro_name">
                    </p>
                    <p>
                        <label>Product Price</label>
                        <input type="text" name="pro_price">
                    </p>
                    <p>
                        <label>Category:
                            <select name="pro_cat" required>
                                <option value="new_arrival">New Arrival</option>
                                <option value="on_sale">On Sale</option>
                                <option value="featured">Featured</option>
                                <option value="high_demand">High Demand</option>
                                <option value="normal" selected>Normal</option>
                            </select>
                        </label><br>
                    </p>
                    <p>
                        <label>Product Quantity</label>
                        <input type="text" name="pro_quantity">
                    </p>
                    <p>
                        <label>Product Size</label>
                        <input type="text" name="pro_size">
                    </p>
                    <p>
                        <label>Product Description</label>
                        <input type="text" name="pro_des">
                    </p>
                    <p>
                        <label>Product Remarks</label>
                        <input type="text" name="pro_remarks">
                    </p>
                    <p>
                        <label>Product Image</label>
                        <input type="file" name="pro_image" accept=".jpeg">
                    </p>
                    <p>
                        <input type="submit" name="insert" value="Insert">
                    </p>
                </fieldset>
            </form>
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
