<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ItemDiscount[]|\Cake\Collection\CollectionInterface $itemDiscounts
  */
$this->set('title', 'List');
?>
<div class="portlet light bordered " >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Item Discounts List') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
					<tr>
						<th scope="col" style="text-align:center">Sr.No.</th>
						<th scope="col" style="text-align:center">ITEM NAME</th>
						<th scope="col" style="text-align:center">PRICE</th>
						<th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 	$i=0;
							foreach ($itemDiscounts as $itemDiscount):
							$i++;
					?>
					<tr>
						<td><?= $this->Number->format($i)?></td>
						<td ><?= h($itemDiscount->name) ?></td>
						<td style="text-align:right"><?= h($itemDiscount->price) ?></td>
						<td class="actions">
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemDiscount->id]) ?>
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
