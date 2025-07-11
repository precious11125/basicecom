<?php
$mysqli = new mysqli("localhost", "root", "", "lifechoicesshop");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
</html>
<!DOCTYPE html>
<html>
<head>
  <title>LifeChoices Shop</title>
  <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    h1 {
        color: #2c3e50;
        font-family: 'Segoe UI', Arial, sans-serif;
        font-size: 2.5em;
        text-align: center;
        margin-top: 40px;
        letter-spacing: 2px;
        text-shadow: 1px 1px 4px #ccc;
        padding: 20px;
    }
    .main-links {
        display: flex;
        justify-content: center;
        gap: 24px;
        margin: 30px 0 0 0;
    }
    .main-link-btn {
        display: inline-block;
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
    .main-link-btn:hover {
        background: #1c5d8c;
        transform: scale(1.05);
    }
    footer {
        margin-top: auto;
        background: #f2f2f2;
        padding: 20px 0;
        text-align: center;
        font-size: 1em;
        color: #555;
        border-top: 1px solid #ddd;
    }
    p {
        margin-left: 100px;
        margin-right: 100px;
        font-size: 1.2em;
        text-align: center;
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        color: black;
    }
    footer a {
        display: inline-block;
        margin: 6px 8px;
        padding: 8px 18px;
        background: #e74c3c;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s, transform 0.2s;
    }
    footer a:hover {
        background: #c0392b;
        transform: scale(1.05);
    }
</style>
</head>
<body>
  <h1>Welcome to LifeChoices Shop!</h1>
  <p>Browse meaningful products that inspire mindful living.</p>
  <div class="main-links">
    <a href="productspage.php" class="main-link-btn">View Products</a>
    <a href="loginpage.php" class="main-link-btn">Login</a>
    <a href="cartpage.php" class="main-link-btn">View Cart</a>
  </div>
</body>
<footer>
    <p>Contact us at: 0837221059</p>
    <p>Email: lolwanavuyisiweprecious@gmail.com</p>
    <p>Follow us on social media for the latest updates and offers!</p> 
    <a href="https://www.instagram.com/vuyisekalolwana/">Instagram Page</a>
    <a href="https://twitter.com/Vuyisekalolwana">Twitter Page</a>
    <a href="https://www.facebook.com/vuyisekalolwana.mavuyi.7">Facebook Page</a>
    <p>Thank you for visiting our website!</p>
    <p>&copy; 2023 Our Company. All rights reserved.</p>
</footer>
</html>