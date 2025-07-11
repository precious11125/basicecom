<?php
$mysqli = new mysqli("localhost", "root", "", "lifechoicesshop");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
<?php
session_start();

$user_id = $_SESSION['user_id'] ?? 1; // Default to johnboy

// Remove item
if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];
    $stmt = $mysqli->prepare("DELETE FROM cart WHERE cart_id=? AND user_id=?");
    $stmt->bind_param("ii", $cart_id, $user_id);
    $stmt->execute();
}

$stmt = $mysqli->prepare("
    SELECT cart.cart_id, items.item_name, items.item_price
    FROM cart
    JOIN items ON cart.item_id = items.item_id
    WHERE cart.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-top: 30px;
        }
        table {
            margin: 40px auto;
            border-collapse: collapse;
            width: 80%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 16px 20px;
            text-align: center;
        }
        th {
            background: #34495e;
            color: #fff;
            font-size: 1.1em;
        }
        tr {
            transition: background 0.2s;
        }
        tr:hover {
            background: #eaf6fb;
        }
        a.button, td a {
            display: inline-block;
            padding: 8px 18px;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s, transform 0.2s;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.07);
        }
        a.button:hover, td a:hover {
            background: #c0392b;
            transform: scale(1.05);
        }
        .back-link {
            display: block;
            width: fit-content;
            margin: 30px auto 0 auto;
            padding: 10px 24px;
            background: #2980b9;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s, transform 0.2s;
        }
        .back-link:hover {
            background: #1c5d8c;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h2>Your Cart</h2>
    <table border="1" cellpadding="10">
        <tr><th>Item</th><th>Price</th><th>Action</th></tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['item_name'] ?></td>
            <td>R<?= $row['item_price'] ?></td>
            <td><a href="?remove=<?= $row['cart_id'] ?>">Remove</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="productspage.php">Back to Products</a>
</body>
</html>