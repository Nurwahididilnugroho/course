<?php
// Koneksi ke database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursus_bahasa_arab";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Membuat database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database berhasil dibuat.<br>";
} else {
    echo "Error membuat database: " . $conn->error;
}

// Pilih database
$conn->select_db($dbname);

// Membuat tabel `users`
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabel `users` berhasil dibuat.<br>";
} else {
    echo "Error membuat tabel `users`: " . $conn->error;
}

// Membuat tabel `courses`
$sql = "CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    description TEXT,
    max_students INT DEFAULT 30,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabel `courses` berhasil dibuat.<br>";
} else {
    echo "Error membuat tabel `courses`: " . $conn->error;
}

// Membuat tabel `course_registrations`
$sql = "CREATE TABLE IF NOT EXISTS course_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabel `course_registrations` berhasil dibuat.<br>";
} else {
    echo "Error membuat tabel `course_registrations`: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
