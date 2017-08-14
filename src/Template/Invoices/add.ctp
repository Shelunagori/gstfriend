<?php $this->set('title', 'Add Invoice'); ?>
<style>
p{
	margin-bottom: 0;
}

.tbl td, .tbl th {
    border: 1px solid black;
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
</style>
<?= $this->Form->create($invoice,['id'=>'form_3']) ?>
<div style="width:100%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;" class="maindiv">
	
	
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color: #c4151c;font-size:18px;color: #FFF;"><b>TAX INVOICE</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td><div><b>Invoice Type</b></div></br></td>
							<td><div>&nbsp;:&nbsp;</div></br></td>
							<td>
								<div class="radio-list">
									<label class="radio-inline">
									<div class="radio" id="uniform-optionsRadios26"><span class="checked"><input type="radio" name="invoicetype" id="invoicetype" value="Credit" checked></span></div> Credit </label>
									
									<label class="radio-inline">
									<div class="radio" id="uniform-optionsRadios25"><span class=""><input type="radio" name="invoicetype" id="invoicetype" value="Cash"></span></div> Cash </label>
								</div></br>
							</td>
						</tr>
						<tr>
							<td><b>Invoice Date</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('transaction_date',['label'=>false,'placeholder'=>'dd-mm-yyyy','type'=>'text','class'=>'date-picker form-control input-sm','data-date-format'=>'dd-mm-yyyy','value'=>date('d-m-Y')]); ?></td>
						</tr>
						<tr>
							<td> <span class='hide'> <b>Sales Account</b> </span> </td>
							<td><span class='hide'>&nbsp;:&nbsp; </span></td>
							<td><?php echo $this->Form->control('sales_ledger_id',['label'=>false,'autofocus','class'=>'form-control input-sm hide','options'=>$salesLedgers]); ?></td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;" >
					<table width="100%">
						<tr>
							<td colspan="3"><b>Bill to Party</b></td>
						</tr>
						<tr id='cashhide'>
							<td><b>Name</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td class="form-group"><?php echo $this->Form->control('customer_ledger_id',['empty' => "---Select---",'label'=>false,'class'=>'form-control input-sm cstmr']); ?></td>
						</tr>
						<tr id='cashshow' class="hide">
							<td><b>Name</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td class="form-group"><?php echo $this->Form->control('customername',['label'=>false,'class'=>'form-control input-sm ']); ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div align="center" style="border:none;">
		<table width="100%" class="tbl" id="mainTbl">
			<thead>
				<tr style="background-color: #e4e3e3;">
					<th rowspan="2" style="border-left: none;">Sr. No.</th>
					<th rowspan="2" width="30%">Item Description</th>
					<th rowspan="2" width="80" class="hide">HSN code</th>
					<th rowspan="2" width="40">Qty</th>
					<th rowspan="2" width="80">Rate</th>
					<th rowspan="2" width="80">Amount</th>
					<th rowspan="2">Discount Amount </th>
					<th rowspan="2" width="80">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
					<th rowspan="2" style="border-right: none;" width="80">Total</th>
				</tr>
				<tr style="background-color: #e4e3e3;">
					<th width="80">Rate</th>
					<th width="80">Amount</th>
					<th width="80">Rate</th>
					<th width="80">Amount</th>
				</tr>
			</thead>
			<tbody id="mainTbody">
				
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<tr>
					<td rowspan="4" style="border-left: none;border-top: none;border-bottom: none;" width="70%" valign="top">
						<button type="button" class="btn blue-hoki  btn-xs addrow"><i class="fa fa-plus"></i> Add row</button>
					</td>
					<td style="text-align:right;border-top: none;"><b>Total Amount before Tax</b></td>
					<td style="text-align:right;border-right: none;border-top: none;" width="80">
						<?php echo $this->Form->control('total_amount_before_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total CGST</b></td>
					<td style="text-align:right;border-right: none;">
						<?php echo $this->Form->control('total_cgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total SGST</b></td>
					<td style="text-align:right;border-right: none;">
						<?php echo $this->Form->control('total_sgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;border-bottom: none;"><b>Total Amount after Tax</b></td>
					<td style="text-align:right;border-right: none;border-bottom: none;">
						<?php echo $this->Form->control('total_amount_after_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;text-align: right;border: none;','tabindex'=>'-1']); ?>	
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div align="center"><?= $this->Form->button(__('Generate Invoice'),['class'=>'btn green']) ?></div>
<?= $this->Form->end() ?>
<?php foreach($items as $item){
		}
	?>
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
			transaction_date : {
				  required: true,
			},
			customer_ledger_id : {
				  required: true,
			},
			quantity:{
				required: true,	
			},
			rate:{
				required: true,	
			},
			discount_amount:{
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
	add_row();
	$('.addrow').live("click",function() {
		add_row();
	});
	
	$('.viewThisResult').live("click",function() {
		$(this).closest("tr").remove();
		rename_rows();
	});
	
	function add_row(){
		var tr=$("#sampleTbl tbody tr").clone();
		$("#mainTbl tbody#mainTbody").append(tr);
		$("#mainTbl tbody#mainTbody tr.mainTr:last").find('td:eq(1) input').focus();
		rename_rows();
	}
	
	function rename_rows(){
		var i=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			$(this).find("td:eq(0) span.sr").html(++i); i--;
			$(this).find("td:nth-child(2) select").select2().attr({name:"invoice_rows["+i+"][item_id]", id:"invoice_rows-"+i+"-item_id"}).rules("add","required");
			$(this).find("td:eq(2) input").attr({name:"invoice_rows["+i+"][hsn_code]", id:"invoice_rows-"+i+"-hsn_code"}).rules("add","required");
			$(this).find("td:eq(3) input").attr({name:"invoice_rows["+i+"][quantity]", id:"invoice_rows-"+i+"-quantity"}).rules("add","required");
			$(this).find("td:eq(4) input").attr({name:"invoice_rows["+i+"][rate]", id:"invoice_rows-"+i+"-rate"}).rules("add","required");
			$(this).find("td:eq(5) input").attr({name:"invoice_rows["+i+"][amount]", id:"invoice_rows-"+i+"-amount"}).rules("add","required");
			
			$(this).find("td:eq(6) input").attr({name:"invoice_rows["+i+"][discount_amount]", id:"invoice_rows-"+i+"-discount_amount"});
			$(this).find("td:eq(7) input").attr({name:"invoice_rows["+i+"][taxable_value]", id:"invoice_rows-"+i+"-taxable_value"}).rules("add","required");
			$(this).find("td:eq(8) select").attr({name:"invoice_rows["+i+"][cgst_rate]", id:"invoice_rows-"+i+"-cgst_rate"}).rules("add","required");
			$(this).find("td:eq(9) input").attr({name:"invoice_rows["+i+"][cgst_amount]", id:"invoice_rows-"+i+"-cgst_amount"}).rules("add","required");
			$(this).find("td:eq(10) select").attr({name:"invoice_rows["+i+"][sgst_rate]", id:"invoice_rows-"+i+"-sgst_rate"}).rules("add","required");
			$(this).find("td:eq(11) input").attr({name:"invoice_rows["+i+"][sgst_amount]", id:"invoice_rows-"+i+"-sgst_amount"}).rules("add","required");
			$(this).find("td:eq(12) input").attr({name:"invoice_rows["+i+"][total]", id:"invoice_rows-"+i+"-total"}).rules("add","required");
		i++;
		});
		calculation();
	}
	
	$('.calculate').live("keyup",function() {
		calculation();
	});
	
	$('#mainTbl input').die().live("keyup","blur",function() { 
		calculation();
	});	

	$('#mainTbl select').die().live("change","blur",function() { 
		calculation();
	});		
	
	function calculation(){ 
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_amount_after_tax=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			
			var total=parseFloat($(this).find("td:eq(12) input").val());
			if(!total){ total=0; }
			
			total_amount_after_tax=total_amount_after_tax+total
			var sgst_rate=parseFloat($(this).find("td:eq(10) option:selected").attr('tax_rate'));
			if(!sgst_rate){ sgst_rate=0; }
			$(this).val(sgst_rate);
			var sgst_per=parseFloat($(this).val());
			var cgst_rate=parseFloat($(this).find("td:eq(8) option:selected").attr('tax_rate'));
			if(!cgst_rate){ cgst_rate=0; }
			$(this).val(cgst_rate);
			var cgst_per=parseFloat($(this).val());
			if(!cgst_per){ cgst_per=0; }
			var total_tax=(sgst_per+cgst_per);
			//tax value calculate start
			var taxable_value =  (total/((total_tax)+100))*100;
			$(this).find("td:eq(7) input").val(taxable_value.toFixed(2));
			var cgst_amount = taxable_value * (cgst_per/100);
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			var sgst_amount = taxable_value * (sgst_per/100);
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			//tax value calculate end
			$(this).find("td:eq(9) input").val(total_cgst.toFixed(2));
			$(this).find("td:eq(11) input").val(total_sgst.toFixed(2));
			var discount_amount=parseFloat($(this).find("td:eq(6) input").val());
			if(!discount_amount){ discount_amount=0; }
			var amount = taxable_value+discount_amount;
			$(this).find("td:eq(5) input").val(amount.toFixed(2));
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			if(!quantity){ quantity=0; }
			var rate = amount/ quantity;
			$(this).find("td:eq(4) input").val(rate.toFixed(2));
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;			
		});
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
	}
	
	//change value on change quantity start
	$(".change_qty").on('keyup',function(){
		
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			var rate = $(this).find('option:selected').attr('rate');
			var discount = parseFloat($(this).find("td:eq(6) input").val());
			if(!discount){ discount=0; }
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			
			var total=rate*quantity;
			var discount=discount*quantity;
			
			$(this).find("td:eq(12) input").val(total.toFixed(2));
			$(this).find("td:eq(6) input").val(discount.toFixed(2));
		});
		calculation();
	});
	//change value on change quantity end
	

	$('.revCalculate').live("keyup",function() {
		reverseCalculation();
	});
	
	function reverseCalculation(){
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_amount_after_tax=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			var total=parseFloat($(this).find("td:eq(12) input").val());
			if(!total){ total=0; }
			
			var cgst_rate=parseFloat($(this).find("td:eq(8) input").val());
			if(!cgst_rate){ cgst_rate=0; }
			
			var sgst_rate=parseFloat($(this).find("td:eq(10) input").val());
			if(!sgst_rate){ sgst_rate=0; }
			
			var to_be_divide=parseFloat(cgst_rate)+parseFloat(sgst_rate)+100;
			
			var taxable_value=(total/to_be_divide)*100;
			
			$(this).find("td:eq(8) input").val(taxable_value.toFixed(2));
			$(this).find("td:eq(5) input").val(taxable_value.toFixed(2));
			
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			if(!quantity){ quantity=0; }
			
			var rate=taxable_value/quantity;
			$(this).find("td:eq(4) input").val(rate.toFixed(2));
			
			var discount_amount=(taxable_value*discount_rate)/100;
			$(this).find("td:eq(6) input").val(taxable_value.toFixed(2));
			
			var cgst_amount=(taxable_value*cgst_rate)/100;
			$(this).find("td:eq(9) input").val(cgst_amount.toFixed(2));
			
			var sgst_amount=(taxable_value*sgst_rate)/100;
			$(this).find("td:eq(11) input").val(sgst_amount.toFixed(2));
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			total_amount_after_tax=total_amount_after_tax+total;
		});
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
	}
	
	//$('input[name="party_name"]').focus();
