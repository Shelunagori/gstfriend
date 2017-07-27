<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Add');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form">
		<?= $this->Form->create($ledgerAccount) ?>
		<fieldset>
			<legend><?= __('Add Ledger Account') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Name']); ?>
						</div>
						<div class="form-group">
							<?php echo $this->Form->control('freezed'); ?>
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
		<div>
			<button type="submit" class="btn btn-primary">Submit
		</div>
		<?= $this->Form->end() ?>
	</div> 
</div>   
