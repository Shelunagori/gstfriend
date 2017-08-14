<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseInvoice $purchaseInvoice
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Invoice'), ['action' => 'edit', $purchaseInvoice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Invoice'), ['action' => 'delete', $purchaseInvoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Invoices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Invoice'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseInvoices view large-9 medium-8 columns content">
    <h3><?= h($purchaseInvoice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseInvoice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice No') ?></th>
            <td><?= $this->Number->format($purchaseInvoice->invoice_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Base Amount') ?></th>
            <td><?= $this->Number->format($purchaseInvoice->base_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cgst') ?></th>
            <td><?= $this->Number->format($purchaseInvoice->cgst) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sgst') ?></th>
            <td><?= $this->Number->format($purchaseInvoice->sgst) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($purchaseInvoice->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($purchaseInvoice->date) ?></td>
        </tr>
    </table>
</div>