<<<<<<< HEAD
	
	$('.item').die().live("change",function() { 
		var rate = $(this).find('option:selected').attr('rate');
		var cgst_ledger_id = $(this).find('option:selected').attr('cgst_ledger_id');
		var sgst_ledger_id = $(this).find('option:selected').attr('sgst_ledger_id');
		$(this).closest('tr').find('td .rate').val(rate);
		$(this).closest('tr').find('td .total_cgst').val(cgst_ledger_id);
		$(this).closest('tr').find('td .sgst_rate').val(sgst_ledger_id);
		
		var customer = $(".cstmr").find('option:selected').val();
		var item = $(this).find('option:selected').val();
		var obj = $(this);
		var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'CustomerDiscount']);?>";
		if(customer != '')
		{
			url=url+'/'+customer+'/'+item;
			$.ajax({ 
					url:url,
					type:"GET",
				}).done(function(response){
					obj.closest('tr').find('td .discount').val(response);
					calculation();
				});
		}

		else{
			alert('Please Select Customer');
			obj.val('').select2();
			return false;
		}	
		

		
		
	});			
	
	

    $("input[type='radio']").click(function(){
		var radioValue = $("input[name='invoicetype']:checked").val();
		if(radioValue == 'Cash'){
			$('#cashhide').addClass('hide');
		}else{ 
				$('#cashhide').removeClass('hide'); 
			}
			$('.item').die().live("change",function() { 
				var rate = $(this).find('option:selected').attr('rate');
				var cgst_ledger_id = $(this).find('option:selected').attr('cgst_ledger_id');
				var sgst_ledger_id = $(this).find('option:selected').attr('sgst_ledger_id');
				$(this).closest('tr').find('td .rate').val(rate);
				$(this).closest('tr').find('td .total_cgst').val(cgst_ledger_id);
				$(this).closest('tr').find('td .sgst_rate').val(sgst_ledger_id);
			});				
		
		else{ 
			$('#cashhide').removeClass('hide');
			
			$('.item').die().live("change",function() { 
				var rate = $(this).find('option:selected').attr('rate');
				var cgst_ledger_id = $(this).find('option:selected').attr('cgst_ledger_id');
				var sgst_ledger_id = $(this).find('option:selected').attr('sgst_ledger_id');
				$(this).closest('tr').find('td .rate').val(rate);
				$(this).closest('tr').find('td .total_cgst').val(cgst_ledger_id);
				$(this).closest('tr').find('td .sgst_rate').val(sgst_ledger_id);
				var customer = $(".cstmr").find('option:selected').val();
				var item = $(this).find('option:selected').val();
				var obj = $(this);
				var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'CustomerDiscount']);?>";
				if(customer != '')
				{
					url=url+'/'+customer+'/'+item;
					$.ajax({ 
							url:url,
							type:"GET",
						}).done(function(response){
							obj.closest('tr').find('td .discount').val(response);
							calculation();
						});
					}
				else{
					alert('Please Select Customer');
					obj.val('').select2();
					return false;
				}		
			});					
			
		}
    });
    	
});
</script>





