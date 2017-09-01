<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $logo
 * @property string $district
 * @property string $state
 * @property int $phone_no
 * @property int $freeze
 *
 * @property \App\Model\Entity\AccountingEntry[] $accounting_entries
 * @property \App\Model\Entity\AccountingGroup[] $accounting_groups
 * @property \App\Model\Entity\Customer[] $customers
 * @property \App\Model\Entity\Invoice[] $invoices
 * @property \App\Model\Entity\ItemDiscount[] $item_discounts
 * @property \App\Model\Entity\Item[] $items
 * @property \App\Model\Entity\Ledger[] $ledgers
 * @property \App\Model\Entity\PurchaseInvoice[] $purchase_invoices
 * @property \App\Model\Entity\PurchaseVoucher[] $purchase_vouchers
 * @property \App\Model\Entity\Supplier[] $suppliers
 * @property \App\Model\Entity\User[] $users
 */
class Company extends Entity
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
