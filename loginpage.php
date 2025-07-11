<?php
$mysqli = new mysqli("localhost", "root", "", "lifechoicesshop");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT user_id FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password); // NOTE: Use hashed passwords in real apps
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header("Location: cartpage.php");
        exit;
    } else {
        $error = "Invalid login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            padding: 36px 32px 28px 32px;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.10);
            min-width: 340px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-card h2 {
            margin-top: 0;
            color: #2c3e50;
            margin-bottom: 18px;
        }
        .login-card form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .login-card input[type="text"],
        .login-card input[type="password"] {
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            outline: none;
            transition: border 0.2s;
        }
        .login-card input[type="text"]:focus,
        .login-card input[type="password"]:focus {
            border-color: #2980b9;
        }
        .login-card input[type="submit"] {
            background: #2980b9;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 0;
            font-size: 1em;
            font-weight: 500;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s, transform 0.2s;
        }
        .login-card input[type="submit"]:hover {
            background: #1c5d8c;
            transform: scale(1.03);
        }
        .login-card .error-msg {
            color: #e74c3c;
            margin-bottom: 10px;
            font-size: 0.98em;
        }
    </style>
</head>
<body>
<div class="login-card">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        Username:<br><input type="text" name="username"><br>
        Password:<br><input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>