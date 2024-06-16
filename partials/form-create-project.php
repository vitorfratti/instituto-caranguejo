<?php

include_once __DIR__ . '/../controllers/projects.php';

?>

<form
class="form"
id="create-project"
action=""
method="POST">
    <input type="hidden" name="create-project">
    <span data-input="project-name">
        <div class="input">
            <input type="text" name="project-name" placeholder="Nome do projeto">
        </div>
        <p class="invalid-text none">O nome do projeto deve ser preenchido.</p>
    </span>
    <span data-input="project-description">
        <div class="input">
            <textarea name="project-description" placeholder="Descrição do projeto"></textarea>
        </div>
        <p class="invalid-text none">A descrição do projeto deve ser preenchida.</p>
    </span>
    <span data-input="project-link">
        <div class="input">
            <input type="text" name="project-link" placeholder="Link do projeto (opcional)">
        </div>
    </span>
    <input type="date" name="project-date" style="display: none;">
    <div class="submit">
        <button type="button">CRIAR PROJETO</button>
    </div>
</form>