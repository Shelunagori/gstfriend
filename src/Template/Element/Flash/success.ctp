<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="toast toast-success" onclick="this.classList.add('hidden')">
	<div class="toast-message"><?= $message ?></div>
</div>