<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Add');
?>
<div class="portlet light bordered " >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($purchaseVoucher) ?>
		<fieldset>
			<legend><?= __('Purchase Voucher') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						
						<div class="form-group col-md-3 controls">
							<label class="control-label">Supplier/Party<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('supplier_ledger_id',['options'=>$SupplierLedger,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Supplier Name.']);?>
							
						</div>
						<div class="form-group col-md-3">
							<label class="control-label">Purchase Ledger <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('purchase_ledger_id',['options'=>$PurchaseLedger,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Email']); ?> 
						</div>
						<div class="form-group col-md-3">
							<label class="control-label">Reference No.<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('voucher_no', ['type'=>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Reference No.']); ?>
						</div>
						<div class="form-group col-md-3">
							<label class="control-label">Transaction Date <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('transaction_date', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'D-M-Y']); ?>
						</div>
					</div>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box " >
						<div class="portlet-title">
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body flip-scroll ">
							<table class="table table-bordered table-striped table-condensed flip-content" id="main_table">
								<thead class="flip-content">
									<tr>
										<th >
											 Sr.No.
										</th>
										<th>
											 ITEM
										</th>
										<th>
											 QUANTITY
										</th>
										<th>
											 RATE PER
										</th>
										<th>
											 AMOUNT (RS.)
										</th>
										<th>
											 ACTION
										</th>
									</tr>
								</thead>
								<tbody id="main_tbody">
									
									
								</tbody>
								<tfoot>
									<tr style="text-align:right">
										
										<td colspan="4" style="text-align:right">Total</td>
										<td><input type="text" name="total" readonly></td>
									<tr>
								</tfoot>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					<br>
					<div class="col-md-12">
						<div class="form-group col-md-2">
							<label class="control-label">Narration</label>
						</div>
						<div class="form-group col-md-4">
							<?php echo $this->Form->control('narration',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Narration']); ?> 
						</div>
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



<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script type="text/javascript">
	$(document).ready(function() 
	{ 
		// add row script
		add_row();
		
		$(document).on("click",".add",function(){
				add_row();
		});
		
		function add_row(){
			var tr=$("#sample_table tbody tr.main_tr").clone();
			$("#main_table tbody#main_tbody").append(tr);
			rename_rows();
		}
		
		
		
		$(document).on("click",".deleterow",function() {
			$(this).closest('tr').remove();
			rename_rows();
			calculate_total();
			});
		
		
		
	function rename_rows(){
		var j=0;
		$("#main_table tbody#main_tbody tr").each(function(){
			$(this).find('td:nth-child(1)').html(j+1);					
			$(this).find("td:nth-child(2) select").attr({name:"purchase_voucher_rows["+j+"][item_id]", id:"purchase_voucher_rows-"+j+"-item_id"});

			$(this).find("td:nth-child(3) input").attr({name:"purchase_voucher_rows["+j+"][quantity]", id:"purchase_voucher_rows-"+j+"-quantity"});

			$(this).find("td:nth-child(4) input").attr({name:"purchase_voucher_rows["+j+"][rate_per]", id:"purchase_voucher_rows-"+j+"-rate_per"});							
					
			$(this).find("td:nth-child(5) input").attr({name:"purchase_voucher_rows["+j+"][amount]", id:"purchase_voucher_rows-"+j+"-amount"});
			j++;
	   });
	};


		$('#main_table input').die().live("keyup","blur",function() { 
		calculate_total();
    });
	function calculate_total(){
		var total=0;
		$("#main_table tbody#main_tbody tr").each(function(){
			var unit=$(this).find("td:nth-child(3) input").val();
			var Rate=$(this).find("td:nth-child(4) input").val();
			var Amount=unit*Rate;
			$(this).find("td:nth-child(5) input").val(Amount.toFixed(2));
			total=total+Amount;
		});
		$('input[name="total"]').val(total.toFixed(2));
	}
		
	});
</script>					



<table id="sample_table" style="display:none">
	<tbody id="sample_tbody">
		<tr class="main_tr">
			<td align="center" width="1px"></td>
			<td width="20%">
				<?php echo $this->Form->control('item_id', ['options' =>$items, 'empty' => false,'label' => false,'class' => 'form-control input-sm select2me']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('quantity',['label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Quantity']); ?> 
			</td>
			<td>
				<?php echo $this->Form->control('rate_per',['label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Price']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('amount',['label' => false,'class' => 'form-control input-sm ','placeholder'=>'Enter Amount']); ?>
			</td>
			<td>
				<input type="button" value="+" class="add"/>
				<input type="button" value="X" class="deleterow" />
			</td>
		</tr>
	</tbody>
</table>

<!-- BEGIN PAGE LEVEL STYLES -->
<?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'cssComponentsPickers']); ?>
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
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsPickers']); ?>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
	jQuery(document).ready(function() {  
		// initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		ComponentsPickers.init();
	});   
</script>