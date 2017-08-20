<?php
/**
  * @var \App\View\AppView $this
  */
  $this->set('title', 'Add');
?>
<style>
.maindiv{
		font-family: sans-serif !important; font-size:12px !important;
	}
@media print{
	.maindiv{
		width:100% !important;font-family: sans-serif;
	}	
	.hidden-print{
		display:none;
	}
	body {
      -webkit-print-color-adjust: exact;
   }
}
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 20px 0 20px;  /* this affects the margin in the printer settings */
}

p{
	margin-bottom: 0;
}

.tbl td, .tbl th {
    border: 1px solid black;
}

.footertble td{
    padding: 1px 3px;
}


.nbtbl td, .nbtbl th {
    border: none;
}
.tbl th {
    text-align:center;
}
.tbl td {
    padding:3px;
}

.hide { display:none; }
.mainTr:hover .viewThisResult { display: block; }
.mainTr:hover .sr { display: none; }
.viewThisResult { display: none; }
</style>

<div style="width:100%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;margin-top:2%" class="maindiv">
	<?= $this->Form->create($purchaseVoucher,['id'=>'form_3']) ?>
		<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color : #c4151c !important;font-size:18px;color: #FFF !important;"><b style="color: #FFF !important;">PURCHASE VOUCHER</b></div>
		<div>
			<table width="100%">
				<tr>
					<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
						<table>
							
							<tr>
								<td width="40%"><b>Reference No.</b></td>
								<td width="40%" class="form-group"><?php echo $this->Form->control('reference_no', ['type'=>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Reference No.']); ?></td>
							</tr>
							<tr>
								<td><br/></td>
								<td><br/></td>
							</tr>
							<tr>
								<td width="40%"><b>Transaction Date</b></td>
								<td class="form-group"><?php echo $this->Form->input('transaction_date', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyy','value'=>date("d-m-Y",strtotime('today'))]); ?></td>
							</tr>
						</table>
					</td>
					<td style="padding:5px;" valign="top">
						<table width="100%">
							
							<tr>
								<td width="30%"><b>Supplier Name</b></td>
								<td width="50%" class="form-group"><?php echo $this->Form->control('supplier_ledger_id',['empty'=>"---select---",'options'=>$SupplierLedger,'label' => false,'class' => 'form-control input-sm select2me']);?></td>
							</tr>
							<tr>
								<td><br/></td>
								<td><br/></td>
							</tr>
							<tr class='hide'>
								<td width="30%" ><b>Purchase Ledger </b></td>
								<td class="form-group"><?php echo $this->Form->control('purchase_ledger_id',['options'=>$PurchaseLedger,'label' => false,'class' => 'form-control input-sm']); ?> </td>
							</tr>
							
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div align="center" style="border:none;">
			<table width="100%" class="tbl" id="main_table">
				<thead>
					<tr style="background-color: #e4e3e3;">
						<th rowspan="2" style="border-left: none;">Sr. No.</th>
						<th rowspan="2" width="350">Item Description</th>
						<th rowspan="2" width="80" class="hide">HSN code</th>
						<th rowspan="2" width="100">Qty</th>
						<th rowspan="2" width="100">Rate</th>
						<th rowspan="2" width="80">Amount</th>
						<th rowspan="2" width="130">Discount Amount </th>
						<th rowspan="2" width="100">Taxable Value</th>
						<th colspan="2" class='gst'>CGST</th>
						<th colspan="2" class='gst'>SGST</th>
						<th colspan="2" class='igst'>IGST</th>
						<th rowspan="2" style="border-right: none;" width="80">Total</th>
						<th rowspan="2" width="80">Action</th>
						
					</tr>
					<tr style="background-color: #e4e3e3;">
						<th width="80" class='gst'>Rate</th>
						<th width="80" class='gst'>Amount</th>
						<th width="80" class='gst'>Rate</th>
						<th width="80" class='gst'>Amount</th>
						<th width="80" class='igst'>Rate</th>
						<th width="80" class='igst'>Amount</th>						
					</tr>
				</thead>
				<tbody id="main_tbody">
					
				</tbody>
			</table>
		
			<table width="100%" class="tbl">
				<tbody>
					<tr>
						<td style="border-top: none;" width="200" colspan="7" rowspan="5" class="form-group"><label class="control-label" >Narration</label>
							
							<?php echo $this->Form->control('narration',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Narration']); ?> 
						</td>
						<td style="text-align:right;border-top: none;" width="35" colspan="4"><b>Total Amount before Tax</b></td>
						<td style="text-align:right;border-right: none;border-top: none;" width="55" >
							<?php echo $this->Form->control('total_amount_before_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 65px;border: none;text-align: right;','tabindex'=>'-1']); ?>
						</td>
						<td style="text-align:right;border-right:none;border-top:none;" rowspan="5" width="57px"></td>
					</tr>
					<tr>
						<td style="text-align:right;" colspan="4"><b>Total CGST</b></td>
						<td style="text-align:right;border-right:none;" width="55" >
							<?php echo $this->Form->control('total_cgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 65px;border: none;text-align: right;','tabindex'=>'-1']); ?>
						</td>
					
					</tr>
					<tr>
						<td style="text-align:right;" colspan="4"><b>Total SGST</b></td>
						<td style="text-align:right;border-right: none;" width="55">
							<?php echo $this->Form->control('total_sgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 65px;border: none;text-align: right;','tabindex'=>'-1']); ?>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;" colspan="4"><b>Total IGST</b></td>
						<td style="text-align:right;border-right: none;" width="55">
							<?php echo $this->Form->control('total_igst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 65px;border: none;text-align: right;','tabindex'=>'-1']); ?>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;" colspan="4"><b>Total Amount after Tax</b></td>
						<td style="text-align:right;" width="55" >
							<?php echo $this->Form->control('total_amount_after_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 65px;text-align: right;border: none;','tabindex'=>'-1']); ?>	
						</td>
						
					</tr>
				</tbody>
			</table>
		</div>
	<div style="text-align:center;margin-top:15px;margin-bottom:15px;">
		<button type="submit" class="btn btn-primary">Submit
	</div>
	<?= $this->Form->end() ?>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>



