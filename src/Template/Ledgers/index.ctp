<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Ledger[]|\Cake\Collection\CollectionInterface $ledgers
  */
$this->set('title', 'List');
?>
<div class="portlet light bordered" >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Ledgers List') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
					<tr>
						<th scope="col" style="text-align:center">Sr.No.</th>
						<th scope="col" style="text-align:center">NAME</th>
						<th scope="col" style="text-align:center">ACCOUNTING GROUP</th>
						<th scope="col" style="text-align:center">FREEZED</th>
						<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0;
					
					foreach ($ledgers as $ledger):
					$i++; 	
					?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($ledger->name) ?></td>
						<td><?= h($ledger->accounting_group->name) ?></td>
						<!--<td><?php /*h($ledger->accounting_group->name, ['controller' => 'AccountingGroups', 'action' => 'view', $ledger->accounting_group->id]) */ ?></td>-->
						<td><?php if(@$ledger->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
						<td class="actions">
							<?php /*  $this->Html->link(__('Edit'), ['action' => 'edit', $ledger->id])   */ ?>
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