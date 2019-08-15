<div class="col-md-12">
    <?= $this->Form->create(['schema' => [], 'errors' => $errors ?? []], ['url' => $this->Url->build(['_name' => 'login'])]) ?>
    <div class="form-group">
        <h3><?= __('Authorization') ?></h3>
        <?php
        echo $this->Form->control('login', ['label' => __('Login')]);
        echo $this->Form->control('password', ['label' => __('Password')]);
        echo $this->Form->button(__('Login'), ['class' => 'btn btn-primary']);
        ?>
    </div>
    <?= $this->Form->end() ?>
</div>