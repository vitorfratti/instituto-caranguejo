<?php

include '../config/config.php';
include '../db/db.php';

global $connect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 2;

    $stmt = $connect->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        $stmt->close();
        $connect->close();
        header("Location: " . base_url('/'));
        exit();
    } else {
        $stmt->close();
        $connect->close();
        header("Location: " . base_url('/cadastro/funcionario'));
        exit();
    }
}

?>