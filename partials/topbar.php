<?php

include_once __DIR__ . '/../controllers/users.php';

$user_id = $_SESSION['user_id'];
$user_info = get_user_info($user_id, ['name']);

?>

<nav class="topbar">
    <span>
        <div class="profile">
            <span>
                <img src="<?= base_url('assets/images/svg/user-profile.svg') ?>" alt="user-profile">
                <?= $user_info['name'] ?>
            </span>
        </div>
    </span>
</nav>