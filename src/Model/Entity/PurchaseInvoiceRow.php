<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseInvoiceRow Entity
 *
 * @property int $id
 * @property int $cgst_ledger_id
 * @property float $cgst_amount
 * @property int $sgst_ledger_id
 * @property float $sgst_amount
 * @property int $purchase_invoice_id
 *
 * @property \App\Model\Entity\CgstLedger $cgst_ledger
 * @property \App\Model\Entity\SgstLedger $sgst_ledger
 * @property \App\Model\Entity\PurchaseInvoice $purchase_invoice
 */
class PurchaseInvoiceRow extends Entity
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
