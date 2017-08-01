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

$activeClass = (($active_menu == 'Items.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Item'), ['controller' => 'Items', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Items.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Items'), ['controller' => 'Items', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Suppliers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Supplier'), ['controller' => 'Suppliers', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Suppliers.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Customers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Customer'), ['controller' => 'Customers', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Customers.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Customers'), ['controller' => 'Customers', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'AccountingGroups.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Account Group'), ['controller' => 'AccountingGroups', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'AccountingGroups.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Account Groups'), ['controller' => 'AccountingGroups', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Ledgers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Ledger'), ['controller' => 'Ledgers', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Ledgers.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Ledgers'), ['controller' => 'Ledgers', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'PurchaseVouchers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Invoices.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Invoice Vouchers'), ['controller' => 'Invoices', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Invoices.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Invoices'), ['controller' => 'Invoices', 'action' => 'Index'], ['escape' => false]), $activeClass);

echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-power-off"></i> '.__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]));
?>