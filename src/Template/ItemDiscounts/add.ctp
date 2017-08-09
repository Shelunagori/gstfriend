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
				<div class="row main_div">
					<div class="form-group col-md-12 main_table">
						
					</div >
					<div class="form-group" style="text-align:center">
						<button type="submit" class="btn btn-primary">Submit	
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

	$('.select_item').die().live("change",function() { 
		var tr=$(".display_table").html();
		$(".main_table").html(tr);
	});


});
</script>
<div class="display_table" style="display:none;">
	<table class=" table table-bordered table-hover" >
		<thead >
			<th >SR.NO.</th>
			<th>CUSTOMER NAME</th>
			<th>PRICE</th>
			<th>DISCOUNT</th>
		</thead>	
		<tbody >
			<?php 	$i=1;
					foreach($customerLedgers as $customerLedger)
					{  
			?>
			<tr >
				<td><?= $this->Number->format($i++) ?></td>
				<td >
					<?= h($customerLedger->name)?>
				</td>
				<td>
					<?php echo $this->Form->control('price',['option'=>$items,'label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Price']); ?> 
				</td>
				<td >
					<?php echo $this->Form->control('discount',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Discount']); ?>
				</td>
			</tr>
			<?php 	} ?>
		</tbody>
	</table>   
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