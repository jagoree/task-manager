<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */
?>
<div class="col-md-12 col-sm-12">
    <h3><?= __('List of tasks') ?></h3>

    <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
            <tr>
                <th class="col-md-4 align-top"><?= __('UUID') ?></th>
                <th class="sortable col-md-4 align-top"><?= $this->Paginator->sort('caption', __('Caption')) ?></th>
                <th class="sortable align-top"><?= $this->Paginator->sort('status', __('Status')) ?></th>
                <th class="sortable align-top"><?= $this->Paginator->sort('priority', __('Priority')) ?></th>
                <th class="sortable align-top"><?= $this->Paginator->sort('created', __('Created')) ?></th>
                <th class="col-md-1 align-top"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tasks as $task):
                $tags = [];
                ?>
                <tr>
                    <td><?= $task->uuid ?></td>
                    <td>
                        <?= $this->Html->link($task->caption, ['action' => 'view', $task->id]) ?>
                        <?php
                        $task_tags = [];
                        $query_tags = $this->request->getQuery('tags', []);
                        foreach ($task->tags as $tag) {
                            $caption = $this->Html->link($tag->caption, ['?' => ['tags' => array_merge($query_tags, [$tag->id])]]);
                            if (in_array($tag->id, $query_tags)) {
                                $caption = $tag->caption;
                                $tags[$tag->id] = $this->Html->link(null, ['?' => ['tags' => array_diff($query_tags, [$tag->id])]], ['class' => 'badge badge-danger fa-times']) . $caption;
                            }
                            $task_tags[] = $caption;
                        }
                        if (!empty($task_tags)) {
                            ?>
                            <br>Теги:
                            <?php
                            echo implode(', ', $task_tags);
                        }
                        ?>
                    </td>
                    <td><?= h($task->status_text) ?></td>
                    <td><?= h($task->priority_text) ?></td>
                    <td><?= h($task->created->format('d.m.Y H:i')) ?></td>
                    <td>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $task->id]) ?>
                        <?= $this->Html->link(__('Remove'), '#', ['class' => 'remove', 'data-href' => $this->Url->build(['action' => 'delete', $task->id]), 'data-csrf' => $this->request->getParam('_csrfToken')]) ?>
                    </td>
                </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($tags) { ?>
        <p>Фильтр тегов: <?= implode(', ', $tags) ?></p>
    <?php } ?>
<?= $this->Html->link(__('Add'), ['_name' => 'add_task'], ['class' => 'btn btn-primary']) ?>
<?= $this->element('paginator') ?>
</div>
<?= $this->element('modal') ?>