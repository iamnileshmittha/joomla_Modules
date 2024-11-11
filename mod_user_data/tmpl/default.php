<?php
defined('_JEXEC') or die;

if (empty($userList)) : ?>
    <p>No users found in the selected groups.</p>
<?php else : ?>
    <ul class="user-list">
        <?php foreach ($userList as $user) : ?>
            <li>
                <?php if ($params->get('show_name')) : ?>
                    <span>Name: <?php echo htmlspecialchars($user->name); ?></span>
                <?php endif; ?>
                <?php if ($params->get('show_username')) : ?>
                    <span>Username: <?php echo htmlspecialchars($user->username); ?></span>
                <?php endif; ?>
                <?php if ($params->get('show_email')) : ?>
                    <span>Email: <?php echo htmlspecialchars($user->email); ?></span>
                <?php endif; ?>
                <?php if ($params->get('show_register_date')) : ?>
                    <span>Registered: <?php echo htmlspecialchars($user->registerDate); ?></span>
                <?php endif; ?>
                <?php if ($params->get('show_last_login')) : ?>
                    <span>Last Login: <?php echo htmlspecialchars($user->lastvisitDate); ?></span>
                <?php endif; ?>
                <?php if ($params->get('show_user_group')) : ?>
                    <span>Group: <?php echo htmlspecialchars($user->usergroup); ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
