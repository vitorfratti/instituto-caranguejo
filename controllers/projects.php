<?php

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../db/db.php';

function create_project() {
    global $connect;

    $project_name = $_POST['project-name'];
    $project_description = $_POST['project-description'];
    $project_link = $_POST['project-link'];
    $project_date = $_POST['project-date'];

    $query = "INSERT INTO projects (name, description, link, date) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('ssss', $project_name, $project_description, $project_link, $project_date);
    $stmt->execute();

    header("Location: " . base_url('/projetos'));
    exit;
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

function get_all_projects() {
    global $connect;

    $query = "SELECT * FROM projects";
    $result = $connect->query($query);

    if (!$result) {
        die("Erro ao buscar projetos: " . $connect->error);
    }

    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    return $projects;
}

?>