<?php
$this->set('title', 'List');
?>

<div class="form-body">
	<h3><?= __('Items') ?></h3>
	<table id="example1" class="table table-bordered table-striped">
		<thead style="text-align:center;">
			<tr >
				<th scope="col" style="text-align:center"><?= $this->Paginator->sort('id') ?></th>
				<th scope="col" style="text-align:center"><?= $this->Paginator->sort('name') ?></th>
				<th scope="col" style="text-align:center"><?= $this->Paginator->sort('hsn_code') ?></th>
				<th scope="col" style="text-align:center"><?= $this->Paginator->sort('freezed') ?></th>
				<th scope="col" style="text-align:center"><?= $this->Paginator->sort('company_id') ?></th>
				<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($items as $item):  ?>
			<tr style="text-align:center">
				<td><?= $this->Number->format($item->id) ?></td>
				<td><?= h($item->name) ?></td>
				<td><?= h($item->hsn_code) ?></td>
				<td><?php if(@$item->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
				<td><?= $item->has('company') ? $this->Html->link($item->company->name, ['controller' => 'Companies', 'action' => 'view', $item->company->id]) : '' ?></td>
				<td class="actions">
					<?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
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