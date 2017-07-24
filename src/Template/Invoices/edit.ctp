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
                ['action' => 'delete', $invoice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Invoices'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="invoices form large-9 medium-8 columns content">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Edit Invoice') ?></legend>
        <?php
            echo $this->Form->control('invoice_no');
            echo $this->Form->control('invoice_date');
            echo $this->Form->control('state');
            echo $this->Form->control('party_name');
            echo $this->Form->control('party_address');
            echo $this->Form->control('party_mobile');
            echo $this->Form->control('party_state');
            echo $this->Form->control('party_gst');
            echo $this->Form->control('total_amount_before_tax');
            echo $this->Form->control('total_cgst');
            echo $this->Form->control('total_sgst');
            echo $this->Form->control('total_amount_after_tax');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
