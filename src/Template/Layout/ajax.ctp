<div class="container">
    <?= $this->element('nav') ?>
    <?= $this->Flash->render() ?>
    <div class="row">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</div>
<?= $this->fetch('modal') ?>