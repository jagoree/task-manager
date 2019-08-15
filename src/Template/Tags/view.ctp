<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<div class="col-md-12 col-xs-12">
    <h3><?= __('Tag') ?> "<?= $tag->caption ?>"</h3>
    <table class="table table-striped table-responsive-sm">
        <tr>
            <th scope="row">ID</th>
            <td><?= $this->Number->format($tag->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Caption') ?></th>
            <td><?= h($tag->caption) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $tag->created->format('d.m.Y H:i:s') ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related tasks') ?></h4>
        <?php if (!empty($tag->tasks)): ?>
        <table class="table table-hover table-responsive-sm">
            <tr>
                <th scope="col"><?= __('UUID') ?></th>
                <th scope="col"><?= __('Caption') ?></th>
                <th scope="col"><?= __('Priority') ?></th>
                <th scope="col"><?= __('Status') ?></th>
            </tr>
            <?php foreach ($tag->tasks as $task): ?>
            <tr>
                <td><?= h($task->uuid) ?></td>
                <td><?= $this->Html->link($task->caption, ['controller' => 'Tasks', 'action' => 'view', $task->id]) ?></td>
                <td><?= h($task->status_text) ?></td>
                <td><?= h($task->priority_text) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
