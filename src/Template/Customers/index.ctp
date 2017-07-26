<?php
$this->set('title', 'List');
?>
<div class="portlet light bordered" style="background-color:#f5f3f3">
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Customers') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
					<tr>
						<th scope="col"><?= $this->Paginator->sort('id') ?></th>
						<th scope="col"><?= $this->Paginator->sort('name') ?></th>
						<th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
						<th scope="col"><?= $this->Paginator->sort('email') ?></th>
						<th scope="col"><?= $this->Paginator->sort('freezed') ?></th>
						<th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($customers as $customer): ?>
					<tr>
						<td><?= $this->Number->format($customer->id) ?></td>
						<td><?= h($customer->name) ?></td>
						<td><?= h($customer->mobile) ?></td>
						<td><?= h($customer->email) ?></td>
						<td><?php if(@$customer->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
						<td><?= $customer->has('company') ? $this->Html->link($customer->company->name, ['controller' => 'Companies', 'action' => 'view', $customer->company->id]) : '' ?></td>
						<td class="actions">
						   <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
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
