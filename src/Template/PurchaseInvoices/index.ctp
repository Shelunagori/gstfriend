<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseInvoice[]|\Cake\Collection\CollectionInterface $purchaseInvoices
  */
$this->set('title', 'List');
?>
<style>
.hide { display:none; }
</style>
<div class="portlet light bordered" >
	<div class="portlet-body-form"  >
		<div class="form-body">
			<h3><?= __('Purchae Invoice List') ?></h3>
			<div align='right' ><button class="btn btn-success  showdata" ><b>Report</b>&nbsp; &nbsp;</div><br>
			<table id="example1" class="table table-bordered table-striped hidetable">
				<thead style="text-align:center;">
					<tr >
						<th scope="col" >Sr. No.</th>
						<th scope="col" >Date</th>
						<th scope="col" >Invoice No.</th>
						<th scope="col" >Base Amount</th>
						<th scope="col" >CGST Amount</th>
						<th scope="col" >SGST Amount</th>
						<th scope="col" >Total</th>
						<th scope="col" class="actions" ><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 	$i=0; foreach ($purchaseInvoices as $purchaseInvoice): 
							$i++;
					?>
					<tr>
						<td><?= $this->Number->format($i) ?></td>
						<td><?= h($purchaseInvoice->date) ?></td>
						<td><?= $this->Number->format($purchaseInvoice->invoice_no) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->base_amount) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->cgst) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->sgst) ?></td>
						<td style="text-align:right"><?= $this->Number->format($purchaseInvoice->total) ?></td>
						<td class="actions">
							<?php $this->Html->link(__('View'), ['action' => 'view', $purchaseInvoice]) ?>
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseInvoice->id]) ?>
							<?php /*  $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseInvoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoice->id)]) */ ?>
						</td>
					</tr>
					<?php endforeach;  ?>
				</tbody>
			</table>
			<div class="form-body hide reportshow" >
				<div class="row">
					<div class="form-group col-md-9">
						<div class="form-group col-md-4">
							<label class="control-label">Date From</label>
							<?php echo $this->Form->input('from', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker datefrom' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy']); ?>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label">Date To</label>
							<?php echo $this->Form->input('to', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker dateto' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y",strtotime('today'))]); ?>
						</div>
						<div class="form-group col-md-1">
							<label class="control-label"></label>
							<button class="go btn btn-success" name="go">Go
						</div>		
					</div >
				</div>
				<div class="row main_div">
					<div class="form-group col-md-12 main_table"> 
					
					</div>
				</div>
			</div>

			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('first')) ?>
					<?= $this->Paginator->prev('< ' . __('previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('next') . ' >') ?>
					<?= $this->Paginator->last(__('last') . ' >>') ?>
				</ul>
				<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
			</div>
		</div>
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
			alert(response);
			$(".main_table").html(response);
			
			
		});
    });
	

	$(".showdata").click(function(){ 
		$('.hidetable').addClass('hide');
		$('.paginator').addClass('hide');
		$('.reportshow').removeClass('hide');
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