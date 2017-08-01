<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Invoice $invoice
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invoice'), ['action' => 'edit', $invoice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invoice'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Rows'), ['controller' => 'InvoiceRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Row'), ['controller' => 'InvoiceRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invoices view large-9 medium-8 columns content">
    <h3><?= h($invoice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice No') ?></th>
            <td><?= $this->Number->format($invoice->invoice_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Ledger Id') ?></th>
            <td><?= $this->Number->format($invoice->customer_ledger_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Ledger Id') ?></th>
            <td><?= $this->Number->format($invoice->sales_ledger_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount Before Tax') ?></th>
            <td><?= $this->Number->format($invoice->total_amount_before_tax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Cgst') ?></th>
            <td><?= $this->Number->format($invoice->total_cgst) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Sgst') ?></th>
            <td><?= $this->Number->format($invoice->total_sgst) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount After Tax') ?></th>
            <td><?= $this->Number->format($invoice->total_amount_after_tax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($invoice->transaction_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Invoice Rows') ?></h4>
        <?php if (!empty($invoice->invoice_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Invoice Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Discount Rate') ?></th>
                <th scope="col"><?= __('Discount Amount') ?></th>
                <th scope="col"><?= __('Taxable Value') ?></th>
                <th scope="col"><?= __('Cgst Rate') ?></th>
                <th scope="col"><?= __('Cgst Amount') ?></th>
                <th scope="col"><?= __('Sgst Rate') ?></th>
                <th scope="col"><?= __('Sgst Amount') ?></th>
                <th scope="col"><?= __('Total') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoice->invoice_rows as $invoiceRows): ?>
            <tr>
                <td><?= h($invoiceRows->id) ?></td>
                <td><?= h($invoiceRows->invoice_id) ?></td>
                <td><?= h($invoiceRows->item_id) ?></td>
                <td><?= h($invoiceRows->quantity) ?></td>
                <td><?= h($invoiceRows->rate) ?></td>
                <td><?= h($invoiceRows->amount) ?></td>
                <td><?= h($invoiceRows->discount_rate) ?></td>
                <td><?= h($invoiceRows->discount_amount) ?></td>
                <td><?= h($invoiceRows->taxable_value) ?></td>
                <td><?= h($invoiceRows->cgst_rate) ?></td>
                <td><?= h($invoiceRows->cgst_amount) ?></td>
                <td><?= h($invoiceRows->sgst_rate) ?></td>
                <td><?= h($invoiceRows->sgst_amount) ?></td>
                <td><?= h($invoiceRows->total) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InvoiceRows', 'action' => 'view', $invoiceRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InvoiceRows', 'action' => 'edit', $invoiceRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InvoiceRows', 'action' => 'delete', $invoiceRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
