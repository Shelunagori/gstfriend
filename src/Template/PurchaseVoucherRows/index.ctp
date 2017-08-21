<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseVoucher[]|\Cake\Collection\CollectionInterface $purchaseVouchers
  */
$this->set('title', 'List');
?>
<div class="portlet light bordered " >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Purchase Voucher Rows List') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
					<tr>
						<th scope="col" style="text-align:center">Sr.No.</th>
						<th scope="col" style="text-align:center">PURCHASE VOUCHER ID</th>
						<th scope="col" style="text-align:center">ITEM NAME</th>
						<th scope="col" style="text-align:center">QUANTITY</th>
						<th scope="col" style="text-align:center">RATE PER</th>
						<th scope="col" style="text-align:center">AMOUNT</th>
						<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; foreach ($purchaseVoucherRows as $purchaseVoucherRow): 
					$i++;?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= $purchaseVoucherRow->has('purchase_voucher') ? $this->Html->link($purchaseVoucherRow->purchase_voucher->id, ['controller' => 'PurchaseVouchers', 'action' => 'view', $purchaseVoucherRow->purchase_voucher->id]) : '' ?></td>
						<td><?= $purchaseVoucherRow->has('item') ? $this->Html->link($purchaseVoucherRow->item->name, ['controller' => 'Items', 'action' => 'view', $purchaseVoucherRow->item->id]) : '' ?></td>
						<td><?= $this->Number->format($purchaseVoucherRow->quantity) ?></td>
						<td><?= $this->Number->format($purchaseVoucherRow->rate_per) ?></td>
						<td><?= $this->Number->format($purchaseVoucherRow->amount) ?></td>
						<td class="actions">
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucherRow->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseVoucherRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucherRow->id)]) ?>
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
	</div>
</div>	
