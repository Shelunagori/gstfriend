<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseInvoice Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property int $invoice_no
 * @property float $base_amount
 * @property float $cgst
 * @property float $sgst
 * @property float $total
 */
class PurchaseInvoice extends Entity
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
