<?php
$this->set('title', 'List');
?>
<div class="portlet light bordered" >
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Items List</span>
		</div>
		<div class="actions">
			
		</div>
	</div>
	<div class="portlet-body-form"  >
		<div class="form-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead style="text-align:center;">
					<tr >
						<th scope="col" >Sr. No.</th>
						<th scope="col" >Name</th>
						<th scope="col" >HSN Code</th>
						<th scope="col" >Sale Price</th>
						<th scope="col" >Purchase Price</th>
						<th scope="col" >CGST</th>
						<th scope="col" >SGST</th>
						<th scope="col" >IGST</th>
						<th scope="col" >Freezed</th>
						<th scope="col" class="actions" ><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; foreach ($items as $item): 
			
					$i++;?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($item->name) ?></td>
						<td><?= h($item->hsn_code) ?></td>
						<td><?= $this->Number->format($item->price) ?></td>
						<td><?= $this->Number->format($item->purchase_price) ?></td>
						<td><?php echo @$item->cgst_ledger->name; ?></td>
						<td><?php echo @$item->sgst_ledger->name; ?></td>
						<td><?php echo @$item->igst_ledger->name; ?></td>
						<td><?php if(@$item->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
						<td class="actions">
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
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