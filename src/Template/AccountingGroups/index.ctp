<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\AccountingGroup[]|\Cake\Collection\CollectionInterface $accountingGroups
  */
$this->set('title', 'List');
?>
<div class="portlet light bordered" >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Ledger Accounts List') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
					<tr>
						<th scope="col" style="text-align:center">Sr. No.</th>
						<th scope="col" style="text-align:center">NATURE OF GROUP</th>
						<th scope="col" style="text-align:center">NAME</th>
						<th scope="col" style="text-align:center">PARENT</th>
						<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0;
					foreach ($accountingGroups as $accountingGroup):
					$i++; 	?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= $accountingGroup->has('nature_of_group') ? $this->Html->link($accountingGroup->nature_of_group->name, ['controller' => 'NatureOfGroups', 'action' => 'view', $accountingGroup->nature_of_group->id]) : '' ?></td>
						<td><?= h($accountingGroup->name) ?></td>
						<td><?= $accountingGroup->has('parent_accounting_group') ? $this->Html->link($accountingGroup->parent_accounting_group->name, ['controller' => 'AccountingGroups', 'action' => 'view', $accountingGroup->parent_accounting_group->id]) : '' ?></td>
						<td class="actions">
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $accountingGroup->id]) ?>
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