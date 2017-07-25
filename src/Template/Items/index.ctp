<?php
$this->set('title', 'List');
?>


<div class="box-body">
	<h3><?= __('Items') ?></h3>
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th scope="col"><?= $this->Paginator->sort('id') ?></th>
				<th scope="col"><?= $this->Paginator->sort('name') ?></th>
				<th scope="col"><?= $this->Paginator->sort('hsn_code') ?></th>
				<th scope="col"><?= $this->Paginator->sort('freezed') ?></th>
				<th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
				<th scope="col" class="actions"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($items as $item): ?>
			<tr >
				<td><?= $this->Number->format($item->id) ?></td>
				<td><?= h($item->name) ?></td>
				<td><?= h($item->hsn_code) ?></td>
				<td><?= h($item->freezed) ?></td>
				<td><?= $item->has('company') ? $this->Html->link($item->company->name, ['controller' => 'Companies', 'action' => 'view', $item->company->id]) : '' ?></td>
				<td class="actions">
					<?= $this->Html->link(__('View'), ['action' => 'view', $item->id]) ?>
					<?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
					<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
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