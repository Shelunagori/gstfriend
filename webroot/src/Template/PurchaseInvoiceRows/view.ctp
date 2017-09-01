<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseInvoiceRow $purchaseInvoiceRow
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Invoice Row'), ['action' => 'edit', $purchaseInvoiceRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Invoice Row'), ['action' => 'delete', $purchaseInvoiceRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoiceRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Invoice Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Invoice Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Invoices'), ['controller' => 'PurchaseInvoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Invoice'), ['controller' => 'PurchaseInvoices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseInvoiceRows view large-9 medium-8 columns content">
    <h3><?= h($purchaseInvoiceRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Purchase Invoice') ?></th>
            <td><?= $purchaseInvoiceRow->has('purchase_invoice') ? $this->Html->link($purchaseInvoiceRow->purchase_invoice->id, ['controller' => 'PurchaseInvoices', 'action' => 'view', $purchaseInvoiceRow->purchase_invoice->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseInvoiceRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cgst Ledger Id') ?></th>
            <td><?= $this->Number->format($purchaseInvoiceRow->cgst_ledger_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cgst Amount') ?></th>
            <td><?= $this->Number->format($purchaseInvoiceRow->cgst_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sgst Ledger Id') ?></th>
            <td><?= $this->Number->format($purchaseInvoiceRow->sgst_ledger_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sgst Amount') ?></th>
            <td><?= $this->Number->format($purchaseInvoiceRow->sgst_amount) ?></td>
        </tr>
    </table>
</div>
