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
		<table class="table table-striped table-bordered table-hover table-advance">
			<thead>
				<tr>
					<th scope="col">Sr.</th>
					<th scope="col"><?= $this->Paginator->sort('invoice_no') ?></th>
					<th scope="col"><?= $this->Paginator->sort('invoice_date') ?></th>
					<th scope="col"><?= $this->Paginator->sort('party_name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('party_mobile') ?></th>
					<th scope="col"><?= $this->Paginator->sort('party_state') ?></th>
					<th scope="col"><?= $this->Paginator->sort('party_gst') ?></th>
					<th scope="col"><?= $this->Paginator->sort('total_amount_after_tax') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($invoices as $invoice): ?>
				<tr>
					<td><?= h(++$page_no) ?></td>
					<td>
						<?php $in_no='#'.str_pad($invoice->invoice_no, 4, '0', STR_PAD_LEFT);  ?>
						<?= $this->Html->link(__($in_no), ['action' => 'view', $invoice->id],['target'=>'_blank']) ?></td>
					<td><?= h($invoice->invoice_date) ?></td>
					<td><?= h($invoice->party_name) ?></td>
					<td><?= h($invoice->party_mobile) ?></td>
					<td><?= h($invoice->party_state) ?></td>
					<td><?= h($invoice->party_gst) ?></td>
					<td align="right"><?= $this->Number->format($invoice->total_amount_after_tax,[ 'places' => 2]) ?></td>
					<td class="actions">
						
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
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
