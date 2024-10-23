<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Bahasa Arab</title>
    <!-- <link rel="stylesheet" href="style.css">  -->
     <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body */
        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        body {
            width: 1000px;
            margin: auto;
            margin-top: 15%;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1a5276, #3498db, #1a5276, #3498db);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            color: #E2F1E7;
            line-height: 1.6;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        /* Header styling */
        header {
            background-color: #2980b9;
            color: #E2F1E7;
            text-align: center;
            padding: 20px 0;
            border-radius: 10px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Heading utama */
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        /* Main section */
        main {
            margin: 20px 0;
        }

        h2 {
            font-size: 1.8rem;
            color: #E2F1E7;
        }

        p {
            font-size: 1.1rem;
            color: #E2F1E7;
        }

        /* Styling navigasi */
        nav ul {
            list-style-type: none;
            margin: 20px 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 15px;
        }

        nav ul li a {
            background-color: #243642;
            color: #E2F1E7;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #629584;
        }

        /* Responsif untuk perangkat mobile */
        @media (max-width: 768px) {
            header {
                padding: 15px;
            }

            h1 {
                font-size: 2rem;
            }

            nav ul li {
                display: block;
                margin-bottom: 10px;
            }

            nav ul li a {
                display: block;
                text-align: center;
            }
        }
     </style>
</head>
<body>
    <header>
        <h1>Selamat Datang di Kursus Bahasa Arab</h1>
    <main>
        <h2>Pendaftaran Kursus</h2>
        <p>Silakan login atau daftar untuk memulai.</p>
    </main>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Daftar</a></li>
            </ul>
        </nav>
    </header>
    
</body>
</html>
