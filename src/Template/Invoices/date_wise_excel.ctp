<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Date_wise_Excel_".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>
<table class=" table table-bordered table-hover"  style="border:1px solid" id='main_tbl' >
	<thead >
		<tr style="border:1px solid">
			<th scope="col" >Sr. No.</th>
			<th scope="col" >Date</th>
			<th scope="col" >Invoice No.</th>
			<th scope="col" >Base Amount</th>
			<th scope="col" >CGST Amount</th>
			<th scope="col" >SGST Amount</th>
			<th scope="col" >Total</th>
			<th scope="col" >Rec. Amount</th>
			<th scope="col" >Due Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php 	$i=0;
				$baseamount = 0;  $cgstamount=0;  $sgstamount=0; 		 $totalamount=0;
				$recamount=0;    $dewamount=0;     
				foreach ($reportdatas as $reportdata): 
				$i++;
		?>
		<tr style="border:1px solid">
			<td><?php echo $i; ?></td>
			<td><?= h($reportdata->transaction_date) ?></td>
			<td><?php echo $reportdata->invoice_no; ?></td>
			<td style="text-align:right"><?php echo $reportdata->total_amount_before_tax; ?></td>
			<td style="text-align:right"><?php echo $reportdata->total_cgst; ?></td>
			<td style="text-align:right"><?php echo $reportdata->total_sgst; ?></td>
			<td style="text-align:right"><?php echo $reportdata->total_amount_after_tax; ?></td>
			<td style="text-align:right"><?php echo $reportdata->recieveamount; ?></td>
			<td style="text-align:right"><?php echo $reportdata->dueamountamount; ?></td>
		</tr>
		<?php 
			$baseamount = $baseamount + $reportdata->total_amount_before_tax;
			$cgstamount = $cgstamount + $reportdata->total_cgst;
			$sgstamount = $sgstamount + $reportdata->total_sgst;
			$totalamount = $totalamount + $reportdata->total_amount_after_tax;
			$recamount = $recamount + $reportdata->recieveamount;
			$dewamount = $dewamount + $reportdata->dueamountamount;
			endforeach;
		?>
	</tbody>
	<tfoot>
		<tr style="border:1px solid">
			<td colspan="3" style="text-align:right"><b>TOTAL </b></td>
			<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
			<td class="totalcgst" style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
			<td class="totalsgst" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
			<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
			<td class="recamount" style="text-align:right"><b><?php echo $recamount; ?></b></td>
			<td class="dewamount" style="text-align:right"><b><?php echo $dewamount; ?></b></td>
		</tr>
	</tfoot>
</table> 