<table id="sampleTbl" style="display:none;">
	<tbody>
		<tr class="mainTr">
			<td style="text-align:center;border-left: none;">
				<span class="sr"></span>
				<button type="button" class="btn btn-xs red viewThisResult" role="button"><i class="fa fa-times"></i></button>
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('item_id',['empty'=>"----select----",'options'=>$items,'label'=>false,'style'=>'width: 100%;resize: none;','class'=>'form-control input-sm item ']); ?>
			</td>
			<td class="hide form-group">
				<?php echo $this->Form->control('hsn_code',['label'=>false,'placeholder'=>'HSN code','style'=>'width: 100%;','class'=>'form-control input-sm ']); ?>
			</td>
			<td style="text-align:center;" class="form-group">
				<?php echo $this->Form->control('quantity',['label'=>false,'placeholder'=>'Qty','style'=>'width: 100%;text-align: center;','class'=>'form-control input-sm change_qty','value'=>1]); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('rate',['label'=>false,'placeholder'=>'Rate','style'=>'width: 100%;text-align: right;','class'=>'calculate form-control input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('amount',['label'=>false,'placeholder'=>'Amount','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('discount_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','class'=>'form-control discount input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('taxable_value',['label'=>false,'placeholder'=>'Taxable Value','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('total_cgst',['empty' => "---Select---",'label'=>false,'class'=>'form-control input-sm total_cgst','style'=>'width: 80px;border: none;text-align: right;','options'=>$taxs_CGST]); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('cgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('sgst_rate',['empty' => "---Select---",'label'=>false,'class'=>'form-control input-sm sgst_rate','style'=>'width: 80px;border: none;text-align: right;','options'=>$taxs_SGST]); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('sgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control input-sm']); ?>
			</td>
			<td style="text-align:right;border-right: none;">
				<?php echo $this->Form->control('total',['label'=>false,'placeholder'=>'Total','style'=>'width: 100%;text-align: right;','class'=>'revCalculate','class'=>'form-control rate input-sm']); ?>
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
<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js'); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'cssComponentsDropdowns']); ?>
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
