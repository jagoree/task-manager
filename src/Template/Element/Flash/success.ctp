<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-success mt-3" onclick="this.remove()">
    <?= $message ?>
</div>
