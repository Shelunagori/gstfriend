<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchaseInvoiceRow->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoiceRow->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Invoice Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Invoices'), ['controller' => 'PurchaseInvoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Invoice'), ['controller' => 'PurchaseInvoices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseInvoiceRows form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseInvoiceRow) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Invoice Row') ?></legend>
        <?php
            echo $this->Form->control('cgst_ledger_id');
            echo $this->Form->control('cgst_amount');
            echo $this->Form->control('sgst_ledger_id');
            echo $this->Form->control('sgst_amount');
            echo $this->Form->control('purchase_invoice_id', ['options' => $purchaseInvoices]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
