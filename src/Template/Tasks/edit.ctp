<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>
<div class="col-md-12">
    <h3><?= __('Editing task') ?> &quot;<?= $task->caption ?>&quot;</h3>
    <?= $this->Form->create($task, ['templates' => 'form']) ?>
    <div class="form-group">
        <?php
        echo $this->Form->control('uuid', ['label' => __('UUID'), 'readonly' => true]);
        echo $this->Form->control('caption', ['label' => __('Caption')]);
        echo $this->Form->control('status', $schema['status']);
        echo $this->Form->control('priority', $schema['priority']);
        echo $this->Form->control('tags._ids', ['options' => $tags, 'type' => 'select', 'multiple' => 'checkbox', 'label' => __('Tags') . ':', 'templates' => [
            'inputContainer' => '<div class="form-group checkboxes">{{content}}</div>',
            'checkboxWrapper' => '<div class="form-check form-check-inline">{{label}}</div>',
        ]]);
        echo $this->Form->button(__('Save'), ['class' => 'btn btn-primary']);
        echo $this->Html->link(__('To list'), ['action' => 'index'], ['class' => 'btn btn-info ml-3']);
        ?>
    </div>
    <?= $this->Form->end() ?>
</div>
