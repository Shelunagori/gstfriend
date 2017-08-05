<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ItemMaster $itemMaster
  */
  $this->set('title', 'View');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<h3><?= h($itemMaster->id) ?></h3>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label"><b>Item Name &nbsp: &nbsp</b></label>
							 <?= h($itemMaster->item->name) ?>
						</div>
						<div class="form-group">
							<label class="control-label"><b>Item Price &nbsp: &nbsp</b></label>
							<?= $this->Number->format($itemMaster->price) ?> 
						</div>
						<div class="form-group">
							<label class="control-label"><b>Cgst &nbsp: &nbsp</b></label>
							<?= h($itemMaster->cgst_ledger->name) ?>
						</div>
						<div class="form-group">
							<label class="control-label"><b>Sgst &nbsp: &nbsp</b></label>
							<?= h($itemMaster->sgst_ledger->name) ?>
						</div>
					</div>
				</div> 
			</div>
		
	</div>
</div> 

