<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\AccountingEntry $accountingEntry
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Accounting Entry'), ['action' => 'edit', $accountingEntry->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Accounting Entry'), ['action' => 'delete', $accountingEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountingEntry->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Accounting Entries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accounting Entry'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ledgers'), ['controller' => 'Ledgers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ledger'), ['controller' => 'Ledgers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['controller' => 'PurchaseVouchers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accountingEntries view large-9 medium-8 columns content">
    <h3><?= h($accountingEntry->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ledger') ?></th>
            <td><?= $accountingEntry->has('ledger') ? $this->Html->link($accountingEntry->ledger->name, ['controller' => 'Ledgers', 'action' => 'view', $accountingEntry->ledger->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Voucher') ?></th>
            <td><?= $accountingEntry->has('purchase_voucher') ? $this->Html->link($accountingEntry->purchase_voucher->id, ['controller' => 'PurchaseVouchers', 'action' => 'view', $accountingEntry->purchase_voucher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $accountingEntry->has('company') ? $this->Html->link($accountingEntry->company->name, ['controller' => 'Companies', 'action' => 'view', $accountingEntry->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice') ?></th>
            <td><?= $accountingEntry->has('invoice') ? $this->Html->link($accountingEntry->invoice->name, ['controller' => 'Invoices', 'action' => 'view', $accountingEntry->invoice->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($accountingEntry->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Debit') ?></th>
            <td><?= $this->Number->format($accountingEntry->debit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit') ?></th>
            <td><?= $this->Number->format($accountingEntry->credit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($accountingEntry->transaction_date) ?></td>
        </tr>
    </table>
</div>
