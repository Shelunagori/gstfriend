<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Item_Wise_Excel_".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>
<table id="example1" class="table table-bordered  hidetable maindiv  main_table"  style="border:1px solid">
	<?php if(!empty($filterdatasitem))
		{	?>
	<thead style="text-align:center;"  class="maindiv">
		<tr style="border:1px solid">
			<th scope="col">Sr.</th>
			<th scope="col">Trans. Date</th>
			<th scope="col">Inv. No.</th>
			<th scope="col">Customer</th>
			<th scope="col">Item Name</th>
			<th scope="col">HSN Code</th>
			<th scope="col" style="width:30px;">Qty</th>
			<th scope="col" style="width:50px;">Rate</th>
			<th scope="col" >Discount</th>
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
		$cgstamount=0;     $sgstamount=0;     $basevalue=0;     $totalvalue=0;
		$baseamount=0;     $totalamount=0;    $totalquantity=0;
		//pr($filterdatasitem->toarray());    exit;
		foreach ($filterdatasitem as $invoice): $i++; 
			if(sizeof($invoice->invoice_rows)>0){ 
			?>
		<tr class="main_tr"  style="border:1px solid">
			<td style="width:5px;"><?php echo $i; ?></td>
			<td style="width:5px;"><?= h($invoice->transaction_date) ?></td>
			<td><?php echo $invoice->invoice_no; ?></td>
			<td><?php if($invoice->customer_ledger_id !=''){
				echo $invoice->customer_ledgers->name;
			}else{
			echo $invoice->customer_name; }?></td>
			<td colspan="9" style="text-align:right">
				<table class="table table-bordered table-hover">
					<?php  foreach ($invoice->invoice_rows as $invoice_row):?>
					<tr>
						<td style="width:60px;text-align:left">
						<?php
							if(!empty($invoice_row->item_id)) 
							{
								echo $invoice_row->item->name; 
							}else
							{ 
								echo '0';
							}?>
						</td>
						<td style="width:60px;text-align:left">
						<?php
								echo $invoice_row->item->hsn_code; 
						?>
						</td>
						<td style="width:30px;text-align:left">
						<?php
								echo $invoice_row->quantity; 
								$totalquantity=$totalquantity+$invoice_row->quantity;
								
						?>
						</td>
						<td style="width:50px;text-align:left">
						<?php
								echo $invoice_row->rate; 
								$totalvalue=$invoice_row->rate*$invoice_row->quantity;
						?>
						</td>
						<td style="width:50px;text-align:left">
						<?php
								echo $invoice_row->discount_amount; 
								
						?>
						</td>
						<td style="width:60px">
						<?php
							if(!empty($invoice_row->cgst)) 
							{
								echo $invoice_row->cgst->name; 
							}else
							{ 
								echo '0';
							}?>
						</td>
						<td style="text-align:right;width:80px">
						<?php 
							echo $invoice_row->cgst_amount;
							$cgstamount = $cgstamount + $invoice_row->cgst_amount; 
						?>
						</td>
						<td style="width:60px">
						<?php if(!empty($invoice_row->sgst)) 
							{
								echo $invoice_row->sgst->name; 
							}else
							{ 
								echo '0';
							} ?>
						</td>
						<td style="text-align:right;width:80px">
						<?php 
							echo $invoice_row->sgst_amount;
							$sgstamount = $sgstamount + $invoice_row->sgst_amount;
						?>
						</td>
						
					</tr>
					<?php   $basevalue=$totalvalue-$invoice_row->discount_amount-$invoice_row->cgst_amount-$invoice_row->sgst_amount;
							$baseamount = $baseamount + $basevalue;
							$totalamount = $totalamount + $totalvalue;
							endforeach;  ?>
				</table>		
			</td>
			<td style="text-align:right"><?php echo $basevalue; ?></td>
			<td style="text-align:right"><?php echo $totalvalue; ?></td>
			
		</tr>
		<?php 
			}
			
			endforeach;
		?>
	</tbody>				
	<tfoot >
		<tr  style="border:1px solid">
			<td colspan="6" style="text-align:right"><b>TOTAL Qty</b></td>
			<td class="totalcgst" style="text-align:right"><b><?php echo $totalquantity; ?></b></td>
			<td colspan="3"  style="text-align:right"><b>TOTAL Amount</b></td>
			<td class="totalcgst"  style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
			<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
			<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
			<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
			<td></td>
			
		</tr>
	</tfoot>
	<?php } else{
			echo 'No Data Found';
		}?>
</table>		
