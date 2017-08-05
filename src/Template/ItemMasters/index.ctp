<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ItemMaster[]|\Cake\Collection\CollectionInterface $itemMasters
  */
$this->set('title', 'List');
?>
<div class="portlet light bordered " >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('List Item Masters') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
					<tr>
						<th scope="col" style="text-align:center">Sr.No.</th>
						<th scope="col" style="text-align:center">ITEM NAME</th>
						<th scope="col" style="text-align:center">PRICE</th>
						<th scope="col" style="text-align:center">CGST</th>
						<th scope="col" style="text-align:center">SGST</th>
						<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 	$i=0; 
							foreach ($itemMasters as $itemMaster): 
							$i++;
					?>
							
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($itemMaster->item->name) ?></td>
						<td><?= $this->Number->format($itemMaster->price) ?></td>
						<td><?= h($itemMaster->cgst_ledger->name) ?></td>
						<td><?= h($itemMaster->sgst_ledger->name) ?></td>
						<td class="actions">
							<?php /* $this->Html->link(__('View'), ['action' => 'view', $itemMaster->id]) */ ?>
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemMaster->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemMaster->id)]) ?>
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