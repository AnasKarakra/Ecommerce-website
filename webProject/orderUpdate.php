<?php
include "dbconfig.in.php";

// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id AND user_id = :user_id");
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_SESSION['username'], PDO::PARAM_INT);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $stmtItems = $pdo->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $stmtItems->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmtItems->execute();
        $orderItems = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST['quantity'] as $itemId => $newQuantity) {
                $stmtUpdate = $pdo->prepare("UPDATE order_items SET quantity = :quantity WHERE item_id = :item_id AND order_id = :order_id");
                $stmtUpdate->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':item_id', $itemId, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $stmtUpdate->execute();
            }
            header("Location: orderUpdate.php?order_id=$order_id");
            exit();
        }
        $totalAmount = 0;
        foreach ($orderItems as $item) {
            $totalAmount += ($item['pro_price'] * $item['quantity']);
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Order Update</title>
        </head>
        <body>
            <h2>Order Update - Order ID: <?= $order_id ?></h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td><?= $item['pro_id'] ?></td>
                            <td><?= $item['pro_name'] ?></td>
                            <td><?= $item['pro_price'] ?></td>
                            <td>
                                <form method="post">
                                    <input type="number" name="quantity[<?= $item['item_id'] ?>]" value="<?= $item['quantity'] ?>" min="0">
                                    <input type="submit" value="Update">
                                </form>
                            </td>
                            <td><a href="removeItem.php?item_id=<?= $item['item_id'] ?>&order_id=<?= $order_id ?>">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p>Total Order Amount: $<?= $totalAmount ?></p>

            <p><a href="checkout.php?order_id=<?= $order_id ?>">Proceed to Checkout</a></p>
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
