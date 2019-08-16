<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="col-md-12">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
        <h3><?= __('Edit User') ?> "<?= h($user->name) ?>"</h3>
        <?php
            echo $this->Form->control('name', ['label' => __('Name')]);
            echo $this->Form->control('login', ['label' => __('Login')]);
            echo $this->Form->control('password', ['label' => __('Password')]);
        ?>
    </div>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('To list'), ['action' => 'index'], ['class' => 'btn btn-info ml-3']) ?>
    <?= $this->Form->end() ?>
</div>
