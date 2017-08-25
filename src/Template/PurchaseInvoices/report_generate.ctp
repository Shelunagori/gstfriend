<?php
/**
  * @var \App\View\AppView $this
  */

$this->set('title', 'Report');
?>
<div class="portlet light bordered  col-md-9" style="margin-left:10%">
	<div class="portlet-body-form"  >
		<?= $this->Form->create($purchaseInvoice) ?>
		<fieldset>
			<legend><?= __('Date Wise Report') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label">Date From</label>
						<?php echo $this->Form->input('from', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker datefrom' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy']); ?>
						<label class="control-label">Date To</label>
						<?php echo $this->Form->input('to', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker dateto' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y",strtotime('today'))]); ?>
					</div >
					<div class="form-group col-md-6">
						<button class="go btn btn-default" name="go">Go
					</div>
				</div>
				<div class="row main_div">
					<div class="form-group col-md-12 main_table"> 
					<!-- this div close at ajax page get_item_discount.ctp -->
						
					</div>
				</div>
			</div>
		</fieldset>
		<?= $this->Form->end() ?>
	</div>
</div> 
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() { 

	$(".go").on('click',function() {
		var datefrom = $('.datefrom').val();
		
		var dateto = $('.dateto').val();
		var obj=$(this);
		var url="<?php echo $this->Url->build(['controller'=>'PurchaseInvoices','action'=>'datewisereport']);?>";
		url=url+'/'+datefrom+'/'+dateto,
		
		$.ajax({ 
			url: url,
			type: 'GET',
		}).done(function(response) {
			//$(".main_table").html(response);
			
		});
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


<script>
	jQuery(document).ready(function() {
		// initiate layout and plugins
		
		ComponentsPickers.init();
	});   
</script>