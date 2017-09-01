<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Edit');
?>
<div class="portlet light bordered  col-md-12">
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
						<?php echo $this->Form->control('item_id', ['options' => $items,'label' => false,'class' => 'form-control input-sm select2me item','placeholder'=>'Enter Item','value'=>$itemDiscount->id]); ?>
					</div >
				</div>
				<div class="row main_div">
					<div class="col-md-12 second_div">	
						<table class="table table-bordered table-hover main_tb" >
							<thead >
								<th >SR.NO.</th>
								<th>CUSTOMER NAME</th>
								<th>PRICE</th>
								<th>DISCOUNT</th>
							</thead>	
							<tbody class="tbody">
								<?php 	$i=1; $j=0;
										foreach($customerLedgers as $customerLedger)
										
										{  
								?>
								<tr class="main_tr">
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
				</div>
			</div>
		</fieldset>
		<?= $this->Form->end() ?>
	</div>
</div> 
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() { 

	
	$('.item').die().load(function() { alert();
		
		
		
	});	

	/* var rate = $(this).find('option:selected').attr('rate');
	
		alert(rate);
		$('.main_div .second_div table.main_tb tbody.tbody tr.main_tr ').find('td .rate').val(rate); */
	
	
	
});
</script>
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