<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Edit Invoice');
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
<div class="portlet light bordered  col-md-12" >
	<div class="portlet-body-form"  >
		<div class="portlet-title">
			<div class="caption" >
				<legend><?= __('Edit Purchase Invoice') ?></legend>
			</div>
		</div>
		<?= $this->Form->create($purchaseInvoice) ?>
		<fieldset>
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
									<th>CGST</th>
									<th>CGST Tax Amount </th>
									<th>SGST</th>
									<th>SGST Tax Amount </th>
									<th>IGST</th>
									<th>IGST Tax Amount </th>
									<th>Action</th>
								</tr>	
							</thead>
							<tbody id="main_tbody">
								<?php 
									$Cgst=[];
									foreach($CgstTax as $CgstTaxe){

										$Cgst[]=['text' =>$CgstTaxe->name, 'value' => $CgstTaxe->id, 'percentage'=>$CgstTaxe->tax_percentage];
									}

									$Sgst=[];
									foreach($SgstTax as $SgstTaxe){
										$Sgst[]=['text' =>$SgstTaxe->name, 'value' => $SgstTaxe->id, 'percentage'=>$SgstTaxe->tax_percentage];
									}

									$Igst=[];
									foreach($IgstTax as $IgstTaxe){
										$Igst[]=['text' =>$IgstTaxe->name, 'value' => $IgstTaxe->id, 'percentage'=>$IgstTaxe->tax_percentage];
									}
								?>
								<?php  
									foreach ($purchaseInvoice->purchase_invoice_rows as $PurchaseInvoiceRow){
										
								?>
								<tr class="main_tr">
									<td class="form-group">
										<?php echo $this->Form->control('cgst_ledger_id', ['options' => $Cgst,'label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Item Name','value'=>$PurchaseInvoiceRow->cgst_ledger_id]);  ?>
									</td>
									<td class="form-group">
										<?php echo $this->Form->control('cgst_amount',['label' => false,'class' => 'form-control input-sm firstupercase cgst_amount','placeholder'=>'Amount','value'=>$PurchaseInvoiceRow->cgst_amount]); ?> 
									</td>
									<td class="form-group">
										<?php echo $this->Form->control('sgst_ledger_id', ['options' => $Sgst,'label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Item Name','value'=>$PurchaseInvoiceRow->sgst_ledger_id]);  ?>
									</td>
									<td class="form-group">
										<?php echo $this->Form->control('sgst_amount',['label' => false,'class' => 'form-control input-sm firstupercase cgst_amount','placeholder'=>'Amount','value'=>$PurchaseInvoiceRow->sgst_amount]); ?> 
									</td>
									<td class="form-group">
										<?php echo $this->Form->control('igst_ledger_id', ['options' => $Igst,'label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Item Name','value'=>$PurchaseInvoiceRow->igst_ledger_id]);  ?>
									</td>
									<td class="form-group">
										<?php echo $this->Form->control('igst_amount',['label' => false,'class' => 'form-control input-sm firstupercase cgst_amount','placeholder'=>'Amount','value'=>$PurchaseInvoiceRow->igst_amount]); ?> 
									</td>
									<td>
										<input type="button" value="+" class="add"/>
										<input type="button" value="X" class="deleterow" />
									</td>
								</tr>
									
								<?php
									} 
									
								?>
								
							</tbody>
							<tfoot >
								<td><b>Total CGST</b></td>
								<td ><b><?php echo $this->Form->control('total_cgst',['label'=>false,'type'=>'text','placeholder'=>'0.00','style'=>'text-align: right;','class'=>' totalcgst','readonly','value'=>$purchaseInvoice->total_cgst]); ?></b></td>
								<td><b>Total SGST</b></td>
								<td ><b><?php echo $this->Form->control('total_sgst',['label'=>false,'type'=>'text','placeholder'=>'0.00','style'=>'text-align: right;','class'=>' totalsgst','readonly','value'=>$purchaseInvoice->total_sgst]); ?></b></td>
								<td><b>Total IGST</b></td>
								<td ><b><?php echo $this->Form->control('total_igst',['label'=>false,'type'=>'text','placeholder'=>'0.00','style'=>'text-align: right;','class'=>' totaligst','readonly','value'=>$purchaseInvoice->total_igst]); ?></b></td>
							</tfoot>
						</table><br>
					</div>
					<div class="col-md-12">	
						<div class="form-group">
							<label class="control-label">Total Amount </label>
							<?php echo $this->Form->control('total',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase total','placeholder'=>'Enter Total Amount']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Base Amount</label>
							<?php echo $this->Form->control('base_amount', ['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase baseamount','placeholder'=>'Enter sgst Amount','readonly']); ?>
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
		var cgst = parseFloat($('.totalcgst').val()); 
		var sgst = parseFloat($('.totalsgst').val()); 
		var igst = parseFloat($('.totaligst').val()); 
		var gst = (cgst + sgst + igst);
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
			$(this).find("td:nth-child(1) select").select2().attr({name:"purchase_invoice_rows["+j+"][cgst_ledger_id]", id:"purchase_invoice_rows-"+j+"-cgst_ledger_id"});
			
			$(this).find("td:nth-child(2) input").attr({name:"purchase_invoice_rows["+j+"][cgst_amount]", id:"purchase_invoice_rows-"+j+"-cgst_amount"});
			
			$(this).find("td:nth-child(3) select").select2().attr({name:"purchase_invoice_rows["+j+"][sgst_ledger_id]", id:"purchase_invoice_rows-"+j+"-sgst_ledger_id"});
			
			$(this).find("td:nth-child(4) input").attr({name:"purchase_invoice_rows["+j+"][sgst_amount]", id:"purchase_invoice_rows-"+j+"-sgst_amount"});
			
			$(this).find("td:nth-child(5) select").select2().attr({name:"purchase_invoice_rows["+j+"][igst_ledger_id]", id:"purchase_invoice_rows-"+j+"-igst_ledger_id"});
			
			$(this).find("td:nth-child(6) input").attr({name:"purchase_invoice_rows["+j+"][igst_amount]", id:"purchase_invoice_rows-"+j+"-igst_amount"});
			
			j++;
			calculation();
	   });
	};
	
	
	$('.cgst_amount').live("keyup",function() {
		calculation();
		baseamount();
	});
	
	calculation();
	function calculation(){ 
		var total_cgst=0;
		var total_sgst=0;
		var total_igst=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			
			var cgst_amount=$(this).find("td:nth-child(2) input").val();
			if(!cgst_amount){ cgst_amount=0; }
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			
			var sgst_amount=$(this).find("td:nth-child(4) input").val();
			if(!sgst_amount){ sgst_amount=0; }
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			
			var igst_amount=$(this).find("td:nth-child(6) input").val();
			if(!igst_amount){ igst_amount=0; }
			
			total_igst=parseFloat(total_igst)+parseFloat(igst_amount);
			
		});
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_igst"]').val(total_igst.toFixed(2));
	}

	
	
	
});
</script>

<table class="sample_table" style="display:none">
	<tbody class="sample_tbody">
		<tr class="main_tr">	
			<td class="form-group">
				<?php echo $this->Form->control('cgst_ledger_id', ['options' => $Cgst,'label' => 	false,'class' => 'form-control input-sm ','placeholder'=>'Enter Item Name']); ?>
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('cgst_amount',['label' => false,'class' => 'form-control input-sm firstupercase cgst_amount  ','placeholder'=>'0.00']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('sgst_ledger_id', ['options' => $Sgst,'label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Item Name']); ?>
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('sgst_amount',['label' => false,'class' => 'form-control input-sm firstupercase cgst_amount ','placeholder'=>'0.00']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('igst_ledger_id', ['options' => $Igst,'label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Item Name']); ?>
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('igst_amount',['label' => false,'class' => 'form-control input-sm firstupercase cgst_amount ','placeholder'=>'0.00']); ?> 
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