<?php

session_start();

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../db/db.php';

global $connect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 2;
    $redirect_success = $_POST['redirect_success'];
    $redirect_error = $_POST['redirect_error'];

    $stmt_check_email = $connect->prepare("SELECT id FROM users WHERE email = ?");
    
    if ($stmt_check_email === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $stmt_check_email->store_result();

    if ($stmt_check_email->num_rows > 0) {
        $_SESSION['error'] = "Este email já está em uso. Por favor, escolha outro.";

        $stmt_check_email->close();
        $connect->close();
        header("Location: " . base_url($redirect_error));
        exit();
    }

    $stmt_check_email->close();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt_insert_user = $connect->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    
    if ($stmt_insert_user === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt_insert_user->bind_param("sssi", $name, $email, $hashed_password, $role);

    if ($stmt_insert_user->execute()) {
        $stmt_insert_user->close();
        $connect->close();
        header("Location: " . base_url($redirect_success));
        exit();
    } else {
        $stmt_insert_user->close();
        $connect->close();
        header("Location: " . base_url($redirect_error));
        exit();
    }
}

?>