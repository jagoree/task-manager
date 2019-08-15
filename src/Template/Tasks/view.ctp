<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>
<div class="col-md-12 col-sm-12">
    <h3><?= h($task->caption) ?></h3>
    <table class="table table-striped table-responsive-sm">
        <tr>
            <th scope="row"><?= __('UUID') ?></th>
            <td><?= $task->uuid ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Caption') ?></th>
            <td><?= h($task->caption) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $task->status_text ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Priority') ?></th>
            <td><?= $task->priority_text ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $task->created->format('d.m.Y H:i:s') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $task->modified->format('d.m.Y H:i:s') ?></td>
        </tr>
        <?php
        $tags = [];
        foreach ($task->tags as $tag) {
            $tags[] = $this->Html->link($tag->caption, ['controller' => 'tags', 'action' => 'view', $tag->id]);
        }
        if (!empty($tags)) { ?>
        <tr>
            <th scope="row"><?= __('Tags') ?></th>
            <td>
                <?= implode(', ', $tags) ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
