<?php $this->start('modal') ?>
<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?= __('Warning') ?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?= __('Are you sure you want to delete this item?') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary yes"><?= __('Yes') ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('No') ?></button>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>