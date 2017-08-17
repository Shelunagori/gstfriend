<?php $this->set('title','Dashboard | GST Friend'); ?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual">
				<i class="fa fa-comments"></i>
			</div>
			<div class="details">
				<div class="number">
					
				</div>
				<div class="desc">
					Purchase Report
				</div>
			</div>
	
			<?=  $this->Html->tag('li', $this->Html->link('View More<i class="m-icon-swapright m-icon-white"></i>', ['controller' => 'PurchaseInvoices', 'action' => 'index','class'=>'more'])); ?>
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
					 Invoice Report
				</div>
			</div>
			<a class="more" href="http://localhost/gstfriend/invoices">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	
</div>