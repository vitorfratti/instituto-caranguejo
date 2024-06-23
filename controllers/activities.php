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
    $query .= " LIMIT ? OFFSET ?";

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

?>