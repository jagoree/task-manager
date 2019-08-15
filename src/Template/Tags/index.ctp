<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<div class="col-md-12 col-sm-12">
    <h3><?= __('List of tags') ?></h3>
    <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
            <tr>
                <th class="sortable col-md-1"><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th class="sortable"><?= $this->Paginator->sort('caption', __('Caption')) ?></th>
                <th class="sortable col-md-2"><?= $this->Paginator->sort('created', __('Created')) ?></th>
                <th class="col-md-3"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= $this->Number->format($tag->id) ?></td>
                <td>
                    <?= $this->Html->link($tag->caption, ['action' => 'view', $tag->id]) ?>
                </td>
                <td><?= h($tag->created->format('d.m.Y H:i')) ?></td>
                <td>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->id]) ?>
                    <?= $this->Html->link(__('Remove'), '#', ['class' => 'remove', 'data-href' => $this->Url->build(['action' => 'delete', $tag->id]), 'data-csrf' => $this->request->getParam('_csrfToken')]) ?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <a href="<?= $this->Url->build(['_name' => 'add_tag']) ?>" class="btn btn-primary"><?= __('Add') ?></a>
    <?= $this->element('paginator') ?>
</div>
<?= $this->element('modal') ?>