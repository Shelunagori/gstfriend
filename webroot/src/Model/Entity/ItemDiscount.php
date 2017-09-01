<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemDiscount Entity
 *
 * @property int $id
 * @property int $customer_ledger_id
 * @property int $item_id
 * @property float $discount
 *
 * @property \App\Model\Entity\CustomerLedger $customer_ledger
 * @property \App\Model\Entity\Item $item
 */
class ItemDiscount extends Entity
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
