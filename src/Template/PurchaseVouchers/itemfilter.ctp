<div  class="main_div maindiv" style="border:none">
	<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/PurchaseVouchers/Item-Wise-Excel/'.$itemwise.'/'.$startdatefrom.'/'.$startdateto.'',['class' =>'btn btn-sm green tooltips pull-right Item-Wise-Excel','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>

<table id="example1" class="table table-bordered  hidetable maindiv  main_table">
	<?php if(!empty($filterdatasitem))
		{	?>
	<thead style="text-align:center;"  class="maindiv">
		<tr>
			<th scope="col">Sr.</th>
			<th scope="col">Trans. Date</th>
			<th scope="col">Inv. No.</th>
			<th scope="col">Ref. No.</th>
			<th scope="col">Supplier</th>
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
			<th scope="col" class="hidden-print">Action</th>
		</tr>
	</thead>
	<tbody class="main_tbody">
		<?php $i=0;
		$cgstamount=0;     $sgstamount=0;     $totalbase=0;    $totalvalue=0;
		$baseamount=0;     $totalamount=0;    $dueamountamount=0;
		$recieveamount=0;	$totalquantity=0;
		foreach ($filterdatasitem as $purchasevoucher): $i++; 
		if(sizeof($purchasevoucher->purchase_voucher_rows)>0){
			?>
		<tr class="main_tr">
			<td style="width:5px;"><?php echo $i; ?></td>
			<td style="width:5px;"><?= h($purchasevoucher->transaction_date) ?></td>
			<td><?php echo $purchasevoucher->voucher_no; ?></td>
			<td><?php echo $purchasevoucher->reference_no; ?></td>
			<td><?php echo $purchasevoucher->supplier_ledger->name;
			?></td>
			<td colspan="9" style="text-align:right">
				<table class="table table-bordered table-hover">
					<?php  foreach ($purchasevoucher->purchase_voucher_rows as $invoice_row):?>
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
						<td style="width:70px;text-align:left">
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
						<td style="width:40px;text-align:left">
						<?php
								echo $invoice_row->rate_per; 
								$totalvalues=$invoice_row->rate_per*$invoice_row->quantity;
						?>
						</td>
						<td style="width:40px;text-align:left">
						<?php
								echo $invoice_row->discount_amount; 
								$totalvalue=$totalvalues-$invoice_row->discount_amount;
						?>
						</td>
						<td style="width:60px">
						<?php
							if(!empty($invoice_row->cgst_ledger)) 
							{
								echo $invoice_row->cgst_ledger->name; 
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
						<?php if(!empty($invoice_row->sgst_ledger)) 
										{
											echo $invoice_row->sgst_ledger->name; 
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
					<?php  	$totalbase=$totalvalue-$invoice_row->cgst_amount-$invoice_row->sgst_amount;
							$baseamount = $baseamount + $totalbase;
							$totalamount = $totalamount + $totalvalue;
							endforeach;      ?>
				</table>		
			</td>
			<td style="text-align:right"><?php echo $totalbase; ?></td>
			<td style="text-align:right"><?php echo $totalvalue; ?></td>
			<td class="hidden-print"><?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchasevoucher->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete',$purchasevoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchasevoucher->id)]) ?>
			</td>
		</tr>
		<?php }
			
			endforeach;
		?>
	</tbody>				
	<tfoot >
		<tr>
			<td colspan="7" style="text-align:right"><b>TOTAL Qty</b></td>
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
</div>