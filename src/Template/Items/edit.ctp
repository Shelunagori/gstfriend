<?php
$this->set('title', 'Edit');
?>


<div class="box box-primary" >
	<div class="portlet-title">
		<div class="caption" >
			<legend><?= __('Edit Item') ?></legend>
		</div>
	</div>
	<?= $this->Form->create($item) ?>
	<fieldset>
		<div class="box-body" >
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Item Name']); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Hsn No.<span class="required" aria-required="true">*</span></label>
                        <?php echo $this->Form->control('hsn_code',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter HSN No.']); ?> 
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo $this->Form->control('freezed'); ?>
					</div>
                </div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo $this->Form->control('company_id', ['options' => $companies]); ?>
					</div>
                </div>
			</div> 
		</div>
	</fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>    