<script>

$(document).ready(function() { 
	var form3 = $('#form_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		
		rules: {
			reference_no:{
				required: true,
			},
			transaction_date : {
				  required: true,
			},
			supplier_ledger_id : {
				  required: true,
			},
			purchase_ledger_id : {
				  required: true,
			},
			quantity:{
				required: true,	
			},
			rate_per:{
				required: true,	
			},
			item_id: {
				required: true,
			},
			cgst_ledger_id: {
				required: true,
			},
			sgst_ledger_id: {
				required: true,
				
			}
		},

		
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			success3.hide();
			error3.show();
			//Metronic.scrollTo(error3, -200);
		},

		highlight: function (element) { // hightlight error inputs
		   $(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form3) {

			form3[0].submit(); // submit the form
		}

	});
	//--	 END OF VALIDATION
	
	
	
	$('.item').die().live("change",function() { 
			var rate = $(this).find('option:selected').attr('rate');
			var cgst_ledger_id = $(this).find('option:selected').attr('cgst_ledger_id');
			var sgst_ledger_id = $(this).find('option:selected').attr('sgst_ledger_id');
			var igst_ledger_id = $(this).find('option:selected').attr('igst_ledger_id');
			
			if(cgst_ledger_id == 0 || sgst_ledger_id == 0)
			{
				$(this).closest('tr').find('.gst').hide();
				
			}
			else
			{
				$(this).closest('tr').find('.gst').show();
				
			}
			if(igst_ledger_id == 0)
			{
				$(this).closest('tr').find('.igst').hide();
				
			}
			else
			{
				$(this).closest('tr').find('.igst').show();
				
			}			
			
			
			$(this).closest('tr').find('td .rate').val(rate);
			$(this).closest('tr').find('td .cgst').val(cgst_ledger_id);
			$(this).closest('tr').find('td .sgst').val(sgst_ledger_id);
			$(this).closest('tr').find('td .igst').val(igst_ledger_id);
			calculation();
		});
	
	
	// add row script Start
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
			calculation();
			});
		
		
		
	function rename_rows(){
		var j=0;
		$("#main_table tbody#main_tbody tr").each(function(){
			$(this).find('td:nth-child(1)').html(j+1);					
			$(this).find("td:nth-child(2) select").select2().attr({name:"purchase_voucher_rows["+j+"][item_id]", id:"purchase_voucher_rows-"+j+"-item_id"}).rules("add","required");

			$(this).find("td:nth-child(3) input").attr({name:"purchase_voucher_rows["+j+"][quantity]", id:"purchase_voucher_rows-"+j+"-quantity"}).rules("add","required");

			$(this).find("td:nth-child(4) input").attr({name:"purchase_voucher_rows["+j+"][rate_per]", id:"purchase_voucher_rows-"+j+"-rate_per"}).rules("add","required");						
					
			$(this).find("td:nth-child(5) input").attr({name:"purchase_voucher_rows["+j+"][amount]", id:"purchase_voucher_rows-"+j+"-amount"}).rules("add","required");
			
			$(this).find("td:nth-child(6) input").attr({name:"purchase_voucher_rows["+j+"][discount_amount]", id:"purchase_voucher_rows-"+j+"-discount_amount"});
			
			$(this).find("td:nth-child(7) input").attr({name:"purchase_voucher_rows["+j+"][taxable_value]", id:"purchase_voucher_rows-"+j+"-taxable_value"}).rules("add","required");
			
			$(this).find("td:nth-child(8) select").attr({name:"purchase_voucher_rows["+j+"][cgst_ledger_id]", id:"purchase_voucher_rows-"+j+"-cgst_ledger_id"}).rules("add","required");
			
			$(this).find("td:nth-child(9) input").attr({name:"purchase_voucher_rows["+j+"][cgst_amount]", id:"purchase_voucher_rows-"+j+"-cgst_amount"}).rules("add","required");
			
			$(this).find("td:nth-child(10) select").attr({name:"purchase_voucher_rows["+j+"][sgst_ledger_id]", id:"purchase_voucher_rows-"+j+"-sgst_ledger_id"}).rules("add","required");
			
			$(this).find("td:nth-child(11) input").attr({name:"purchase_voucher_rows["+j+"][sgst_amount]", id:"purchase_voucher_rows-"+j+"-sgst_amount"}).rules("add","required");
			
			
			$(this).find("td:nth-child(12) select").attr({name:"purchase_voucher_rows["+j+"][igst_ledger_id]", id:"purchase_voucher_rows-"+j+"-igst_ledger_id"}).rules("add","required");
			
			$(this).find("td:nth-child(13) input").attr({name:"purchase_voucher_rows["+j+"][igst_amount]", id:"purchase_voucher_rows-"+j+"-igst_amount"}).rules("add","required");			
			
			$(this).find("td:nth-child(14) input").attr({name:"purchase_voucher_rows["+j+"][total]", id:"purchase_voucher_rows-"+j+"-total"}).rules("add","required");
			j++;
	   });
	   calculation();
	}

	//Add Row Script End
	
	//Calculation In Row  Start
	$('#main_table input').die().live("keyup","blur",function() { 
		calculation();
	});
	$('.gst_call').die().live("change",function() { 
		calculation();
	});
	
	function calculation(){ 
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_igst=0;
		var total_amount_after_tax=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			var total=parseFloat($(this).find("td:nth-child(14) input").val());
			if(!total){ total=0; }
			
			total_amount_after_tax=total_amount_after_tax+total
			
			
			var sgst_rate=parseFloat($(this).find("td:nth-child(10) option:selected").attr('percentage'));
			if(!sgst_rate){ sgst_rate=0; }
			var sgst_per=parseFloat(sgst_rate);
			
			
			var cgst_rate=parseFloat($(this).find("td:nth-child(8) option:selected").attr('percentage'));
			if(!cgst_rate){ cgst_rate=0; }
			var cgst_per=parseFloat(cgst_rate);
			
			
			var igst_rate=parseFloat($(this).find("td:nth-child(12) option:selected").attr('percentage'));
			if(!igst_rate){ igst_rate=0; }
			
			var igst_per=parseFloat(igst_rate);
			
			
			
			var total_tax=parseFloat(sgst_per)+parseFloat(cgst_per)+parseFloat(igst_per);
			
			//tax value calculate start
			var taxable_value =  (total/((total_tax)+100))*100;
			
			$(this).find("td:nth-child(7) input").val(taxable_value.toFixed(2));
			var cgst_amount = taxable_value * (cgst_per/100);
			$(this).find("td:nth-child(9) input").val(cgst_amount.toFixed(2));
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			
			var sgst_amount = taxable_value * (sgst_per/100);
			$(this).find("td:nth-child(11) input").val(sgst_amount.toFixed(2));
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			
			

			var igst_amount = taxable_value * (igst_per/100);
			$(this).find("td:nth-child(13) input").val(igst_amount.toFixed(2));
			total_igst=parseFloat(total_igst)+parseFloat(igst_amount);
			
		
				
			var discount_amount=parseFloat($(this).find("td:nth-child(6) input").val());
			if(!discount_amount){ discount_amount=0; }
			var amount = taxable_value+discount_amount;
			$(this).find("td:nth-child(5) input").val(amount.toFixed(2));
			var quantity=parseFloat($(this).find("td:nth-child(3) input").val());
			if(!quantity){ quantity=0; }
			var rate = amount/ quantity;
			$(this).find("td:nth-child(4) input").val(rate.toFixed(2));
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;			
		});
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_igst"]').val(total_igst.toFixed(2));
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
	}
	
	
	
});
</script>					



