<?php $this->set('title', 'Purchase Voucher List'); ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Purchase Vouchers List</span>
		</div>
		<div class="actions">
			
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-scrollable">
		<?php $page_no=$this->Paginator->current('purchaseVouchers'); $page_no=($page_no-1)*20; ?>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col">Sr.</th>
						<th scope="col">Voucher No</th>
						<th scope="col">Date</th>
						<th scope="col">Supplier</th>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
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
						<td>
						<?php $in_no='#'.str_pad($purchaseVoucher->voucher_no, 4, '0', STR_PAD_LEFT);  ?>
						<?= $this->Html->link(__($in_no), ['action' => 'view', $purchaseVoucher->id],['target'=>'_blank']) ?></td>
						<td><?= h($purchaseVoucher->transaction_date) ?></td>
						<td><?= h($purchaseVoucher->supplier_ledger->supplier->name) ?></td>
						<td class="actions">
							<?= $this->Html->link(__('View'), ['action' => 'view', $purchaseVoucher->id]) ?>
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id]) ?>
							
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
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
