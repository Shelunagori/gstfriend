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
		<?php 	$i=0; foreach ($reportdatas as $reportdata): 
				$i++;
		?>
		<tr>
			<td><?= $this->Number->format($i) ?></td>
			<td><?= h($reportdata->transaction_date) ?></td>
			<td><?= $this->Number->format($reportdata->invoice_no) ?></td>
			<td style="text-align:right"><?= $this->Number->format($reportdata->total_amount_before_tax) ?></td>
			<td style="text-align:right"><?= $this->Number->format($reportdata->total_cgst) ?></td>
			<td style="text-align:right"><?= $this->Number->format($reportdata->total_sgst) ?></td>
			<td style="text-align:right"><?= $this->Number->format($reportdata->total_amount_after_tax) ?></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" style="text-align:right"><b>TOTAL </b></td>
			<td class="totalbase"><b></b></td>
			<td class="totalcgst"><b></b></td>
			<td class="totalsgst"><b></b></td>
			<td class="totalamount"><b></b></td>
		</tr>
	</tfoot>
</table> 
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() { 

	alert();

});
</script>