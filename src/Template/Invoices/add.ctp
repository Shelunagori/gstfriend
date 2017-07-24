<?php $this->set('title', 'Add Invoice'); ?>
<style>
@media print{
	.maindiv{
		width:100% !important;
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
    margin: 0 5px 0 20px;  /* this affects the margin in the printer settings */
}

p{
	margin-bottom: 0;
}

.tbl td, .tbl th {
    border: 1px solid black;
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
<?= $this->Form->create($invoice) ?>
<div style="width:80%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;" class="maindiv">
	<table width="100%">
		<tr>
			<td width="30%" style="padding:5px;"><?php echo $this->Html->image('/img/viewlogo.png', ['height' => '100px']); ?></td>
			<td>
				<div align="center" style="color: #c4151c;"><b>
					<span style="font-size:16px;">NEW BHAGYALAXMI MOBILE POINT</span><br/>
					<span style="color: #4a4c4c;">287-A, MAIN ROAD SAVEENA,</span><br/>
					<span style="color: #4a4c4c;">Udaipur, Rajasthan. PIN: 313001</span><br/>
					<span style="color: #4a4c4c;">Tel: +91 9001222622</span><br/>
					<span style="color: #4a4c4c;">GSTIN: 08BICPD5795A1ZG</span></b>
				</div>
			</td>
			<td width="30%"></td>
		</tr>
	</table>
	
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color: #c4151c;font-size:18px;color: #FFF;"><b>TAX INVOICE</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td><b>Invoice No.</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>-</td>
						</tr>
						<tr>
							<td><b>Invoice Date</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('invoice_date',['label'=>false,'placeholder'=>'dd-mm-yyyy']); ?></td>
						</tr>
						<tr>
							<td><b>State</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>
							<?php echo $this->Form->control('state',['label'=>false,'placeholder'=>'Rajasthan']); ?>
							</td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;" valign="top">
					<table width="100%">
						<tr>
							<td colspan="3"><b>Bill to Party</b></td>
						</tr>
						<tr>
							<td><b>Name</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('party_name',['label'=>false,'placeholder'=>'Name']); ?></td>
							<td><b>Mobile</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('party_mobile',['label'=>false,'placeholder'=>'Mobile']); ?></td>
						</tr>
						<tr>
							<td><b>Address</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td colspan="4"><?php echo $this->Form->control('party_address',['label'=>false,'placeholder'=>'Address','style'=>'width: 100%;height: 60px;']); ?></td>
						</tr>
						<tr>
							<td><b>State</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('party_state',['label'=>false,'placeholder'=>'Rajasthan']); ?></td>
							<td><b>GSTIN</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('party_gst',['label'=>false,'placeholder'=>'GSTIN']); ?></td>
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
					<th rowspan="2">HSN code</th>
					<th rowspan="2">Qty</th>
					<th rowspan="2">Rate</th>
					<th rowspan="2">Amount</th>
					<th colspan="2">Discount</th>
					<th rowspan="2">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
					<th rowspan="2" style="border-right: none;">Total</th>
				</tr>
				<tr style="background-color: #e4e3e3;">
					<th>Rate</th>
					<th>Amount</th>
					<th>Rate</th>
					<th>Amount</th>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody id="mainTbody">
				
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<tr>
					<td rowspan="4" style="border-left: none;border-top: none;border-bottom: none;" width="70%" valign="top">
						<button type="button" class="btn btn-default btn-xs addrow"><i class="fa fa-plus"></i> Add row</button>
					</td>
					<td style="text-align:right;border-top: none;"><b>Total Amount before Tax</b></td>
					<td style="text-align:right;border-right: none;border-top: none;" width="80">
						<?php echo $this->Form->control('total_amount_before_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total CGST</b></td>
					<td style="text-align:right;border-right: none;">
						<?php echo $this->Form->control('total_cgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total SGST</b></td>
					<td style="text-align:right;border-right: none;">
						<?php echo $this->Form->control('total_sgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;border-bottom: none;"><b>Total Amount after Tax</b></td>
					<td style="text-align:right;border-right: none;border-bottom: none;">
						<?php echo $this->Form->control('total_amount_after_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;']); ?>	
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	add_row();
	$('.addrow').live("click",function() {
		add_row();
	});
	function add_row(){
		var tr=$("#sampleTbl tbody tr").clone();
		$("#mainTbl tbody#mainTbody").append(tr);
		rename_rows();
	}
	
	function rename_rows(){
		var i=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			$(this).find("td:eq(1) input").attr({name:"invoices["+i+"][item]", id:"invoices-"+i+"-item"});
			$(this).find("td:eq(2) input").attr({name:"invoices["+i+"][hsn_code]", id:"invoices-"+i+"-hsn_code"});
			$(this).find("td:eq(3) input").attr({name:"invoices["+i+"][quantity]", id:"invoices-"+i+"-quantity"});
			$(this).find("td:eq(4) input").attr({name:"invoices["+i+"][rate]", id:"invoices-"+i+"-rate"});
			$(this).find("td:eq(5) input").attr({name:"invoices["+i+"][amount]", id:"invoices-"+i+"-amount"});
			$(this).find("td:eq(6) input").attr({name:"invoices["+i+"][discount_rate]", id:"invoices-"+i+"-discount_rate"});
			$(this).find("td:eq(7) input").attr({name:"invoices["+i+"][discount_amount]", id:"invoices-"+i+"-discount_amount"});
			$(this).find("td:eq(8) input").attr({name:"invoices["+i+"][taxable_value]", id:"invoices-"+i+"-taxable_value"});
			$(this).find("td:eq(9) input").attr({name:"invoices["+i+"][cgst_rate]", id:"invoices-"+i+"-cgst_rate"});
			$(this).find("td:eq(10) input").attr({name:"invoices["+i+"][cgst_amount]", id:"invoices-"+i+"-cgst_amount"});
			$(this).find("td:eq(11) input").attr({name:"invoices["+i+"][sgst_rate]", id:"invoices-"+i+"-sgst_rate"});
			$(this).find("td:eq(12) input").attr({name:"invoices["+i+"][sgst_amount]", id:"invoices-"+i+"-sgst_amount"});
			$(this).find("td:eq(13) input").attr({name:"invoices["+i+"][total]", id:"invoices-"+i+"-total"});
		i++;
		});
	}
});
</script>

<table id="sampleTbl" style="display:none;">
	<tbody>
		<tr class="mainTr">
			<td style="text-align:center;border-left: none;">1</td>
			<td>
				<?php echo $this->Form->control('item',['label'=>false,'placeholder'=>'Item Description','style'=>'width: 100%;']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('hsn_code',['label'=>false,'placeholder'=>'HSN code','style'=>'width: 100%;']); ?>
			</td>
			<td style="text-align:center;">
				<?php echo $this->Form->control('quantity',['label'=>false,'placeholder'=>'Qty','style'=>'width: 100%;text-align: center;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('rate',['label'=>false,'placeholder'=>'Rate','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('amount',['label'=>false,'placeholder'=>'Amount','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('discount_rate',['label'=>false,'placeholder'=>'%','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('discount_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('taxable_value',['label'=>false,'placeholder'=>'Taxable Value','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('cgst_rate',['label'=>false,'placeholder'=>'%','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('cgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('sgst_rate',['label'=>false,'placeholder'=>'%','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('sgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;']); ?>
			</td>
			<td style="text-align:right;border-right: none;">
				<?php echo $this->Form->control('total',['label'=>false,'placeholder'=>'Total','style'=>'width: 100%;text-align: right;']); ?>
			</td>
		</tr>
	</tbody>
</table>