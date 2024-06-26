<?php

include_once __DIR__ . '/../controllers/activities.php';
include_once __DIR__ . '/../controllers/users.php';

$users = get_all_users($filter_name, 1);

?>

<form class="form" id="add-student-activity" action="" method="POST">
    <input type="hidden" name="add-students-to-activity">
    <input type="hidden" name="activity-id" value="<?= $activity_id ?>">
    <input type="hidden" name="current-activity-url">
    <span data-input="students-select">
        <div class="input">
            <input list="students-list" id="students-input" name="students-input" placeholder="Selecione os alunos"/>
            <datalist id="students-list">
                <?php foreach($users as $user): ?>
                    <?php if(intval($user['role']) == 3): ?>
                        <option value="<?= $user['name'] ?>" data-id="<?= $user['id'] ?>"></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </datalist>
        </div>
        <p class="invalid-text none">Pelo menos 1 aluno deve ser selecionado.</p>
    </span>
    <span class="input" data-input="students-names">
        <div class="textarea" id="selected-students"></div>
    </span>
    <span class="input" data-input="students-ids" style="display: none;">
        <textarea id="students-ids" name="students-ids"></textarea>
    </span>
    <div class="submit">
        <button type="button" id="add-student-button">ADICIONAR ALUNOS</button>
    </div>
</form>