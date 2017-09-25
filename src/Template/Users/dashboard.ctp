<?php $this->set('title','Dashboard | GST Friend'); ?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual">
				<i class="fa fa-shopping-cart"></i>
			</div>
			<div class="details">
				<div class="number">
					 
				</div>
				<div class="desc">
					 GST Report
				</div>
			</div>
			<?php echo $this->Html->link('View More<i class="m-icon-swapright m-icon-white"></i>',array('controller'=>'AccountingEntries','action'=>'index'),['escape'=>false,'class'=>'more']); ?>
		</div>	
	</div>
	
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual">
				<i class="fa fa-bar-chart-o"></i>
			</div>
			<div class="details">
				<div class="number">
					
				</div>
				<div class="desc">
					 Sale Invoice Report
				</div>
			</div>
			
				<?php echo $this->Html->link('View More<i class=""m-icon-swapright m-icon-white"></i>',array('controller'=>'Invoices','action'=>'index'),['escape'=>false,'class'=>'more']); ?>			
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual">
				<i class="fa fa-comments"></i>
			</div>
			<div class="details">
				<div class="number">
					
				</div>
				<div class="desc">
					Purchase Invoice Report
				</div>
			</div>
				<?php echo $this->Html->link('View More<i class="m-icon-swapright m-icon-white"></i>',array('controller'=>'PurchaseVouchers','action'=>'index'),['escape'=>false,'class'=>'more']); ?>
		</div>
	</div>
	
</div>