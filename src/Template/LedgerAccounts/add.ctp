<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Add');
?>
<div class="portlet light bordered" style="background-color:#f5f3f3">
	<div class="portlet-body-form">
		<?= $this->Form->create($ledgerAccount) ?>
		<fieldset>
			<legend><?= __('Add Ledger Account') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Hsn No.<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('hsn_code',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter HSN No.']); ?> 
						</div>
						<div class="form-group">
							<?php echo $this->Form->control('freezed'); ?>
						</div>
					
						<div class="form-group">
							<label class="control-label">Company Name<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('company_id',['options' => $companies ,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Supplier Name<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('supplier_id',['options' => $suppliers ,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Customer Name<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('customer_id',['options' => $customers ,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						</div>
					</div>
				</div> 
			</div>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div> 
</div>   
