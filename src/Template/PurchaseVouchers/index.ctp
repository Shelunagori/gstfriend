<?php $this->set('title', 'Purchase Voucher List'); ?>
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
	<div class="portlet-title  ">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Purchase Vouchers List</span>
		</div>
		<div class="actions  hidden-print">
			<a class="btn  blue hidden-print hide  print" onclick="javascript:window.print();" id="printcustomer">Print <i class="fa fa-print"></i></a>
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
		<div align='right' ><button class="btn btn-success  showdata" ><b>Purchase Voucher Report</b>&nbsp; &nbsp;</div>
	</div>
	<div class="portlet-body maindiv">
		<div class="form-body">
		<?php $page_no=$this->Paginator->current('purchaseVouchers'); $page_no=($page_no-1)*20; ?>
			<table id="example1" class="table table-bordered table-striped  hidetable main_table">
				<thead>
					<tr>
						<th scope="col">Sr.</th>
						<th scope="col">Voucher No</th>
						<th scope="col">Date</th>
						<th scope="col">Supplier</th>
						<th scope="col">Base Amount</th>
						<th scope="col">CGST Amount</th>
						<th scope="col">SGST Amount</th>
						<th scope="col">IGST Amount</th>
						<th scope="col">Total Amount</th>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody class="filter_div main_tbody">
					<?php  
						$i=0; 
						foreach ($purchaseVouchers as $purchaseVoucher):
						$i++;
					?>
					<tr class="main_tr">
						<td><?= $this->Number->format($i) ?></td>
						<td>
						<?php $in_no='#'.str_pad($purchaseVoucher->voucher_no, 4, '0', STR_PAD_LEFT);  ?>
						<?= $this->Html->link(__($in_no), ['action' => 'view', $purchaseVoucher->id],['target'=>'_blank']) ?></td>
						<td><?= h($purchaseVoucher->transaction_date) ?></td>
						<td><?= h($purchaseVoucher->supplier_ledger->supplier->name) ?></td>
						<td><?= h($purchaseVoucher->total_amount_before_tax) ?></td>
						<td><?= h($purchaseVoucher->total_cgst) ?></td>
						<td><?= h($purchaseVoucher->total_sgst) ?></td>
						<td><?= h($purchaseVoucher->total_igst) ?></td>
						<td><?= h($purchaseVoucher->total_amount_after_tax) ?></td>
						<td class="actions">
							<?= $this->Html->link(__('View'), ['action' => 'view', $purchaseVoucher->id]) ?>
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseVoucher->id]) ?>
							<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVoucher->id)]) ?>
							
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="form-body hide reportshow  " >
				<div class="row  hidden-print">
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

		$(".go").on('click',function() { 
		$('#main_table_div').html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><b> Loading... </b>');
		var startdate = $('.firstdate').val();
		var enddate = $('.lastdate').val();	
		if(startdate <= enddate)
		{
			var datefrom = $('.datefrom').val();
			
			var dateto = $('.dateto').val();
			var obj=$(this);
			var url="<?php echo $this->Url->build(['controller'=>'PurchaseVouchers','action'=>'datewisereport']);?>";
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
				var url="<?php echo $this->Url->build(['controller'=>'PurchaseVouchers','action'=>'filterreportsupplier']);?>";
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