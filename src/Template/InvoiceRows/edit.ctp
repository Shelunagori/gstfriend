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
                ['action' => 'delete', $invoiceRow->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceRow->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Invoice Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoiceRows form large-9 medium-8 columns content">
    <?= $this->Form->create($invoiceRow) ?>
    <fieldset>
        <legend><?= __('Edit Invoice Row') ?></legend>
        <?php
            echo $this->Form->control('invoice_id', ['options' => $invoices]);
            echo $this->Form->control('item_id', ['options' => $items, 'empty' => true]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('rate');
            echo $this->Form->control('amount');
            echo $this->Form->control('discount_rate');
            echo $this->Form->control('discount_amount');
            echo $this->Form->control('taxable_value');
            echo $this->Form->control('cgst_rate');
            echo $this->Form->control('cgst_amount');
            echo $this->Form->control('sgst_rate');
            echo $this->Form->control('sgst_amount');
            echo $this->Form->control('total');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
