<?php
session_start();
require 'function.php';

// Pastikan hanya admin yang bisa mengakses halaman ini
// Misalnya, tambahkan kondisi di sini (misalnya $_SESSION['is_admin'])

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $max_students = $_POST['max_students'];

    $conn = dbConnect();
    $stmt = $conn->prepare("INSERT INTO courses (course_name, description, max_students) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $course_name, $description, $max_students);
    if ($stmt->execute()) {
        $success = "Kursus berhasil ditambahkan.";
    } else {
        $error = "Gagal menambahkan kursus.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kursus</title>
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
            background-color: #f5f6fa;
            color: #2f3640;
            line-height: 1.6;
            padding: 20px;

            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container form */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        /* Styling judul */
        h2 {
            font-size: 2rem;
            color: #2980b9;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Styling label dan input form */
        label {
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: block;
            color: #34495e;
        }

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 1rem;
            color: #2f3640;
            background-color: #ecf0f1;
        }

        /* Styling untuk button */
        button {
            background-color: #2980b9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #27ae60;
        }

        /* Styling untuk pesan sukses atau error */
        .message {
            font-size: 1rem;
            text-align: center;
            margin-top: 20px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        /* Responsif untuk mobile */
        @media (max-width: 768px) {
            .form-container {
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
    <h2>Tambah Kursus</h2>
    <form action="courses.php" method="POST">
        <label for="course_name">Nama Kursus:</label>
        <input type="text" id="course_name" name="course_name" required>
        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="max_students">Jumlah Maksimal Siswa:</label>
        <input type="number" id="max_students" name="max_students" required>
        <button type="submit">Tambah Kursus</button>
    </form>

    <a href="dashboard.php">Kembali</a>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
