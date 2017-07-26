<?php
$this->set('title', 'List');
?>
<div class="portlet light bordered portlet-box-yellow" style="background-color:#f5f3f3">
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Customers') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
					<tr>
						<th scope="col" style="text-align:center">ID</th>
						<th scope="col" style="text-align:center">NAME</th>
						<th scope="col" style="text-align:center">MONILE NO.</th>
						<th scope="col" style="text-align:center">EMAIL</th>
						<th scope="col" style="text-align:center">FREEZED</th>
						<th scope="col" style="text-align:center">COMPANY NAME</th>
						<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
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
						<td><?php echo $customer->company->name; ?></td>
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
