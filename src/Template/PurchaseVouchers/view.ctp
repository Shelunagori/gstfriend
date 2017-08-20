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
<div class="row">
	<div class="col-md-12">
		<a class="btn  blue hidden-print" style="margin-left:77%;" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id],['class'=>'btn yellow-crusta hidden-print']) ?>
	</div>
</div>	
<div style="width:80%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;margin-top:2%" class="maindiv">
	<table width="100%">
		<tr>
			<td width="30%" style="padding:5px;"><?php echo $this->Html->image('/img/viewlogo.png', ['height' => '100px']); ?></td>
			<td>
				<div align="center" style="color: #c4151c;"><b>
					<?php foreach($companies as $company) {?>
					<span style="font-size:30px;color: #c4151c !important;" style=""><?= $company->name ?></span><br/>
					<span style="color: #4a4c4c;"><?= $company->address ?></span><br/>
					<span style="color: #4a4c4c;"><?= $company->district ?>&nbsp,&nbsp<?= $company->state ?></span><br/>
					<span style="color: #4a4c4c;"><?= $company->phone_no ?></span><br/>
					<span style="color: #4a4c4c;">GSTIN: 08BICPD5795A1ZG</span></b>
				<?php } ?>	
				</div>
			</td>
			<td width="30%"></td>
		</tr>
	</table>
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color : #c4151c !important;font-size:18px;color: #FFF !important;"><b style="color: #FFF !important;">PURCHASE VOUCHER</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td width="70%"><b>Voucher No.</b></td>
							<td><?= $this->Number->format($purchaseVoucher->voucher_no) ?></td>
						</tr>
						<tr>
							<td width="50%"><b>Reference No.</b></td>
							<td><?= h($purchaseVoucher->reference_no) ?></td>
						</tr>
						<tr>
							<td width="50%"><b>Transaction Date</b></td>
							<td><?= h($purchaseVoucher->transaction_date) ?></td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;" valign="top">
					<table width="100%">
						
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
						<tr>
							<td width="50"><b>GST No.</b></td>
							<td><?= h($purchaseVoucher->supplier_ledger->supplier->gstno) ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div align="center" style="border:none;">
		<table width="100%" class="tbl" id="mainTbl">
			<thead>
				<tr style="background-color: #e4e3e3;">
					<th rowspan="2" style="border-left: none;">Sr. No.</th>
					<th rowspan="2" width="30%">Item Description</th>
					<th rowspan="2" width="80">HSN code</th>
					<th rowspan="2" width="40">Qty</th>
					<th rowspan="2" width="80">Rate</th>
					<th rowspan="2" width="80">Amount</th>
					<th rowspan="2">Discount</th>
					<th rowspan="2" width="80">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
					<th colspan="2">IGST</th>
					<th rowspan="2" style="border-right: none;" width="80">Total</th>
				</tr>
				<tr style="background-color: #e4e3e3;">
					<th width="80">Rate</th>
					<th width="80">Amount</th>
					<th width="80">Rate</th>
					<th width="80">Amount</th>
					<th width="80">Rate</th>
					<th width="80">Amount</th>
				</tr>
			</thead>
			<tbody id="mainTbody">
				<?php   $i=0; //pr($purchaseVoucher->purchase_voucher_rows); exit;
						foreach ($purchaseVoucher->purchase_voucher_rows as $purchaseVoucherRows):
						$i++;
				?>
				<tr>
					<td width="15px"style="border-left: none;"><?= $this->Number->format($i) ?></td>
					<td width="30%"><?= h($purchaseVoucherRows->item->name) ?></td>
					<td width="80"><?= h($purchaseVoucherRows->item->hsn_code) ?></td>
					<td width="40" style="text-align:center"><?= $this->Number->format($purchaseVoucherRows->quantity) ?></td>
					<td width="40" style="text-align:right"><?= $this->Number->format($purchaseVoucherRows->rate_per) ?></td>
					<td width="40" style="text-align:right"><?= $this->Number->format($purchaseVoucherRows->amount) ?></td>
					<td width="44px" style="text-align:right"><?= $this->Number->format($purchaseVoucherRows->discount_amount) ?></td>
					<td width="48px" style="text-align:right"><?= $this->Number->format($purchaseVoucherRows->taxable_value) ?></td>
					<td width="35px" style="text-align:right"><?= h($cgst_per[$purchaseVoucherRows->id]['tax_percentage']) ?>%</td>
					<td width="43px" style="text-align:right"><?= $this->Number->format($purchaseVoucherRows->cgst_amount) ?></td>
					<td width="34px" style="text-align:right"><?= h($sgst_per[$purchaseVoucherRows->id]['tax_percentage']) ?>%</td>
					<td width="39px" style="text-align:right"><?= $this->Number->format($purchaseVoucherRows->sgst_amount) ?></td>
					<td width="34px" style="text-align:right"><?php 
					if($igst_per[$purchaseVoucherRows->id]['tax_percentage'] != 0)
					{
						echo $igst_per[$purchaseVoucherRows->id]['tax_percentage'];
					}
					else{ echo 0; }

					?>%</td>
					<td width="39px" style="text-align:right"><?= $this->Number->format($purchaseVoucherRows->igst_amount) ?></td>
					<td style="border-right: none;text-align:right"width="31px"><?= $this->Number->format($purchaseVoucherRows->total) ?></td>
					
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<!--Convert Rupees ito Word- Start-->
		<?php
			$grand_total=explode('.',$purchaseVoucher->total_amount_after_tax);
			$rupees=$grand_total[0];
			$paisa_text='';
			if(sizeof($grand_total)==2)
			{
				$grand_total[1]=str_pad($grand_total[1], 2, '0', STR_PAD_RIGHT);
				$paisa=(int)$grand_total[1];
				$paisa_text=' and ' . h(ucwords($this->NumberWords->convert_number_to_words($paisa))) .' Paisa';
			}else{ $paisa_text=""; }
		?>
		<!--Convert Rupees ito Word- End-->
		<table width="100%" class="tbl total">
			<tbody>
				<tr>
					<td style="text-align:left;border-left: none;border-top: none;" rowspan="4" width="70%" valign="top">
						<p><b>Amount in words : </b>
						<?= h(ucwords($this->NumberWords->convert_number_to_words($rupees))) ?> Rupees<?= h($paisa_text) ?>
						</p>
					</td>
					<td style="text-align:right;border-top: none;"><b>Total Amount before Tax</b></td>
					<td style="text-align:right;border-right: none;border-top: none;" width="80"><?= $this->Number->format($purchaseVoucher->total_amount_before_tax) ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total CGST</b></td>
					<td style="text-align:right;border-right: none;"><?= $this->Number->format($purchaseVoucher->total_cgst) ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total SGST</b></td>
					<td style="text-align:right;border-right: none;"><?= $this->Number->format($purchaseVoucher->total_sgst) ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total IGST</b></td>
					<td style="text-align:right;border-right: none;"><?= $this->Number->format($purchaseVoucher->total_igst) ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total Amount after Tax</b></td>
					<td style="text-align:right;border-right: none;" class="total_after_tax"><?= $this->Number->format($purchaseVoucher->total_amount_after_tax)?></td>
				</tr>
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<!---<tr>
					<td style="border-top: none;border-left: none;border-right: none;"  valign="top" colspan="2">
						<b><u>Terms & Conditions</u></b>
						<ol>
							<li>Here will be first term or condition. </li>
							<li>Here will be second term or condition. </li>
							<li>Here will be third term or condition. </li>
							<li>Here will be fouth term or condition. </li>
						</ol>
					</td>
				</tr>--->
				<tr>
					<td style="border-top: none;border-left: none;border-bottom: none;" width="50%" valign="top">
						<div align="center"></br></br></br></div>
						<div align="center"><b>Customer Signture</b></div>
					</td>
					<td style="border-top: none;border-right: none;border-bottom: none;" valign="bottom">
						<div align="center"></br></br></br></div>
						<div align="center"><span style="border-top: solid 1px;"><b>Authorised signatory</b><span></div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>