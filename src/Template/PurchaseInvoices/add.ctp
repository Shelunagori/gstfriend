<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Add Invoice');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($purchaseInvoice) ?>
		<fieldset>
			<legend><?= __('Purchase Invoice') ?></legend>
			<div class="form-body" >
				<div class="row">
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
								<label class="control-label">Invoice Date<label>
							</div>
							<div class="row">		
								<?php echo $this->Form->input('date', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y",strtotime('today'))]); ?>
							</div>
						</div>
					</div>	
					<div class="col-md-12">	
						<div class="form-group">
							<label class="control-label">Total Amount </label>
							<?php echo $this->Form->control('total',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase total','placeholder'=>'Enter Total Amount']); ?> 
						</div>
						<div class="form-group col-md-5">
							<div class="row">	
								<label class="control-label">CGST Amount</label>
							</div>
							<div class="row">	
								<?php echo $this->Form->control('cgst', ['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase cgst','placeholder'=>'Enter CGST Amount']); ?>
							</div>	
						</div>
						<div class="col-md-1">
						</div>
						<div class="form-group col-md-6">
							<div class="row">
								<label class="control-label">SGST Amount</label>
							</div>
							<div class="row">
								<?php echo $this->Form->control('sgst', ['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase sgst calculate','placeholder'=>'Enter SGST Amount']); ?>
							</div>
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
		var baseamount=0;
		var total= parseFloat($('.total').val());
		var sgst = parseFloat($('.sgst').val());
		var cgst = parseFloat($('.cgst').val()); 
		var baseamount = sgst + cgst;
		var amount = total - baseamount;	
		$('.baseamount').val(amount);
   
});

});

</script>
<!-- BEGIN PAGE LEVEL STYLES -->
<?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'cssComponentsPickers']); ?>
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

<script>
	jQuery(document).ready(function() {
		// initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		ComponentsPickers.init();
	});   
</script>