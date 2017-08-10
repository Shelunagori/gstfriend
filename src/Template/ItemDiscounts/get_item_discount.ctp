
	<table class=" table table-bordered table-hover" id='main_tbl' >
		<thead >
			<th >SR.NO.</th>
			<th>CUSTOMER NAME</th>
			<th>PRICE</th>
			<th>DISCOUNT</th>
		</thead>	
		<tbody >
			<?php 	$i=1; $j=0;
					
					foreach($customerLedgers as $customerLedger)
					{  
			?>
			<tr >
				<td><?= $this->Number->format($i++) ?>
					<?php echo $this->Form->control('item_discounts.'.$j.'.item_id', ['label' => false,'type'=>'hidden','class' => 'form-control input-sm item_hidden','placeholder'=>'Enter Item']); ?> 
				</td>
				<td>
					<?php echo $customerLedger->name; ?>
					<?php echo $this->Form->control('item_discounts.'.$j.'.customer_ledger_id',['label' => false,'type'=>'hidden','class' => 'form-control input-sm firstupercase','value'=>$customerLedger->id,'readonly']); ?>
				</td>
				<td>
					<?php echo $this->Form->control('item_discounts.'.$j.'.price',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase rate','placeholder'=>'Enter Price','readonly']); ?> 
				</td>
				<td >
					<?php echo $this->Form->control('item_discounts.'.$j.'.discount',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Discount','value'=>@$discount[$customerLedger->id]]); ?>
				</td>
			</tr>
			<?php $j++;	} ?>
		</tbody>
	</table>   
