<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $id
 * @property int $invoice_no
 * @property \Cake\I18n\FrozenDate $invoice_date
 * @property string $state
 * @property string $party_name
 * @property string $party_address
 * @property string $party_mobile
 * @property string $party_state
 * @property string $party_gst
 * @property float $total_amount_before_tax
 * @property float $total_cgst
 * @property float $total_sgst
 * @property float $total_amount_after_tax
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
