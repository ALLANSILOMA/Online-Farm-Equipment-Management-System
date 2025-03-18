<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_farm_equipment_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$toastclass = isset($_SESSION['toastclass']) ? $_SESSION['toastclass'] : "";

unset($_SESSION['message']);
unset($_SESSION['toastclass']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $other_names = $_POST['other_names'];
    $location = $_POST['location'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($first_name) || empty($surname) || empty($other_names) || empty($location) || empty($phone_number) || empty($username) || empty($email) || empty($password) || empty($role)) {
        $_SESSION["message"] = "Please fill in all fields.";
        $_SESSION["toastclass"] = "#ffc107";
    } else {
        $checkEmailStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        if ($checkEmailStmt) {
            $checkEmailStmt->bind_param("s", $email);
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                $_SESSION["message"] = "Error: Email already exists. Please choose another email.";
                $_SESSION["toastclass"] = "#ffc107";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (first_name, surname, other_names, location, phone_number, username, email, password, role) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                if ($stmt) {
                    $stmt->bind_param("sssssssss", $first_name, $surname, $other_names, $location, $phone_number, $username, $email, $hashed_password, $role);

                    if ($stmt->execute()) {
                        $_SESSION["email"] = $email;
                        $_SESSION["message"] = "Account created successfully!";
                        $_SESSION["toastclass"] = "#28a745";

                        echo "<div style='background-color: {$_SESSION['toastclass']}; padding: 10px; color: white;'> {$_SESSION['message']}</div>";
                        session_write_close();
                        sleep(5);
                        header("location: login.php");
                        exit();
                    } else {
                        $_SESSION["message"] = "Account Registration Failed. Try again.";
                        $_SESSION["toastclass"] = "#dc3545";
                    }
                    $stmt->close();
                }
            }
            $checkEmailStmt->close();
        }
    }
    header("Refresh:0; url=register.php");
    exit();
}
$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background-image: url('assets/4f36b2650c0afaaf9af210e44fa69317.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        .card {
            background: rgb(255, 255, 255);
            border-radius: 15px;
            padding: 2rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .title {
            font-family: Roboto, sans-serif;
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #000;
            text-align: center;
            font-style: normal;
            line-height: normal;
        }

        .subtitle {
            color: #000000;
            text-align: center;
            font-family: Roboto, sans-serif;
            font-size: 1.5rem;
            font-style: normal;
            font-weight: 300;
            line-height: normal;
        }

        .avatar {
            width: 96px;
            height: 96px;
            background-color: #9eacb6;
            border-radius: 50%;
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar i {
            font-size: 48px;
            color: black;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .input {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1.5rem;
            text-align: left;
            font-family: Roboto, sans-serif;
            font-style: normal;
            font-weight: 300;
            border-radius: 0.5rem;
            border: 1px solid #000;
            background: #FFF;
        }

        .button {
            width: 100%;
            padding: 0.75rem;
            background-color: #00C48CFF;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin: 0.5rem 0;
        }

        .button:hover {
            background-color: #2c28a7;
        }

        .footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 1rem;
            font-family: Poppins, sans-serif;
        }

        .footer a {
            color: #00C48CFF;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="card">
    <?php if (!empty($message)): ?>
        <div style="background-color: <?= $toastclass ?>; padding: 10px; color: white;">
            <?= $message ?>
       </div>



    <?php endif; ?>


    <div class="header">
        <h1 class="title">Sign Up</h1>
        <p class="subtitle">Create a free account with your email.</p>
    </div>

    <div class="avatar">
        <i class="fa-solid fa-user"></i>
    </div>

    <form class="form" id="signup" action="" method="post" autocomplete="on">
        <input type="text" name="first_name" placeholder="First Name" class="input" required>
        <input type="text" name="surname" placeholder="Surname" class="input" required>
        <input type="text" name="other_names" placeholder="Other Names" class="input" required>
        <input type="text" name="location" placeholder="Location" class="input" required>
        <input type="email" name="email" placeholder="Email" class="input" required>
        <input type="tel" name="phone_number" placeholder="Phone Number" class="input" required>
        <input type="text" name="username" placeholder="Username" class="input" required>
        <input type="password" name="password" placeholder="Password" class="input" required>

        <select id="role" name="role" class="input" required>
            <option value="" disabled selected>Select a Role</option>
            <option value="Admin">Admin</option>
            <option value="Equipment Owner">Equipment Owner</option>
            <option value="Farmer">Farmer</option>
        </select>

        <button type="submit" class="button">Sign up</button>
    </form>

    <div class="footer">
        Have an account? <a href="login.php">Log in</a>
    </div>
</div>

</body>
</html>