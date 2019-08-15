<?php

use Cake\Core\Configure;
?>
<nav class="navbar bg-light">
    <ul class="navbar nav">
        <?php if (!Configure::read('useAuth') or $this->request->getSession()->read('Auth.User.id')) { ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Tasks') ?>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= $this->Url->build(['_name' => 'tasks']) ?>"><?= __('List') ?></a>
                <a class="dropdown-item" href="<?= $this->Url->build(['_name' => 'add_task']) ?>"><?= __('Add') ?></a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Tags') ?>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= $this->Url->build(['_name' => 'tags']) ?>"><?= __('List') ?></a>
                <a class="dropdown-item" href="<?= $this->Url->build(['_name' => 'add_tag']) ?>"><?= __('Add') ?></a>
            </div>
        </li>
        <?php
        }
        if (Configure::read('useAuth')) {
            if ($this->request->getSession()->read('Auth.User.id')) {
                ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Users') ?>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= $this->Url->build(['_name' => 'users']) ?>"><?= __('List') ?></a>
                <a class="dropdown-item" href="<?= $this->Url->build(['_name' => 'add_user']) ?>"><?= __('Add') ?></a>
            </div>
        </li>
            <?php } ?>
        <li class="nav-item">
        <?php
        if ($this->request->getSession()->read('Auth.User.id')) {
            echo $this->Html->link(__('Logout'), ['_name' => 'logout']);
        } else {
            echo $this->Html->link(__('Sign in'), ['_name' => 'login']);
        }
        ?>
        </li>
        <?php } ?>
    </ul>
</nav>