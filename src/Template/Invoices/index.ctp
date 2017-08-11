<?php $this->set('title', 'Invoice List'); ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Invoices</span>
		</div>
		<div class="actions">
			
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-scrollable">
		<?php $page_no=$this->Paginator->current('Invoices'); $page_no=($page_no-1)*20; ?>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">Sr.</th>
					<th scope="col">Invoice No</th>
					<th scope="col">Invoice Date</th>
					<th scope="col">Customer</th>
					<th scope="col">Total Amount After Tax</th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($invoices as $invoice): ?>
				<tr>
					<td><?= h(++$page_no) ?></td>
					<td>
						<?php $in_no='#'.str_pad($invoice->invoice_no, 4, '0', STR_PAD_LEFT);  ?>
						<?= $this->Html->link(__($in_no), ['action' => 'view', $invoice->id],['target'=>'_blank']) ?></td>
					<td><?= h($invoice->transaction_date) ?></td>
					<td><?= h($invoice->customer_ledgers['customer']['name']) ?></td>
					<td align="right"><?= $this->Number->format($invoice->total_amount_after_tax,[ 'places' => 2]) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id]) ?>
						<?= $this->Html->link(__('View'), ['action' => 'view', $invoice->id]) ?>
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
