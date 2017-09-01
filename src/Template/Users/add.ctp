<?php
$this->set('title', 'Add');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($user) ?>
		<fieldset>
			<legend><?= __('Add User') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter User Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">User Name </label>
							<?php echo $this->Form->control('username' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter username']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<?php echo $this->Form->control('password' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Password']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Mobile No </label>
							<?php echo $this->Form->control('mobile_no',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Mobile No.']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Email</label>
							<?php echo $this->Form->control('email', ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Email']); ?>
						</div>
						<div class="form-group">
						
							<label class="control-label">Under Company</label>
							<?php echo $this->Form->control('company_id', ['label' => false,'options' =>$company,'empty'=>'--Select--','class' => 'form-control input-sm firstupercase']); ?>
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