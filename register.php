<?php
session_start();
require 'function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (registerUser($username, $password, $email)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Gagal registrasi! Username atau email mungkin sudah terdaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <style>
          /* Reset CSS */
          * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            color: #2c3e50;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        /* Kontainer untuk form login */
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        /* Judul h2 */
        h2 {
            text-align: center;
            color: #2980b9;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Styling untuk form */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #34495e;
        }

        input[type="text"], 
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        /* Tombol login */
        button {
            background-color: #2980b9;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1f6398;
        }

        /* Link pendaftaran */
        p {
            text-align: center;
            margin-top: 20px;
            font-size: 1rem;
        }

        p a {
            color: #2980b9;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Pesan error */
        .error {
            color: red;
            text-align: center;
            font-size: 1rem;
            margin-top: 10px;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }

            h2 {
                font-size: 1.8rem;
            }

            button {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <h2>Daftar</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Daftar</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>
