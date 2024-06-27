<?php

include_once __DIR__ . '/../controllers/activities.php';

?>

<form
class="form"
id="edit-activity"
action=""
method="POST">
    <input type="hidden" name="edit-activity">
    <input type="hidden" name="activity-id" value="<?= $activity['id'] ?>">
    <input type="hidden" name="current-project-url">
    <span data-input="activity-name">
        <div class="input">
            <input
            type="text"
            name="activity-name"
            placeholder="Nome da atividade"
            value="<?= $activity['name'] ?>"
            required>
        </div>
    </span>
    <span data-input="activity-link">
        <div class="input">
            <input
            type="text"
            name="activity-link"
            placeholder="Link da atividade (opcional)"
            value="<?= $activity['link'] ?>">
        </div>
    </span>
    <input type="date" name="activity-date" style="display: none;">
    <div class="submit">
        <button type="submit">EDITAR ATIVIDADE</button>
    </div>
</form>