<?php 
$Cgst=[];
foreach($CgstTax as $GstTaxe){

	$Cgst[]=['text' =>$GstTaxe->name, 'value' => $GstTaxe->id, 'percentage'=>$GstTaxe->tax_percentage];
}

$Sgst=[];
foreach($SgstTax as $SgstTaxe){
	$Sgst[]=['text' =>$SgstTaxe->name, 'value' => $SgstTaxe->id, 'percentage'=>$SgstTaxe->tax_percentage];
}

$Igst=[];
foreach($IgstTax as $IgstTaxe){
	$Igst[]=['text' =>$IgstTaxe->name, 'value' => $IgstTaxe->id, 'percentage'=>$IgstTaxe->tax_percentage];
}


?>


<table id="sample_table" style="display:none">
	<tbody id="sample_tbody">
		<tr class="main_tr">
			<td align="center" width="1px"></td>
			<td width="20%" class="form-group">
				<?php echo $this->Form->control('item_id', ['empty'=>"----select----",'options' =>$items, 'label' => false,'class' => 'form-control item input-sm itemchange select2me ']); ?>
			
			</td>
			
			<td class="form-group">
				<?php echo $this->Form->control('quantity',['label' => false,'class' => 'form-control change_qty input-sm ','placeholder'=>'Qty','value'=>1]); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('rate_per',['label' => false,'class' => 'form-control input-sm rate_per','placeholder'=>'Rate']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('amount',['label' => false,'class' => 'form-control input-sm ','placeholder'=>'Amount']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('discount_amount',['label' => false,'class' => 'form-control input-sm ','placeholder'=>'Amount']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('taxable_value',['label' => false,'class' => 'form-control input-sm ','placeholder'=>'Amount']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('cgst_ledger_id', ['empty'=>"-select-",'options' =>$Cgst,'label' => false,'class' => 'form-control gst cgst input-sm gst_call','placeholder'=>'CGST']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('cgst_amount',['label' => false,'class' => 'form-control gst input-sm ','placeholder'=>'Amount']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('sgst_ledger_id',['empty'=>"-select-",'options' =>$Sgst,'label' => false,'class' => 'form-control gst sgst input-sm gst_call','placeholder'=>'SGST']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('sgst_amount',['label' => false,'class' => 'form-control gst input-sm ','placeholder'=>'Amount']); ?>
			</td>
			
			<td class="form-group">
				<?php echo $this->Form->control('igst_ledger_id',['empty'=>"-select-",'options' =>$Igst,'label' => false,'class' => 'form-control input-sm igst gst_call','placeholder'=>'IGST']); ?> 
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('igst_amount',['label' => false,'class' => 'form-control igst input-sm ','placeholder'=>'Amount']); ?>
			</td>			
			
			
			<td class="form-group">
				<?php echo $this->Form->control('total',['label' => false,'name'=>'total','class' => 'form-control input-sm ','placeholder'=>'Total']); ?>
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

<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'cssComponentsDropdowns']); ?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>



<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<!-- END PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js'); ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsPickers']); ?>

<?php //echo $this->Html->script('/assets/global/scripts/metronic.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<?php //echo $this->Html->script('/assets/admin/layout/scripts/layout.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<?php //echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<?php //echo $this->Html->script('/assets/admin/layout/scripts/demo.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
	jQuery(document).ready(function() {
		// initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		ComponentsPickers.init();
		ComponentsDropdowns.init();
		FormValidation.init();
	});   
</script>