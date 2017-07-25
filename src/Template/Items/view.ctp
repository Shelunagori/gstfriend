<?php
$this->set('title', 'View');
?>
<div class="form-body">
	<h3><?= h($item->name) ?></h3>

   
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($item->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hsn Code') ?></th>
            <td><?= h($item->hsn_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $item->has('company') ? $this->Html->link($item->company->name, ['controller' => 'Companies', 'action' => 'view', $item->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freezed') ?></th>
            <td><?= $item->freezed ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
