<?php
$this->set('title', 'Edit');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($company , [ 'type' => 'file']) ?>
		<fieldset>
			<legend><?= __('Add Company') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Company Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Address </label>
							<?php echo $this->Form->control('address' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Address']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">District </label>
							<?php echo $this->Form->control('district' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter District']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">State </label>
							<?php echo $this->Form->control('state' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter State']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Phone No. </label>
							<?php echo $this->Form->control('phone_no' ,['type'=>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Phone No.']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Mobile No. </label>
							<?php echo $this->Form->control('mobile_no' ,['type'=>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Phone No.']); ?>
						</div>	
						<div class="form-group">
							<label class="control-label">GST No. </label>
							<?php echo $this->Form->control('gstno' ,['type'=>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter GST No.']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Exclusive LIC. No. </label>
							<?php echo $this->Form->control('exclusive_lic_no' ,['type'=>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Exc. LIC No.']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">DSO LIC. No. </label>
							<?php echo $this->Form->control('dso_lic_no' ,['type'=>'text','label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter DSO LIC No.']); ?>
						</div>	
						<div class="form-group">
							<label class="control-label">Upload Image</label>
							<?php echo $this->Form->input('logo', ['type' => 'file','label' => false]);?>
							<div><?php echo $this->Html->image('/company_logo/'.$company->logo, ['height' => '50px']); ?></div>
							<span class="help-block">Only JPG format is allowed </span>
						</div>
						<div class="form-group">
							<?php echo $this->Form->control('freezed', ['type' => 'checkbox']); ?>
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