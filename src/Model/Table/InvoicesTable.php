<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
/**
 * Invoices Model
 *
 * @property \App\Model\Table\CustomerLedgersTable|\Cake\ORM\Association\BelongsTo $CustomerLedgers
 * @property \App\Model\Table\SalesLedgersTable|\Cake\ORM\Association\BelongsTo $SalesLedgers
 * @property \App\Model\Table\InvoiceRowsTable|\Cake\ORM\Association\HasMany $InvoiceRows
 *
 * @method \App\Model\Entity\Invoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Invoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Invoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Invoice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoicesTable extends Table
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

        $this->setTable('invoices');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

		$this->belongsTo('AccountingEntries');
        
		$this->belongsTo('CustomerLedgers', [
			'className' => 'Ledgers',
			'foreignKey' => 'customer_ledger_id',
			'propertyName' => 'customer_ledgers',
		]);
		$this->belongsTo('SalesLedgers', [
			'className' => 'Ledgers',
			'foreignKey' => 'sales_ledger_id',
			'propertyName' => 'sales_ledgers',
		]);
		
		$this->belongsTo('CgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'cgst_rate',
			'propertyName' => 'cgst_ledger',
		]);
		
		$this->belongsTo('SgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'sgst_rate',
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
		
		
		$this->belongsTo('Companies');		
		
        $this->hasMany('InvoiceRows', [
            'foreignKey' => 'invoice_id',
			'saveStrategy'=>'replace'
        ]);
    }

	/* public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options) {
		$data['transaction_date'] = date('Y-m-d',strtotime($data['transaction_date']));
	} */
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

   

        $validator
            ->decimal('total_amount_before_tax')
            ->requirePresence('total_amount_before_tax', 'create')
            ->notEmpty('total_amount_before_tax');

        $validator
            ->decimal('total_cgst')
            ->requirePresence('total_cgst', 'create')
            ->notEmpty('total_cgst');

        $validator
            ->decimal('total_sgst')
            ->requirePresence('total_sgst', 'create')
            ->notEmpty('total_sgst');

        $validator
            ->decimal('total_amount_after_tax')
            ->requirePresence('total_amount_after_tax', 'create')
            ->notEmpty('total_amount_after_tax');

        return $validator;
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
        $rules->add($rules->existsIn(['customer_ledger_id'], 'CustomerLedgers'));
        $rules->add($rules->existsIn(['sales_ledger_id'], 'SalesLedgers'));

        return $rules;
    }
}
