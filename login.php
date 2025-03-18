<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_farm_equipment_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);

$message = "";
$toastclass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($username) && !empty($password)) {

        $stmt = $conn->prepare("SELECT username, password FROM users WHERE email=? AND username=?");

        if (!$stmt){
            die("Error in SQL statement: " .$conn->error);
        }
        $stmt->bind_param("ss",  $email,$username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_username, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $db_username;
                $_SESSION['email'] = $email;

                header("location:homepage.php");
                exit();
            } else {
                $message = "Incorrect username or password";
                $toastclass = "#dc3545";
            }

        }
        $stmt->close();
    }else{
        $message="Please fill in all the required fields";
        $toastclass = "#dc3545";
    }
}
$conn->close();
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <style>
        body {
            box-sizing: border-box;
            font-family: Oswald, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('assets/login.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-container {
            font-family: Oswald, sans-serif;
            width: 100%;
            max-width: 420px;
            padding: 32px;
            border-radius: 8px;
            backdrop-filter: blur(1.5px);
            background: rgba(255, 255, 255, 0.15);
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            color: white;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        input {
            width: 100%;
            height: 48px;
            padding: 0 16px;
            border: none;
            border-radius: 4px;
            background-color: white;
            font-size: 16px;
            color: #333;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        }

        button {
            width: 100%;
            height: 48px;
            background: linear-gradient(#00FF00 0%, #4BA457 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .signup-text {
            margin-top: 16px;
            text-align: center;
            color: white;
            font-size: 14px;
        }

        .signup-text a {
            color: #1702ff;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Sign In to your Account</h2>
    <?php if (!empty($message)) : ?>
        <div class="alert <?= $toastclass ?>"><?= $message ?></div>
    <?php endif; ?>

    <form id="signin" action="" method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login">Submit</button>
        <div class="signup-text">
            New Here? <a href="Register.php">Create Account</a>
        </div>
    </form>
</div>
</body>
</html>