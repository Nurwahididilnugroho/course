<?php
session_start();
require 'function.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = dbConnect();
$user_id = $_SESSION['user_id'];

// Ambil informasi pengguna
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Ambil kursus yang didaftarkan pengguna
$stmt = $conn->prepare("
    SELECT courses.course_name, courses.description, course_registrations.registered_at, course_registrations.status 
    FROM course_registrations 
    JOIN courses ON course_registrations.course_id = courses.id 
    WHERE course_registrations.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$registrations = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
            /* Reset CSS */
            * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling umum untuk body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f6fa;
            color: #2f3640;
            line-height: 1.6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Kontainer utama */
        .container {
            max-width: 1000px;
            width: 100%;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Header (Judul dan Selamat Datang) */
        h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 1.1rem;
            color: #34495e;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Tautan (logout, isi kursus) */
        a {
            display: inline-block;
            background-color: #2980b9;
            color: white;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2f3640;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2980b9;
            color: white;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        tbody tr:nth-child(even) {
            background-color: #2980b9;
        }

        tbody tr:hover {
            background-color: #eaeaea;
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 1.8rem;
            }

            table, th, td {
                font-size: 0.9rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Dashboard</h2>
    <p>Selamat datang, <?php echo htmlspecialchars($user['username']); ?>!</p>
    <a href="logout.php">Logout</a>
    <a href="register_course.php">Isi Kursus</a>

    <h3>Kursus yang Terdaftar</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Kursus</th>
                <th>Deskripsi</th>
                <th>Tanggal Pendaftaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($registration = $registrations->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($registration['course_name']); ?></td>
                    <td><?php echo htmlspecialchars($registration['description']); ?></td>
                    <td><?php echo htmlspecialchars($registration['registered_at']); ?></td>
                    <td><?php echo htmlspecialchars($registration['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</body>
</html>
