<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ItemDiscount $itemDiscount
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Discount'), ['action' => 'edit', $itemDiscount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Discount'), ['action' => 'delete', $itemDiscount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemDiscount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Discounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Discount'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemDiscounts view large-9 medium-8 columns content">
    <h3><?= h($itemDiscount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $itemDiscount->has('item') ? $this->Html->link($itemDiscount->item->name, ['controller' => 'Items', 'action' => 'view', $itemDiscount->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemDiscount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Ledger Id') ?></th>
            <td><?= $this->Number->format($itemDiscount->customer_ledger_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount') ?></th>
            <td><?= $this->Number->format($itemDiscount->discount) ?></td>
        </tr>
    </table>
</div>
