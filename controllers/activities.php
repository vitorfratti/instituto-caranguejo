<?php

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../db/db.php';

function create_activity() {
    global $connect;

    $activity_name = $_POST['activity-name'];
    $activity_link = $_POST['activity-link'];
    $activity_date = $_POST['activity-date'];
    $project_id = $_POST['project-id'];
    $current_project_url = $_POST['current-project-url'];

    $query = "SELECT * FROM activities WHERE name = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('s', $activity_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Já existe uma atividade com esse nome.";
        header("Location: " . $current_project_url);
        exit;
    }

    $slug = create_activity_slug($activity_name);

    $query = "INSERT INTO activities (name, link, date, slug, project_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('sssss', $activity_name, $activity_link, $activity_date, $slug, $project_id);
    $stmt->execute();

    header("Location: " . $current_project_url);
    exit;
}

function create_activity_slug($activity_name) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $activity_name)));
    
    global $connect;
    $query = "SELECT * FROM activities WHERE slug = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    $original_slug = $slug;
    $i = 1;

    while ($result->num_rows > 0) {
        $slug = $original_slug . '-' . $i;
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $i++;
    }

    return $slug;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-activity'])) {
    create_activity();
    exit;
}

function delete_activity($activity_id, $current_project_url) {
    global $connect;

    $query = "DELETE FROM activities WHERE id = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param('i', $activity_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $current_project_url);

    return true;
}

function get_all_activities($filter_name = '', $limit = 20, $offset = 0, $project_id = null) {
    global $connect;

    $query = "SELECT * FROM activities WHERE project_id = ?";
    if (!empty($filter_name)) {
        $query .= " AND name LIKE ?";
        $filter_name = '%' . $filter_name . '%';
    }
    $query .= " ORDER BY date DESC LIMIT ? OFFSET ?";

    $stmt = $connect->prepare($query);
    if (!empty($filter_name)) {
        $stmt->bind_param('isii', $project_id, $filter_name, $limit, $offset);
    } else {
        $stmt->bind_param('iii', $project_id, $limit, $offset);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Erro ao buscar atividades: " . $connect->error);
    }

    $activities = [];
    while ($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }

    return $activities;
}

function count_all_activities($filter_name = '', $project_id = null) {
    global $connect;

    $query = "SELECT COUNT(*) as total FROM activities WHERE project_id = ?";
    if (!empty($filter_name)) {
        $query .= " AND name LIKE ?";
        $filter_name = '%' . $filter_name . '%';
    }

    $stmt = $connect->prepare($query);
    if (!empty($filter_name)) {
        $stmt->bind_param('is', $project_id, $filter_name);
    } else {
        $stmt->bind_param('i', $project_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Erro ao contar atividades: " . $connect->error);
    }

    $row = $result->fetch_assoc();

    return $row['total'];
}

function get_activity_info($slug) {
    global $connect;

    $query = "SELECT * FROM activities WHERE slug = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function add_students_to_activity($activity_id, $user_ids) {
    global $connect;
    $query_insert = "INSERT INTO student_activities (user_id, activity_id) VALUES (?, ?)";
    $stmt_insert = $connect->prepare($query_insert);

    foreach ($user_ids as $user_id) {
        $query_check = "SELECT COUNT(*) FROM student_activities WHERE user_id = ? AND activity_id = ?";
        $stmt_check = $connect->prepare($query_check);
        $stmt_check->bind_param('ii', $user_id, $activity_id);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count == 0) {
            $stmt_insert->bind_param('ii', $user_id, $activity_id);
            $stmt_insert->execute();
        }
    }

    $stmt_insert->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-students-to-activity'])) {
    $activity_id = $_POST['activity-id'];
    $user_ids = explode(',', $_POST['students-ids']);
    $current_activity_url = $_POST['current-activity-url'];

    add_students_to_activity($activity_id, $user_ids);

    header("Location: " . $current_activity_url);
    exit;
}

function get_students_by_activity($activity_id, $filter_name, $page, $limit = 30) {
    global $connect;

    $offset = ($page - 1) * $limit;

    $filter_query = $filter_name ? "AND users.name LIKE ?" : "";
    $sql = "
        SELECT users.*
        FROM users
        JOIN student_activities ON users.id = student_activities.user_id
        WHERE student_activities.activity_id = ? $filter_query
        LIMIT ? OFFSET ?
    ";
    $stmt = $connect->prepare($sql);

    if ($filter_name) {
        $filter_name_param = '%' . $filter_name . '%';
        $stmt->bind_param("isii", $activity_id, $filter_name_param, $limit, $offset);
    } else {
        $stmt->bind_param("iii", $activity_id, $limit, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    
    return $users;
}

function get_total_student_count_by_activity($activity_id, $filter_name) {
    global $connect;

    $filter_query = $filter_name ? "AND users.name LIKE ?" : "";
    $sql = "
        SELECT COUNT(*) as total
        FROM users
        JOIN student_activities ON users.id = student_activities.user_id
        WHERE student_activities.activity_id = ? $filter_query
    ";
    
    $stmt = $connect->prepare($sql);

    if ($filter_name) {
        $filter_name_param = '%' . $filter_name . '%';
        $stmt->bind_param("is", $activity_id, $filter_name_param);
    } else {
        $stmt->bind_param("i", $activity_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
    
    return $row['total'];
}

function remove_student_from_activity($user_id, $activity_id) {
    global $connect;

    $query = "DELETE FROM student_activities WHERE user_id = ? AND activity_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('ii', $user_id, $activity_id);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove-user-from-activity'])) {
    $user_id = $_POST['user_id'];
    $activity_id = $_POST['activity_id'];
    $current_activity_url = $_POST['current-activity-url'];

    remove_student_from_activity($user_id, $activity_id);

    header("Location: " . $current_activity_url);
    exit;
}

function set_score_activity($user_id, $activity_id, $score) {
    global $connect;

    $query = "UPDATE student_activities SET score = ? WHERE user_id = ? AND activity_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('iii', $score, $user_id, $activity_id);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['set-score-activity'])) {
    $user_id = $_POST['user_id'];
    $activity_id = $_POST['activity_id'];
    $score = $_POST['score'];
    $current_activity_url = $_POST['current-activity-url'];

    set_score_activity($user_id, $activity_id, $score);

    header("Location: " . $current_activity_url);
    exit;
}

function get_score_from_student($user_id, $activity_id) {
    global $connect;

    $query = "SELECT score FROM student_activities WHERE user_id = ? AND activity_id = ? LIMIT 1";
    $stmt = $connect->prepare($query);
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $connect->error);
    }
    $stmt->bind_param('ii', $user_id, $activity_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $score = null;
    if ($row = $result->fetch_assoc()) {
        $score = $row['score'];
    }

    $stmt->close();
    
    return $score;
}

?>