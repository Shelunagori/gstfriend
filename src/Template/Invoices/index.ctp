<?php $this->set('title', 'Invoice List'); ?>
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
	font-size:12px !important;
}
@page {
	size: auto;   /* auto is the initial value */
    margin: 0 0px 0 0px;  /* this affects the margin in the printer settings */
}

.hide { display:none; }
</style>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Invoices</span>
		</div>
		<div class="actions">
			<a class="btn  blue hidden-print  print" onclick="javascript:window.print();" id="printcustomer">Print <i class="fa fa-print"></i></a>
			<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/Invoices/Export-Excel/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right Export-Excel','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
			
		</div>
		
	</div>
	<div class="row filterhide">
		<div class="form-group col-md-8  hidden-print ">
			<div class="radio-list col-md-3">
				<label class="radio-inline ">
				<div class="radio" id="uniform-optionsRadios26"><span class="checked"><input type="radio" name="invoicetype" id="invoicetype" value="Credit" checked></span></div> Credit </label>
				
				<label class="radio-inline">
				<div class="radio" id="uniform-optionsRadios25"><span class=""><input type="radio" name="invoicetype" id="invoicetype" value="Cash"></span></div> Cash </label>
				<div class="form-group ">
					<label class="control-label">Customer Name</label>
					<?php echo $this->Form->control('customer_ledger_id',['empty' => "---Select---",'label'=>false,'class'=>'form-control input-sm  select2me cashhide','id'=>'custmor']); ?>
					<?php echo $this->Form->input('customer', ['type' =>'text','label' => false,'class' => 'form-control input-sm firstupercase filter_customer  cashshow  hide' ,'placeholder'=>'Customer Name']); ?>
				</div>
			</div></br>
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
				<button class="filtergo btn btn-success " name="go">Go
			</div>	
			<div class="form-group col-md-3"> 
				<?php   foreach($items as $item){?>
				<label class="control-label">Item Name</label>
				<?php echo $this->Form->control('item_id',['empty' => "---Select---",'option'=>$item,'label'=>false,'class'=>'form-control input-sm  select2me itemwise','label' => false,'id'=>'itemwise']); ?>
				<?php } ?>
			</div>
			<div class="form-group col-md-1">
				<label class="control-label"></label>
				<button class="itemfilter btn btn-success " name="go">Go
			</div>
		</div >
	<div align='right' class="hidden-print" ><button class="btn btn-success  showdata" ><b>Invoice Report</b>&nbsp; &nbsp;</div><br>
	</div>
	<div class="portlet-body">
		<div class="table-scrollable hidetable main_div">
		<?php $page_no=$this->Paginator->current('Invoices'); $page_no=($page_no-1)*20; ?>
			<table id="example1" class="table table-bordered  hidetable maindiv  main_table">
				<thead style="text-align:center;"  class="maindiv">
					<tr>
						<th scope="col">Sr.</th>
						<th scope="col">Trans. Date</th>
						<th scope="col">Inv. No.</th>
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
						<th scope="col">Rec.Amt</th>
						<th scope="col">Due Amt</th>
						<th scope="col" class="hidden-print">Action</th>
					</tr>
				</thead>
				<tbody class="main_tbody">
				<?php 	$i=0; 
						$cgstamount=0;     $sgstamount=0;     
						$baseamount=0;     $totalamount=0;    $dueamountamount=0;
						$recieveamount=0;      $totalquantity=0;
						foreach ($invoices as $invoice): 
						$i++;
				?>
					<tr class="main_tr">
						<td style="width:5px;"><?php echo $i; ?></td>
						<td style="width:5px;"><?= h($invoice->transaction_date) ?></td>
						<td><?php echo $invoice->invoice_no; ?></td>
						<td><?php if(!empty($invoice->customer_ledger_id)){
							echo $invoice->customer_ledgers->name;
							}else{
							echo $invoice->customer_name; 
							}?></td>
						<td colspan="9" style="text-align:right">
							<table class="table table-bordered table-hover">
								<?php 		
								
								foreach($invoice->invoice_rows as $invoice_row):
								
								?>
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
									<td style="width:40px;text-align:left">
									<?php
											echo $invoice_row->rate; 
									?>
									</td>
									<td style="width:40px;text-align:left">
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
								<?php  	endforeach;
										
								?>
							</table>		
						</td>
						<td style="text-align:right"><?php echo $invoice->total_amount_before_tax; ?></td>
						<td style="text-align:right"><?php echo $invoice->total_amount_after_tax; ?></td>
						<td style="text-align:right"><?php echo $invoice->recieveamount; ?></td>
						<td style="text-align:right"><?php echo $invoice->dueamountamount; ?></td>
						<td class="hidden-print"><?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id]) ?>
						<?= $this->Html->link(__('View'), ['action' => 'view', $invoice->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
						</td>
					</tr>
					<?php 
						  
						$baseamount = $baseamount + $invoice->total_amount_before_tax;
						$totalamount = $totalamount + $invoice->total_amount_after_tax;
						$recieveamount = $recieveamount + $invoice->recieveamount;
						$dueamountamount = $dueamountamount + $invoice->dueamountamount;
						endforeach;
					?>
				
				</tbody>
				<tfoot class="tfoot">
					<tr>
						<td colspan="6" style="text-align:right"><b>TOTAL Qty</b></td>
						<td class="totalcgst" style="text-align:right"><b><?php echo $totalquantity; ?></b></td>
						<td colspan="3"  style="text-align:right"><b>TOTAL Amount</b></td>
						<td class="totalcgst" colspan="1" style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
						<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
						<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
						<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
						<td class="recieveamount" style="text-align:right"><b><?php echo $recieveamount; ?></b></td>
						<td class="dueamountamount" style="text-align:right"><b><?php echo $dueamountamount; ?></b></td>
						<td></td>
						
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="form-body hide reportshow datevalid" >
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


<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() { 
	
	$("input[type='radio']").click(function(){
		var radioValue = $("input[name='invoicetype']:checked").val();
		
		if(radioValue == 'Cash'){
			
			$('.cashhide').addClass('hide');
			$('.cashshow').removeClass('hide');
		}
		else{ 
			$('.cashhide').removeClass('hide');
			$('.cashshow').addClass('hide');
		}		
    });
	// filter report date wise start
	$(".go").on('click',function() {
		$('#main_table_div').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
		var startdate = $('.firstdate').val();
		var enddate = $('.lastdate').val();	
		if(startdate <= enddate)
		{
			var datefrom = $('.datefrom').val();
			
			var dateto = $('.dateto').val();
			var obj=$(this);
			var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'datewiseinvoicereport']);?>";
			url=url+'/'+datefrom+'/'+dateto,
			
			$.ajax({ 
				url: url,
				type: 'GET',
			}).done(function(response) 
			{
				$("#main_table_div").html(response);
				$('.Export-Excel').addClass('hide');
			});
		}else
		{
			alert('Please Select Valid Date');
			$('.firstdate').val('');
		}
	});
		//filter report date wise end

		
		//filter report item vise start
		$(".itemfilter").on('click',function() {  
			$('#main_table_div').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
			var itemwise = document.getElementById('itemwise');	
			var itemwise = itemwise.options[itemwise.selectedIndex].value;
			
			if(itemwise!='')
			{ 
				var itemwise = document.getElementById('itemwise');	
				var itemwise = itemwise.options[itemwise.selectedIndex].value;
				var obj=$(this);
				var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'itemfilter']);?>";
				url=url+'/'+itemwise,
				
				$.ajax({ 
					url: url,
					type: 'GET',
				}).done(function(response) 
				{	
					$('.main_table tbody.main_tbody tr').addClass('hide');
					$('.paginator').addClass('hide');
					$('.Export-Excel').addClass('hide');
					$('.tfoot').addClass('hide');
					$(".main_div ").html(response);
				});
			
		};
		});
		//filter report item vise end
	//Start Filter Date wise and customer wise
	$(".filtergo").on('click',function() {
		$('.filter_div').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
		var startfilterdate = $('.filter_date_from').val();
		var endfilterdate = $('.filter_date_to').val();	
		var customername = $('.filter_customer').val();	
		var radioValue = $("input[name='invoicetype']:checked").val();
		var cstmr = document.getElementById('custmor');	
		var cstmrUser = cstmr.options[cstmr.selectedIndex].value;	
		if(startfilterdate <= endfilterdate || !empty(radioValue))
		{	
			if(radioValue=='Cash'){  
			
				var startdatefrom = $('.filter_date_from').val();
				var startdateto = $('.filter_date_to').val();
				var customername = $('.filter_customer').val();
				var radioValue = $("input[name='invoicetype']:checked").val();
				
				
				var obj=$(this);
				var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'filterreportcustomer']);?>";
				url=url+'/'+startdatefrom+'/'+startdateto+'/'+customername+'/'+radioValue,
				
				$.ajax({ 
					url: url,
					type: 'GET',
				}).done(function(response) 
				{	
					$('.main_table tbody.main_tbody tr').addClass('hide');
					$('.paginator').addClass('hide');
					$('.Export-Excel').addClass('hide');
					$(".main_div ").html(response);
				});
			}else
			{ 
				var startdatefrom = $('.filter_date_from').val();
				var startdateto = $('.filter_date_to').val();
				var radioValue = $("input[name='invoicetype']:checked").val();
				var cstmr = document.getElementById('custmor');	
				var cstmrUser = cstmr.options[cstmr.selectedIndex].value;	
				
				var obj=$(this);
				var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'filterreportcreditcustomer']);?>";
				url=url+'/'+startdatefrom+'/'+startdateto+'/'+radioValue+'/'+cstmrUser,
				
				$.ajax({ 
					url: url,
					type: 'GET',
				}).done(function(response) 
				{	
					$('.main_table tbody.main_tbody tr').addClass('hide');
					$('.paginator').addClass('hide');
					$('.Export-Excel').addClass('hide');
					$('.tfoot').addClass('hide');
					$(".main_div ").html(response);
				});
			}	
		}else
		{
			alert('Please Select Valid Date');
			$('.firstdate').val('');
		}
	});
	//End Filter Date wise and customer wise

	$(".showdata").click(function(){ 
		$('.hidetable').addClass('hide');
		$('.paginator').addClass('hide');
		$('.filterhide').addClass('hide');
		$('.reportshow').removeClass('hide');
		$('.print').removeClass('hide');
    });
	
	

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

<!-- END PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'cssComponentsDropdowns']); ?>


<script>
	jQuery(document).ready(function() {
		// initiate layout and plugins
		ComponentsDropdowns.init();
		ComponentsPickers.init();
	});   
</script>