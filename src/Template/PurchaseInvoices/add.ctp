<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Add Invoice');
?>
<style>

.tbl td, .tbl th {
    border: 1px solid black;
}


.tbl th {
    text-align:center;
}
.tbl td {
    padding:3px;
}


</style>

<div class="portlet light bordered  col-md-8" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($purchaseInvoice) ?>
		<fieldset>
			<legend><?= __('Purchase Invoice') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-5">
							<div class="row">
								<label class="control-label">Invoice Date<label>
							</div>
							<div class="row">		
								<?php echo $this->Form->input('transaction_date', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y",strtotime('today'))]); ?>
							</div>
							
						</div>
						<div class="form-group col-md-1">
						</div>
						<div class="form-group col-md-6 hide">
							<div  class="row">
								<label class="control-label">Purchase Ledger</label>
							</div>
							<div class="row">
								<?php echo $this->Form->control('purchase_ledger_id',['options'=>$PurchaseLedger,'label' => false,'class' => 'form-control input-sm']); ?> 
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group col-md-5">
							<div class="row">
								<label class="control-label">Invoice No. <span class="required" aria-required="true">*</span></label>
							</div>	
							<div class="row">
								<?php echo $this->Form->control('invoice_no' , ['type' =>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Invoice No']); ?>
							</div>	
						</div>
						<div class="col-md-1">
						</div>
						<div class="form-group col-md-6">
							<div class="row">
								<label class="control-label">Supplier Name</label>
							</div>
							<div class="row">	
								<?php echo $this->Form->control('supplier_ledger_id',['empty'=>"---select---",'options'=>$SupplierLedger,'label' => false,'class' => 'form-control input-sm select2me']);?>
							</div>
						</div>	
					</div>	
					<div class="col-md-12 main_div">	
						<table width="100%" class="tbl" id="main_table">
							<thead>
								<tr style="background-color: #e4e3e3;">
									<th>GST Type</th>
									<th>Item Tax Amount </th>
									<th>Action</th>
								</tr>	
							</thead>
							<tbody id="main_tbody">
								
							</tbody>
							<tfoot>
								<td><b>Total GST</b></td>
								<td colspan='2'><b><?php echo $this->Form->control('total_cgst',['label'=>false,'type'=>'text','placeholder'=>'0.00','style'=>'text-align: right;','class'=>'gst totalgst','readonly']); ?></b></td>
								
							</tfoot>
						</table>
						<div class="form-group">
							<label class="control-label">Total Amount </label>
							<?php echo $this->Form->control('total',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase total calculate','placeholder'=>'Enter Total Amount']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Base Amount</label>
							<?php echo $this->Form->control('base_amount', ['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase baseamount','placeholder'=>'0.00','readonly']); ?>
						</div>
					</div>
				</div> 
			</div>
		</fieldset>
		<div>
			<button type="submit" class="btn btn-primary">Submit
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>    

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function(){ 
	$('.calculate').on('keyup', function() {
		baseamount();
	});

	function baseamount(){
		var baseamount=0;
		var total= parseFloat($('.total').val());
		var gst = parseFloat($('.totalgst').val()); 
		
		var amount = total - gst;	
		$('.baseamount').val(amount);
	}
	
	add_row();
	function add_row(){
		var table=$(".sample_table tbody.sample_tbody tr.main_tr").clone();
		$("#main_table tbody#main_tbody ").append(table);
		rename_rows();
		calculation();
	}
	
	$(document).on("click",".add",function(){
		add_row();
	});
	
	$(document).on("click",".deleterow",function() {
		$(this).closest('tr').remove();
		rename_rows();
		calculation();
	});
	
	function rename_rows(){
		var j=0;
		$("#main_table tbody#main_tbody tr").each(function(){
			$(this).find("td:nth-child(1) select").select2().attr({name:"purchase_invoice_others["+j+"][tax_type_id]", id:"purchase_invoice_others-"+j+"-tax_type_id"});
			
			$(this).find("td:nth-child(2) input").attr({name:"purchase_invoice_others["+j+"][tax_amount]", id:"purchase_invoice_others-"+j+"-tax_amount"});
			j++;
	   });
	};
	
	
	$('.cgst_amount').live("keyup",function() {
		calculation();
		baseamount();
	});
	
	calculation();
	function calculation(){ 
		var total_igst=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			
			var cgst_amount=$(this).find("td:nth-child(2) input").val();
			if(!cgst_amount){ cgst_amount=0; }
			total_igst=parseFloat(total_igst)+parseFloat(cgst_amount);
			
		});
		$('input[name="total_igst"]').val(total_igst.toFixed(2));
	}

	
	
	
});

</script>

<table class="sample_table" style="display:none">
	<tbody class="sample_tbody">
		<tr class="main_tr">	
			<td class="form-group">
				<?php echo $this->Form->control('tax_type_id', ['options' => $taxtypes,'label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Item Name']); ?>
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('cgst_amount',['label' => false,'class' => 'form-control input-sm firstupercase cgst_amount addcgst','placeholder'=>'Amount']); ?> 
			</td>

			<td>
				<input type="button" value="+" class="add"/>
				<input type="button" value="X" class="deleterow" />
			</td>
		</tr>
	</tbody>
</table>

<!-- BEGIN PAGE LEVEL STYLES -->
<?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'cssComponentsDropdowns']); ?>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
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

<script>
	jQuery(document).ready(function() {
		// initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		ComponentsPickers.init();
		ComponentsDropdowns.init();
	});   
</script>