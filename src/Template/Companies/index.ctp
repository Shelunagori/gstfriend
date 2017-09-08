<?php
$this->set('title', 'List');
?>
<div class="portlet light bordered" >
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Companies List</span>
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
						<th scope="col" >Address</th>
						<th scope="col" >District</th>
						<th scope="col" >State</th>
						<th scope="col" >Phone No.</th>
						<th scope="col" >Logo</th>
						<th scope="col" >Freezed</th>
						<th scope="col" class="actions" ><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; foreach ($companies as $company): 
					$i++;?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($company->name) ?></td>
						<td><?= h($company->address) ?></td>
						<td><?= h($company->district) ?></td>
						<td><?= h($company->state) ?></td>
						<td><?= h($company->phone_no) ?></td>
						<td><?php echo $this->Html->image('/company_logo/'.$company->logo, ['height' => '50px']); ?></td>
						<td><?php if(@$item->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
						<td class="actions">
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $company->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?>
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