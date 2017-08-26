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
			<legend><?= __('Discount Screen') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="form-group col-md-4">
						<label class="control-label">Select Item</label>
						<?php echo $this->Form->control('item_ids', ['empty' => "---Select---",'options' => $items,'label' => false,'class' => 'form-control input-sm select2me select_item item','placeholder'=>'Enter Item']); ?> 
						
						
					</div >
				</div>
				<div class="row main_div">
					<div class="form-group col-md-12 main_table"> 
					<!-- this div close at ajax page get_item_discount.ctp -->
						

				</div>
			</div>
		</fieldset>
		<?= $this->Form->end() ?>
	</div>
</div> 
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() { 

	$(".select_item").change(function() {
		var item_id = $(this).find('option:selected').val();
		var obj=$(this);
		var url="<?php echo $this->Url->build(['controller'=>'ItemDiscounts','action'=>'getItemDiscount']);?>";
		url=url+'/'+item_id,
		$.ajax({ 
			url: url,
			type: 'GET',
		}).done(function(response) {
			$(".main_table").html(response);
			
			var rate = obj.find('option:selected').attr('rate');
			var item = obj.find('option:selected').val();
		
			$('#main_tbl').find('td .rate').val(rate);
			$('.item_hidden').val(item);
		});
    });

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