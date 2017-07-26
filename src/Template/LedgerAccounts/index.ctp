<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\LedgerAccount[]|\Cake\Collection\CollectionInterface $ledgerAccounts
  */
$this->set('title', 'List');
?>
<div class="portlet light bordered" style="background-color:#f5f3f3">
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Ledger Accounts') ?></h3>
			<table id="example1" class="table table-bordered form-group table-striped">
				<thead>
            <tr>
                <th scope="col" style="text-align:center">ID </th>
                <th scope="col" style="text-align:center">NAME</th>
                <th scope="col" style="text-align:center">HSN CODE</th>
                <th scope="col" style="text-align:center">FREEZED</th>
                <th scope="col" style="text-align:center">COMPANY NAME</th>
                <th scope="col" style="text-align:center">SUPPLIER NAME</th>
                <th scope="col" style="text-align:center">CUSTOMER NAME</th>
                <th scope="col" class="actions" style="text-align:center"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ledgerAccounts as $ledgerAccount): ?>
            <tr style="text-align:center">
                <td><?= $this->Number->format($ledgerAccount->id) ?></td>
                <td><?= h($ledgerAccount->name) ?></td>
                <td><?= h($ledgerAccount->hsn_code) ?></td>
                <td><?php if(@$ledgerAccount->freezed==0){ echo "Unfreezed";  } else {   echo "Freezed"; } ?></td>
                <td><?php echo $ledgerAccount->company->name; ?></td>
                <td><?php echo $ledgerAccount->supplier->name; ?></td>
                <td><?php echo $ledgerAccount->customer->name; ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ledgerAccount->id]) ?>
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