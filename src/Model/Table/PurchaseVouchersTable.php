<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
/**
 * PurchaseVouchers Model
 *
 * @property \App\Model\Table\SupplierLedgersTable|\Cake\ORM\Association\BelongsTo $SupplierLedgers
 * @property \App\Model\Table\PurchaseLedgersTable|\Cake\ORM\Association\BelongsTo $PurchaseLedgers
 * @property \App\Model\Table\CompaniesTable|\Cake\ORM\Association\BelongsTo $Companies
 * @property \App\Model\Table\AccountingEntriesTable|\Cake\ORM\Association\HasMany $AccountingEntries
 * @property \App\Model\Table\PurchaseVoucherRowsTable|\Cake\ORM\Association\HasMany $PurchaseVoucherRows
 *
 * @method \App\Model\Entity\PurchaseVoucher get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseVoucher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseVoucher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucher findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseVouchersTable extends Table
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

        $this->setTable('purchase_vouchers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
		/*Data Fetch To Third Table Use Binding Key Start*/
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
			'propertyName' => 'supplier_ledger',
		]);
		
		$this->belongsTo('SgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'sgst_ledger_id',
			'propertyName' => 'purchase_ledger',
		]);


		$this->belongsTo('IgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'igst_ledger_id',
			'propertyName' => 'purchase_ledger',
		]);		
		
		$this->belongsTo('Ledgers', [
            'foreignKey' => 'ledger_id',
            'joinType' => 'INNER'
        ]);
		/*Data Fetch To Third Table Use Bindin Key End*/
		
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('AccountingEntries', [
            'foreignKey' => 'purchase_voucher_id'
        ]);
        $this->hasMany('PurchaseVoucherRows', [
            'foreignKey' => 'purchase_voucher_id',
			'saveStrategy'=>'replace'
        ]);
		
		$this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
		
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
            ->integer('supplier_ledger_id')
            ->requirePresence('supplier_ledger_id', 'create')
            ->notEmpty('supplier_ledger_id');
		
        $validator
            ->date('transaction_date')
             ->allowEmpty('transaction_date');

        $validator
            ->requirePresence('narration', 'create')
            ->allowEmpty('narration');

        return $validator;
    }

	public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
	{
		$data['transaction_date'] = date('Y-m-d',strtotime($data['transaction_date']));
	}
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));
        //$rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}
