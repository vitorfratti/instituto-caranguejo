<?php

include_once __DIR__ . '/../controllers/activities.php';

$project_id = $project_info['id'];

?>

<form
class="form"
id="create-activity"
action=""
method="POST">
    <input type="hidden" name="create-activity">
    <input type="hidden" name="project-id" value="<?= $project_id ?>">
    <input type="hidden" name="current-project-url">
    <span data-input="activity-name">
        <div class="input">
            <input type="text" name="activity-name" placeholder="Nome da atividade">
        </div>
        <p class="invalid-text none">O nome da atividade deve ser preenchido.</p>
    </span>
    <span data-input="activity-link">
        <div class="input">
            <input type="text" name="activity-link" placeholder="Link da atividade (opcional)">
        </div>
    </span>
    <input type="date" name="activity-date" style="display: none;">
    <div class="submit">
        <button type="button">CRIAR ATIVIDADE</button>
    </div>
</form>