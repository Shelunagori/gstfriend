<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * PurchaseInvoices Model
 *
 * @method \App\Model\Entity\PurchaseInvoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseInvoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseInvoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseInvoicesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
		
		$this->belongsTo('SupplierLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'supplier_ledger_id',
			'propertyName' => 'supplier_ledger',
		]);
		
		$this->belongsTo('PurchaseLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'purchase_ledger_id',
			'propertyName' => 'purchase_ledger',
		]);
		
		$this->belongsTo('CgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'cgst_ledger_id',
			'propertyName' => 'cgst_ledger',
		]);
		
		$this->belongsTo('SgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'sgst_ledger_id',
			'propertyName' => 'sgst_ledger',
		]);

		$this->belongsTo('IgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'igst_ledger_id',
			'propertyName' => 'igst_ledger',
		]);			
		
		
		$this->belongsTo('Ledgers', [
            'foreignKey' => 'ledger_id',
            'joinType' => 'INNER'
        ]);
		
		$this->hasMany('AccountingEntries', [
			'foreignKey' => 'purchase_invoice_id'
        ]);
		
		$this->hasMany('PurchaseInvoiceRows', [
            'foreignKey' => 'purchase_invoice_id',
			'saveStrategy'=>'replace'
        ]);
		
		$this->belongsTo('TaxTypes');
		
		$this->belongsTo('Companies');

        $this->setTable('purchase_invoices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        

        $validator
            ->integer('invoice_no')
            ->requirePresence('invoice_no', 'create')
            ->notEmpty('invoice_no');
		
		return $validator;
    }
}
