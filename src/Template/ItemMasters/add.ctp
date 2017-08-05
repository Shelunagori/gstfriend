<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Add');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($itemMaster) ?>
		<fieldset>
			<legend><?= __('Add Item Master') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label"><b>Item Name </b></label>
							<?php echo $this->Form->control('item_id', ['options' => $items,'label' => false,'class' => 'form-control input-sm select2me','value'=>'item']); ?>
						</div>
						<div class="form-group">
							<label class="control-label"><b>Item Price </b></label>
							<?php echo $this->Form->control('price',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Price']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label"><b>CGST </b></label>
							<?php echo $this->Form->control('cgst_ledger_id', ['options' => $cgstLedgers,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label"><b>SGST </b></label>
							<?php echo $this->Form->control('sgst_ledger_id', ['options' => $sgstLedgers,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item Name']); ?>
						</div>
						
					</div>
				</div> 
			</div>
		</fieldset>
		<div style="text-align:center">
			<button type="submit" class="btn btn-primary">Submit
		</div>
		<?= $this->Form->end() ?>
	</div>
</div> 
<!-- BEGIN PAGE LEVEL STYLES -->
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'cssComponentsDropdowns']); ?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<!-- END PAGE LEVEL SCRIPTS -->

<?php 
$js='  
jQuery(document).ready(function() {
		ComponentsDropdowns.init();
		
});'; 
?>
<?php echo $this->Html->scriptBlock($js, ['block'=>'bottomJS']); ?>
