<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        header("Location: problemlist.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
     <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #1e1e2f, #2a2a40, #3b3b56);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
            color: white;
            position: relative;
        }

        h1.welcome {
            font-size: 36px;
            margin-top: 30px;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease forwards;
            text-shadow: 1px 1px 5px #000;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            width: 350px;
            text-align: center;
            animation: fadeInUp 1s ease forwards;
        }

        .form-container h2 {
            margin-bottom: 25px;
            font-size: 24px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        input::placeholder {
            color: #eee;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        button:hover {
            transform: scale(1.05);
        }

        .form-container p {
            margin-top: 15px;
            font-size: 14px;
        }

        .form-container a {
            color: #ffd700;
            text-decoration: none;
        }

        .form-container a:hover {
            text-decoration: underline;
        }

        .error {
            background-color: rgba(255, 0, 0, 0.2);
            border-left: 5px solid red;
            padding: 10px;
            margin-bottom: 15px;
            color: #ffdddd;
            border-radius: 5px;
        }

        footer {
            margin-top: auto;
            padding: 20px;
            font-size: 14px;
            color: #fff;
            opacity: 0.8;
            text-align: center;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        footer:hover {
            transform: scale(1.05);
            color: #ffdd57;
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <h1>Welcomme to CodeArena</h1>
<div class="form-container">
    <h2>Signup</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Sign Up</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>
<footer>Made with ❤️ by Vishal</footer>
</body>
</html>
