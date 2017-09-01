<table class=" table table-bordered table-hover" id='main_tbl' >
	<thead >
		<tr>
			<th scope="col" >Sr. No.</th>
			<th scope="col" >Date</th>
			<th scope="col" >Invoice No.</th>
			<th scope="col" >Base Amount</th>
			<th scope="col" >CGST Amount</th>
			<th scope="col" >SGST Amount</th>
			<th scope="col" >Total</th>
		</tr>
	</thead>
	<tbody>
		<?php 	$i=0; 
				$baseamount = 0;  $cgstamount=0;  $sgstamount=0;  $totalamount=0;
				foreach ($reportdatas as $reportdata): 
				$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?= h($reportdata->transaction_date) ?></td>
			<td><?php echo $reportdata->invoice_no; ?></td>
			<td style="text-align:right"><?php echo $reportdata->base_amount; ?></td>
			<td style="text-align:right"><?php echo $reportdata->total_cgst; ?></td>
			<td style="text-align:right"><?php echo $reportdata->total_sgst; ?></td>
			<td style="text-align:right"><?php echo $reportdata->total; ?></td>
		</tr>
		<?php 	
			$baseamount = $baseamount + $reportdata->base_amount;
			$cgstamount = $cgstamount + $reportdata->total_cgst;
			$sgstamount = $sgstamount + $reportdata->total_sgst;
			$totalamount = $totalamount + $reportdata->total;
			endforeach;  
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" style="text-align:right"><b>TOTAL </b></td>
			<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
			<td class="totalcgst" style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
			<td class="totalsgst" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
			<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
		</tr>
	</tfoot>
</table> 
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() { 


});
</script>



<script>
	jQuery(document).ready(function() {
		ComponentsPickers.init();
	});   
</script>