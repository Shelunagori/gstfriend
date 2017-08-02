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
<a class="btn  blue hidden-print" style="margin-left:88%;" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id],['class'=>'btn yellow-crusta hidden-print']) ?>
<div style="width:80%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;margin-top:2%" class="maindiv">
	<table width="100%">
		<tr>
			<td width="30%" style="padding:5px;"><?php echo $this->Html->image('/img/viewlogo.png', ['height' => '100px']); ?></td>
			<td>
				<div align="center" style="color: #c4151c;"><b>
					<span style="font-size:16px;color: #c4151c !important;" style=""><h2><?= $purchaseVoucher->company->name ?></h2></span><br/>
					<span style="color: #4a4c4c;">Subhash Nagar Sevasram</span><br/>
					<span style="color: #4a4c4c;">Udaipur, Rajasthan. PIN: 313001</span><br/>
					<span style="color: #4a4c4c;">Tel: +91 9876543210</span><br/>
					<span style="color: #4a4c4c;">GSTIN: 08BICPD5795A1ZG</span></b>
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
					<th colspan="2">Discount</th>
					<th rowspan="2" width="80">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
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
				
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<?php   $i=0;
						foreach ($purchaseVoucher->purchase_voucher_rows as $purchaseVoucherRows):
						$i++;
				?>
				<tr>
					<td width="15px"style="border-left: none;"><?= $this->Number->format($i) ?></td>
					<td width="30%"><?= h($purchaseVoucherRows->item->name) ?></td>
					<td width="80"><?= $this->Number->format($i) ?></td>
					<td width="40"><?= $this->Number->format($i) ?></td>
					<td width="40"><?= $this->Number->format($i) ?></td>
					<td width="40"></td>
					<td width="43px"><?= h($purchaseVoucherRows->quantity) ?></td>
					<td width="44px"><?= h($purchaseVoucherRows->rate_per) ?></td>
					<td width="48px"><?= h($purchaseVoucherRows->amount) ?></td>
					<td width="35px"><?= h($purchaseVoucherRows->amount) ?></td>
					<td width="43px"><?= h($purchaseVoucherRows->amount) ?></td>
					<td width="34px"><?= h($purchaseVoucherRows->amount) ?></td>
					<td width="39px"><?= h($purchaseVoucherRows->amount) ?></td>
					<td style="border-right: none;"width="31px"><?= h($purchaseVoucherRows->amount) ?></td>
					
				</tr>
				<?php endforeach; ?>
				<tr>
					<td style="text-align:right;border-top: none;" width="80" colspan="10"><b>Total Amount before Tax</b></td>
					<td style="text-align:right;border-right: none;border-top: none;" width="80" colspan="3">
						<?php echo $this->Form->control('total_amount_before_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;" colspan="10"><b>Total CGST</b></td>
					<td style="text-align:right;border-right:none;" width="80" colspan="3">
						<?php echo $this->Form->control('total_cgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;" colspan="10"><b>Total SGST</b></td>
					<td style="text-align:right;border-right: none;" width="80" colspan="3">
						<?php echo $this->Form->control('total_sgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;border-bottom: none;" colspan="10"><b>Total Amount after Tax</b></td>
					<td style="text-align:right;border-right: none;border-bottom:none;" width="80" colspan="3">
						<?php echo $this->Form->control('total_amount_after_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;text-align: right;border: none;','tabindex'=>'-1']); ?>	
					</td>
				</tr>
			</tbody>
		</table>
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



<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	$('.calculate').live("keyup",function() {
		calculation();
	});
	
	function calculation(){
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_amount_after_tax=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			if(!quantity){ quantity=0; }
			var rate=parseFloat($(this).find("td:eq(4) input").val());
			if(!rate){ rate=0; }
			var amount=parseFloat(quantity*rate).toFixed(2);
			$(this).find("td:eq(5) input").val(amount);
			
			var discount_rate=parseFloat($(this).find("td:eq(6) input").val());
			if(!discount_rate){ discount_rate=0; }
			var discount_amount=parseFloat(amount*discount_rate/100).toFixed(2);
			
			$(this).find("td:eq(7) input").val(discount_amount);
			
			var taxable_value=parseFloat(amount-discount_amount);
			$(this).find("td:eq(8) input").val(taxable_value);
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;
			
			var cgst_rate=parseFloat($(this).find("td:eq(9) input").val());
			if(!cgst_rate){ cgst_rate=0; }
			var cgst_amount=parseFloat(taxable_value*cgst_rate/100).toFixed(2);
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			
			$(this).find("td:eq(10) input").val(cgst_amount);
			
			var sgst_rate=parseFloat($(this).find("td:eq(11) input").val());
			if(!sgst_rate){ sgst_rate=0; }
			var sgst_amount=parseFloat(taxable_value*sgst_rate/100).toFixed(2);
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			
			$(this).find("td:eq(12) input").val(sgst_amount);
			
			var total=parseFloat(taxable_value)+parseFloat(cgst_amount)+parseFloat(sgst_amount);
			$(this).find("td:eq(13) input").val(total.toFixed(2));
			total_amount_after_tax=total_amount_after_tax+total;
			
		});
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
	}
	
	$('.revCalculate').live("keyup",function() {
		reverseCalculation();
	});
	
	function reverseCalculation(){
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_amount_after_tax=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			var total=parseFloat($(this).find("td:eq(13) input").val());
			if(!total){ total=0; }
			
			var cgst_rate=parseFloat($(this).find("td:eq(9) input").val());
			if(!cgst_rate){ cgst_rate=0; }
			
			var sgst_rate=parseFloat($(this).find("td:eq(11) input").val());
			if(!sgst_rate){ sgst_rate=0; }
			
			var to_be_divide=parseFloat(cgst_rate)+parseFloat(sgst_rate)+100;
			
			var taxable_value=(total/to_be_divide)*100;
			
			$(this).find("td:eq(8) input").val(taxable_value.toFixed(2));
			
			var discount_rate=parseFloat($(this).find("td:eq(6) input").val());
			if(!discount_rate){ discount_rate=0; }
			
			var to_be_divide_for_discount=100-parseFloat(discount_rate);
			var amount=(taxable_value/to_be_divide_for_discount)*100;
			
			$(this).find("td:eq(5) input").val(amount.toFixed(2));
			
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			if(!quantity){ quantity=0; }
			
			var rate=amount/quantity;
			$(this).find("td:eq(4) input").val(rate.toFixed(2));
			
			var discount_amount=(amount*discount_rate)/100;
			$(this).find("td:eq(7) input").val(discount_amount.toFixed(2));
			
			var cgst_amount=(taxable_value*cgst_rate)/100;
			$(this).find("td:eq(10) input").val(cgst_amount.toFixed(2));
			
			var sgst_amount=(taxable_value*sgst_rate)/100;
			$(this).find("td:eq(12) input").val(sgst_amount.toFixed(2));
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			total_amount_after_tax=total_amount_after_tax+total;
		});
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
	}
	
	$('input[name="party_name"]').focus();
});
</script>
<style>
.mainTr:hover .viewThisResult { display: block; }
.mainTr:hover .sr { display: none; }
.viewThisResult { display: none; }
</style>


	