<?php
    ini_set('display_errors', 'on');

    require 'admin/bd.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the order details from the database
$order_id = $_SESSION['order_id'];
$query = "SELECT * FROM commande WHERE id = $order_id";
$result = $conn->query($query);
$order = $result->fetch_assoc();

// Get the line items for the order from the database
$query = "SELECT article.designation, article.prix, ligne_commande.quantite
          FROM ligne_commande
          INNER JOIN article ON ligne_commande.article_id = article.id
          WHERE ligne_commande.commande_id = $order_id";
$result = $conn->query($query);
$line_items = $result->fetch_all(MYSQLI_ASSOC);

// Calculate the total cost of the order
$total_cost = 0;
foreach ($line_items as $item) {
    $total_cost += $item['prix'] * $item['quantite'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Order Confirmation</h2>
    <p>Thank you for your order!</p>

    <h3>Order Details</h3>
    <p><strong>Order Number:</strong> <?php echo $order['num']; ?></p>
    <p><strong>Date:</strong> <?php echo $order['date']; ?></p>
    <p><strong>Delivery Address:</strong> <?php echo $order['adresse_livraison']; ?></p>

    <h3>Order Items</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($line_items as $item): ?>
                <tr>
                    <td><?php echo $item['designation']; ?></td>
                    <td><?php echo $item['prix']; ?> €</td>
                    <td><?php echo $item['quantite']; ?></td>
                    <td><?php echo $item['prix'] * $item['quantite']; ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total:</strong></td>
                <td><strong><?php echo $total_cost; ?> €</strong></td>
            </tr>
        </tfoot>
    </table>

    <form action="place_order.php" method="post">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <button type="submit" class="btn btn-primary">Confirm Order</button>
    </form>
</div>

</body>
</html>
