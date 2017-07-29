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
						<div class="form-group col-md-2">
							<label class="control-label">Supplier/Party</label>
						</div>
						<div class="form-group col-md-4">
							<?php echo $this->Form->control('supplier_id',['label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Mobile No.']); ?> 
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group col-md-2">
							<label class="control-label">Reference No.<span class="required" aria-required="true">*</span></label>
						</div>
						<div class="form-group col-md-4">	
							<?php echo $this->Form->control('voucher_no', ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Reference No.']); ?>
						</div>
					</div>	
					<div class="col-md-12">
						<div class="form-group col-md-2">
							<label class="control-label">Purchase Ledger</label>
						</div>
						<div class="form-group col-md-4">	
							<?php echo $this->Form->control('customer_id',['label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Email']); ?> 
						</div>
					</div>	
					<div class="col-md-12">
						<div class="form-group col-md-2">
							<label class="control-label">Transaction Date</label>
						</div>
						<div class="form-group col-md-4">	
							<?php echo $this->Form->control('transaction_date',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Date']); ?> 
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




<?php echo $this->Html->script('jquery.min.js'); ?>

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
			});
		
		
		
		function rename_rows(){
		var j=0;
		$("#main_table tbody#main_tbody tr").each(function(){
			
			$(this).find('td:nth-child(1)').html(j+1);					
					$(this).find("td:nth-child(2) input").attr({name:"purchase_voucher_rows["+j+"][item_id]", id:"purchase_voucher_rows-"+j+"-item_id"});

					$(this).find("td:nth-child(3) input").attr({name:"purchase_voucher_rows["+j+"][quantity]", id:"purchase_voucher_rows-"+j+"-quantity"});

					$(this).find("td:nth-child(4) input").attr({name:"purchase_voucher_rows["+j+"][rate_per]", id:"purchase_voucher_rows-"+j+"-rate_per"});							
							
					$(this).find("td:nth-child(5) input").attr({name:"purchase_voucher_rows["+j+"][amount]", id:"purchase_voucher_rows-"+j+"-amount"});
					j++;
	   });
	};	
		
	});
</script>					



<table id="sample_table" style="display:none">
	<tbody id="sample_tbody">
		<tr class="main_tr">
			<td align="center" width="1px"></td>
			<td width="20%">
				<?php echo $this->Form->control('item_id',['label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item']); ?> 
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