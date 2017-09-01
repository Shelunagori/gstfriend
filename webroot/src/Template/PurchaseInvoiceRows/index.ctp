<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseInvoiceRow[]|\Cake\Collection\CollectionInterface $purchaseInvoiceRows
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Invoice Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Invoices'), ['controller' => 'PurchaseInvoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Invoice'), ['controller' => 'PurchaseInvoices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseInvoiceRows index large-9 medium-8 columns content">
    <h3><?= __('Purchase Invoice Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cgst_ledger_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cgst_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sgst_ledger_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sgst_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_invoice_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseInvoiceRows as $purchaseInvoiceRow): ?>
            <tr>
                <td><?= $this->Number->format($purchaseInvoiceRow->id) ?></td>
                <td><?= $this->Number->format($purchaseInvoiceRow->cgst_ledger_id) ?></td>
                <td><?= $this->Number->format($purchaseInvoiceRow->cgst_amount) ?></td>
                <td><?= $this->Number->format($purchaseInvoiceRow->sgst_ledger_id) ?></td>
                <td><?= $this->Number->format($purchaseInvoiceRow->sgst_amount) ?></td>
                <td><?= $purchaseInvoiceRow->has('purchase_invoice') ? $this->Html->link($purchaseInvoiceRow->purchase_invoice->id, ['controller' => 'PurchaseInvoices', 'action' => 'view', $purchaseInvoiceRow->purchase_invoice->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseInvoiceRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseInvoiceRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseInvoiceRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoiceRow->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
