<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<div class="col-md-12">
    <h3><?= __('New tag') ?></h3>
    <?= $this->Form->create($tag, ['templates' => 'form']) ?>
    <div class="form-group">
        <?php
        echo $this->Form->control('caption', ['label' => __('Caption')]);
        echo $this->Form->button(__('Add'), ['class' => 'btn btn-primary']);
        echo $this->Html->link(__('To list'), ['action' => 'index'], ['class' => 'btn btn-info ml-3']);
        ?>
    </div>
    <?= $this->Form->end() ?>
</div>