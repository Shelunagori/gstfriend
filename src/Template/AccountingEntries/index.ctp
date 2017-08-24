<?php $this->set('title', 'GST Report'); ?>
<style>
.hide { display:none; }
</style>
<div class="portlet light bordered" >
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">GST Report</span>
		</div>
		<div class="actions">
			
		</div>
	</div>
	<div class="portlet-body-form">
		<div class="form-body">
			<div class="form-body reportshow">
				<div class="row">
					<?= $this->Form->create($accountingEntries) ?>
					<div class="form-group col-md-9">
						<div class="form-group col-md-4">
							<label class="control-label">Date From</label>
							<?php echo $this->Form->input('start', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker datefrom firstdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y"),'required']); ?>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label">Date To</label>
							<?php echo $this->Form->input('end', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker dateto lastdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y"),'required']); ?>
						</div>
						<div class="form-group col-md-1">
							<label class="control-label"></label>
							<button class="go btn btn-success" name="go">Go
						</div>		
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
			<?php  
			if($this->request->is('post'))
			{ ?>
			<div class='col-md-12'>
			<?php if(!empty($accountingEntries['Invoices']->toArray()))
			{ ?> 

				<center><h3>OUTPUT GST</h3> </center> <hr>
				<table class=" table table-bordered table-hover" id='main_tbl' >
					<thead >
						<tr>
							<th>Sr. No.</th>
							<th>Transaction Date</th>
							<th>Invoice No.</th>
							<th>Base Amount</th>
							<th>CGST Percentage</th>
							<th>CGST Amount</th>
							<th>SGST Percentage</th>
							<th>SGST Amount</th>
							<th>IGST Percentage</th>
							<th>IGST Amount</th>							
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<?php 	$i=0; $igstamount_invoices=0;
								$baseamount_invoices = 0;  $cgstamount_invoices=0;  $sgstamount_invoices=0;  $totalamount_invoices=0;
								//pr($accountingEntries['Invoices']->toArray()); exit;
								foreach ($accountingEntries['Invoices'] as $invoice): 
								$i++;
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?= h($invoice->transaction_date) ?></td>
							<td><?php echo $invoice->invoice_no; ?></td>
							<td style="text-align:right"><?php echo $invoice->total_amount_before_tax; ?></td>

							<td style="text-align:right">
								<?php foreach($invoice->invoice_rows as $invoice_row)
								{
									if(!empty($invoice_row->cgst)) {
									echo $invoice_row->cgst->name.'<br>';
									}
								}
							
								?>
							</td>							
							
							<td style="text-align:right"><?php echo $invoice->total_cgst; ?></td>
							<td style="text-align:right">
								<?php foreach($invoice->invoice_rows as $invoice_row)
								{
									if(!empty($invoice_row->sgst)) {
									echo $invoice_row->sgst->name.'<br>';
									}
								}
								?>
							</td>	
							<td style="text-align:right"><?php echo $invoice->total_sgst; ?></td>
							<td style="text-align:right">
								<?php foreach($invoice->invoice_rows as $invoice_row)
								{
									if(!empty($invoice_row->igst)) {
									echo $invoice_row->igst->name.'<br>';
									}
								}
								?>
							</td>	
							<td style="text-align:right"><?php echo $invoice->total_igst; ?></td>							
							<td style="text-align:right"><?php echo $invoice->total_amount_after_tax; ?></td>
						</tr>
						<?php 
							$baseamount_invoices = $baseamount_invoices + $invoice->total_amount_before_tax;
							$cgstamount_invoices = $cgstamount_invoices + $invoice->total_cgst;
							$sgstamount_invoices = $sgstamount_invoices + $invoice->total_sgst;
							$igstamount_invoices = $igstamount_invoices + $invoice->total_igst;
							$totalamount_invoices = $totalamount_invoices + $invoice->total_amount_after_tax;
							endforeach;
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3" style="text-align:right"><b>TOTAL </b></td>
							<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount_invoices; ?></b></td>
							<td class="totalcgst" colspan="2" style="text-align:right"><b><?php echo $cgstamount_invoices; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount_invoices; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $igstamount_invoices; ?></b></td>
							<td class="totalamount" style="text-align:right"><b><?php echo $totalamount_invoices; ?></b></td>
						</tr>
					</tfoot>
				</table> 
			<?php } else { echo 'No Data Found in Invoices (Output GST)'; }  ?>
			</div>	
		<div class='col-md-12'>
			<?php if(!empty($accountingEntries['PurchaseInvoices']->toArray()))
			{  ?>
				<center><h3>INPUT GST</h3> </center> <hr>
				<table class="table table-bordered table-hover">
					<thead >
						<tr>
							<th>Sr. No.</th>
							<th>Transaction Date</th>
							<th>Invoice No.</th>
							<th>Base Amount</th>
							<th>CGST Percentage</th>
							<th>CGST Amount</th>
							<th>SGST Percentage</th>
							<th>SGST Amount</th>
							<th>IGST Percentage</th>
							<th>IGST Amount</th>							
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					<?php $i=0; $baseamount = 0; $igstamount=0; $cgstamount=0;  $sgstamount=0;  $totalamount=0; 
							foreach($accountingEntries['PurchaseInvoices'] as $PurchaseInvoice):
								
							$i++;
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?= h($PurchaseInvoice->transaction_date) ?></td>
							<td><?php echo $PurchaseInvoice->invoice_no; ?></td>
							<td style="text-align:right"><?php echo $PurchaseInvoice->base_amount; ?></td>
							
							<td colspan="6" style="text-align:right">
								<table class="table table-bordered table-hover">
									<?php 	foreach($PurchaseInvoice->purchase_invoice_rows as $purchase_invoice_row):?>
									<tr>
										<td style="width:80px">
										<?php
											if(!empty($purchase_invoice_row->cgst_ledger)) 
											{
												echo $purchase_invoice_row->cgst_ledger->name; 
											}else
											{ 
												echo '0';
											}?>
										</td>
										<td style="text-align:right;width:80px"><?php echo $purchase_invoice_row->cgst_amount;?>
										</td>
										<td style="width:80px">
										<?php if(!empty($purchase_invoice_row->sgst_ledger)) 
											{
												echo $purchase_invoice_row->sgst_ledger->name; 
											}else
											{ 
												echo '0';
											} ?>
										</td>
										<td style="text-align:right;width:70px"><?php echo $purchase_invoice_row->sgst_amount;?>
										</td>
										<td style="width:80px">
										<?php 
											if(!empty($purchase_invoice_row->igst_ledger)) 
											{
												echo $purchase_invoice_row->igst_ledger->name; 
											}else
											{ 
												echo '0';
											}
											?>
										</td>
										<td style="text-align:right;width:70px"><?php echo $purchase_invoice_row->igst_amount;?>
										</td>
									</tr>
									<?php  endforeach;?>
								</table>		
							</td>
						<?php 
							$cgstamount = $cgstamount + $purchase_invoice_row->cgst_amount; 
							$sgstamount = $sgstamount + $purchase_invoice_row->sgst_amount; 
							$igstamount = $igstamount + $purchase_invoice_row->igst_amount;
							
						?>
							<td style="text-align:right"><?php echo $PurchaseInvoice->total; ?></td>
						</tr>
						<?php 
							  
							$baseamount = $baseamount + $PurchaseInvoice->base_amount;
							$totalamount = $totalamount + $PurchaseInvoice->total;
							endforeach;
						?>
					
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3" style="text-align:right"><b>TOTAL </b></td>
							<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
							<td class="totalcgst" colspan="2" style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $igstamount; ?></b></td>
							<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
						</tr>
					</tfoot>
				</table> 			
			<?php }  else { echo 'No Data Found in Purchase Invoices (Input GST)'; } ?>
			</div>

			<div class='col-md-12'>
			<?php if(!empty($accountingEntries['PurchaseInvoices']->toArray()))
			{  ?>
				<center><h3>INPUT GST (Item wise) </h3> </center> <hr>
				<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="border-left: none; vertical-align: top;">Sr. No.</th>
						<th style='vertical-align: top;'>Transaction Date</th>
						<th style='vertical-align: top;'>Invoice No.</th>
						<th style='vertical-align: top;'>Discount</th>
						<th style='vertical-align: top;'>Base Amount</th>
						<th style='vertical-align: top;'>CGST Percentage</th>
						<th style='vertical-align: top;'>CGST Amount</th>
						<th style='vertical-align: top;'>SGST Percentage</th>
						<th style='vertical-align: top;'>SGST Amount</th>
						<th style='vertical-align: top;'>IGST Percentage</th>
						<th style='vertical-align: top;'>IGST Amount</th>	
						<th style="border-right: none; vertical-align: top;" >Total</th>
					</tr>
					
				</thead>
					<tbody>
				<?php   $i=0; $baseamount_item = 0;
					$igstamount_item=0; $cgstamount_item=0;  $sgstamount_item=0;  $totalamount_item=0; $discount_item = 0;
				foreach($accountingEntries['PurchaseVouchers'] as $purchaseVoucher):
					foreach ($purchaseVoucher->purchase_voucher_rows as $purchaseVoucherRows):
						$i++;
				?>
				<tr>
					<td width="15px"style="border-left: none;"><?php echo $i; ?></td>
					<td><?= h($purchaseVoucher->transaction_date) ?></td>
					<td><?php echo $purchaseVoucher->reference_no; ?></td>					
					<td width="44px" style="text-align:right">
						<?php echo $this->Number->format($purchaseVoucherRows->discount_amount);
							$discount_item = $discount_item + $purchaseVoucherRows->discount_amount;
						?>
					</td>
					<td width="48px" style="text-align:right">
						<?php echo $this->Number->format($purchaseVoucherRows->taxable_value);
						$baseamount_item = $baseamount_item + $purchaseVoucherRows->taxable_value;
						?>
						</td>

					
					<?php if(!empty($purchaseVoucherRows->cgst_ledger))
					{ ?>
						<td style="text-align:right">
							<?php echo $purchaseVoucherRows->cgst_ledger->name; ?>
						</td>
						<td style="text-align:right">
						<?php echo $purchaseVoucherRows->cgst_amount;
							$cgstamount_item = $cgstamount_item + $purchaseVoucherRows->cgst_amount;
						?>
						</td>								
					<?php } else {?> 
						<td style="text-align:right">0%</td>
						<td style="text-align:right">0</td>					
					<?php }  ?>					

					<?php if(!empty($purchaseVoucherRows->sgst_ledger))
					{ ?>
						<td style="text-align:right">
							<?php echo $purchaseVoucherRows->sgst_ledger->name; ?>
						</td>
						<td style="text-align:right">
						<?php echo $purchaseVoucherRows->sgst_amount;
							$sgstamount_item = $sgstamount_item + $purchaseVoucherRows->sgst_amount;
						?></td>								
					<?php }else {?> 
						<td style="text-align:right">0%</td>
						<td style="text-align:right">0</td>					
					<?php }  ?>				
					
					<?php if(!empty($purchaseVoucherRows->igst_ledger))
					{ ?>
						<td style="text-align:right">
							<?php echo $purchaseVoucherRows->igst_ledger->name; ?>
						</td>
						<td style="text-align:right">
							<?php echo $purchaseVoucherRows->igst_amount;
							$igstamount_item = $igstamount_item + $purchaseVoucherRows->igst_amount;?>
							</td>								
					<?php } 
					else { ?> 
						<td style="text-align:right">0%</td>
						<td style="text-align:right">0</td>					
					<?php }  ?>	
					
					
					<td style="border-right: none;text-align:right"width="31px">
						<?php echo $this->Number->format($purchaseVoucherRows->total);
							$totalamount_item = $totalamount_item + $purchaseVoucherRows->total; ?></td>
				</tr>
				<?php endforeach;  endforeach; ?>
					
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4" style="text-align:right"><b>TOTAL </b></td>
							<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount_item; ?></b></td>
							<td class="totalcgst" colspan="2" style="text-align:right"><b><?php echo $cgstamount_item; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount_item; ?></b></td>
							<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $igstamount_item; ?></b></td>
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
									<?php echo @$totalamount_invoices - (@$totalamount + @$totalamount_item) ?>
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