<?php $this->set('title', 'GST Report'); ?>
<?php $url_excel="/?".$url; ?>
<style>
.maindiv{
		font-family: sans-serif !important; font-size:12px !important;
		margin: 0 20px 0 0px;  /* this affects the margin in the printer settings */
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
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px !important;
	font-family:Lato !important;
}
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 0px 0 0px;  /* this affects the margin in the printer settings */
}
.hide { display:none; }
</style>
<div class="portlet light bordered" >
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">GST Report</span>
		</div>
		<div class="actions  hidden-print">
			<a class="btn  blue hidden-print " onclick="javascript:window.print();" id="printcustomer">Print <i class="fa fa-print"></i></a>
			
		</div>
	</div>
	<div class="portlet-body-form">
		<div class="form-body">
			<div class="form-body reportshow  hidden-print">
				<div class="row">
					<?= $this->Form->create($accountingEntries) ?>
					<div class="form-group col-md-10">
						<div class="form-group col-md-3">
							<label class="control-label">Date From</label>
							<?php echo $this->Form->input('start', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker datefrom firstdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y"),'required']); ?>
						</div>
						<div class="form-group col-md-3">
							<label class="control-label">Date To</label>
							<?php echo $this->Form->input('end', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker dateto lastdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y"),'required']); ?>
						</div>
						<div class="form-group col-md-1">
							<label class="control-label"></label>
							<button class="go btn btn-success" name="go">Go
						</div>	
						<div class="form-group col-md-2"> 
							<?php   foreach($items as $item){?>
							<label class="control-label">Item Name</label>
							<?php echo $this->Form->control('item_id',['empty' => "---Select---",'option'=>$item,'label'=>false,'class'=>'form-control input-sm  select2me itemwise','label' => false,'id'=>'itemwise']); ?>
							<?php } ?>
						</div>
						<div class="form-group col-md-1">
							<label class="control-label"></label>
							<button class="itemfilter btn btn-success " name="go">Go
						</div>		
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
			<div class='row   maindiv'>
				<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/AccountingEntries/Export-Excel/'.$start.'/'.$end.'',['class' =>'btn btn-sm green tooltips pull-right Export-Excel','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
			<div class='col-md-12'>
			<?php  
			if($this->request->is('post'))
			{ ?>
			
			<div class='col-md-12'>
			<?php if(!empty($accountingEntries['Invoices']->toArray()))
			{ ?> 

				<center><h3>OUTPUT GST (Item wise)</h3> </center> <hr>
				<table class=" table table-bordered table-hover" id='main_tbl' >
					<thead >
						<tr>
							<th scope="col">Sr.</th>
							<th scope="col">Trans. Date</th>
							<th scope="col">Inv. No.</th>
							<th scope="col">Customer</th>
							<th scope="col">Gst No.</th>
							<th scope="col">Item Name</th>
							<th scope="col">HSN Code</th>
							<th scope="col">Qty</th>
							<th scope="col">Rate</th>
							<th scope="col">Discount</th>
							<th scope="col">CGST %</th>
							<th scope="col">CGST Amount</th>
							<th scope="col">SGST %</th>
							<th scope="col">SGST Amount</th>
							<th scope="col" class="hide">IGST %</th>
							<th scope="col" class="hide">IGST Amount</th>
							<th scope="col">Base Amount</th>							
							<th scope="col">Total</th>
							<th scope="col">Rec.Amt</th>
							<th scope="col">Due Amt</th>
						</tr>
					</thead>
					<tbody>
						<?php 	$i=0; $igstamount_invoices=0;		$dueamountamount=0;			$recieveamount=0;
								$baseamount_invoices = 0;  $cgstamount_invoices=0;  $sgstamount_invoices=0;  $totalamount_invoices=0;		$totalquantity=0;
								//pr($accountingEntries['Invoices']->toArray()); exit;
								foreach ($accountingEntries['Invoices'] as $invoice): 
								$i++;
						?>
						<tr class="main_tr">
						<td style="width:5px;"><?php echo $i; ?></td>
						<td style="width:5px;"><?= h($invoice->transaction_date) ?></td>
						<td><?php echo $invoice->invoice_no; ?></td>
						<td><?php if(!empty($invoice->customer_ledger_id)){
							echo $invoice->customer_ledgers->name;
						}
						else{
							echo $invoice->customer_name;
						}?></td>
						<td><?php if(!empty($invoice->customer_ledger_id)){
							echo $invoice->customer_ledgers->customer->gstno;
						}
						else{
							echo 'Not Gst No.';
						}?></td>
						<td colspan="9" style="text-align:right">
							<table class="table table-bordered table-hover">
								<?php 		
								
								foreach($invoice->invoice_rows as $invoice_row):
								
								?>
								<tr>
									<td style="width:65px;text-align:left">
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
									<td style="width:30px;text-align:left">
									<?php
											echo $invoice_row->rate; 
									?>
									</td>
									<td style="width:30px;text-align:left">
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
									<td style="text-align:right;width:90px">
									<?php 
										echo $invoice_row->cgst_amount;
										$cgstamount_invoices = $cgstamount_invoices + $invoice_row->cgst_amount; 
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
									<td style="text-align:right;width:90px">
									<?php 
										echo $invoice_row->sgst_amount;
										$sgstamount_invoices = $sgstamount_invoices + $invoice_row->sgst_amount;
									?>
									</td>
									<td style="width:50px" class="hide">
									<?php 
										if(!empty($invoice_row->igst)) 
										{
											echo $invoice_row->igst->name; 
										}else
										{ 
											echo '0';
										}
										?>
									</td>
									<td style="text-align:right;width:80px" class="hide"><?php echo $invoice_row->igst_amount; 
									$igstamount_invoices = $igstamount_invoices + $invoice_row->igst_amount;
										
									?>
									</td>
								</tr>
								<?php  	endforeach;
										
								?>
							</table>		
						</td>
						<td style="text-align:right"><?php echo $invoice->total_amount_before_tax; ?></td>
						<td style="text-align:right"><?php echo $invoice->total_amount_after_tax; ?></td>
						<td style="text-align:right"><?php echo $invoice->recieveamount; ?></td>
						<td style="text-align:right"><?php echo $invoice->dueamountamount; ?></td>
					</tr>
						<?php 
							$baseamount_invoices = $baseamount_invoices + $invoice->total_amount_before_tax;
							
							$totalamount_invoices = $totalamount_invoices + $invoice->total_amount_after_tax;
							$recieveamount = $recieveamount + $invoice->recieveamount;
							$dueamountamount = $dueamountamount + $invoice->dueamountamount;
							endforeach;
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="7" style="text-align:right"><b>TOTAL Qty</b></td>
							<td class="totalcgst" style="text-align:right"><b><?php echo $totalquantity; ?></b></td>
							<td colspan="3"  style="text-align:right"><b>TOTAL Amount</b></td>
							<td class="totalcgst" style="text-align:right"><b><?php echo $cgstamount_invoices; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount_invoices; ?></b></td>
							<td class="totaligst  hide" colspan="2" style="text-align:right"><b><?php echo $igstamount_invoices; ?></b></td>
							<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount_invoices; ?></b></td>
							<td class="totalamount" style="text-align:right"><b><?php echo $totalamount_invoices; ?></b></td>
							<td class="recieveamount" style="text-align:right"><b><?php echo $recieveamount; ?></b></td>
							<td class="dueamountamount" style="text-align:right"><b><?php echo $dueamountamount; ?></b></td>
						</tr>
					</tfoot>
				</table> 
			<?php } else { echo 'No Data Found in Invoices (Output GST)'; }  ?>
			</div>	
			<div class='col-md-12'>
			<?php if(!empty($accountingEntries['PurchaseVouchers']->toArray()))
			{  ?>
				<center><h3>INPUT GST (Item wise) </h3> </center> <hr>
				<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col">Sr. No.</th>
						<th scope="col">Trans. Date</th>
						<th scope="col">Invoice No.</th>
						<th scope="col">Reference No.</th>
						<th scope="col">Item Name</th>
						<th scope="col">HSN Code</th>
						<th scope="col">Qty</th>
						<th scope="col">Rate</th>
						<th scope="col">Discount</th>
						<th scope="col">CGST %</th>
						<th scope="col">CGST Amount</th>
						<th scope="col">SGST %</th>
						<th scope="col">SGST Amount</th>
						<th scope="col" class="hide">IGST %</th>
						<th scope="col" class="hide"> IGST Amount</th>
						<th scope="col">Base Amount</th>							
						<th scope="col">Total</th>
					</tr>
				</thead>
				<tbody>
				<?php   $i=0; $baseamount_item = 0;    $totalquantity=0;
					$igstamount_item=0; $cgstamount_item=0;  $sgstamount_item=0;  $totalamount_item=0; $discount_item = 0;
					foreach($accountingEntries['PurchaseVouchers'] as $purchaseVoucher):
						$i++;
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?= h($purchaseVoucher->transaction_date) ?></td>
						<td><?php echo $purchaseVoucher->voucher_no; ?></td>
						<td><?php echo $purchaseVoucher->reference_no; ?></td>
						<td colspan="9" style="text-align:right">
							<table class="table table-bordered table-hover">
								<?php 		
								
								foreach($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row):
								
								?>
								<tr>
									<td style="width:70px;text-align:left">
									<?php
										if(!empty($purchase_voucher_row->item_id)) 
										{
											echo $purchase_voucher_row->item->name; 
										}else
										{ 
											echo '0';
										}?>
									</td>
									<td style="width:70px;text-align:left">
									<?php
											echo $purchase_voucher_row->item->hsn_code; 
									?>
									</td>
									<td style="width:30px;text-align:left">
									<?php
											echo $purchase_voucher_row->quantity; 
									$totalquantity=$totalquantity+$purchase_voucher_row->quantity;
									?>
									</td>
									<td style="width:30px;text-align:left">
									<?php
											echo $purchase_voucher_row->rate_per; 
									?>
									</td>
									<td style="width:30px;text-align:left">
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
										$cgstamount_item = $cgstamount_item + $purchase_voucher_row->cgst_amount; 
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
										$sgstamount_item = $sgstamount_item + $purchase_voucher_row->sgst_amount;
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
									$igstamount_item = $igstamount_item + $purchase_voucher_row->igst_amount;
									?>
									</td>
								</tr>
							<?php  	endforeach;?>
							</table>		
						</td>
						<td style="text-align:right"><?php echo $purchaseVoucher->total_amount_before_tax; ?></td>
						<td style="text-align:right"><?php echo $purchaseVoucher->total_amount_after_tax; ?></td>
					</tr>
					<?php 
						  
						$baseamount_item = $baseamount_item + $purchaseVoucher->total_amount_before_tax;
						$totalamount_item = $totalamount_item + $purchaseVoucher->total_amount_after_tax;
						endforeach;
					?>
				</tbody>
					<tfoot>
						<tr><td colspan="6" style="text-align:right"><b>TOTAL Qty</b></td>
							<td class="totalcgst" style="text-align:right"><b><?php echo $totalquantity; ?></b></td>
							<td colspan="3"  style="text-align:right"><b>TOTAL Amount</b></td>
							<td class="totalcgst" style="text-align:right"><b><?php echo $cgstamount_item; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount_item; ?></b></td>
							<td class="totaligst  hide" colspan="2" style="text-align:right"><b><?php echo $igstamount_item; ?></b></td>
							<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount_item; ?></b></td>
							<td class="totalamount" style="text-align:right"><b><?php echo $totalamount_item; ?></b></td>
						</tr>
					</tfoot>
				</table> 			
			<?php }  else { echo 'No Data Found in Purchase Invoices (Input GST)'; } ?>
			</div>
			
			</div>
				
				<div class='col-md-12'>
					<div class='col-md-offset-4 col-md-4'>
						<table class='table'>
							<tr>
								<td style="text-align:right"><b>Net Payable : </b></td>
								<td style="text-align:right"> 
									<?php echo @$totalamount_invoices -  @$totalamount_item ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
		<?php } ?>	
				
			</div>
		</div>
	</div>
</div>	

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() { 

	//filter report item vise start
		$(".itemfilter").on('click',function() {  
			$('#maindiv').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
			var itemwise = document.getElementById('itemwise');	
			var itemwise = itemwise.options[itemwise.selectedIndex].value;
			
			if(itemwise!='')
			{ 
				var itemwise = document.getElementById('itemwise');	
				var itemwise = itemwise.options[itemwise.selectedIndex].value;
				var obj=$(this);
				var url="<?php echo $this->Url->build(['controller'=>'AccountingEntries','action'=>'itemfilter']);?>";
				url=url+'/'+itemwise,
				
				$.ajax({ 
					url: url,
					type: 'GET',
				}).done(function(response) 
				{	
					$('.Export-Excel').addClass('hide');
					$(".maindiv ").html(response);
				});
			
		};
		});
		//filter report item vise end



});
</script>

<!-- BEGIN PAGE LEVEL STYLES -->

<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'cssComponentsPickers']); ?>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>


<script>
	jQuery(document).ready(function() {
		// initiate layout and plugins
		
		
		
		
		ComponentsPickers.init();
	});   
</script>