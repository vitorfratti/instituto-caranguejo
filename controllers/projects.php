<?php

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../db/db.php';
session_start();

function create_project() {
    global $connect;

    $project_name = $_POST['project-name'];
    $project_description = $_POST['project-description'];
    $project_link = $_POST['project-link'];
    $project_date = $_POST['project-date'];

    $query = "SELECT * FROM projects WHERE name = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('s', $project_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Já existe um projeto com esse nome.";
        header("Location: " . base_url('/projetos'));
        exit;
    }

    $slug = create_project_slug($project_name);

    $query = "INSERT INTO projects (name, description, link, date, slug) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('sssss', $project_name, $project_description, $project_link, $project_date, $slug);
    $stmt->execute();

    header("Location: " . base_url('/projetos'));
    exit;
}

function create_project_slug($project_name) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $project_name)));
    
    global $connect;
    $query = "SELECT * FROM projects WHERE slug = ?";
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-project'])) {
    create_project();
    exit;
}

function delete_project($project_id) {
    global $connect;

    $query = "DELETE FROM projects WHERE id = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param('i', $project_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . base_url('/projetos'));

    return true;
}

function get_all_projects($filter_name = '', $limit = 20, $offset = 0) {
    global $connect;

    $query = "SELECT * FROM projects";
    if (!empty($filter_name)) {
        $query .= " WHERE name LIKE ?";
        $filter_name = '%' . $filter_name . '%';
    }
    $query .= " LIMIT ? OFFSET ?";

    $stmt = $connect->prepare($query);
    if (!empty($filter_name)) {
        $stmt->bind_param('sii', $filter_name, $limit, $offset);
    } else {
        $stmt->bind_param('ii', $limit, $offset);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Erro ao buscar projetos: " . $connect->error);
    }

    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    return $projects;
}

function count_all_projects($filter_name = '') {
    global $connect;

    $query = "SELECT COUNT(*) as total FROM projects";
    if (!empty($filter_name)) {
        $query .= " WHERE name LIKE ?";
        $filter_name = '%' . $filter_name . '%';
    }

    $stmt = $connect->prepare($query);
    if (!empty($filter_name)) {
        $stmt->bind_param('s', $filter_name);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Erro ao contar projetos: " . $connect->error);
    }

    $row = $result->fetch_assoc();

    return $row['total'];
}

function get_project_info($slug) {
    global $connect;

    $query = "SELECT * FROM projects WHERE slug = ?";
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