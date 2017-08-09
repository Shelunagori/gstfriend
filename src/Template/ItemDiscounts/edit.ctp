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
					<div class="form-group col-md-4">
						<label class="control-label">Select Item</label>
						<?php echo $this->Form->control('item_ids', ['options' => $items,'label' => false,'class' => 'form-control input-sm select2me select_item item','placeholder'=>'Enter Item']); ?> 
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
		<div>
			<button type="submit" class="btn btn-primary">Submit
		</div>
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
	
	$('.item').die().live("change",function() { 
		var rate = $(this).find('option:selected').attr('rate');
		var item = $(this).find('option:selected').val();
	
		$('#main_tbl').find('td .rate').val(rate);
		$('.item_hidden').val(item);
		
	});	

	
	
	
	
});
</script>
<div class="display_table" style="display:none;">
	<table class=" table table-bordered table-hover" id='main_tbl' >
		<thead >
			<th >SR.NO.</th>
			<th>CUSTOMER NAME</th>
			<th>PRICE</th>
			<th>DISCOUNT</th>
		</thead>	
		<tbody >
			<?php 	$i=1; $j=0;
					foreach($customerLedgers as $customerLedger)
					{  
			?>
			<tr >
				<td><?= $this->Number->format($i++) ?>
					<?php echo $this->Form->control('item_discounts.'.$j.'.item_id', ['label' => false,'type'=>'hidden','class' => 'form-control input-sm item_hidden','placeholder'=>'Enter Item']); ?> 
				</td>
				<td>
					<?php echo $customerLedger->name; ?>
					<?php echo $this->Form->control('item_discounts.'.$j.'.customer_ledger_id',['label' => false,'type'=>'hidden','class' => 'form-control input-sm firstupercase','value'=>$customerLedger->id,'readonly']); ?>
				</td>
				<td>
					<?php echo $this->Form->control('item_discounts.'.$j.'.price',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase rate','placeholder'=>'Enter Price','readonly']); ?> 
				</td>
				<td >
					<?php echo $this->Form->control('item_discounts.'.$j.'.discount',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Discount']); ?>
				</td>
			</tr>
			<?php $j++;	} ?>
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