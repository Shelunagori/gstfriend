<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Edit');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<div class="portlet-title">
			<div class="caption" >
				<legend><?= __('Edit Item') ?></legend>
			</div>
		</div>
		<?= $this->Form->create($itemDiscount) ?>
		<fieldset>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Cutomer Name </label>
							<?php echo $this->Form->control('customer_ledger_id', ['options'=>$customerLedgers ,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Discount</label>
							<?php echo $this->Form->control('discount',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Discount']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Item Name</label>
							<?php echo $this->Form->control('item_id', ['options' => $items,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item']); ?> 
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
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php 
$js='  
jQuery(document).ready(function() {
		ComponentsDropdowns.init();
});'; 
?>   