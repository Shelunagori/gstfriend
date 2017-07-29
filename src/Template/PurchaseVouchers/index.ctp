<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseVoucher[]|\Cake\Collection\CollectionInterface $purchaseVouchers
  */
?>
<div class="purchaseVouchers index large-9 medium-8 columns content">
    <h3><?= __('Purchase Vouchers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supplier_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseVouchers as $purchaseVoucher): ?>
            <tr>
                <td><?= $this->Number->format($purchaseVoucher->id) ?></td>
                <td><?= $this->Number->format($purchaseVoucher->voucher_no) ?></td>
                <td><?= $this->Number->format($purchaseVoucher->supplier_id) ?></td>
                <td><?= $this->Number->format($purchaseVoucher->customer_id) ?></td>
                <td><?= h($purchaseVoucher->transaction_date) ?></td>
                <td><?= $purchaseVoucher->has('company') ? $this->Html->link($purchaseVoucher->company->name, ['controller' => 'Companies', 'action' => 'view', $purchaseVoucher->company->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseVoucher->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucher->id)]) ?>
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
