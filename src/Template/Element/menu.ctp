<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-plus-square']).'Add Item', '/Items/Add',['escape' => false]).'</li>'; 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-list-alt']).'List Item', '/Items/index',['escape' => false]).'</li>'; 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-pencil-alt']).'Edit Item', '/Items/edit',['escape' => false]).'</li>';
?>