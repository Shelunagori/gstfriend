<?php $this->set('title', 'View Invoice'); ?>
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
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id],['class'=>'btn yellow-crusta hidden-print']) ?>
	</div>	
</div>
<div style="width:80%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF; margin-top:2%" class="maindiv" >
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
	
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color : #c4151c !important;font-size:18px;color: #FFF !important;"><b style="color: #FFF !important;">TAX INVOICE</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td width="80"><b>Invoice No.</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?= h('#'.str_pad($invoice->invoice_no, 4, '0', STR_PAD_LEFT)) ?></td>
						</tr>
						<tr>
						</tr>
						<tr>
							<td width="80"><b>Invoice Date</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?= $invoice->transaction_date ?></td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;" valign="top">
					<div style="text-align: center;"><u>Bill to Party</u></div>
					<?php 	if($invoice->invoicetype == 'Credit')
							{
					?>
					<table width="100%">
						<tr>
							<td width="60"><b>Name</b></td>
							<td><?php echo $invoice->customer_ledgers->customer->name; ?></td>
							
							<td width="50"><b>Mobile</b></td>
							<td><?php echo $invoice->customer_ledgers->customer->mobile; ?></td>
							<td></td>
						</tr>
						<tr>
							<td valign="top" width="60"><b>Address</b></td>
							<td valign="top"><?php echo $invoice->customer_ledgers->customer->address; ?></td>
							<td colspan="4"></td>
						</tr>
						<tr>
							<td width="50"><b>State</b></td>
							<td><?php echo $invoice->customer_ledgers->customer->state; ?></td>
							<td><b>GSTIN</b></td>
							<td><?php echo $invoice->customer_ledgers->customer->gstno;?></td>
						</tr>
					</table>
					<?php  } else{?>
					<table width="100%">
						<!---<tr>
							<td width="50"><b>Type</b></td>
							<td>Cash</td>
						</tr>-->
						<tr>		
							<td width="60"><b>Name</b></td>
							<td><?php echo $invoice->customer_name; ?></td>
						</tr>
					</table>	
					<?php } ?>
				</td>
			</tr>
		</table>
	</div>
	<div align="center" style="border:none;">
		<table width="100%" class="tbl">
			<thead>
				<tr style="background-color: #e4e3e3 !important;">
					<th rowspan="2" style="border-left: none;">Sr. No.</th>
					<th rowspan="2">Item</th>
					<th rowspan="2">HSN code</th>
					<th rowspan="2">Qty</th>
					<th rowspan="2">Rate</th>
					<th rowspan="2">Amount</th>
					<th rowspan="2">Discount</th>
					<th rowspan="2">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
					<th colspan="2">IGST</th>
					<th rowspan="2" style="border-right: none;">Total</th>
				</tr>
				<tr style="background-color: #e4e3e3 !important;">
					<th>Rate</th>
					<th>Amount</th>
					<th>Rate</th>
					<th>Amount</th>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=0; if(!empty($invoice->invoice_rows)) {
			foreach($invoice->invoice_rows as $invoice_row){ ?>
				<tr>
					<td style="text-align:center;border-left: none;"><?= ++$i ?></td>
					<td><?= h($invoice_row->item->name) ?></td>
					<td><?= $invoice_row->item->hsn_code ?></td>
					<td style="text-align:center;"><?= $invoice_row->quantity ?></td>
					<td style="text-align:right;"><?= $invoice_row->rate ?></td>
					<td style="text-align:right;"><?= $invoice_row->amount ?></td>
					<td style="text-align:right;"><?= $invoice_row->discount_amount ?></td>
					<td style="text-align:right;"><?= $invoice_row->taxable_value ?></td>
					<td style="text-align:right;">
					<?php 
						if($invoice_row->cgst->tax_percentage!= 0)
						{
							echo $invoice_row->cgst->tax_percentage;
						}
						else{ echo 0; }
					?>%</td>		
					<td style="text-align:right;"><?= $invoice_row->cgst_amount ?></td>
					<td style="text-align:right;">
					<?php 
						if($invoice_row->sgst->tax_percentage!= 0)
						{
							echo $invoice_row->sgst->tax_percentage;
						}
						else{ echo 0; }
						 
					?>%</td>
					<td style="text-align:right;"><?= $invoice_row->sgst_amount ?></td>
					<td style="text-align:right;">
					<?php 
						if($invoice_row->igst->tax_percentage!= 0)
						{
							echo $invoice_row->igst->tax_percentage;
						}
						else{ echo 0; }
					?>%</td>
					<td style="text-align:right;"><?= $invoice_row->igst_amount ?></td>
					<td style="text-align:right;border-right: none;"><?= $invoice_row->total ?></td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>
		<?php
			$grand_total=explode('.',$invoice->total_amount_after_tax);
			$rupees=$grand_total[0];
			$paisa_text='';
			if(sizeof($grand_total)==2)
			{
				$grand_total[1]=str_pad($grand_total[1], 2, '0', STR_PAD_RIGHT);
				$paisa=(int)$grand_total[1];
				$paisa_text=' and ' . h(ucwords($this->NumberWords->convert_number_to_words($paisa))) .' Paisa';
			}else{ $paisa_text=""; }
		?>
		<table width="100%" class="tbl">
			<tbody>
				<tr>
					<td style="text-align:left;border-left: none;border-top: none;" rowspan="4" width="70%" valign="top">
						<p><b>Amount in words : </b>
						<?= h(ucwords($this->NumberWords->convert_number_to_words($rupees))) ?> Rupees<?= h($paisa_text) ?>
						</p>
					</td>
					<td style="text-align:right;border-top: none;"><b>Total Amount before Tax</b></td>
					<td style="text-align:right;border-right: none;border-top: none;" width="80"><?= $invoice->total_amount_before_tax ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total CGST</b></td>
					<td style="text-align:right;border-right: none;"><?= $invoice->total_cgst ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total SGST</b></td>
					<td style="text-align:right;border-right: none;"><?= $invoice->total_sgst ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total IGST</b></td>
					<td style="text-align:right;border-right: none;"><?= $invoice->total_igst ?></td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total Amount after Tax</b></td>
					<td style="text-align:right;border-right: none;"><?= $invoice->total_amount_after_tax ?></td>
				</tr>
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<!--<tr>
					<td style="border-top: none;border-left: none;border-right: none;"  valign="top" colspan="2">
						<b><u>Terms & Conditions</u></b>
						<ol>
							<li>Here will be first term or condition. </li>
							<li>Here will be second term or condition. </li>
							<li>Here will be third term or condition. </li>
							<li>Here will be fouth term or condition. </li>
						</ol>
					</td>
				</tr>-->
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
