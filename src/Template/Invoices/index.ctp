<?php $this->set('title', 'Invoice List'); ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-cursor font-purple-intense"></i>
			<span class="caption-subject font-purple-intense ">Invoices</span>
		</div>
		<div class="actions">
			
		</div>
	</div>
	<div align='right' ><button class="btn btn-success  showdata" ><b>Invoice Report</b>&nbsp; &nbsp;</div><br>
	<div class="portlet-body">
		<div class="table-scrollable hidetable">
		<?php $page_no=$this->Paginator->current('Invoices'); $page_no=($page_no-1)*20; ?>
			<table class="table table-bordered table-striped  ">
				<thead>
					<tr>
						<th scope="col">Sr.</th>
						<th scope="col">Invoice No</th>
						<th scope="col">Invoice Date</th>
						<th scope="col">Customer</th>
						<th scope="col">Total Amount After Tax</th>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($invoices as $invoice): ?>
					<tr>
						<td><?= h(++$page_no) ?></td>
						<td>
							<?php $in_no='#'.str_pad($invoice->invoice_no, 4, '0', STR_PAD_LEFT);  ?>
							<?= $this->Html->link(__($in_no), ['action' => 'view', $invoice->id],['target'=>'_blank']) ?></td>
						<td><?= h($invoice->transaction_date) ?></td>
						<td><?= h($invoice->customer_ledgers['customer']['name']) ?></td>
						<td align="right"><?= $this->Number->format($invoice->total_amount_after_tax,[ 'places' => 2]) ?></td>
						<td class="actions">
							<?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id]) ?>
							<?= $this->Html->link(__('View'), ['action' => 'view', $invoice->id]) ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="form-body hide reportshow datevalid" >
			<div class="row">
				<div class="form-group col-md-9">
					<div class="form-group col-md-4">
						<label class="control-label">Date From</label>
						<?php echo $this->Form->input('from', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker datefrom firstdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy']); ?>
					</div>
					<div class="form-group col-md-4">
						<label class="control-label">Date To</label>
						<?php echo $this->Form->input('to', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker dateto lastdate' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y",strtotime('today'))]); ?>
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


<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() { 
	
	
	
	$(".go").on('click',function() {
		var startdate = $('.firstdate').val();
		var enddate = $('.lastdate').val();	
		if(startdate < enddate)
		{
			var datefrom = $('.datefrom').val();
			
			var dateto = $('.dateto').val();
			var obj=$(this);
			var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'datewiseinvoicereport']);?>";
			url=url+'/'+datefrom+'/'+dateto,
			
			$.ajax({ 
				url: url,
				type: 'GET',
			}).done(function(response) 
			{
				$(".main_table").html(response);
			});
		}else
		{
			alert('Please Select Valid Date');
			$('.lastdate').val('');
			$('.firstdate').val('');
		}
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