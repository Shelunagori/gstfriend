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
			<h3><?= __('Purchase Vouchers List') ?></h3>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="text-align:center">Sr.No.</th>
						<th style="text-align:center">VOUCHER No.</th>
						<th style="text-align:center">SUPPLIER NAME</th>
						<th style="text-align:center">CUSTOMER NAME</th>
						<th style="text-align:center">TRANSACTION DATE</th>
						<th style="text-align:center">NARRATION</th>
						<th class="actions" style="text-align:center"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$i=0; 
						foreach ($purchaseVouchers as $purchaseVoucher):
						$i++;
					?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= $this->Number->format($purchaseVoucher->voucher_no) ?></td>
						<td><?= h($purchaseVoucher->supplier_ledger->supplier->name) ?></td>
						<td><?= h(@$purchaseVoucher->purchase_ledger->customer->name) ?></td>
						<td><?= h($purchaseVoucher->transaction_date) ?></td>
						<td><?= h($purchaseVoucher->narration) ?></td>
						<td class="actions">
							<?= $this->Html->link(__('View'), ['action' => 'view', $purchaseVoucher->id]) ?>
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id]) ?>
							
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
