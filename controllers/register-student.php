<?php

include '../config/config.php';
include '../db/db.php';

global $connect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $registration_number = $_POST['registration-number'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $institution = $_POST['institution'];
    $hours_to_be_validated = $_POST['hours-to-be-validated'];
    $password = $_POST['password'];
    $role = 3;

    $stmt = $connect->prepare("INSERT INTO users (name, email, phone, registration_number, course, year, institution, hours_to_be_validated, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param("ssssssssss", $name, $email, $phone, $registration_number, $course, $year, $institution, $hours_to_be_validated, $password, $role);

    if ($stmt->execute()) {
        $stmt->close();
        $connect->close();
        header("Location: " . base_url('/'));
        exit();
    } else {
        $stmt->close();
        $connect->close();
        header("Location: " . base_url('/cadastro/aluno'));
        exit();
    }
}

?>