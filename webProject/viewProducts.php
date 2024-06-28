<!-- =========================================== PHP code  ========================================= -->
<?php
require "dbconfig.in.php";
$stmt = $pdo->query("SELECT * FROM product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- =========================================== HTML Code  =============================================== -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Table</title>
<!-- =========================================== Style in Same Page  =============================================== -->
    <style>
        body  {
            font-family: Arial, sans-serif;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: flex-start;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        table th {
        background-color: #190ef0;
        font-weight: bold;
        color: #090808;
        }
        table tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        
        table tr:nth-child(even) {
            background-color: #93dc89;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<!-- =========================================== HTML Code body =============================================== -->
<body class="viewProducts">
    <h2>Product List</h2>
    <table class="productsTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Category</th>
                <th>Product Quantity</th>
                <th>Product Size</th>
                <th>Product Description</th>
                <th>Product Remarks</th>
                <th>Product Image</th>
            </tr>
        </thead>
        <tbody>
            <!-- display all products in table  -->
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['pro_name'] ?></td>
                    <td><?= $product['pro_price'] ?></td>
                    <td><?= $product['pro_cat'] ?></td>
                    <td><?= $product['pro_quantity'] ?></td>
                    <td><?= $product['pro_size'] ?></td>
                    <td><?= $product['pro_des'] ?></td>
                    <td><?= $product['pro_remarks'] ?></td>
                    <td>
                        <?php if (!empty($product['pro_image'])): ?>
                            <img src="<?= $product['pro_image'] ?>" alt="<?= $product['pro_name'] ?>" width="50">
                        <?php else: ?>
                            There is no Image
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
