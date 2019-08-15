<nav>
    <ul class="pagination justify-content-center">
        <?= $this->Paginator->first(__('First')) ?>
        <?= $this->Paginator->prev(__('Previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Next')) ?>
        <?= $this->Paginator->last(__('Last')) ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}')]) ?></p>
</nav>