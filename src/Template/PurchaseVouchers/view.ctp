<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseVoucher $purchaseVoucher
  */
  $this->set('title', 'View');
?>
<div class="portlet light bordered " >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<!--Header Start Company Detail--->
			<div class="row">
				<div style="text-align:center">
					<h2><?= $purchaseVoucher->company->name ?><h2>
				</div>
			</div>
			<!--Header End Company Detail--->
			<h3><?= __('Vouchers No.:')?><?=h($purchaseVoucher->voucher_no) ?></h3>
			<div class="col-md-4">
						<table id="example1" class="vertical-table table table-bordered form-group table-striped">
							
							<tr>
								<th scope="row"><?= __('Voucher No') ?></th>
								<td><?= $this->Number->format($purchaseVoucher->voucher_no) ?></td>
							</tr>
							<tr>
								<th scope="row"><?= __('Supplier Ledger Id') ?></th>
								<td><?= $this->Number->format($purchaseVoucher->supplier_ledger_id) ?></td>
							</tr>
							<tr>
								<th scope="row"><?= __('Purchase Ledger Id') ?></th>
								<td><?= $this->Number->format($purchaseVoucher->purchase_ledger_id) ?></td>
							</tr>
							<tr>
								<th scope="row"><?= __('Transaction Date') ?></th>
								<td><?= h($purchaseVoucher->transaction_date) ?></td>
							</tr>
						</table>
			</div>
			<div class="row">
				<h4><?= __('Narration') ?></h4>
				<?= $this->Text->autoParagraph(h($purchaseVoucher->narration)); ?>
			</div>
			<div class="related">
				<h4><?= __('Related Accounting Entries') ?></h4>
				<?php   if (!empty($purchaseVoucher->accounting_entries)): ?>
				<table id="example1" class="table table-bordered form-group table-striped">
					<tr>
						<th scope="col">Sr. No</th>
						<th scope="col">Debit</th>
						<th scope="col">Credit</th>
						<th scope="col">Transaction Date</th>
						<th scope="col">Purchase Voucher Id</th>
						<th scope="col" class="actions">Action</th>
					</tr>
					<?php 
						$i=0;
						foreach ($purchaseVoucher->accounting_entries as $accountingEntries): 
						$i++;
					?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($accountingEntries->ledger_id) ?></td>
						<td><?= h($accountingEntries->debit) ?></td>
						<td><?= h($accountingEntries->credit) ?></td>
						<td><?= h($accountingEntries->transaction_date) ?></td>
						<td><?= h($accountingEntries->purchase_voucher_id) ?></td>
						<td><?= h($accountingEntries->company_id) ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
				<?php endif; ?>
			</div>
			<div class="related">
				<h4><?= __('Related Purchase Voucher Rows') ?></h4>
				<?php if (!empty($purchaseVoucher->purchase_voucher_rows)): ?>
				<table id="example1" class="table table-bordered form-group table-striped">
					<tr>
						<th scope="col">Sr.No.</th>
						<th scope="col">Item Name</th>
						<th scope="col">Quantity</th>
						<th scope="col">Rate Per</th>
						<th scope="col">Amount</th>
					</tr>
					<?php   $i=0;
							foreach ($purchaseVoucher->purchase_voucher_rows as $purchaseVoucherRows):
							$i++;
							
					?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($purchaseVoucherRows->item_id) ?></td>
						<td><?= h($purchaseVoucherRows->quantity) ?></td>
						<td><?= h($purchaseVoucherRows->rate_per) ?></td>
						<td><?= h($purchaseVoucherRows->amount) ?></td>
						
					</tr>
					<?php endforeach; ?>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>	