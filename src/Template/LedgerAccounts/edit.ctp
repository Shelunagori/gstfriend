<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Edit');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<div class="portlet-title">
			<div class="caption" >
				<legend><?= __('Edit Ledger Account') ?></legend>
			</div>
		</div>
		<?= $this->Form->create($ledgerAccount) ?>
		<fieldset>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Name']); ?>
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
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>    