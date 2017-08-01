<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
if(!isset($active_menu))
{
    $active_menu = '';
}
?>
<?php
$activeClass = (($active_menu == 'Users.Dashboard')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('Dashboard'), ['controller' => 'Users', 'action' => 'Dashboard'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'PurchaseVouchers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Purchase Vouchers '), ['controller' => 'PurchaseVouchers', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'PurchaseVouchers.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Invoices.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Create Invoice'), ['controller' => 'Invoices', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Invoices.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Invoices'), ['controller' => 'Invoices', 'action' => 'Index'], ['escape' => false]), $activeClass);

echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-power-off"></i> '.__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]));
?>