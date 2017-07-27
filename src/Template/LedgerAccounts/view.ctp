<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\LedgerAccount $ledgerAccount
  */
?>

<div class="ledgerAccounts view large-9 medium-8 columns content">
    <h3><?= h($ledgerAccount->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($ledgerAccount->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= $ledgerAccount->has('supplier') ? $this->Html->link($ledgerAccount->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $ledgerAccount->supplier->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $ledgerAccount->has('customer') ? $this->Html->link($ledgerAccount->customer->name, ['controller' => 'Customers', 'action' => 'view', $ledgerAccount->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ledgerAccount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freezed') ?></th>
            <td><?= $ledgerAccount->freezed ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
