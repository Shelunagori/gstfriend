<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="purchaseVoucherRows form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseVoucherRow) ?>
    <fieldset>
        <legend><?= __('Add Purchase Voucher Row') ?></legend>
        <?php
            echo $this->Form->control('purchase_voucher_id', ['options' => $purchaseVouchers]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('rate_per');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
