<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$current_user = $this->request->getSession()->read('Auth.User.id');
?>

<div class="col-md-12">
    <h3><?= __('List of users') ?></h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name', __('Name')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('login', __('Login')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', __('Created')) ?></th>
                <th scope="col"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->login) ?></td>
                <td><?= h($user->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?php
                    if ($user->id != $current_user) {
                        echo $this->Html->link(__('Remove'), '#', ['class' => 'remove', 'data-href' => $this->Url->build(['action' => 'delete', $user->id]), 'data-csrf' => $this->request->getParam('_csrfToken')]);
                    }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Html->link(__('Add'), ['_name' => 'add_user'], ['class' => 'btn btn-primary']) ?>
    <?= $this->element('paginator') ?>
</div>
<?= $this->element('modal') ?>