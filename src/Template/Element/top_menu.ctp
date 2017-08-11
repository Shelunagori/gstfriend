<div class="hor-menu hidden-sm hidden-xs">
	<ul class="nav navbar-nav">
		<!-- DOC: Remove data-hover="megadropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
		<li class="classic-menu-dropdown">
			<a data-toggle="dropdown" href="javascript:;" aria-expanded="false">
			Masters & Setup <i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu pull-left">
				<?php echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('Add New Item'), ['controller' => 'Items', 'action' => 'Add'], ['escape' => false])); ?>
				<?php echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('List Items'), ['controller' => 'Items', 'action' => 'Index'], ['escape' => false])); ?>
				<?php echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('Add New Customer'), ['controller' => 'Customers', 'action' => 'Add'], ['escape' => false])); ?>
				<?php echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('List Customers'), ['controller' => 'Customers', 'action' => 'Index'], ['escape' => false])); ?>
				<?php echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('Add New Supplier'), ['controller' => 'Suppliers', 'action' => 'Add'], ['escape' => false])); ?>
				<?php echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'Index'], ['escape' => false])); ?>
				<?php echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('Discount Screen'), ['controller' => 'ItemDiscounts', 'action' => 'Add'], ['escape' => false])); ?>
				
			</ul>
		</li>
	</ul>
</div>
