<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Supplier_name_wise_".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>
<table id="example1" class="table table-bordered  hidetable maindiv  main_table" style="border:1px solid">
	<?php if(!empty($filterdatas))
		{	?>
	<thead style="text-align:center;"  class="maindiv">
		<tr style="border:1px solid">
			<th scope="col">Sr.</th>
			<th scope="col">Trans. Date</th>
			<th scope="col">Inv. No.</th>
			<th scope="col">Ref. No.</th>
			<th scope="col">Customer</th>
			<th scope="col">Item Name</th>
			<th scope="col">HSN Code</th>
			<th scope="col" style="width:30px;">Qty</th>
			<th scope="col" style="width:50px;">Rate</th>
			<th scope="col">Discount</th>
			<th scope="col">CGST %</th>
			<th scope="col">CGST Amount</th>
			<th scope="col">SGST %</th>
			<th scope="col">SGST Amount</th>
			<th scope="col">Base Amount</th>							
			<th scope="col">Total</th>
		</tr>
	</thead>
	<tbody class="main_tbody" style="border:1px solid">
	<?php $i=0;
	$cgstamount=0;     $sgstamount=0;    
	$baseamount=0;     $totalamount=0;		$totalquantity=0;
	foreach ($filterdatas as $filterdata): $i++;  
	 ?>
	<tr class="main_tr" style="border:1px solid">
		<td><?php echo  $i; ?></td>
		<td><?= h($filterdata->transaction_date) ?></td>
		<td><?= h($filterdata->voucher_no) ?></td>
		<td><?= h($filterdata->reference_no) ?></td>
		<td><?php echo $filterdata->supplier_ledger->name; ?></td>
		<td colspan="9" style="text-align:right">
			<table class="table table-bordered table-hover">
				<?php 		
				foreach($filterdata->purchase_voucher_rows as $purchase_voucher_row):
				?>
				<tr>
					<td style="width:60px;text-align:left">
					<?php
						if(!empty($purchase_voucher_row->item_id)) 
						{
							echo $purchase_voucher_row->item->name; 
						}else
						{ 
							echo '0';
						}?>
					</td>
					<td style="width:60px;text-align:left">
					<?php
							echo $purchase_voucher_row->item->hsn_code; 
					?>
					</td>
					<td style="width:40px;text-align:left">
					<?php
							echo $purchase_voucher_row->quantity; 
							
					?>
					</td>
					<td style="width:40px;text-align:left">
					<?php
							echo $purchase_voucher_row->rate_per; 
					?>
					</td>
					<td style="width:40px;text-align:left">
					<?php
							echo $purchase_voucher_row->discount_amount; 
							
					?>
					</td>
					<td style="width:60px">
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
					<td style="width:60px">
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
					
				</tr>
				<?php  	
					$totalquantity=$totalquantity+$purchase_voucher_row->quantity;
					$cgstamount = $cgstamount + $purchase_voucher_row->cgst_amount; 
					$sgstamount = $sgstamount + $purchase_voucher_row->sgst_amount;
					endforeach;
						
				?>
			</table>		
		</td>
		<td align="right"><?= $this->Number->format($filterdata->total_amount_before_tax) ?></td>
		
		<td align="right"><?= $this->Number->format($filterdata->total_amount_after_tax) ?></td>
		
	</tr>

	<?php 
	$baseamount = $baseamount + $filterdata->total_amount_before_tax;
	$totalamount = $totalamount + $filterdata->total_amount_after_tax;

	endforeach; ?>
	</tbody>

	<tfoot class="tfoot" >
		<tr style="border:1px solid">
			<td colspan="7" style="text-align:right"><b>TOTAL Qty</b></td>
			<td class="totalcgst" style="text-align:right"><b><?php echo $totalquantity; ?></b></td>
			<td colspan="3"  style="text-align:right"><b>TOTAL Amount</b></td>
			<td class="totalcgst"  style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
			<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
			<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
			<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
		</tr>
	</tfoot>
	<?php } else{
			echo 'No Data Found';
		}?>
</table>	