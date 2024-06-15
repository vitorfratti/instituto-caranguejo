<?php

session_start();
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../db/db.php';

global $connect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($connect, $email);

    $query = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $user_id, $db_email, $db_password);
        mysqli_stmt_fetch($stmt);

        if (password_verify($password, $db_password)) {
            $cookie_value = bin2hex(random_bytes(16));
            setcookie('isAuth', $cookie_value, time() + 86400, "/");

            $_SESSION['user_id'] = $user_id;

            header("Location: " . base_url('/'));
            exit;
        } else {
            $_SESSION['error'] = "Dados incorretos. Tente novamente.";
        }
    } else {
        $_SESSION['error'] = "Dados incorretos. Tente novamente.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connect);

header("Location: " . base_url('/login'));
exit;

?>