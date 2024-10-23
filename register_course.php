<?php
session_start();
require 'function.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = dbConnect();
$user_id = $_SESSION['user_id'];

// Ambil daftar kursus
$courses = $conn->query("SELECT * FROM courses");

// Jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];

    // Memeriksa apakah pengguna sudah terdaftar di kursus ini
    $stmt = $conn->prepare("SELECT * FROM course_registrations WHERE user_id = ? AND course_id = ?");
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Anda sudah terdaftar di kursus ini.";
    } else {
        // Daftarkan pengguna ke kursus
        $stmt = $conn->prepare("INSERT INTO course_registrations (user_id, course_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $course_id);
        if ($stmt->execute()) {
            $success = "Anda berhasil mendaftar ke kursus.";
        } else {
            $error = "Gagal mendaftar ke kursus.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kursus</title>
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
            color: #2c3e50;
            line-height: 1.6;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Kontainer untuk form */
        .form-container {
            background-color: #387478;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        /* Judul h2 */
        h2 {
            text-align: center;
            color: solid black;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Styling untuk label dan select */
        label {
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: block;
            color: solid black;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #ecf0f1;
            color: #E2F1E7;
        }

        /* Tombol submit */
        button {
            background-color: #2980b9;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1f6398;
        }

        /* Pesan sukses dan error */
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

        a {
            color: #387478;
            text-decoration: none;
        }

        a:hover {
            color: solid red;
        }

        /* Responsif untuk layar kecil */
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
    <h2>Daftar Kursus</h2>
    <form action="register_course.php" method="POST">
        <label for="course_id">Pilih Kursus:</label>
        <select id="course_id" name="course_id" required>
            <?php while ($course = $courses->fetch_assoc()): ?>
                <option value="<?php echo $course['id']; ?>">
                    <?php echo $course['course_name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Daftar</button>
        <br>
        <br>
        <a href="dashboard.php">Kembali</a>
    </form>

    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
