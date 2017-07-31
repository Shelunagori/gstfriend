<?php
 //echo $this->Form->control('supplier_ledger_id');
 //echo $this->Form->control('purchase_ledger_id');
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Edit');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<div class="portlet-title">
			<div class="caption" >
				<legend><?= __('Edit Purchase Voucher') ?></legend>
			</div>
		</div>
		<?= $this->Form->create($purchaseVoucher) ?>
		<fieldset>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Voucher No<span class="required" aria-required="true">*</span></label>
							<?php  echo $this->Form->control('voucher_no',['label' => false,'class' => 'form-control input-sm ', 'placeholder'=>'Enter Voucher No.']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Supplier Name</label>
							<?php echo $this->Form->control('supplier_ledger_id',['options'=>$SupplierLedger,'label' => false,'class' => 'form-control input-sm select2me']);?>
						</div>
						<div class="form-group">
							<label class="control-label">Customer Name</label>
							<?php echo $this->Form->control('purchase_ledger_id',['options'=>$PurchaseLedger,'label' => false,'class' => 'form-control input-sm select2me']); ?>  
						</div>
						<div class="form-group">
							<label class="control-label">Transaction Date</label>
							<?php echo $this->Form->control('transaction_date', ['type' =>'text','label' => false,'class' => 'form-control input-sm date-picker' , 'data-date-format'=>'dd-mm-yyyy','placeholder'=>'D-M-Y']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Narration</label>
							<?php echo $this->Form->control('narration',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Narration']); ?>
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