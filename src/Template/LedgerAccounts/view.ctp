<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\LedgerAccount $ledgerAccount
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ledger Account'), ['action' => 'edit', $ledgerAccount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ledger Account'), ['action' => 'delete', $ledgerAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ledgerAccount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ledger Accounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ledger Account'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ledgerAccounts view large-9 medium-8 columns content">
    <h3><?= h($ledgerAccount->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($ledgerAccount->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hsn Code') ?></th>
            <td><?= h($ledgerAccount->hsn_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $ledgerAccount->has('company') ? $this->Html->link($ledgerAccount->company->name, ['controller' => 'Companies', 'action' => 'view', $ledgerAccount->company->id]) : '' ?></td>
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
