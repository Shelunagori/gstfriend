<?php
/**
  * @var \App\View\AppView $this
  */

$this->set('title', 'Add');

?>
<div class="portlet light bordered  col-md-9" style="margin-left:10%">
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
					<div class="form-group col-md-12 main_table">
						
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
		var tr=$(".display_table").clone();
		alert();
		$(".main_table").append(tr);
	});


});
</script>
<table class="display_table  form-group" style="display:none;">
	<thead>
		<th style="width:20%; text-align:center; border:1px solid">SR.NO.</th>
		<th style="width:40%; text-align:center; border:1px solid">CUSTOMER NAME</th>
		<th style="width:30%; text-align:center; border:1px solid">PRICE</th>
		<th style="width:50%; text-align:center; border:1px solid;">DISCOUNT</th>
						
	</thead>	
	<tbody class="display_body  form-group">
		<tr class="display_tr  form-group">
			<?php 	$i=0;
					foreach($customerLedgers as $customerLedger)
					$i++;
					{  
			?>
			<td><?= $this->Number->format($i) ?></td>
			<td><label class="control-label form-group">Cutomer Name </label>
				<?= h($customerLedger->name)?>
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