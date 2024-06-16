<?php

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../db/db.php';

function get_user_info($user_id, $fields = []) {
    global $connect;

    $field_list = implode(", ", $fields);
    $query = "SELECT $field_list FROM users WHERE id = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    
    $result = [];
    $bind_result_args = [];
    foreach ($fields as $field) {
        $bind_result_args[] = &$result[$field];
    }
    call_user_func_array([$stmt, 'bind_result'], $bind_result_args);

    $stmt->fetch();
    $stmt->close();

    return $result;
}

function get_all_users($filter_name, $page, $limit = 30) {
    global $connect;

    $offset = ($page - 1) * $limit;

    $filter_query = $filter_name ? "WHERE name LIKE ?" : "";
    $sql = "SELECT * FROM users $filter_query LIMIT ? OFFSET ?";
    $stmt = $connect->prepare($sql);
    
    if ($filter_name) {
        $filter_name_param = '%' . $filter_name . '%';
        $stmt->bind_param("sii", $filter_name_param, $limit, $offset);
    } else {
        $stmt->bind_param("ii", $limit, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    
    return $users;
}

function get_total_user_count($filter_name) {
    global $connect;

    $filter_query = $filter_name ? "WHERE name LIKE ?" : "";
    $sql = "SELECT COUNT(*) as total FROM users $filter_query";
    $stmt = $connect->prepare($sql);

    if ($filter_name) {
        $filter_name_param = '%' . $filter_name . '%';
        $stmt->bind_param("s", $filter_name_param);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
    
    return $row['total'];
}

function delete_user($user_id) {
    global $connect;

    $query = "DELETE FROM users WHERE id = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . base_url('/membros'));

    return true;
}

function change_role($user_id, $new_role) {
    global $connect;

    if (!in_array($new_role, [1, 2])) {
        return false;
    }

    $query = "UPDATE users SET role = ? WHERE id = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param('ii', $new_role, $user_id);
    $stmt->execute();
    $stmt->close();

    return true;
}

function approve_user($user_id) {
    global $connect;

    $query = "UPDATE users SET approved = 1 WHERE id = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();

    return true;
}

function edit_user($user_id, $name, $email, $password) {
    global $connect;

    $query = "SELECT id FROM users WHERE email = ? AND id != ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $_SESSION['error'] = 'O email já está em uso por outro usuário.';
        return false;
    }
    $stmt->close();

    $query = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param("sssi", $name, $email, $password, $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['error'] = '';
    return true;
}

?>