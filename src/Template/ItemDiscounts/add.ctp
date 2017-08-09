<?php
/**
  * @var \App\View\AppView $this
  */

$this->set('title', 'Add');

?>
<div class="portlet light bordered  col-md-12" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($itemDiscount) ?>
		<fieldset>
			<legend><?= __('Add Item Discount') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="form-group col-md-4">
						<label class="control-label">Select Item</label>
						<?php echo $this->Form->control('item_id', ['options' => $items,'label' => false,'class' => 'form-control input-sm select2me select_item ','placeholder'=>'Enter Item']); ?> 
					</div >
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<table class="main_table form-group">
							<tbody class="main_tbody form-group">
								
							</tbody>
						</table>
					</div >
				</div>
			</div>
		</fieldset>
		<?= $this->Form->end() ?>
	</div>
</div> 
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() { 

	$('.select_item').die().live("change",function() { 

		var tr=$(".display_table tbody.display_body tr.display_tr").clone();
	alert();
			$(".main_table tbody.main_tbody").append(tr);
	});


});
</script>
<table class="display_table  form-group" style="display:none;">
	<tbody class="display_body  form-group">
		<tr class="display_tr  form-group">
			<?php 	$i=0;
					foreach($customerLedgers as $customerLedger)
					$i++;
					{  
			?>
			<td><?= $this->Number->format($i) ?></td>
			<td><label class="control-label form-group">Cutomer Name </label>
				<?= h($customerLedger->name)

echo $this->Form->control('customer_ledger_id', ['options'=>$customerLedgers ,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item Name']); ?>
			</td>
			<?php } ?>
			<td>
				<label class="control-label form-group">Discount</label>
				<?php echo $this->Form->control('discount',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Discount']); ?> 
			</td>
		</tr>
	</tbody>
</table>   

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