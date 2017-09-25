<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Purchase_Invoice_Excel".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>
<table id="example1" class="table table-bordered  hidetable maindiv main_table" style="border:1px solid">
	<thead style="text-align:center;">
		<tr style="border:1px solid">
			<th scope="col">Sr. No.</th>
			<th scope="col">Transaction Date</th>
			<th scope="col">Invoice No.</th>
			<th scope="col">Reference No.</th>
			<th scope="col">Supplier Name</th>
			<th scope="col">Item Name</th>
			<th scope="col">HSN Code</th>
			<th scope="col">Qty</th>
			<th scope="col">Rate</th>
			<th scope="col">Discount</th>
			<th scope="col">CGST Percentage</th>
			<th scope="col">CGST Amount</th>
			<th scope="col">SGST Percentage</th>
			<th scope="col">SGST Amount</th>
			<th scope="col" class="hide">IGST Percentage</th>
			<th scope="col" class="hide">IGST Amount</th>
			<th scope="col">Base Amount</th>							
			<th scope="col">Total</th>
		</tr>
	</thead>
	<tbody class="main_tbody" style="border:1px solid">
	<?php 	$i=0; 
			$cgstamount=0;     $sgstamount=0;     $igstamount=0;
			$baseamount=0;     $totalamount=0;		$totalquantity=0;
			foreach ($purchaseVouchers as $purchaseVoucher): 
			$i++;
	?>
		<tr class="main_tr" style="border:1px solid">
			<td><?php echo $i; ?></td>
			<td><?= h($purchaseVoucher->transaction_date) ?></td>
			<td><?php echo $purchaseVoucher->voucher_no; ?></td>
			<td><?php echo $purchaseVoucher->reference_no; ?></td>
			<td><?php echo $purchaseVoucher->supplier_ledger->name; ?></td>
			<td colspan="11" style="text-align:right">
				<table class="table table-bordered table-hover" style="border:1px solid">
					<?php 		
					
					foreach($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row):
					
					?>
					<tr style="border:1px solid">
						<td style="width:50px;text-align:left">
						<?php
							if(!empty($purchase_voucher_row->item_id)) 
							{
								echo $purchase_voucher_row->item->name; 
							}else
							{ 
								echo '0';
							}?>
						</td>
						<td style="width:50px;text-align:left">
						<?php
								echo $purchase_voucher_row->item->hsn_code; 
						?>
						</td>
						<td style="width:30px;text-align:left">
						<?php
								echo $purchase_voucher_row->quantity; 
								
						?>
						</td>
						<td style="width:30px;text-align:left">
						<?php
								echo $purchase_voucher_row->rate_per; 
						?>
						</td>
						<td style="width:60px;text-align:left">
						<?php
								echo $purchase_voucher_row->discount_amount; 
						?>
						</td>
						<td style="width:80px">
						<?php
							if(!empty($purchase_voucher_row->cgst_ledger)) 
							{
								echo $purchase_voucher_row->cgst_ledger->name; 
							}else
							{ 
								echo '0';
							}?>
						</td>
						<td style="text-align:right;width:80px">
						<?php 
							echo $purchase_voucher_row->cgst_amount;
							
						?>
						</td>
						<td style="width:80px">
						<?php if(!empty($purchase_voucher_row->sgst_ledger)) 
							{
								echo $purchase_voucher_row->sgst_ledger->name; 
							}else
							{ 
								echo '0';
							} ?>
						</td>
						<td style="text-align:right;width:70px">
						<?php 
							echo $purchase_voucher_row->sgst_amount;
							
						?>
						</td>
						<td style="width:80px" class="hide">
						<?php 
							if(!empty($purchase_voucher_row->igst_ledger)) 
							{
								echo $purchase_voucher_row->igst_ledger->name; 
							}else
							{ 
								echo '0';
							}
							?>
						</td>
						<td style="text-align:right;width:70px" class="hide"><?php echo $purchase_voucher_row->igst_amount; 
							
						?>
						</td>
					</tr>
					<?php  
						$cgstamount = $cgstamount + $purchase_voucher_row->cgst_amount;
						$sgstamount = $sgstamount + $purchase_voucher_row->sgst_amount;
						$igstamount = $igstamount + $purchase_voucher_row->igst_amount;
						$totalquantity=$totalquantity+$purchase_voucher_row->quantity;
						endforeach;
							
					?>
				</table>		
			</td>
			<td style="text-align:right"><?php echo $purchaseVoucher->total_amount_before_tax; ?></td>
			<td style="text-align:right"><?php echo $purchaseVoucher->total_amount_after_tax; ?></td>
			
		</tr>
		<?php 
			  
			$baseamount = $baseamount + $purchaseVoucher->total_amount_before_tax;
			$totalamount = $totalamount + $purchaseVoucher->total_amount_after_tax;
			endforeach;
		?>
	
	</tbody>
	<tfoot class="tfoot" style="border:1px solid">
		<tr>
			<td colspan="7" style="text-align:right"><b>TOTAL Qty</b></td>
			<td class="totalcgst" style="text-align:right"><b><?php echo $totalquantity; ?></b></td>
			<td colspan="3"  style="text-align:right"><b>TOTAL Amount</b></td>
			<td class="totalcgst"  style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
			<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
			<td class="totaligst  hide" colspan="2" style="text-align:right"><b><?php echo $igstamount; ?></b></td>
			<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
			<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
		</tr>
	</tfoot>
</table>