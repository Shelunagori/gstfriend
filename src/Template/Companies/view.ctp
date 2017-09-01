<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Company $company
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Accounting Entries'), ['controller' => 'AccountingEntries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accounting Entry'), ['controller' => 'AccountingEntries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Accounting Groups'), ['controller' => 'AccountingGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accounting Group'), ['controller' => 'AccountingGroups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Discounts'), ['controller' => 'ItemDiscounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Discount'), ['controller' => 'ItemDiscounts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ledgers'), ['controller' => 'Ledgers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ledger'), ['controller' => 'Ledgers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Invoices'), ['controller' => 'PurchaseInvoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Invoice'), ['controller' => 'PurchaseInvoices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['controller' => 'PurchaseVouchers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companies view large-9 medium-8 columns content">
    <h3><?= h($company->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($company->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?= h($company->logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('District') ?></th>
            <td><?= h($company->district) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($company->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($company->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone No') ?></th>
            <td><?= $this->Number->format($company->phone_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freeze') ?></th>
            <td><?= $this->Number->format($company->freeze) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($company->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Accounting Entries') ?></h4>
        <?php if (!empty($company->accounting_entries)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Ledger Id') ?></th>
                <th scope="col"><?= __('Debit') ?></th>
                <th scope="col"><?= __('Credit') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Purchase Voucher Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Invoice Id') ?></th>
                <th scope="col"><?= __('Purchase Invoice Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->accounting_entries as $accountingEntries): ?>
            <tr>
                <td><?= h($accountingEntries->id) ?></td>
                <td><?= h($accountingEntries->ledger_id) ?></td>
                <td><?= h($accountingEntries->debit) ?></td>
                <td><?= h($accountingEntries->credit) ?></td>
                <td><?= h($accountingEntries->transaction_date) ?></td>
                <td><?= h($accountingEntries->purchase_voucher_id) ?></td>
                <td><?= h($accountingEntries->company_id) ?></td>
                <td><?= h($accountingEntries->invoice_id) ?></td>
                <td><?= h($accountingEntries->purchase_invoice_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AccountingEntries', 'action' => 'view', $accountingEntries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AccountingEntries', 'action' => 'edit', $accountingEntries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AccountingEntries', 'action' => 'delete', $accountingEntries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountingEntries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Accounting Groups') ?></h4>
        <?php if (!empty($company->accounting_groups)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nature Of Group Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->accounting_groups as $accountingGroups): ?>
            <tr>
                <td><?= h($accountingGroups->id) ?></td>
                <td><?= h($accountingGroups->nature_of_group_id) ?></td>
                <td><?= h($accountingGroups->name) ?></td>
                <td><?= h($accountingGroups->parent_id) ?></td>
                <td><?= h($accountingGroups->lft) ?></td>
                <td><?= h($accountingGroups->rght) ?></td>
                <td><?= h($accountingGroups->company_id) ?></td>
                <td><?= h($accountingGroups->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AccountingGroups', 'action' => 'view', $accountingGroups->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AccountingGroups', 'action' => 'edit', $accountingGroups->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AccountingGroups', 'action' => 'delete', $accountingGroups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountingGroups->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Customers') ?></h4>
        <?php if (!empty($company->customers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('Freezed') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Gstno') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->customers as $customers): ?>
            <tr>
                <td><?= h($customers->id) ?></td>
                <td><?= h($customers->name) ?></td>
                <td><?= h($customers->mobile) ?></td>
                <td><?= h($customers->email) ?></td>
                <td><?= h($customers->address) ?></td>
                <td><?= h($customers->state) ?></td>
                <td><?= h($customers->freezed) ?></td>
                <td><?= h($customers->company_id) ?></td>
                <td><?= h($customers->gstno) ?></td>
                <td><?= h($customers->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Customers', 'action' => 'view', $customers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Customers', 'action' => 'edit', $customers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Customers', 'action' => 'delete', $customers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($company->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Invoice No') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Customer Ledger Id') ?></th>
                <th scope="col"><?= __('Customer Name') ?></th>
                <th scope="col"><?= __('Sales Ledger Id') ?></th>
                <th scope="col"><?= __('Total Amount Before Tax') ?></th>
                <th scope="col"><?= __('Total Cgst') ?></th>
                <th scope="col"><?= __('Total Sgst') ?></th>
                <th scope="col"><?= __('Total Igst') ?></th>
                <th scope="col"><?= __('Total Amount After Tax') ?></th>
                <th scope="col"><?= __('Invoicetype') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->id) ?></td>
                <td><?= h($invoices->invoice_no) ?></td>
                <td><?= h($invoices->transaction_date) ?></td>
                <td><?= h($invoices->customer_ledger_id) ?></td>
                <td><?= h($invoices->customer_name) ?></td>
                <td><?= h($invoices->sales_ledger_id) ?></td>
                <td><?= h($invoices->total_amount_before_tax) ?></td>
                <td><?= h($invoices->total_cgst) ?></td>
                <td><?= h($invoices->total_sgst) ?></td>
                <td><?= h($invoices->total_igst) ?></td>
                <td><?= h($invoices->total_amount_after_tax) ?></td>
                <td><?= h($invoices->invoicetype) ?></td>
                <td><?= h($invoices->status) ?></td>
                <td><?= h($invoices->company_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Item Discounts') ?></h4>
        <?php if (!empty($company->item_discounts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Ledger Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Discount') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->item_discounts as $itemDiscounts): ?>
            <tr>
                <td><?= h($itemDiscounts->id) ?></td>
                <td><?= h($itemDiscounts->customer_ledger_id) ?></td>
                <td><?= h($itemDiscounts->item_id) ?></td>
                <td><?= h($itemDiscounts->discount) ?></td>
                <td><?= h($itemDiscounts->company_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemDiscounts', 'action' => 'view', $itemDiscounts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemDiscounts', 'action' => 'edit', $itemDiscounts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemDiscounts', 'action' => 'delete', $itemDiscounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemDiscounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($company->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Hsn Code') ?></th>
                <th scope="col"><?= __('Freezed') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Cgst Ledger Id') ?></th>
                <th scope="col"><?= __('Sgst Ledger Id') ?></th>
                <th scope="col"><?= __('Igst Ledger Id') ?></th>
                <th scope="col"><?= __('Tax Type Id') ?></th>
                <th scope="col"><?= __('Input Cgst Ledger Id') ?></th>
                <th scope="col"><?= __('Input Sgst Ledger Id') ?></th>
                <th scope="col"><?= __('Input Igst Ledger Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->items as $items): ?>
            <tr>
                <td><?= h($items->id) ?></td>
                <td><?= h($items->name) ?></td>
                <td><?= h($items->hsn_code) ?></td>
                <td><?= h($items->freezed) ?></td>
                <td><?= h($items->company_id) ?></td>
                <td><?= h($items->price) ?></td>
                <td><?= h($items->cgst_ledger_id) ?></td>
                <td><?= h($items->sgst_ledger_id) ?></td>
                <td><?= h($items->igst_ledger_id) ?></td>
                <td><?= h($items->tax_type_id) ?></td>
                <td><?= h($items->input_cgst_ledger_id) ?></td>
                <td><?= h($items->input_sgst_ledger_id) ?></td>
                <td><?= h($items->input_igst_ledger_id) ?></td>
                <td><?= h($items->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ledgers') ?></h4>
        <?php if (!empty($company->ledgers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Accounting Group Id') ?></th>
                <th scope="col"><?= __('Freeze') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Supplier Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Tax Percentage') ?></th>
                <th scope="col"><?= __('Gst Type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->ledgers as $ledgers): ?>
            <tr>
                <td><?= h($ledgers->id) ?></td>
                <td><?= h($ledgers->name) ?></td>
                <td><?= h($ledgers->accounting_group_id) ?></td>
                <td><?= h($ledgers->freeze) ?></td>
                <td><?= h($ledgers->company_id) ?></td>
                <td><?= h($ledgers->supplier_id) ?></td>
                <td><?= h($ledgers->customer_id) ?></td>
                <td><?= h($ledgers->tax_percentage) ?></td>
                <td><?= h($ledgers->gst_type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ledgers', 'action' => 'view', $ledgers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ledgers', 'action' => 'edit', $ledgers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ledgers', 'action' => 'delete', $ledgers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ledgers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Purchase Invoices') ?></h4>
        <?php if (!empty($company->purchase_invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Invoice No') ?></th>
                <th scope="col"><?= __('Supplier Ledger Id') ?></th>
                <th scope="col"><?= __('Base Amount') ?></th>
                <th scope="col"><?= __('Total Cgst') ?></th>
                <th scope="col"><?= __('Total Sgst') ?></th>
                <th scope="col"><?= __('Total Igst') ?></th>
                <th scope="col"><?= __('Total') ?></th>
                <th scope="col"><?= __('Purchase Ledger Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->purchase_invoices as $purchaseInvoices): ?>
            <tr>
                <td><?= h($purchaseInvoices->id) ?></td>
                <td><?= h($purchaseInvoices->transaction_date) ?></td>
                <td><?= h($purchaseInvoices->invoice_no) ?></td>
                <td><?= h($purchaseInvoices->supplier_ledger_id) ?></td>
                <td><?= h($purchaseInvoices->base_amount) ?></td>
                <td><?= h($purchaseInvoices->total_cgst) ?></td>
                <td><?= h($purchaseInvoices->total_sgst) ?></td>
                <td><?= h($purchaseInvoices->total_igst) ?></td>
                <td><?= h($purchaseInvoices->total) ?></td>
                <td><?= h($purchaseInvoices->purchase_ledger_id) ?></td>
                <td><?= h($purchaseInvoices->company_id) ?></td>
                <td><?= h($purchaseInvoices->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseInvoices', 'action' => 'view', $purchaseInvoices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseInvoices', 'action' => 'edit', $purchaseInvoices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseInvoices', 'action' => 'delete', $purchaseInvoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseInvoices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Purchase Vouchers') ?></h4>
        <?php if (!empty($company->purchase_vouchers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Voucher No') ?></th>
                <th scope="col"><?= __('Reference No') ?></th>
                <th scope="col"><?= __('Supplier Ledger Id') ?></th>
                <th scope="col"><?= __('Purchase Ledger Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Narration') ?></th>
                <th scope="col"><?= __('Total Amount Before Tax') ?></th>
                <th scope="col"><?= __('Total Cgst') ?></th>
                <th scope="col"><?= __('Total Sgst') ?></th>
                <th scope="col"><?= __('Total Igst') ?></th>
                <th scope="col"><?= __('Total Amount After Tax') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->purchase_vouchers as $purchaseVouchers): ?>
            <tr>
                <td><?= h($purchaseVouchers->id) ?></td>
                <td><?= h($purchaseVouchers->voucher_no) ?></td>
                <td><?= h($purchaseVouchers->reference_no) ?></td>
                <td><?= h($purchaseVouchers->supplier_ledger_id) ?></td>
                <td><?= h($purchaseVouchers->purchase_ledger_id) ?></td>
                <td><?= h($purchaseVouchers->transaction_date) ?></td>
                <td><?= h($purchaseVouchers->narration) ?></td>
                <td><?= h($purchaseVouchers->total_amount_before_tax) ?></td>
                <td><?= h($purchaseVouchers->total_cgst) ?></td>
                <td><?= h($purchaseVouchers->total_sgst) ?></td>
                <td><?= h($purchaseVouchers->total_igst) ?></td>
                <td><?= h($purchaseVouchers->total_amount_after_tax) ?></td>
                <td><?= h($purchaseVouchers->company_id) ?></td>
                <td><?= h($purchaseVouchers->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseVouchers', 'action' => 'view', $purchaseVouchers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseVouchers', 'action' => 'edit', $purchaseVouchers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseVouchers', 'action' => 'delete', $purchaseVouchers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseVouchers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Suppliers') ?></h4>
        <?php if (!empty($company->suppliers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('Freezed') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Gstno') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->suppliers as $suppliers): ?>
            <tr>
                <td><?= h($suppliers->id) ?></td>
                <td><?= h($suppliers->name) ?></td>
                <td><?= h($suppliers->mobile) ?></td>
                <td><?= h($suppliers->email) ?></td>
                <td><?= h($suppliers->address) ?></td>
                <td><?= h($suppliers->state) ?></td>
                <td><?= h($suppliers->freezed) ?></td>
                <td><?= h($suppliers->company_id) ?></td>
                <td><?= h($suppliers->gstno) ?></td>
                <td><?= h($suppliers->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Suppliers', 'action' => 'view', $suppliers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Suppliers', 'action' => 'edit', $suppliers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Suppliers', 'action' => 'delete', $suppliers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suppliers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($company->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Mobile No') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Otp') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->name) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->company_id) ?></td>
                <td><?= h($users->mobile_no) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->otp) ?></td>
                <td><?= h($users->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
