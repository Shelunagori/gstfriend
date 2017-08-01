<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\InvoiceRow $invoiceRow
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invoice Row'), ['action' => 'edit', $invoiceRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invoice Row'), ['action' => 'delete', $invoiceRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invoiceRows view large-9 medium-8 columns content">
    <h3><?= h($invoiceRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Invoice') ?></th>
            <td><?= $invoiceRow->has('invoice') ? $this->Html->link($invoiceRow->invoice->id, ['controller' => 'Invoices', 'action' => 'view', $invoiceRow->invoice->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $invoiceRow->has('item') ? $this->Html->link($invoiceRow->item->name, ['controller' => 'Items', 'action' => 'view', $invoiceRow->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoiceRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($invoiceRow->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($invoiceRow->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($invoiceRow->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Rate') ?></th>
            <td><?= $this->Number->format($invoiceRow->discount_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Amount') ?></th>
            <td><?= $this->Number->format($invoiceRow->discount_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Taxable Value') ?></th>
            <td><?= $this->Number->format($invoiceRow->taxable_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cgst Rate') ?></th>
            <td><?= $this->Number->format($invoiceRow->cgst_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cgst Amount') ?></th>
            <td><?= $this->Number->format($invoiceRow->cgst_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sgst Rate') ?></th>
            <td><?= $this->Number->format($invoiceRow->sgst_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sgst Amount') ?></th>
            <td><?= $this->Number->format($invoiceRow->sgst_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($invoiceRow->total) ?></td>
        </tr>
    </table>
</div>
