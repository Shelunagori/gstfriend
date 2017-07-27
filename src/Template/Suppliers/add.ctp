<?php
$this->set('title', 'Add');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($supplier) ?>
		<fieldset>
			<legend><?= __('Add Supplier') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Supplier Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Mobile No.</label>
							<?php echo $this->Form->control('mobile',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Mobile No.']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Email</label>
							<?php echo $this->Form->control('email',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Email']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Address</label>
							<?php echo $this->Form->control('address',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Address']); ?> 
						</div>
						<div class="form-group">
							<?php echo $this->Form->control('freezed'); ?>
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