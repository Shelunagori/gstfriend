<?php
$this->set('title', 'Edit');
?>
<div class="portlet light bordered" style="background-color:#f5f3f3">
	<div class="portlet-body-form"  >
		<div class="portlet-title">
			<div class="caption" >
				<legend><?= __('Edit supplier') ?></legend>
			</div>
		</div>
		<?= $this->Form->create($supplier) ?>
		<fieldset>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter supplier Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Mobile No.<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('mobile',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Mobile No.']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Email<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('email',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Email']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Address<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('address',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Address']); ?> 
						</div>
						<div class="form-group">
							<?php echo $this->Form->control('freezed'); ?>
						</div>
					
						<div class="form-group">
							<label class="control-label">Company Name<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('company_id',['options' => $companies ,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						</div>
					</div>
				</div> 
			</div>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>    