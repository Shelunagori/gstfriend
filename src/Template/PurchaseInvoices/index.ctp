<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseInvoice[]|\Cake\Collection\CollectionInterface $purchaseInvoices
  */
$this->set('title', 'List');
?>
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
<div class="portlet light bordered">
	<div class="portlet-title ">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Purchase Invoice List</span>
		</div>
		<div class="actions ">
			<a class="btn  blue hidden-print  hide  print" onclick="javascript:window.print();" id="printcustomer">Print <i class="fa fa-print"></i></a>
		</div>
	</div>
	<div class="row filterhide  hidden-print">
		<div class="form-group col-md-8 ">
			<div class="form-group col-md-3">
				<label class="control-label">Supplier Name</label>
				<?php echo $this->Form->control('supplier_ledger_id',['empty'=>"---select---",'options'=>$SupplierLedger,'label' => false,'class' => 'form-control input-sm select2me supplierfilter','id'=>'supplierfilter']);?>
			</div>
			<div class="form-group col-md-2">
				<label class="control-label">Date From</label>
				<?php echo $this->Form->input('from', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker filter_date_from' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y")]); ?>
			</div>
			<div class="form-group col-md-2">
				<label class="control-label">Date To</label>
				<?php echo $this->Form->input('to', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker filter_date_to' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y")]); ?>
			</div>
			<div class="form-group col-md-1">
				<label class="control-label"></label>
				<button class="filtergo btn btn-success" name="go">Go
			</div>		
		</div >
		<div align='right' ><button class="btn btn-success  showdata" ><b>Purchase Report</b>&nbsp; &nbsp;</div>
	</div>
	<div class="portlet-body-form"  >
		<div class="form-body">
			
			<table id="example1" class="table table-bordered  hidetable maindiv">
				<thead style="text-align:center;">
					<tr>
						<th scope="col">Sr. No.</th>
						<th scope="col">Transaction Date</th>
						<th scope="col">Invoice No.</th>
						<th scope="col">Base Amount</th>
						<th scope="col">CGST Percentage</th>
						<th scope="col">CGST Amount</th>
						<th scope="col">SGST Percentage</th>
						<th scope="col">SGST Amount</th>
						<th scope="col">IGST Percentage</th>
						<th scope="col">IGST Amount</th>							
						<th scope="col">Total</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody class="main_tbody">
				<?php 	$i=0; 
						$cgstamount=0;     $sgstamount=0;     $igstamount=0;
						$baseamount=0;     $totalamount=0;
						foreach ($purchaseInvoices as $purchaseInvoice): 
						$i++;
				?>
					<tr class="main_tr">
						<td><?php echo $i; ?></td>
						<td><?= h($purchaseInvoice->transaction_date) ?></td>
						<td><?php echo $purchaseInvoice->invoice_no; ?></td>
						<td style="text-align:right"><?php echo $purchaseInvoice->base_amount; ?></td>
						
						<td colspan="6" style="text-align:right">
							<table class="table table-bordered table-hover">
								<?php 		
								
								foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row):
								
								?>
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
									<td style="text-align:right;width:80px">
									<?php 
										echo $purchase_invoice_row->cgst_amount;
										$cgstamount = $cgstamount + $purchase_invoice_row->cgst_amount; 
									?>
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
									<td style="text-align:right;width:70px">
									<?php 
										echo $purchase_invoice_row->sgst_amount;
										$sgstamount = $sgstamount + $purchase_invoice_row->sgst_amount;
									?>
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
									<td style="text-align:right;width:70px"><?php echo $purchase_invoice_row->igst_amount; 
									$igstamount = $igstamount + $purchase_invoice_row->igst_amount;
										
									?>
									</td>
								</tr>
								<?php  	endforeach;
										
								?>
							</table>		
						</td>
					
						<td style="text-align:right"><?php echo $purchaseInvoice->total; ?></td>
						<td><?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseInvoice->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseInvoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoice->id)]) ?>
						</td>
					</tr>
					<?php 
						  
						$baseamount = $baseamount + $purchaseInvoice->base_amount;
						$totalamount = $totalamount + $purchaseInvoice->total;
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
			<div class="form-body hide reportshow hidden-print" >
				<div class="row">
					<div class="form-group col-md-9">
						<div class="form-group col-md-4">
							<label class="control-label">Date From</label>
							<?php echo $this->Form->input('from', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker datefrom firstdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y")]); ?>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label">Date To</label>
							<?php echo $this->Form->input('to', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker dateto lastdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y")]); ?>
						</div>
						<div class="form-group col-md-1">
							<label class="control-label"></label>
							<button class="go btn btn-success" name="go">Go
						</div>		
					</div >
				</div>
				<div class="row main_div">
					<div class="form-group col-md-12" id='main_table_div'> 
					
					</div>
				</div>
			</div>

			<div class="paginator hidden-print">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('first')) ?>
					<?= $this->Paginator->prev('< ' . __('previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('next') . ' >') ?>
					<?= $this->Paginator->last(__('last') . ' >>') ?>
				</ul>
				<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
			</div>
		</div>
	</div>
</div>	

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() { 

	$(".go").on('click',function() { 
		$('#main_table_div').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
		var startdate = $('.firstdate').val();
		var enddate = $('.lastdate').val();	
		if(startdate <= enddate)
		{
			var datefrom = $('.datefrom').val();
			
			var dateto = $('.dateto').val();
			var obj=$(this);
			var url="<?php echo $this->Url->build(['controller'=>'PurchaseInvoices','action'=>'datewisereport']);?>";
			url=url+'/'+datefrom+'/'+dateto,
			
			$.ajax({ 
				url: url,
				type: 'GET',
			}).done(function(response) {
				$("#main_table_div").html(response);
			});
		}else
		{
			alert('Please Select Valid Date');
			$('.firstdate').val('');
		}	
    });
	

	$(".showdata").click(function(){ 
		$('.hidetable').addClass('hide');
		$('.paginator').addClass('hide');
		$('.filterhide').addClass('hide');
		$('.reportshow').removeClass('hide');
		$('.print').removeClass('hide');
    });
	
	
	
	//Start Filter Date wise and customer wise
	$(".filtergo").on('click',function() {
		$('.filter_div').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
		var startfilterdate = $('.filter_date_from').val();
		var endfilterdate = $('.filter_date_to').val();	
		var supplierfilter = document.getElementById('supplierfilter');	
		var supplierfilter = supplierfilter.options[supplierfilter.selectedIndex].value;	
       
		if(startfilterdate <= endfilterdate )
		{	
			  
				var startdatefrom = $('.filter_date_from').val();
				var startdateto = $('.filter_date_to').val();
				var supplierfilter = document.getElementById('supplierfilter');	
				var supplierfilter = supplierfilter.options[supplierfilter.selectedIndex].value;	
				
				var obj=$(this);
				var url="<?php echo $this->Url->build(['controller'=>'PurchaseInvoices','action'=>'filterreportsupplier']);?>";
				url=url+'/'+startdatefrom+'/'+startdateto+'/'+supplierfilter,
				
				$.ajax({ 
					url: url,
					type: 'GET',
				}).done(function(response) 
				{	
					$('.main_table tbody.main_tbody tr').addClass('hide');
					$('.paginator').addClass('hide');
					$(".main_table tbody.main_tbody").html(response);
				});
			
		}else
		{
			alert('Please Select Valid Date');
			$('.firstdate').val('');
		}
	});
	//End Filter Date wise and customer wise

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