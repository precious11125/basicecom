<?php
$mysqli = new mysqli("localhost", "root", "", "lifechoicesshop");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
<?php


// Always use user_id = 1 (johnboy) if not logged in
$user_id = 1;

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $stmt = $mysqli->prepare("INSERT INTO cart (item_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $item_id, $user_id);
    $stmt->execute();
}

$result = $mysqli->query("SELECT * FROM items");
?>
<?php
session_start();

$user_id = $_SESSION['user_id'] ?? 1; // Use logged-in user or default to 1

$added = false;
if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $stmt = $mysqli->prepare("INSERT INTO cart (item_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $item_id, $user_id);
    $stmt->execute();
    $added = true;
}

$result = $mysqli->query("SELECT * FROM items");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
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
        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin: 40px auto;
            max-width: 1200px;
        }
        .product-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border: 1px solid #e0e0e0;
            width: 260px;
            padding: 24px 18px 18px 18px;
            text-align: center;
            transition: box-shadow 0.2s, transform 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .product-card:hover {
            box-shadow: 0 6px 20px rgba(41, 128, 185, 0.13);
            transform: translateY(-6px) scale(1.03);
            border-color: #2980b9;
        }
        .product-card img {
            width: 180px;
            height: 180px;
            object-fit: contain;
            margin-bottom: 16px;
            border-radius: 8px;
            background: #f2f2f2;
        }
        .product-card strong {
            color: #34495e;
            font-size: 1.15em;
        }
        .product-card form {
            margin-top: 14px;
        }
        .product-card input[type="submit"] {
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 22px;
            font-size: 1em;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.07);
        }
        .product-card input[type="submit"]:hover {
            background: #c0392b;
            transform: scale(1.05);
        }
        .view-cart-link {
            display: block;
            width: fit-content;
            margin: 40px auto 0 auto;
            padding: 12px 28px;
            background: #2980b9;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1em;
            transition: background 0.2s, transform 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.07);
        }
        .view-cart-link:hover {
            background: #1c5d8c;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h2>Our Products</h2>
    <?php if ($added): ?>
        <div style="background:#d4edda;color:#155724;padding:12px 20px;margin:20px auto;width:fit-content;border-radius:6px;border:1px solid #c3e6cb;">
            Item added to cart!
        </div>
    <?php endif; ?>
    <div class="products-container">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product-card">
                <img src="<?= $row['item_url'] ?>" alt="<?= htmlspecialchars($row['item_name']) ?>">
                <strong><?= htmlspecialchars($row['item_name']) ?></strong><br>
                <span><?= htmlspecialchars($row['item_description']) ?></span><br>
                <strong>R<?= $row['item_price'] ?></strong><br>
                <form method="POST">
                    <input type="hidden" name="item_id" value="<?= $row['item_id'] ?>">
                    <input type="submit" value="Add to Cart">
                </form>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="cartpage.php" class="view-cart-link">View Cart</a>
</body>
</html>