<?php $this->set('title', 'Invoice List'); ?>
<style>
.hide { display:none; }
</style>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Invoices</span>
		</div>
		<div class="actions">
			
		</div>
	</div>
	<div class="row filterhide">
		<div class="form-group col-md-8   ">
			<div class="radio-list col-md-3">
				<label class="radio-inline">
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
				<button class="filtergo btn btn-success" name="go">Go
			</div>		
		</div >
	<div align='right' ><button class="btn btn-success  showdata" ><b>Invoice Report</b>&nbsp; &nbsp;</div><br>
	</div>
	<div class="portlet-body">
		<div class="table-scrollable hidetable">
		<?php $page_no=$this->Paginator->current('Invoices'); $page_no=($page_no-1)*20; ?>
			<table class="table table-bordered table-striped  main_table">
				<thead>
					<tr>
						<th scope="col">Sr.</th>
						<th scope="col">Invoice No</th>
						<th scope="col">Invoice Date</th>
						<th scope="col">Customer</th>
						<th scope="col">Base Amount</th>
						<th scope="col">CGST Amount</th>
						<th scope="col">SGST Amount</th>
						<th scope="col">IGST Amount</th>
						<th scope="col">Total Amount After Tax</th>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody class="main_tbody filter_div">
					<?php 
					foreach ($invoices as $invoice):  ?>
					<tr class="main_tr">
						<td><?= h(++$page_no) ?></td>
						<td>
							<?php $in_no='#'.str_pad($invoice->invoice_no, 4, '0', STR_PAD_LEFT);  ?>
							<?= $this->Html->link(__($in_no), ['action' => 'view', $invoice->id],['target'=>'_blank']) ?></td>
						<td><?= h($invoice->transaction_date) ?></td>
						<td><?php 
								if($invoice->invoicetype!='Cash')
								{
									echo $invoice->customer_ledgers->name;
								} 
								else
								{ 
									echo $invoice->customer_name;
								}
							?>
						</td>
						<td align="right"><?= $this->Number->format($invoice->total_amount_before_tax) ?></td>
						<td align="right"><?= $this->Number->format($invoice->total_sgst) ?></td>
						<td align="right"><?= $this->Number->format($invoice->total_cgst) ?></td>
						<td align="right"><?= $this->Number->format($invoice->total_igst) ?></td>
						<td align="right"><?= $this->Number->format($invoice->total_amount_after_tax,[ 'places' => 2]) ?></td>
						<td class="actions">
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id]) ?>
							<?= $this->Html->link(__('View'), ['action' => 'view', $invoice->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
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
		<div class="paginator">
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
			});
		}else
		{
			alert('Please Select Valid Date');
			$('.firstdate').val('');
		}
	});


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
					$(".main_table tbody.main_tbody").html(response);
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
					$(".main_table tbody.main_tbody").html(response);
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