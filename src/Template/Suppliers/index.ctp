<?php
$this->set('title', 'List');
?>
<div class="form-body">
	<h3><?= __('Suppliers') ?></h3>
	<table id="example1" class="table table-bordered table-striped">
		<thead style="text-align:center;">
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
			<?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= $this->Number->format($supplier->id) ?></td>
                <td><?= h($supplier->name) ?></td>
                <td><?= h($supplier->mobile) ?></td>
                <td><?= h($supplier->email) ?></td>
                <td><?php if(@$supplier->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
                <td><?= $supplier->has('company') ? $this->Html->link($supplier->company->name, ['controller' => 'Companies', 'action' => 'view', $supplier->company->id]) : '' ?></td>
                <td class="actions">
                   <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplier->id]) ?>
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