<?php
/**
  * @var \App\View\AppView $this
  */
$this->set('title', 'Add');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form">
		<?= $this->Form->create($accountingGroup) ?>
		<fieldset>
			<legend><?= __('Add Accounting Group') ?></legend>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<!--<div class="form-group">
							<label class="control-label">Nature Of Group<span class="required" aria-required="true">*</span></label>--->
							
							<?php /* echo $this->Form->input('nature_of_group_id', ['options' => $natureOfGroups, 'empty' => true,'label' => false,'class' => 'form-control input-sm select2me']); */?>
						<!--</div>-->
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Parent</label>
							<?php echo $this->Form->control('parent_id', ['options' => $parentAccountingGroups, 'empty' => true ,'label' => false,'class' => 'form-control input-sm select2me']); ?>
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
