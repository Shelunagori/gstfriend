<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseInvoice[]|\Cake\Collection\CollectionInterface $purchaseInvoices
  */
$this->set('title', 'List');
?>
<div class="portlet light bordered" >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Items List') ?></h3>
			<table id="example1" class="table table-bordered table-striped">
				<thead style="text-align:center;">
					<tr >
						<th scope="col" >Sr. No.</th>
						<th scope="col" >Date</th>
						<th scope="col" >Invoice No.</th>
						<th scope="col" >Base Amount</th>
						<th scope="col" >CGST Amount</th>
						<th scope="col" >SGST Amount</th>
						<th scope="col" >Total</th>
						<th scope="col" class="actions" ><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 	$i=0; foreach ($purchaseInvoices as $purchaseInvoice): 
							$i++;
					?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($purchaseInvoice->date) ?></td>
						<td><?= $this->Number->format($purchaseInvoice->invoice_no) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->base_amount) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->cgst) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->sgst) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->total) ?></td>
						<td class="actions">
							<?php /*$this->Html->link(__('View'), ['action' => 'view', $purchaseInvoice->id]) */ ?>
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseInvoice->id]) ?>
							<?php /*  $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseInvoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoice->id)]) */ ?>
						</td>
					</tr>
					<?php endforeach;  ?>
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