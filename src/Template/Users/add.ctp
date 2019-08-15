<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="col-md-12">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
        <h3><?= __('Add User') ?></h3>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('login');
            echo $this->Form->control('password');
        ?>
    </div>
    <?= $this->Form->button(__('Add'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('To list'), ['action' => 'index'], ['class' => 'btn btn-info ml-3']) ?>
    <?= $this->Form->end() ?>
</div>
