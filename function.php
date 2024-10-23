<?php
// Koneksi database
function dbConnect() {
    $servername = "localhost"; // Ganti sesuai server Anda
    $username = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "kursus_bahasa_arab";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
}

// Fungsi registrasi
function registerUser($username, $password, $email) {
    $conn = dbConnect();
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $email);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    $stmt->close();
    $conn->close();
}

// Fungsi login
function loginUser($username, $password) {
    $conn = dbConnect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        return $user['id'];
    } else {
        return false;
    }
    $stmt->close();
    $conn->close();
}
?>
