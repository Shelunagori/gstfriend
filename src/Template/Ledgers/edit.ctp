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
				<legend><?= __('Edit Ledger') ?></legend>
			</div>
		</div>
		<?= $this->Form->create($ledger) ?>
		<fieldset>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Name</label>
							<?php echo $this->Form->control('name',['label' => false,'class' => 'form-control input-sm ', 'placeholder'=>'Enter Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Account Group <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('accounting_group_id', ['options' => $accountingGroups, 'empty' => true ,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						</div>
						<div class="form-group">
							<?php echo $this->Form->control('freezed',['type'=>'checkbox']); ?>
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