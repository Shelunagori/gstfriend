<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $id
 * @property int $invoice_no
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property int $customer_ledger_id
 * @property int $sales_ledger_id
 * @property float $total_amount_before_tax
 * @property float $total_cgst
 * @property float $total_sgst
 * @property float $total_amount_after_tax
 *
 * @property \App\Model\Entity\CustomerLedger $customer_ledger
 * @property \App\Model\Entity\SalesLedger $sales_ledger
 * @property \App\Model\Entity\InvoiceRow[] $invoice_rows
 */
class Invoice extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
