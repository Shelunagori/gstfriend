<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseVoucher $purchaseVoucher
  */
  $this->set('title', 'View');
?>
<style>
.maindiv{
		font-family: sans-serif !important; font-size:12px !important;
	}
@media print{
	.maindiv{
		width:100% !important;font-family: sans-serif;
	}	
	.hidden-print{
		display:none;
	}
	body {
      -webkit-print-color-adjust: exact;
   }
}
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 20px 0 20px;  /* this affects the margin in the printer settings */
}

p{
	margin-bottom: 0;
}

.tbl td, .tbl th {
    border: 1px solid black;
}

.footertble td{
    padding: 1px 3px;
}


.nbtbl td, .nbtbl th {
    border: none;
}
.tbl th {
    text-align:center;
}
.tbl td {
    padding:3px;
}
</style>
<a class="btn  blue hidden-print" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id],['class'=>'btn yellow-crusta hidden-print']) ?>
<div style="width:80%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;" class="maindiv">
	<table width="100%">
		<tr>
			<td width="30%" style="padding:5px;"><?php echo $this->Html->image('/img/viewlogo.png', ['height' => '100px']); ?></td>
			<td>
				<div align="center" style="color: #c4151c;"><b>
					<span style="font-size:16px;color: #c4151c !important;" style=""><h2><?= $purchaseVoucher->company->name ?></h2></span><br/>
					<span style="color: #4a4c4c;">Subhash Nagar Sevasram</span><br/>
					<!--<span style="color: #4a4c4c;">Udaipur, Rajasthan. PIN: 313001</span><br/>
					<span style="color: #4a4c4c;">Tel: +91 9876543210</span><br/>
					<span style="color: #4a4c4c;">GSTIN: 08BICPD5795A1ZG</span></b>-->
				</div>
			</td>
			<td width="30%"></td>
		</tr>
	</table>
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color : #c4151c !important;font-size:18px;color: #FFF !important;"><b style="color: #FFF !important;">PURCHASE VOUCHER</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td width="50%"><b>Voucher No.</b></td>
							<td><?= $this->Number->format($purchaseVoucher->voucher_no) ?></td>
						</tr>
						<tr>
							<td width="50%"><b>Transaction Date</b></td>
							<td><?= h($purchaseVoucher->transaction_date) ?></td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;border:solid 1px;" valign="top">
					<table width="100%">
						<tr>
							<td colspan="6">
								<div style="text-align: center;"><u>Bill to Party</u></div>
							</td>
						</tr>
						<tr>
							<td width="50%"><b>Name</b></td>
							<td><?= h($purchaseVoucher->supplier_ledger->supplier->name) ?></td>
						</tr>
						<tr>
							<td width="50%"><b>Mobile No.</b></td>
							<td><?= h($purchaseVoucher->supplier_ledger->supplier->mobile) ?></td>
						</tr>
						<tr>
							<td width="50%"><b>Address</b></td>
							<td colspan="4"><?= h($purchaseVoucher->supplier_ledger->supplier->address) ?></td>
						</tr>
						<tr>
							<td width="50"><b>State</b></td>
							<td><?= h($purchaseVoucher->supplier_ledger->supplier->state) ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div align="center" style="border:none;">
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
					<td><?= h($accountingEntries->debit) ?></td>
					<td><?= h($accountingEntries->credit) ?></td>
					<td><?= h($accountingEntries->transaction_date) ?></td>
					<td><?= h($accountingEntries->purchase_voucher_id) ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		<div class="related">
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
		<table width="100%" class="tbl">
			<tbody>
				<tr>
					<td style="border-top: none;border-left: none;border-right: none;"  valign="top" colspan="2">
						<b><u>Terms & Conditions</u></b>
						<ol>
							<li>Here will be first term or condition. </li>
							<li>Here will be second term or condition. </li>
							<li>Here will be third term or condition. </li>
							<li>Here will be fouth term or condition. </li>
						</ol>
					</td>
				</tr>
				<tr>
					<td style="border-top: none;border-left: none;border-bottom: none;" width="50%" valign="top">
						<div align="center"><b>Party Signture</b></div>
					</td>
					<td style="border-top: none;border-right: none;border-bottom: none;" valign="bottom">
						
						<div align="center"><span style="border-top: solid 1px;"><b>Authorised signatory</b><span></div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>






	