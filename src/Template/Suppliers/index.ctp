<?php
$this->set('title', 'List');
?>
<div class="portlet light bordered" >
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Suppliers List</span>
		</div>
		<div class="actions">
			
		</div>
	</div>
	<div class="portlet-body-form"  >
		<div class="form-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead style="text-align:center;">
					<tr>
						<th scope="col">Sr. No.</th>
						<th scope="col">Name</th>
						<th scope="col">Mobile No.</th>
						<th scope="col">Email</th>
						<th scope="col">State</th>
						<th scope="col">Freezed</th>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0;
					foreach ($suppliers as $supplier): 
					$i++;  ?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($supplier->name) ?></td>
						<td><?= h($supplier->mobile) ?></td>
						<td><?= h($supplier->email) ?></td>
						<td><?= h($supplier->state) ?></td>
						<td><?php if(@$supplier->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
						<td class="actions">
						   <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplier->id]) ?>
						   <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->id)]) ?>
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